<template>
    <CoverImage v-if="page.props.current_section.background_image != null" />
    <FormSectionName />
    <FormSectionDescription />
</template>
<script setup>
import { usePage } from '@inertiajs/vue3';
import CoverImage from './CoverImage.vue';
import FormSectionDescription from './FormSectionDescription.vue';
import FormSectionName from './FormSectionName.vue';

const page = usePage();
</script>