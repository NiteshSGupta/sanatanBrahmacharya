<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    username: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Login | Ojas" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <!-- Logo / Heading -->
        <div class="text-center mb-8">
            <div class="w-14 h-14 bg-saffron-100 rounded-3xl flex items-center justify-center mx-auto text-saffron-600 mb-4">
                <i class="fa-solid fa-om text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-saffron-900 tracking-tight">
                Welcome Back
            </h1>
            <p class="text-gray-500 text-sm mt-2">
                Continue your Brahmacharya journey
            </p>
        </div>

        <!-- Login Form -->
        <form @submit.prevent="submit" class="space-y-6">
            <!-- Username Field -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Username
                </label>
                <div class="relative">
                    <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input
                        id="username"
                        type="text"
                        v-model="form.username"
                        placeholder="Enter your username"
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-saffron-500 focus:border-saffron-500 outline-none transition"
                        required
                        autofocus
                        autocomplete="username"
                    />
                </div>
                <div v-if="form.errors.username" class="text-red-500 text-xs mt-1">{{ form.errors.username }}</div>
            </div>

            <!-- Password Field -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Password
                </label>
                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input
                        id="password"
                        type="password"
                        v-model="form.password"
                        placeholder="Enter your password"
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-saffron-500 focus:border-saffron-500 outline-none transition"
                        required
                        autocomplete="current-password"
                    />
                </div>
                <div v-if="form.errors.password" class="text-red-500 text-xs mt-1">{{ form.errors.password }}</div>
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center text-sm text-gray-600">
                    <input type="checkbox" v-model="form.remember" class="rounded text-saffron-600 focus:ring-saffron-500 border-gray-300 mr-2">
                    Remember me
                </label>

                <Link v-if="canResetPassword" :href="route('password.request')" class="text-sm text-saffron-600 hover:text-saffron-700 transition">
                    Forgot Password?
                </Link>
            </div>

            <!-- Login Button -->
            <button
                type="submit"
                :disabled="form.processing"
                class="w-full bg-saffron-600 text-white font-semibold py-3 rounded-xl hover:bg-saffron-700 transition shadow-lg shadow-saffron-200 disabled:opacity-50"
            >
                <span v-if="form.processing">Logging in...</span>
                <span v-else>Enter</span>
            </button>
        </form>

        <div class="mt-6 text-center text-sm">
            <span class="text-gray-500">Don't have an account?</span>
            <Link :href="route('register')" class="text-saffron-600 font-semibold ml-1 hover:underline">Register here</Link>
        </div>

        <!-- Footer -->
        <p class="text-xs text-gray-400 text-center mt-8">
            Discipline builds power. Power builds character.
        </p>
    </GuestLayout>
</template>
