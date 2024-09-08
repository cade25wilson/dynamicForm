<template>
    <!-- <CoverImage v-if="formSection.background_image != null" /> -->
    <!-- <FormSectionName />
    <FormSectionDescription /> -->
    <div class="mt-6">
            <div class="w-full">
                <div
                :style="{ 
                    borderColor: page.props.form.design.answers, 
                    backgroundColor: page.props.form.design.answers + '1a' 
                }" 
                class="mt-2 text-center rounded-lg border border-dashed border-gray-800 custom-answer-text-color-as-border-color px-6 py-10 custom-answer-text-color-as-background-color-lightest-hover custom-answer-text-color cursor-pointer transition-all">
                    <p class="flex items-center justify-center">
                        <svg :style="{color: page.props.form.design.answers}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"></path>
                        </svg>                          
                                                <span class="pl-1" :style="{color: page.props.form.design.answers}">
                            Upload a file
                        </span>
                                            </p>
                                        <p class="text-xs mt-4" :style="{color: page.props.form.design.answers}">
                        Maximum file size: 10MB
                    </p>
                </div>
            </div>
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
