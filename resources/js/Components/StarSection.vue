<template>
    <CoverImage v-if="page.props.current_section.background_image != null" />
    <FormSectionName />
    <FormSectionDescription />
    <div class="mt-6">
        <div class="flex items-center">
            <svg v-for="index in starsArray" :key="index" 
                :style="{ color: page.props.form.design.star_rating }" 
                class="size-11 cursor-pointer text-gray-700 custom-rating-color" 
                xmlns="http://www.w3.org/2000/svg" 
                fill="none" 
                viewBox="0 0 24 24" 
                stroke-width="1" 
                stroke="currentColor">
                <title>{{ index }}</title>
                <path stroke-linecap="round" stroke-linejoin="round" 
                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"></path>
            </svg>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import CoverImage from './CoverImage.vue';
import FormSectionDescription from './FormSectionDescription.vue';
import FormSectionName from './FormSectionName.vue';

const page = usePage();

const starsArray = computed(() => {
    return Array.from({ length: page.props.current_section.form_fields[0].options.number_stars }, (_, i) => i + 1);
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
