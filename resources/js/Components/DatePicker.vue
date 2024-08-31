<template>
    <CoverImage v-if="page.props.current_section.background_image != null" />
    <FormSectionName />
    <FormSectionDescription />
    <div class="mt-6">
        <input type="date" disabled="" class="block w-1/2 border-0 border-b border-gray-700 focus:border-gray-600 focus:ring-0 sm:text-sm custom-answer-text-color-as-border-color custom-placeholder-answer-text-color custom-answer-text-color bg-transparent" placeholder="Select date...">
    </div>
</template>
<script setup>
import { usePage } from '@inertiajs/vue3';
import CoverImage from './CoverImage.vue';
import FormSectionDescription from './FormSectionDescription.vue';
import FormSectionName from './FormSectionName.vue';

const page = usePage();
</script>

<style scoped>
.iti {
    display: inline-block;
}

.custom-input::placeholder {
    color: var(--custom-placeholder-color);
}

.custom-input {
    --custom-placeholder-color: var(--your-placeholder-color, #ccc); /* Default to #ccc if not set */
    color: var(--your-text-color, #000); /* Set this to your desired text color */
    border-color: var(--your-border-color, #000); /* Set this to your desired underline color */
}
</style>