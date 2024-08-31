<template>
    <div class="mt-6" v-if="![5, 11].includes(page.props.current_section.section_type_id)">
        <label for="input-placeholder-text-editor" class="block text-sm font-medium text-gray-700">Placeholder</label>
        <div class="mt-1">
            <input 
                type="text" 
                v-model="page.props.current_section.form_fields[0].placeholder" 
                @blur="updateField(page.props.current_section.form_fields[0])" 
                name="input-placeholder-text-editor" 
                id="input-placeholder-text-editor" 
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm" 
                placeholder=""
            >
        </div>
    </div>

    <div class="relative flex items-start mt-6">
        <div class="flex h-6 items-center">
          <input 
              :checked="page.props.current_section.form_fields[0].required" 
              @change="toggleRequired(page.props.current_section.form_fields[0])" 
              id="input-required-checkbox-editor" 
              aria-describedby="input-required-checkbox-editor-description" 
              name="input-required-checkbox-editor" 
              type="checkbox" 
              class="h-4 w-4 rounded border-gray-300 text-gray-600 focus:ring-gray-600"
          >
        </div>
        <div class="ml-3 text-sm leading-6">
          <label for="input-required-checkbox-editor" class="text-sm font-medium text-gray-700">Required field</label>
          <p id="input-required-checkbox-editor-description" class="text-gray-500">If checked, users will be required to complete this field.</p>
        </div>
    </div>

    <div class="mt-6" v-if="page.props.current_section.section_type_id === 5">
        <label for="textarea-max-char-editor" class="block text-sm font-medium text-gray-700">
            Max character
        </label>
        <div class="mt-1">
            <input 
                type="number" 
                min="0" 
                max="1000000" 
                v-model="page.props.current_section.form_fields[0].options.length" 
                @blur="updateMaxChar(page.props.current_section.form_fields[0])" 
                name="textarea-max-char-editor" 
                id="textarea-max-char-editor" 
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm" 
                placeholder="e.g 30"
            >
        </div>
        <p class="text-gray-500 text-xs pt-1">
            Leave blank for no limit.
        </p>
    </div>
</template>

<script setup>
import { usePage, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const page = usePage();

function updateField(field){
    router.put(`/field/${field.id}`, {
        _token: page.props.csrf_token,
        label: field.label,
        placeholder: field.placeholder,
        show: field.show,
        required: field.required
    });
}

function updateMaxChar(field){
    router.put(`/field/maxlength/${field.id}`, {
        _token: page.props.csrf_token,
        length: page.props.current_section.form_fields[0].options.length
    });
}

function toggleRequired(field) {
    field.required = !field.required;
    updateField(field);
}
</script>
