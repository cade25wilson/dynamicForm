<template>
    <!-- <CoverImage v-if="formSection.background_image != null" /> -->
    <!-- <FormSectionName />
    <FormSectionDescription /> -->
    <div class="mt-6 grid grid-cols-10 gap-2">
        <button 
      v-for="number in 10" 
      :key="number" 
      :style="{ 
        borderColor: page.props.form.design.answers, 
        backgroundColor: page.props.form.design.answers + '1a' 
      }" 
      class="text-sm px-3 py-3 transition-all custom-answer-text-color-as-background-color-lightest-hover custom-answer-text-color border border-gray-500 custom-answer-text-color-as-border-color text-center rounded" 
      type="button"
    >
      <span>{{ number }}</span>
    </button>
                    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
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
