<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted, computed } from 'vue';

const isJourneyStarted = ref(false);
const journeyStart = ref(null);
const goalDays = 90;

const daysCount = ref(0);
const hoursCount = ref('00');
const minutesCount = ref('00');
const secondsCount = ref('00');
const progressOffset = ref(339.292); // initial offset for SVG circle
const achievedMilestones = ref(new Set());
let timerInterval = null;

// Quotes
const quotes = [
    { text: "The chaste brain has tremendous energy and gigantic willpower. Without chastity there can be no spiritual strength.", author: "Swami Vivekananda" },
    { text: "By the establishment of continence, energy is gained.", author: "Patanjali, Yoga Sutras" },
    { text: "He who is regulated in his habits of eating, sleeping, recreation and work can mitigate all material pains by practicing the yoga system.", author: "Bhagavad Gita" }
];
const currentQuoteIndex = ref(0);
const currentQuote = computed(() => quotes[currentQuoteIndex.value]);

const nextQuote = () => {
    currentQuoteIndex.value = (currentQuoteIndex.value + 1) % quotes.length;
};

// Timer Logic
const startJourney = () => {
    journeyStart.value = new Date();
    localStorage.setItem("ojas_journey_start", journeyStart.value.toISOString());
    isJourneyStarted.value = true;
    updateTimer();
};

const resetStreak = () => {
    if(confirm("Are you sure you want to reset your streak to zero?")) {
        startJourney();
    }
};

const updateTimer = () => {
    if (!isJourneyStarted.value || !journeyStart.value) return;

    const now = new Date();
    const diff = now - journeyStart.value;
    if (diff < 0) return;

    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
    const hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
    const minutes = Math.floor((diff / 1000 / 60) % 60);
    const seconds = Math.floor((diff / 1000) % 60);

    hoursCount.value = hours.toString().padStart(2, "0");
    minutesCount.value = minutes.toString().padStart(2, "0");
    secondsCount.value = seconds.toString().padStart(2, "0");

    if (days !== daysCount.value) {
        daysCount.value = days;
        updateProgressRing(days);
        updateMilestones(days);
    }
};

const updateProgressRing = (days) => {
    const circumference = 339.292; // 2 * PI * 54
    const percent = Math.min((days / goalDays) * 100, 100);
    progressOffset.value = circumference - (percent / 100) * circumference;
};

const updateMilestones = (days) => {
    [7, 30, 90].forEach(req => {
        if (days >= req) achievedMilestones.value.add(req);
        else achievedMilestones.value.delete(req);
    });
};

onMounted(() => {
    const savedStart = localStorage.getItem("ojas_journey_start");
    if (savedStart) {
        journeyStart.value = new Date(savedStart);
        isJourneyStarted.value = true;
        updateTimer();
    }
    timerInterval = setInterval(updateTimer, 1000);
});

onUnmounted(() => {
    if (timerInterval) clearInterval(timerInterval);
});

