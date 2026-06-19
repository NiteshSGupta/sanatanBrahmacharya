<script setup>
import { Link, usePage } from '@inertiajs/vue3';

// Access authenticated user
const user = usePage().props.auth.user;
</script>

<template>
    <div class="antialiased font-sans min-h-screen flex flex-col items-center pb-20 bg-[#fcfbf9] text-gray-900">
        <!-- Top Navigation -->
        <nav class="w-full max-w-2xl px-6 pt-[env(safe-area-inset-top)] py-4 flex justify-between items-center z-10 sticky top-0 bg-[#fcfbf9]/90 backdrop-blur-md mt-2">
            <div class="flex items-center gap-2">
                <Link :href="route('dashboard')" class="flex items-center gap-2">
                    <div class="w-12 h-12 bg-saffron-100 rounded-3xl flex items-center justify-center text-saffron-600">
                        <i class="fa-solid fa-om text-xl"></i>
                    </div>
                    <h1 class="text-xl font-bold tracking-tight text-saffron-900">
                        Ojas
                    </h1>
                </Link>
            </div>
            
            <div class="flex items-center gap-4">
                <!-- Links to other pages will go here -->
                <Link :href="route('profile.edit')" class="text-gray-500 hover:text-saffron-700 transition">
                    <i class="fa-solid fa-gear text-lg"></i>
                </Link>
            </div>
        </nav>

        <!-- Main Content (Page Injection) -->
        <main class="page-content w-full max-w-2xl px-4 flex flex-col gap-8 mt-4">
            <slot />
        </main>

        <!-- Bottom Navigation -->
        <div class="fixed bottom-0 left-0 w-full z-40 bg-gradient-to-t from-[#fcfbf9] via-[#fcfbf9] to-transparent pt-8">
            <div class="max-w-2xl mx-auto px-4 pb-[env(safe-area-inset-bottom)]">
                <div class="glass-panel rounded-3xl mb-4 px-6 py-3 flex justify-around items-center shadow-xl border border-white/40 relative overflow-hidden">
                    
                    <Link :href="route('dashboard')" :class="['nav-item relative flex flex-col items-center font-medium transition', route().current('dashboard') ? 'text-saffron-600' : 'text-gray-400']">
                        <i class="fa-solid fa-house text-lg mb-1"></i>
                        <span class="text-xs">Home</span>
                    </Link>

                    <Link :href="route('dincharya')" :class="['nav-item relative flex flex-col items-center font-medium transition', route().current('dincharya') ? 'text-saffron-600' : 'text-gray-400']">
                        <i class="fa-solid fa-book-open text-lg mb-1"></i>
                        <span class="text-xs">Dincharya</span>
                    </Link>

                </div>
            </div>
        </div>
    </div>
</template>

<style>
body {
    background-color: #fcfbf9;
}

.glass-panel {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow:
        0 4px 6px -1px rgba(0, 0, 0, 0.05),
        0 2px 4px -1px rgba(0, 0, 0, 0.03);
}

/* Hide scrollbar for clean UI */
::-webkit-scrollbar {
    display: none;
}
</style>
