<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex items-center justify-center px-6 relative bg-[#fcfbf9] overflow-hidden">
        <!-- Subtle OM Background -->
        <div class="om-symbol select-none pointer-events-none text-[220px] text-saffron-500/5 absolute">ॐ</div>

        <!-- Glass Card -->
        <div class="glass-panel w-full max-w-md rounded-3xl p-10 relative z-10">
            <slot />
        </div>
    </div>
</template>

<style scoped>
.glass-panel {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow:
        0 4px 6px -1px rgba(0, 0, 0, 0.05),
        0 2px 4px -1px rgba(0, 0, 0, 0.03);
}

.om-symbol {
    animation: rotateOm 50s linear infinite;
}

@keyframes rotateOm {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}
</style>
