<template>
    <!-- <CoverImage v-if="formSection.background_image != null" /> -->
    <!-- <FormSectionName />
    <FormSectionDescription /> -->
    <div class="mt-6">
        <input 
            type="date" 
            disabled 
            class="block w-1/2 border-0 border-b focus:ring-0 sm:text-sm custom-input bg-transparent"
            placeholder="Select date..."
            :style="{
                '--your-placeholder-color': page.props.form.design.answers,
                '--your-border-color': page.props.form.design.answers,
                color: page.props.form.design.answers
            }"
        >
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
