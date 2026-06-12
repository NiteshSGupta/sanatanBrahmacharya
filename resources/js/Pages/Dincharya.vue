<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    activeSankalps: {
        type: Array,
        default: () => []
    }
});

const isSankalpModalOpen = ref(false);
const selectedSankalp = ref("");
const customSankalp = ref("");
const selectedDuration = ref(0);

const sankalpOptions = [
    { text: "📿 Naam Jap (108 times)", value: "Naam Jap (108 times)" },
    { text: "🌅 Wake in Brahma Muhurta", value: "Wake in Brahma Muhurta" },
    { text: "📵 Digital Fast After 8 PM", value: "Digital Fast After 8 PM" },
    { text: "💪 Daily Workout (45 mins)", value: "Daily Workout (45 mins)" },
    { text: "🏢 Reach Office On Time", value: "Reach Office On Time" }
];

const durations = [7, 21, 40, 90];

const selectSankalp = (val) => {
    selectedSankalp.value = val;
    customSankalp.value = "";
};

const selectDuration = (days) => {
    selectedDuration.value = days;
};

const sankalpForm = useForm({
    title: '',
    duration_days: 0
});

const sealSankalp = () => {
    sankalpForm.title = customSankalp.value || selectedSankalp.value;
    sankalpForm.duration_days = selectedDuration.value;
    
    if (!sankalpForm.title || !sankalpForm.duration_days) {
        alert("Please select a sankalp and duration.");
        return;
    }
    
    sankalpForm.post(route('sankalp.store'), {
        onSuccess: () => {
            isSankalpModalOpen.value = false;
            sankalpForm.reset();
            selectedSankalp.value = "";
            customSankalp.value = "";
            selectedDuration.value = 0;
        }
    });
};

// Global Timeline
const timelineDays = computed(() => {
    if (props.activeSankalps.length === 0) return [];
    
    let minDate = new Date(props.activeSankalps[0].start_date);
    let maxDate = new Date(props.activeSankalps[0].start_date);
    
    props.activeSankalps.forEach(s => {
        const start = new Date(s.start_date);
        const end = new Date(start);
        end.setDate(start.getDate() + s.duration_days - 1);
        
        if (start < minDate) minDate = start;
        if (end > maxDate) maxDate = end;
    });
    
    const days = [];
    const current = new Date(minDate);
    let dayCount = 1;
    
    const today = new Date();
    const localToday = new Date(today.getTime() - (today.getTimezoneOffset()*60*1000));
    const todayStr = localToday.toISOString().split('T')[0];
    
    while (current <= maxDate) {
        const offset = current.getTimezoneOffset();
        const localDate = new Date(current.getTime() - (offset*60*1000));
        const dateStr = localDate.toISOString().split('T')[0];
        
        // Find which sankalps are active on this day
        const daySankalps = props.activeSankalps.filter(s => {
            const sStart = new Date(s.start_date);
            const sEnd = new Date(sStart);
            sEnd.setDate(sStart.getDate() + s.duration_days - 1);
            
            // normalize dates for strict comparison
            const sStartStr = new Date(sStart.getTime() - (sStart.getTimezoneOffset()*60*1000)).toISOString().split('T')[0];
            const sEndStr = new Date(sEnd.getTime() - (sEnd.getTimezoneOffset()*60*1000)).toISOString().split('T')[0];
            
            return dateStr >= sStartStr && dateStr <= sEndStr;
        });
        
        let completedCount = 0;
        daySankalps.forEach(s => {
            if (s.checkins_map && s.checkins_map[dateStr]) completedCount++;
        });
        
        let status = 'none';
        if (daySankalps.length > 0) {
            if (completedCount === daySankalps.length) status = 'all';
            else if (completedCount > 0) status = 'partial';
        }
        
        days.push({
            dayNumber: dayCount,
            date: dateStr,
            displayDate: current.toLocaleDateString(undefined, { month: 'short', day: 'numeric' }),
            isToday: dateStr === todayStr,
            isFuture: dateStr > todayStr,
            sankalps: daySankalps,
            completedCount,
            totalCount: daySankalps.length,
            status
        });
        
        current.setDate(current.getDate() + 1);
        dayCount++;
    }
    
    return days;
});

const globalAnalytics = computed(() => {
    let expected = 0;
    let completed = 0;
    
    timelineDays.value.forEach(day => {
        if (!day.isFuture) {
            expected += day.totalCount;
            completed += day.completedCount;
        }
    });
    
    const percent = expected === 0 ? 0 : Math.round((completed / expected) * 100);
    return {
        percent,
        completed,
        missed: expected - completed,
        consistency: percent > 80 ? 'Strong' : (percent > 50 ? 'Average' : 'Needs Focus')
    };
});

const getSankalpProgress = (sankalp) => {
    const totalDays = sankalp.duration_days;
    const start = new Date(sankalp.start_date);
    const now = new Date();
    const elapsedDays = Math.max(0, Math.min(totalDays, Math.floor((now - start) / (1000 * 60 * 60 * 24)) + 1));
    return { elapsedDays, totalDays };
};

const checkinModalDay = ref(null);

