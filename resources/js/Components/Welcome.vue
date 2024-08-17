<script setup>
import ProModal from '@/Components/FormModal.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
defineProps({ forms: Object })
</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
            <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
                Welcome to your Jetstream application! {{forms}}
            </h1>
        </div>
        <ProModal />
        <div>

        </div>

        <div>
            
        </div>

        <div>

        </div>

        <div>
        
        </div>
    </div>
</template>
