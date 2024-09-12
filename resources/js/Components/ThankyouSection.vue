<template>
    <CoverImage v-if="page.props.current_section.background_image != null" />
    <FormSectionName />
    <FormSectionDescription />
    <a v-if="page.props.current_section.options.end == 'button'" 
    :style="{ color: page.props.form.design.button_text, backgroundColor: page.props.form.design.buttons }"
    :href="page.props.current_section.options.button_link" target="_top" class="inline-flex items-center px-4 py-2 mt-8 border border-transparent text-base font-medium rounded-md focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-gray-500 text-white bg-gray-700 hover:opacity-80 custom-button-background-color custom-button-text-color">
        {{ page.props.current_section.button_text || 'Next' }} &nbsp; 
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
        </svg>
    </a>
    <div class="mt-6" v-if="page.props.current_section.options.end != 'button'">
        <svg class="animate-spin h-5 w-5 text-black custom-text-color mx-auto my-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <p class="text-sm text-gray-600 custom-text-color">
            {{page.props.current_section.options.redirect_message}}
        </p>
    </div>
</template>
<script setup>
import { usePage } from '@inertiajs/vue3';
import CoverImage from './CoverImage.vue';
import FormSectionDescription from './FormSectionDescription.vue';
import FormSectionName from './FormSectionName.vue';

const page = usePage();
</script>