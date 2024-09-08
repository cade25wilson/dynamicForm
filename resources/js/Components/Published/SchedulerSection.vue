<template>
    <!-- <CoverImage v-if="formSection.background_image != null" /> -->
    <!-- <FormSectionName />
    <FormSectionDescription /> -->
    <div class="mt-6">
        <button 
        :style="{
                '--your-placeholder-color': page.props.form.design.answers,
                '--your-border-color': page.props.form.design.answers,
                color: page.props.form.design.answers
            }"
        class="flex items-center justify-center space-x-1 text-sm min-w-max max-w-lg px-6 py-2 border border-gray-700 custom-text-color-as-border-color hover:opacity-70 rounded-md custom-text-color shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"></path>
            </svg>
            <span :style="{
                '--your-placeholder-color': page.props.form.design.answers,
                '--your-border-color': page.props.form.design.answers,
                color: page.props.form.design.answers
            }">{{formSection.form_fields[0].label}}</span>
        </button>
    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import CoverImage from './CoverImage.vue';
import FormSectionDescription from './FormSectionDescription.vue';
import FormSectionName from './FormSectionName.vue';

const page = usePage();
const props = defineProps({
    formSection: {
        type: Object,
        required: false
    }
});
</script>

<style scoped>
.custom-input::placeholder {
    color: var(--your-placeholder-color);
}

.custom-input {
    --your-placeholder-color: var(--your-placeholder-color, #ccc); /* Default to #ccc if not set */
    color: var(--your-text-color, #000); /* Set this to your desired text color */
    border-color: var(--your-border-color, #000); /* Set this to your desired underline color */
}
</style>
