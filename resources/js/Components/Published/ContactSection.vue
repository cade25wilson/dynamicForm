<template>
    <!-- <CoverImage v-if="formSection.background_image != null" :formSection="formSection"/> -->
    <!-- <FormSectionName />
    <FormSectionDescription /> --> 
    <ContactInputs :formSection="formSection" @updateResponse="handleUpdateResponse"/>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import { defineProps, defineEmits } from 'vue';
import ContactInputs from './ContactInputs.vue';
import CoverImage from './CoverImage.vue';
import FormSectionDescription from './FormSectionDescription.vue';
import FormSectionName from './FormSectionName.vue';
const emit = defineEmits(['updateResponse']);

// Get the page data
const page = usePage();

// Define props
const props = defineProps({
    formSection: {
        type: Object,
        required: true
    }
});

// Define the method to handle the response from the child component
function handleUpdateResponse({ fieldId, value }) {
    emit('updateResponse', { fieldId, value });
}

</script>
