<template>
    <SingleSelectOptions />



    <div class="relative flex items-center mt-6">
        <div class="flex h-6 items-center">
          <input x-model="randomize" @input.debounce="updateRandomize()" :checked="page.props.current_section.form_fields[0].options.random" id="radio-randomize-checkbox-editor" aria-describedby="radio-randomize-checkbox-editor-description" name="radio-randomize-checkbox-editor" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-gray-600 focus:ring-gray-600" value="">
        </div>
        <div class="ml-3 text-sm leading-6 flex items-center justify-between">
            <label for="radio-randomize-checkbox-editor" class="text-sm font-medium text-gray-700">
                <span>Randomize options</span>
            </label>
            <p  x-tooltip.raw="If checked, options will be presented in a random order. This helps in reducing bias towards selections that are listed first." class="text-gray-500 cursor-pointer hover:text-gray-600 ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"></path>
                </svg>                          
            </p>
        </div>
    </div>
    <div class="relative flex items-start mt-6" v-if="page.props.current_section.section_type_id != 10">
        <div class="flex h-6 items-center">
          <input @input.debounce="updateHorizontal()" :checked="page.props.current_section.form_fields[0].options.align == 'horizontal'" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-gray-600 focus:ring-gray-600" value="">
        </div>
        <div class="ml-3 text-sm leading-6">
          <label for="radio-horizontal-checkbox-editor" class="text-sm font-medium text-gray-700">Horizontally align options</label>
        </div>
    </div>
    <div class="relative flex items-center mt-6" v-if="page.props.current_section.section_type_id != 10">
        <div class="flex h-6 items-center">
          <input x-model="hideLabels" @input.debounce="updateHideLabels()" :checked="page.props.current_section.form_fields[0].options.hide_label" id="radio-hide-labels-checkbox-editor" aria-describedby="radio-hide-labels-checkbox-editor-description" name="radio-hide-labels-checkbox-editor" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-gray-600 focus:ring-gray-600">
        </div>
        <div class="ml-3 text-sm leading-6 flex items-center justify-between">
            <label for="radio-hide-labels-checkbox-editor" class="text-sm font-medium text-gray-700">
                <span>Hide labels</span>
            </label>
            <a href="" target="_blank"  x-tooltip.raw="If checked, option labels will be hidden. Only works when the options have images. Click to learn more." class="text-gray-500 inline-block cursor-pointer hover:text-gray-600 ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"></path>
                </svg>                          
            </a>
        </div>
    </div>
</template>

<script setup>
import { usePage, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import SingleSelectOptions from './SingleSelectOptions.vue';

const page = usePage();

function updateHorizontal() {
    let param;
    if (page.props.current_section.form_fields[0].options.align === 'horizontal') {
        page.props.current_section.form_fields[0].options.align = 'vertical';
        param = 'vertical';
    } else {
        page.props.current_section.form_fields[0].options.align = 'horizontal';
        param = 'horizontal';
    }

    const formFieldId = page.props.current_section.form_fields[0].id;
    const alignParam = param; // Replace with the actual value you want to send

    fetch(`/field/align/${formFieldId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken()
        },
        body: JSON.stringify({
            align: alignParam
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return;
    })
    .catch(error => {
        console.error('Error:', error); // Handle any errors
    });
}

function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}

function updateRandomize() {
    let param;
    if (page.props.current_section.form_fields[0].options.random == true) {
        page.props.current_section.form_fields[0].options.random = false;
        param = false;
    } else {
        page.props.current_section.form_fields[0].options.random = true;
        param = true;
    }

    const formFieldId = page.props.current_section.form_fields[0].id;
    const randomParam = param; // Replace with the actual value you want to send

    fetch(`/field/randomize/${formFieldId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken() // Include the CSRF token in the headers
        },
        body: JSON.stringify({
            random: randomParam
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return;
    })
    .catch(error => {
        console.error('Error:', error); // Handle any errors
    });
}

function updateHideLabels() {
    let param;
    if (page.props.current_section.form_fields[0].options.hide_label == true) {
        page.props.current_section.form_fields[0].options.hide_label = false;
        param = false;
    } else {
        page.props.current_section.form_fields[0].options.hide_label = true;
        param = true;
    }
    
    const formFieldId = page.props.current_section.form_fields[0].id;
    const hideParam = param; // Replace with the actual value you want to send

    fetch(`/field/hide-label/${formFieldId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken() // Include the CSRF token in the headers
        },
        body: JSON.stringify({
            hide: hideParam
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return;
    })
    .catch(error => {
        console.error('Error:', error); // Handle any errors
    });
}
</script>