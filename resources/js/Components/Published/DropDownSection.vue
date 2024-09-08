<template>
    <!-- <CoverImage v-if="formSection.background_image != null" /> -->
    <!-- <FormSectionName />
    <FormSectionDescription /> -->
    <div>
        <div class="relative mt-2">
          <button type="button" disabled="" class="relative w-full cursor-default rounded-md  py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-700 focus:outline-none focus:ring-0 custom-border-color sm:text-sm sm:leading-6 bg-transparent custom-text-color" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
            <span class="block truncate" :style="{color: page.props.form.design.questions}">Please select an option</span>
            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
              <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd"></path>
              </svg>
            </span>
          </button>
        </div>
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
