<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profile Settings" />

    <AuthenticatedLayout>
        <div class="py-2 sm:py-8">
            <div class="mx-auto max-w-2xl space-y-4">
                
                <!-- Profile & Security Menu -->
                <details class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden group">
                    <summary class="p-5 font-semibold text-lg cursor-pointer flex justify-between items-center outline-none list-none [&::-webkit-details-marker]:hidden">
                        <div class="flex items-center gap-3 text-gray-800">
                            <div class="w-12 h-12 rounded-2xl bg-saffron-50 flex items-center justify-center text-saffron-600">
                                <i class="fa-regular fa-user"></i>
                            </div>
                            Profile & Security
                        </div>
                        <i class="fa-solid fa-chevron-down transition-transform group-open:rotate-180 text-gray-400"></i>
                    </summary>
                    <div class="px-6 pb-8 pt-4 border-t border-gray-100 space-y-10">
                        <UpdateProfileInformationForm
                            :status="status"
                            class="max-w-xl"
                        />
                        <hr class="border-gray-100">
                        <UpdatePasswordForm class="max-w-xl" />
                    </div>
                </details>

                <!-- Delete Account Menu -->
                <details class="bg-white rounded-3xl shadow-sm border border-red-50 overflow-hidden group">
                    <summary class="p-5 font-semibold text-lg cursor-pointer flex justify-between items-center outline-none list-none [&::-webkit-details-marker]:hidden">
                        <div class="flex items-center gap-3 text-red-600">
                            <div class="w-12 h-12 rounded-2xl bg-red-50 flex items-center justify-center">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                            </div>
                            Delete Account
                        </div>
                        <i class="fa-solid fa-chevron-down transition-transform group-open:rotate-180 text-red-300"></i>
                    </summary>
                    <div class="px-6 pb-8 pt-4 border-t border-red-50">
                        <DeleteUserForm class="max-w-xl" />
                    </div>
                </details>

                <!-- Log Out Button -->
                <div class="pt-6 pb-4">
                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="w-full flex items-center justify-center gap-2 px-6 py-4 bg-white text-gray-700 rounded-3xl font-semibold hover:bg-red-50 hover:text-red-600 transition border border-gray-100 hover:border-red-100 shadow-sm"
                    >
                        <i class="fa-solid fa-right-from-bracket"></i> Log Out of Device
                    </Link>
                </div>
                
            </div>
        </div>
    </AuthenticatedLayout>
</template>