// Modals state
const isUrgeModalOpen = ref(false);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <!-- Hero: Streak Counter -->
        <section class="glass-panel rounded-3xl p-8 flex flex-col items-center relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-saffron-400 to-amber-300"></div>

            <h2 class="text-sm font-medium text-gray-500 uppercase tracking-widest mb-6">
                Current Streak
            </h2>

            <!-- Circular Timer Display -->
            <div @click="!isJourneyStarted ? startJourney() : null" :class="['relative w-64 h-64 flex items-center justify-center transition', !isJourneyStarted ? 'cursor-pointer hover:scale-105' : '']">
                <!-- Inner Aura & Om -->
                <div class="om-symbol absolute text-[140px] font-semibold text-saffron-500/5 animate-[rotateOm_40s_linear_infinite] pointer-events-none">ॐ</div>

                <svg class="absolute inset-0 w-full h-full -rotate-90" viewBox="0 0 120 120">
                    <circle class="text-gray-200 stroke-current" stroke-width="4" cx="60" cy="60" r="54" fill="transparent"></circle>
                    <circle
                        class="text-saffron-500 stroke-current transition-all duration-500"
                        stroke-width="4"
                        stroke-linecap="round"
                        cx="60" cy="60" r="54"
                        fill="transparent"
                        stroke-dasharray="339.292"
                        :stroke-dashoffset="isJourneyStarted ? progressOffset : 0"
                    ></circle>
                </svg>

                <div class="text-center z-10 flex flex-col items-center justify-center">
                    <div v-if="!isJourneyStarted" class="text-2xl leading-snug px-6 max-w-[180px] text-saffron-600 font-bold">
                        Start Your Journey
                    </div>
                    <template v-else>
                        <div class="text-6xl font-bold tracking-tighter text-gray-800">
                            {{ daysCount }}
                        </div>
                        <div class="text-sm font-medium text-gray-500 mt-1">Days</div>
                    </template>
                </div>
            </div>

            <!-- Detailed Time -->
            <div v-if="isJourneyStarted" class="grid grid-cols-3 gap-6 mt-8 w-full max-w-sm text-center transition-opacity duration-500">
                <div>
                    <div class="text-2xl font-semibold text-gray-700">{{ hoursCount }}</div>
                    <div class="text-xs text-gray-400 uppercase tracking-wider">Hours</div>
                </div>
                <div>
                    <div class="text-2xl font-semibold text-gray-700">{{ minutesCount }}</div>
                    <div class="text-xs text-gray-400 uppercase tracking-wider">Minutes</div>
                </div>
                <div>
                    <div class="text-2xl font-semibold text-gray-700">{{ secondsCount }}</div>
                    <div class="text-xs text-gray-400 uppercase tracking-wider">Seconds</div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div v-if="isJourneyStarted" class="w-full mt-8 flex flex-col sm:flex-row justify-center gap-4">
                <button @click="isUrgeModalOpen = true" class="flex-1 bg-red-50 text-red-600 hover:bg-red-100 font-semibold py-3 px-6 rounded-2xl transition flex justify-center items-center gap-2 border border-red-200 shadow-sm">
                    <i class="fa-solid fa-fire text-red-500"></i> Emergency
                </button>
                <button @click="resetStreak" class="flex-1 bg-gray-50 text-gray-600 hover:bg-gray-100 font-semibold py-3 px-6 rounded-2xl transition flex justify-center items-center gap-2 border border-gray-200 shadow-sm">
                    <i class="fa-solid fa-clock-rotate-left"></i> Relapsed
                </button>
            </div>
        </section>

        <!-- Daily Wisdom (Quotes) -->
        <section class="glass-panel rounded-3xl p-8 relative">
            <i class="fa-solid fa-quote-left text-3xl text-saffron-200 absolute top-6 left-6"></i>
            <div class="pl-8">
                <p class="font-serif text-lg text-gray-800 leading-relaxed italic mb-4">
                    "{{ currentQuote.text }}"
                </p>
                <p class="text-sm font-semibold text-saffron-700 uppercase tracking-wide">
                    — {{ currentQuote.author }}
                </p>
            </div>
            <button @click="nextQuote" class="absolute bottom-6 right-6 text-gray-400 hover:text-saffron-600 transition">
                <i class="fa-solid fa-rotate-right"></i>
            </button>
        </section>

        <!-- Milestones Timeline -->
        <section class="mb-8">
            <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-seedling text-saffron-600"></i> Journey of the Seed
            </h3>
            
            <div class="space-y-6 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px before:h-full before:w-0.5 before:bg-gradient-to-b before:from-saffron-400 before:to-gray-200">
                
                <!-- Milestone 7 -->
                <div class="relative flex items-center group">
                    <div :class="['flex items-center justify-center w-10 h-10 rounded-full border-4 border-white shadow shrink-0 z-10 transition-colors duration-300', achievedMilestones.has(7) ? 'bg-saffron-500 text-white' : 'bg-gray-200 text-gray-400']">
                        <i class="fa-solid fa-check text-sm"></i>
                    </div>
                    <div :class="['w-[calc(100%-4rem)] ml-4 glass-panel p-4 rounded-2xl transition', achievedMilestones.has(7) ? 'opacity-100' : 'opacity-60']">
                        <h4 class="font-bold text-gray-800">Day 7: Testosterone Spike</h4>
                        <p class="text-sm text-gray-600 mt-1">Physical energy increases. Brain fog begins to lift.</p>
                    </div>
                </div>

                <!-- Milestone 30 -->
                <div class="relative flex items-center group">
                    <div :class="['flex items-center justify-center w-10 h-10 rounded-full border-4 border-white shadow shrink-0 z-10 transition-colors duration-300', achievedMilestones.has(30) ? 'bg-saffron-500 text-white' : 'bg-gray-200 text-gray-400']">
                        <i class="fa-solid fa-lock text-sm"></i>
                    </div>
                    <div :class="['w-[calc(100%-4rem)] ml-4 glass-panel p-4 rounded-2xl transition', achievedMilestones.has(30) ? 'opacity-100' : 'opacity-60']">
                        <h4 class="font-bold text-gray-800">Day 30: Mental Clarity</h4>
                        <p class="text-sm text-gray-600 mt-1">Dopamine baseline stabilizes. Increased confidence and control.</p>
                    </div>
                </div>

                <!-- Milestone 90 -->
                <div class="relative flex items-center group">
                    <div :class="['flex items-center justify-center w-10 h-10 rounded-full border-4 border-white shadow shrink-0 z-10 transition-colors duration-300', achievedMilestones.has(90) ? 'bg-saffron-500 text-white' : 'bg-gray-200 text-gray-400']">
                        <i class="fa-solid fa-star text-sm"></i>
                    </div>
                    <div :class="['w-[calc(100%-4rem)] ml-4 glass-panel p-4 rounded-2xl transition', achievedMilestones.has(90) ? 'opacity-100' : 'opacity-60']">
                        <h4 class="font-bold text-gray-800">Day 90: Ojas Cultivation</h4>
                        <p class="text-sm text-gray-600 mt-1">Profound inner peace, magnetism, and willpower.</p>
                    </div>
                </div>

            </div>
        </section>

        <!-- Emergency Urge Modal -->
        <div v-if="isUrgeModalOpen" class="fixed inset-0 bg-gray-900/95 backdrop-blur-xl z-50 flex flex-col items-center justify-center transition-opacity duration-300">
            <button @click="isUrgeModalOpen = false" class="absolute top-6 right-6 text-gray-400 hover:text-white text-2xl">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="text-center px-6 max-w-md mx-auto flex flex-col items-center">
                <h2 class="text-3xl font-bold text-white mb-2 font-serif">Ride the Wave</h2>
                <p class="text-gray-400 mb-12">An urge is just a sensation passing through. Do not fight it; observe it. Breathe with the circle.</p>
                <div class="relative w-48 h-48 flex items-center justify-center mb-12">
                    <div class="absolute w-32 h-32 bg-saffron-500/30 rounded-full animate-pulse blur-xl"></div>
                    <div class="absolute w-24 h-24 bg-saffron-500 rounded-full shadow-[0_0_40px_rgba(249,115,22,0.5)] flex items-center justify-center z-10">
                        <span class="text-white font-medium">Breathe In</span>
                    </div>
                </div>
                <p class="text-gray-300 italic">"You are not your thoughts. You are the consciousness observing them."</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
@keyframes rotateOm {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
</style>
