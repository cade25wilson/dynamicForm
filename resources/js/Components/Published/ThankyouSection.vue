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

const page = usePage();
</script>