const openCheckin = (day) => {
    if (day.isFuture || day.totalCount === 0) return;
    checkinModalDay.value = day;
};

const toggleCheckin = (sankalpId, dateStr) => {
    router.post(route('sankalp.checkin', sankalpId), {
        date: dateStr
    }, {
        preserveScroll: true,
        preserveState: true
    });
};

const isChecked = (sankalp, dateStr) => {
    return sankalp.checkins_map && sankalp.checkins_map[dateStr] !== undefined;
};
</script>

<template>
    <Head title="Dincharya" />

    <AuthenticatedLayout>
        <!-- Header -->
        <section class="glass-panel rounded-3xl p-6 flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-bold text-saffron-900">Dincharya</h2>
                <p class="text-sm text-gray-500">Daily Discipline To-Do</p>
            </div>
            <i class="fa-solid fa-list-check text-saffron-500 text-lg"></i>
        </section>

        <section v-if="activeSankalps.length === 0" class="glass-panel rounded-3xl p-6 text-center mb-6">
            <h3 class="text-gray-800 font-semibold mb-2">No Active Sankalps</h3>
            <p class="text-sm text-gray-500">Add tasks or vows to build your routine.</p>
        </section>

        <!-- Global To-Do List of Active Sankalps -->
        <section v-if="activeSankalps.length > 0" class="glass-panel rounded-3xl p-6 mb-6 shadow-sm border border-saffron-100 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-saffron-400 to-saffron-600"></div>
            <h3 class="text-xs uppercase tracking-widest text-saffron-600 font-bold mb-4">Active Routines</h3>
            
            <div class="space-y-4">
                <div v-for="sankalp in activeSankalps" :key="sankalp.id" class="flex flex-col border-b border-gray-100 last:border-0 pb-4 last:pb-0">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-gray-800 font-bold text-md">{{ sankalp.title }}</span>
                        <span class="text-xs font-semibold text-gray-400 bg-gray-100 px-2 py-1 rounded-lg">
                            Day {{ getSankalpProgress(sankalp).elapsedDays }} / {{ sankalp.duration_days }}
                        </span>
                    </div>
                    <!-- Small Progress Bar per task -->
                    <div class="w-full bg-gray-100 rounded-full h-1.5 relative">
                        <div class="bg-saffron-400 h-1.5 rounded-full transition-all duration-500" :style="{ width: Math.min((getSankalpProgress(sankalp).elapsedDays / sankalp.duration_days) * 100, 100) + '%' }"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Global Check-in Grid -->
        <section v-if="activeSankalps.length > 0" class="glass-panel rounded-3xl p-6 mb-6 shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-sm font-semibold text-gray-800">Check-In Journey</h3>
                <span class="text-xs text-gray-400">Click a day to complete tasks</span>
            </div>
            
            <div class="grid grid-cols-5 gap-3 text-center text-xs font-medium max-h-64 overflow-y-auto pr-2 custom-scrollbar">
                <button 
                    v-for="day in timelineDays" :key="day.date"
                    @click="openCheckin(day)"
                    :disabled="day.isFuture || day.totalCount === 0"
                    :class="[
                        'flex flex-col items-center justify-center p-2 rounded-xl transition-all border shadow-sm relative',
                        day.status === 'all' ? 'bg-saffron-500 text-white border-saffron-500 shadow-saffron-200' : 
                        (day.status === 'partial' ? 'bg-amber-100 text-amber-800 border-amber-300' : 'bg-gray-50 text-gray-500 border-gray-200 hover:bg-gray-100'),
                        (day.isFuture || day.totalCount === 0) ? 'opacity-40 cursor-not-allowed' : 'cursor-pointer',
                        day.isToday && day.status !== 'all' ? 'ring-2 ring-saffron-400 ring-offset-1' : ''
                    ]"
                >
                    <span class="mb-1 opacity-70">{{ day.displayDate }}</span>
                    <span class="text-sm">{{ day.dayNumber }}</span>
                    
                    <!-- Indicator dots for multiple tasks -->
                    <div v-if="day.totalCount > 1 && day.status !== 'all'" class="absolute bottom-1 flex gap-0.5">
                        <div v-for="i in day.totalCount" :key="i" class="w-1 h-1 rounded-full" :class="i <= day.completedCount ? 'bg-saffron-500' : 'bg-gray-300'"></div>
                    </div>
                </button>
            </div>
        </section>

        <!-- Global Analytics -->
        <section v-if="activeSankalps.length > 0" class="glass-panel rounded-3xl p-6 mb-8 shadow-sm border border-gray-100">
            <h3 class="text-sm font-semibold text-gray-800 mb-4">Overall Analysis</h3>
            <div class="flex justify-between text-sm text-gray-600">
                <div class="text-center">
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1">Completion</p>
                    <p class="text-xl font-bold text-saffron-600">{{ globalAnalytics.percent }}%</p>
                </div>
                <div class="text-center border-l border-r border-gray-200 px-4">
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1">Missed</p>
                    <p class="text-xl font-bold text-red-400">{{ globalAnalytics.missed }}</p>
                </div>
                <div class="text-center">
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1">Consistency</p>
                    <p class="text-sm font-bold mt-2 text-gray-700">{{ globalAnalytics.consistency }}</p>
                </div>
            </div>
        </section>

        <!-- Create Sankalp Button -->
        <button
            @click="isSankalpModalOpen = true"
            class="w-full bg-saffron-600 text-white py-4 mb-4 rounded-2xl font-bold shadow-lg shadow-saffron-200 hover:bg-saffron-700 transition"
        >
            + Add New Routine
        </button>

        <!-- Create Sankalp Modal -->
        <div v-if="isSankalpModalOpen" class="fixed inset-0 bg-gray-900/40 backdrop-blur-md z-50 flex items-center justify-center px-4 transition-opacity">
            <div class="glass-panel rounded-3xl w-full max-w-md p-8 relative shadow-2xl bg-white max-h-[90vh] overflow-y-auto">
                <button @click="isSankalpModalOpen = false" class="absolute top-4 right-4 text-gray-400 hover:text-saffron-600 transition p-2">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>

                <div class="text-center mb-8">
                    <div class="w-14 h-14 bg-saffron-100 rounded-full flex items-center justify-center mx-auto mb-4 text-saffron-600">
                        <i class="fa-solid fa-plus text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 font-serif">Add Routine</h2>
                    <p class="text-xs text-gray-500 uppercase tracking-widest mt-2">Build Your Daily List</p>
                </div>

                <div class="space-y-3 mb-6">
                    <button
                        v-for="opt in sankalpOptions" :key="opt.value"
                        @click="selectSankalp(opt.value)"
                        :class="['w-full text-left px-4 py-4 rounded-2xl border transition', selectedSankalp === opt.value && !customSankalp ? 'border-saffron-500 bg-saffron-50 text-saffron-900 shadow-sm' : 'border-gray-200 text-gray-700 hover:border-saffron-400']"
                    >
                        {{ opt.text }}
                    </button>
                </div>

                <div class="mb-6 relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fa-solid fa-pen text-gray-400 text-sm"></i>
                    </div>
                    <input
                        type="text"
                        v-model="customSankalp"
                        @input="selectedSankalp = ''"
                        placeholder="Or write your own custom task..."
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-saffron-500 focus:border-saffron-500 outline-none text-gray-800 transition"
                    />
                </div>

                <div class="mb-8">
                    <h4 class="text-xs uppercase tracking-widest text-gray-500 mb-3 font-semibold">Select Duration</h4>
                    <div class="grid grid-cols-4 gap-3">
                        <button
                            v-for="d in durations" :key="d"
                            @click="selectDuration(d)"
                            :class="['py-3 rounded-xl text-sm transition font-bold', selectedDuration === d ? 'bg-saffron-500 text-white shadow-md shadow-saffron-200 scale-105' : 'bg-gray-100 text-gray-600 hover:bg-gray-200']"
                        >
                            {{ d }}D
                        </button>
                    </div>
                </div>

                <button
                    @click="sealSankalp"
                    :disabled="sankalpForm.processing"
                    class="w-full bg-saffron-600 text-white font-bold text-lg py-4 rounded-2xl shadow-xl shadow-saffron-200 hover:bg-saffron-700 transition disabled:opacity-50"
                >
                    Add to Journey
                </button>
            </div>
        </div>

        <!-- Global Checkin Modal (To-Do List view for a specific day) -->
        <div v-if="checkinModalDay" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-50 flex items-center justify-center px-4">
            <div class="bg-white rounded-3xl p-8 max-w-sm w-full relative shadow-2xl">
                <button @click="checkinModalDay = null" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
                
                <div class="text-center mb-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-1">{{ checkinModalDay.displayDate }}</h3>
                    <p class="text-sm text-saffron-600 font-medium">Daily Checklist</p>
                </div>
                
                <div class="space-y-3">
                    <label 
                        v-for="sankalp in checkinModalDay.sankalps" 
                        :key="sankalp.id"
                        class="flex items-center gap-4 p-4 border-2 rounded-2xl cursor-pointer transition" 
                        :class="isChecked(sankalp, checkinModalDay.date) ? 'border-saffron-500 bg-saffron-50' : 'border-gray-200 hover:border-saffron-300'"
                    >
                        <input 
                            type="checkbox" 
                            class="w-6 h-6 text-saffron-600 rounded border-gray-300 focus:ring-saffron-500"
                            :checked="isChecked(sankalp, checkinModalDay.date)"
                            @change="toggleCheckin(sankalp.id, checkinModalDay.date)"
                        >
                        <span class="font-semibold" :class="isChecked(sankalp, checkinModalDay.date) ? 'text-saffron-800 line-through opacity-70' : 'text-gray-800'">
                            {{ sankalp.title }}
                        </span>
                    </label>
                </div>

                <button @click="checkinModalDay = null" class="w-full mt-6 bg-gray-100 text-gray-700 font-bold py-3 rounded-xl hover:bg-gray-200 transition">
                    Done
                </button>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
    width: 4px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent; 
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #e5e7eb; 
    border-radius: 4px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #d1d5db; 
}
</style>
