<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female',
            'age' => 'required|integer|min:1',
            'username' => 'required|string|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 1. Require Internet for Registration - Ping the main server
        try {
            $response = \Illuminate\Support\Facades\Http::timeout(5)->post(config('services.central_server.url') . '/api/sync', [
                'uuid' => $request->username,
                'name' => $request->name,
                'phone' => null,
                'gender' => $request->gender,
                'age' => $request->age,
                'device_info' => 'Mobile',
                'date' => now()->toDateString()
            ]);

            if (!$response->successful()) {
                throw ValidationException::withMessages([
                    'username' => 'Failed to connect to the central server. Please try again later.',
                ]);
            }
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'username' => 'An active internet connection is required to register. Please connect and try again.',
            ]);
        }

        // 2. Create the user locally only if the internet check passed
        $user = User::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'age' => $request->age,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Login with "Remember Me" set to true to stay logged in permanently
        Auth::login($user, true);

        return redirect(route('dashboard', absolute: false));
    }
}
