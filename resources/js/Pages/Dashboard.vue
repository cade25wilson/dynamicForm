<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import FormModal from '@/Components/FormModal.vue';
import Welcome from '@/Components/Welcome.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({ forms: Object })
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Forms
                </h2>
                <FormModal />

            </div>
        </template>
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-4" v-if="forms.length > 0">
                        <div 
                            class="bg-white dark:bg-gray-900 rounded-lg shadow-bottom-left-right hover:shadow-lg transition-shadow duration-300 ease-in-out p-4"
                            v-for="form in forms" 
                            :key="form.id"
                        >
                            <a 
                                :href="`/form/${form.id}`"
                                class="block"
                            >
                                <div class="flex-1 flex items-center justify-center">
                                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ form.name }}</h2>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-300">{{ form.response_count }} responses</p>
                            </a>
                        </div>
                    </div>
                    <div v-else class="flex items-center justify-center h-full">
                        <h1 class="text-xl text-gray-600 dark:text-gray-300">No Forms created yet!</h1>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
