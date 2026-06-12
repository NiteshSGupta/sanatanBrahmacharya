<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    username: '',
    gender: 'male',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register | Ojas" />

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-14 h-14 bg-saffron-100 rounded-3xl flex items-center justify-center mx-auto text-saffron-600 mb-4">
                <i class="fa-solid fa-seedling text-xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-saffron-900 tracking-tight">
                Begin Your Journey
            </h1>
            <p class="text-gray-500 text-sm mt-2">
                Create your sacred discipline account
            </p>
        </div>

        <!-- Form -->
        <form @submit.prevent="submit" class="space-y-5">
            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                <div class="relative">
                    <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input
                        type="text"
                        v-model="form.name"
                        placeholder="Enter your full name"
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-saffron-500 focus:border-saffron-500 outline-none transition"
                        required
                        autofocus
                    />
                </div>
                <div v-if="form.errors.name" class="text-red-500 text-xs mt-1">{{ form.errors.name }}</div>
            </div>

            <!-- Username -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                <div class="relative">
                    <i class="fa-solid fa-at absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input
                        type="text"
                        v-model="form.username"
                        placeholder="Choose a username"
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-saffron-500 focus:border-saffron-500 outline-none transition"
                        required
                    />
                </div>
                <div v-if="form.errors.username" class="text-red-500 text-xs mt-1">{{ form.errors.username }}</div>
            </div>

            <!-- Gender -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">Gender</label>
                <div class="flex gap-3">
                    <label class="flex-1 cursor-pointer">
                        <input
                            type="radio"
                            name="gender"
                            value="male"
                            v-model="form.gender"
                            class="hidden peer"
                        />
                        <div class="py-3 text-center rounded-xl border border-gray-300 peer-checked:bg-saffron-500 peer-checked:text-white peer-checked:border-saffron-500 transition">
                            Male
                        </div>
                    </label>

                    <label class="flex-1 cursor-pointer">
                        <input
                            type="radio"
                            name="gender"
                            value="female"
                            v-model="form.gender"
                            class="hidden peer"
                        />
                        <div class="py-3 text-center rounded-xl border border-gray-300 peer-checked:bg-saffron-500 peer-checked:text-white peer-checked:border-saffron-500 transition">
                            Female
                        </div>
                    </label>
                </div>
                <!-- Note: Gender needs to be added to user migration later -->
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input
                        type="password"
                        v-model="form.password"
                        placeholder="Create a password"
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-saffron-500 focus:border-saffron-500 outline-none transition"
                        required
                    />
                </div>
                <div v-if="form.errors.password" class="text-red-500 text-xs mt-1">{{ form.errors.password }}</div>
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input
                        type="password"
                        v-model="form.password_confirmation"
                        placeholder="Confirm your password"
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-saffron-500 focus:border-saffron-500 outline-none transition"
                        required
                    />
                </div>
                <div v-if="form.errors.password_confirmation" class="text-red-500 text-xs mt-1">{{ form.errors.password_confirmation }}</div>
            </div>

            <!-- Button -->
            <button
                type="submit"
                :disabled="form.processing"
                class="w-full mt-6 bg-saffron-600 text-white font-semibold py-3 rounded-xl hover:bg-saffron-700 transition shadow-lg shadow-saffron-200 disabled:opacity-50"
            >
                <span v-if="form.processing">Registering...</span>
                <span v-else>Register</span>
            </button>
        </form>

        <div class="mt-6 text-center text-sm">
            <span class="text-gray-500">Already have an account?</span>
            <Link :href="route('login')" class="text-saffron-600 font-semibold ml-1 hover:underline">Log in</Link>
        </div>

        <!-- Footer -->
        <p class="text-xs text-gray-400 text-center mt-8">
            Power is built through daily discipline.
        </p>
    </GuestLayout>
</template>
