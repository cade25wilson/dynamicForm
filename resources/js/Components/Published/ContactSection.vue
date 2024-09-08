<template>
    <!-- <CoverImage v-if="formSection.background_image != null" :formSection="formSection"/> -->
    <!-- <FormSectionName />
    <FormSectionDescription /> --> 
	<ContactInputs :formSection=formSection />
</template>
<script setup>
import { usePage } from '@inertiajs/vue3';
import ContactInputs from './ContactInputs.vue';
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