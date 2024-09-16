<template>
    <!-- <CoverImage v-if="formSection.background_image != null" :formSection="formSection"/> -->
    <!-- <FormSectionName />
    <FormSectionDescription /> -->
</template>
<script setup>
import { usePage } from '@inertiajs/vue3';
import CoverImage from './CoverImage.vue';
import FormSectionDescription from './FormSectionDescription.vue';
import FormSectionName from './FormSectionName.vue';
// Define props
const props = defineProps({
    formSection: {
        type: Object,
        required: false
    }
});

const page = usePage();
</script>