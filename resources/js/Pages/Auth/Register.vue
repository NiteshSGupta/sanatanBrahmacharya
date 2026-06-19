<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    name: '',
    username: '',
    gender: 'male',
    age: 18,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

const scrollContainer = ref(null);

const scroll = (direction) => {
    if (scrollContainer.value) {
        const scrollAmount = 200;
        scrollContainer.value.scrollBy({
            left: direction === 'left' ? -scrollAmount : scrollAmount,
            behavior: 'smooth'
        });
    }
};

let isDown = false;
let startX;
let scrollLeft;

const onMouseDown = (e) => {
    isDown = true;
    scrollContainer.value.classList.add('cursor-grabbing');
    scrollContainer.value.classList.remove('snap-mandatory', 'scroll-smooth');
    startX = e.pageX - scrollContainer.value.offsetLeft;
    scrollLeft = scrollContainer.value.scrollLeft;
};

const onMouseLeave = () => {
    if (!isDown) return;
    isDown = false;
    scrollContainer.value.classList.remove('cursor-grabbing');
    scrollContainer.value.classList.add('snap-mandatory', 'scroll-smooth');
};

const onMouseUp = () => {
    if (!isDown) return;
    isDown = false;
    scrollContainer.value.classList.remove('cursor-grabbing');
    scrollContainer.value.classList.add('snap-mandatory', 'scroll-smooth');
};

const onMouseMove = (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - scrollContainer.value.offsetLeft;
    const walk = (x - startX) * 2;
    scrollContainer.value.scrollLeft = scrollLeft - walk;
};

const showPassword = ref(false);
const showConfirmPassword = ref(false);
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
                        <div class="py-3 flex items-center justify-center gap-2 rounded-xl border border-gray-200 peer-checked:bg-saffron-600 peer-checked:text-white peer-checked:border-saffron-600 transition">
                            <i class="fa-solid fa-mars text-lg"></i> Male
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
                        <div class="py-3 flex items-center justify-center gap-2 rounded-xl border border-gray-200 peer-checked:bg-saffron-600 peer-checked:text-white peer-checked:border-saffron-600 transition">
                            <i class="fa-solid fa-venus text-lg"></i> Female
                        </div>
                    </label>
                </div>
                <!-- Note: Gender needs to be added to user migration later -->
            </div>

            <!-- Age -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Age</label>
                <div class="relative w-full rounded-2xl border border-gray-100 bg-white/50 px-1 select-none">
                    <!-- Left Arrow -->
                    <button type="button" @click="scroll('left')" class="absolute left-1 top-1/2 -translate-y-1/2 z-20 w-8 h-8 flex items-center justify-center bg-white rounded-full shadow-sm border border-gray-100 hover:bg-gray-50 transition text-gray-600 focus:outline-none">
                        <i class="fa-solid fa-chevron-left text-xs"></i>
                    </button>

                    <!-- Right Arrow -->
                    <button type="button" @click="scroll('right')" class="absolute right-1 top-1/2 -translate-y-1/2 z-20 w-8 h-8 flex items-center justify-center bg-white rounded-full shadow-sm border border-gray-100 hover:bg-gray-50 transition text-gray-600 focus:outline-none">
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </button>

                    <!-- Fade overlays for sides -->
                    <div class="absolute left-0 top-0 bottom-0 w-10 bg-gradient-to-r from-white via-white/80 to-transparent pointer-events-none rounded-l-2xl z-10"></div>
                    <div class="absolute right-0 top-0 bottom-0 w-10 bg-gradient-to-l from-white via-white/80 to-transparent pointer-events-none rounded-r-2xl z-10"></div>
                    
                    <div 
                        ref="scrollContainer"
                        class="flex overflow-x-auto hide-scrollbar py-4 px-10 gap-3 snap-x snap-mandatory relative z-0 cursor-grab active:cursor-grabbing scroll-smooth"
                        @mousedown="onMouseDown"
                        @mouseleave="onMouseLeave"
                        @mouseup="onMouseUp"
                        @mousemove="onMouseMove"
                    >
                        <label v-for="i in 92" :key="i + 7" class="relative flex-none cursor-pointer snap-center group">
                            <input type="radio" name="age" :value="i + 7" v-model="form.age" class="hidden peer" />
                            <div class="w-14 h-14 flex items-center justify-center text-xl text-gray-500 font-medium rounded-2xl peer-checked:bg-saffron-600 peer-checked:text-white peer-checked:shadow-lg peer-checked:shadow-saffron-200 transition-all duration-300">
                                {{ i + 7 }}
                            </div>
                            <!-- Indicators -->
                            <div class="absolute -bottom-3 left-0 w-full flex justify-center items-center h-4">
                                <div class="w-1 h-1 rounded-full bg-gray-300 peer-checked:hidden transition-all duration-300 pointer-events-none"></div>
                                <div class="hidden peer-checked:block w-0 h-0 border-l-[6px] border-l-transparent border-r-[6px] border-r-transparent border-b-[8px] border-b-saffron-600 pointer-events-none"></div>
                            </div>
                        </label>
                    </div>
                </div>
                <div v-if="form.errors.age" class="text-red-500 text-xs mt-1">{{ form.errors.age }}</div>
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input
                        :type="showPassword ? 'text' : 'password'"
                        v-model="form.password"
                        placeholder="Create a password"
                        class="w-full pl-10 pr-10 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-saffron-500 focus:border-saffron-500 outline-none transition"
                        required
                    />
                    <button type="button" @click="showPassword = !showPassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <i class="fa-solid text-sm" :class="showPassword ? 'fa-eye' : 'fa-eye-slash'"></i>
                    </button>
                </div>
                <div v-if="form.errors.password" class="text-red-500 text-xs mt-1">{{ form.errors.password }}</div>
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input
                        :type="showConfirmPassword ? 'text' : 'password'"
                        v-model="form.password_confirmation"
                        placeholder="Confirm your password"
                        class="w-full pl-10 pr-10 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-saffron-500 focus:border-saffron-500 outline-none transition"
                        required
                    />
                    <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <i class="fa-solid text-sm" :class="showConfirmPassword ? 'fa-eye' : 'fa-eye-slash'"></i>
                    </button>
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

<style scoped>
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}
.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
