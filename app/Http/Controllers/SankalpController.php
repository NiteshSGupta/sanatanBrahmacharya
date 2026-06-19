<?php

namespace App\Http\Controllers;

use App\Models\Sankalp;
use App\Models\SankalpCheckin;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class SankalpController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        $activeSankalps = $user->sankalps()
            ->where('is_active', true)
            ->with('checkins')
            ->latest()
            ->get();

        // Calculate checkins dictionary for each
        foreach ($activeSankalps as $sankalp) {
            $checkinsMap = [];
            foreach ($sankalp->checkins as $checkin) {
                $checkinsMap[$checkin->checkin_date->format('Y-m-d')] = clone $checkin;
            }
            $sankalp->checkins_map = $checkinsMap;
        }

        return Inertia::render('Dincharya', [
            'activeSankalps' => $activeSankalps
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titles' => 'required|array|min:1',
            'titles.*' => 'required|string|max:255',
            'duration_days' => 'required|integer|in:7,21,40,90',
        ]);

        $user = $request->user();

        foreach ($request->titles as $title) {
            $user->sankalps()->create([
                'title' => $title,
                'duration_days' => $request->duration_days,
                'start_date' => Carbon::today(),
                'is_active' => true,
            ]);
        }

        return redirect()->route('dincharya')->with('success', 'Sankalps created successfully!');
    }

    public function checkin(Request $request, Sankalp $sankalp)
    {
        // Ensure user owns this sankalp
        if ($sankalp->user_id !== $request->user()->id) {
            abort(403);
        }

        $request->validate([
            'date' => 'required|date',
        ]);

        $date = Carbon::parse($request->date)->format('Y-m-d');

        // Toggle checkin
        $checkin = SankalpCheckin::where('sankalp_id', $sankalp->id)
            ->where('checkin_date', $date)
            ->first();

        if ($checkin) {
            $checkin->delete();
        } else {
            SankalpCheckin::create([
                'sankalp_id' => $sankalp->id,
                'checkin_date' => $date,
                'is_completed' => true,
            ]);
        }

        return redirect()->route('dincharya');
    }
}
