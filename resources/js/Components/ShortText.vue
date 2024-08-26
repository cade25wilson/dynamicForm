<template>
    <CoverImage v-if="page.props.current_section.background_image != null" />
    <FormSectionName />
    <FormSectionDescription />
    <div class="mt-6">
        <input 
            type="text" 
            disabled 
            class="custom-input block w-full px-0 border-0 border-b focus:ring-0 sm:text-sm bg-transparent" 
            :placeholder="page.props.current_section.form_fields[0].placeholder"
            :style="{
                '--custom-placeholder-color': page.props.form.design.answers,
                color: page.props.form.design.answers, 
                borderColor: page.props.form.design.answers
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
</script>

<style scoped>
.custom-input::placeholder {
    color: var(--custom-placeholder-color);
}

.custom-input {
    --custom-placeholder-color: var(--your-placeholder-color, #ccc); /* Fallback to #ccc */
}
</style>
