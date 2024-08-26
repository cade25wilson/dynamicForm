<template>
    <CoverImage v-if="page.props.current_section.background_image != null" />
    <FormSectionName />
    <FormSectionDescription />
	<ContactInputs />
</template>
<script setup>
import { usePage } from '@inertiajs/vue3';
import ContactInputs from './ContactInputs.vue';
import CoverImage from './CoverImage.vue';
import FormSectionDescription from './FormSectionDescription.vue';
import FormSectionName from './FormSectionName.vue';

const page = usePage();
</script>