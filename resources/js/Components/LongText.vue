<template>
    <CoverImage v-if="page.props.current_section.background_image != null" />
    <FormSectionName />
    <FormSectionDescription />
    <div class="mt-6">
        <textarea 
            disabled
            style="max-height: 24rem; height: 110px" 
            class="block w-full min-h-6 rounded-md shadow-sm sm:text-sm bg-transparent custom-textarea"
            :style="{
                color: page.props.form.design.answers, 
                borderColor: page.props.form.design.answers
            }"
        ></textarea>
        <p class="text-right mt-2 text-gray-600 custom-text-color-light" v-if="formFieldOptions.length > 0"
            :style="{ color: page.props.form.design.answers }"
            >
            <span>0</span>/<span>{{ formFieldOptions.length }}</span>
        </p>
    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import CoverImage from './CoverImage.vue';
import FormSectionDescription from './FormSectionDescription.vue';
import FormSectionName from './FormSectionName.vue';

const page = usePage();
const formFieldOptions = ref(JSON.parse(page.props.current_section.form_fields[0].options || '{}'));

// Watch for updates to formFieldOptions and sync with page.props
watch(formFieldOptions, (newOptions) => {
    page.props.current_section.form_fields[0].options = JSON.stringify(newOptions);
});
</script>
