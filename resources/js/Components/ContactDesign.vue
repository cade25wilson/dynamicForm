<template>
    <div class="mt-8">
        <div v-for="(field, index) in page.props.current_section.form_fields" :key="field.id">
            <div class="flex items-center justify-between mt-4">
                <label class="block text-sm font-light text-gray-800">{{ field.label }}</label>
                <div class="flex items-center space-x-4">
                    <!-- Show/Hide Setting Icon -->
                    <button type="button" @click="toggleFieldVisibility(field)" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5" v-if="field.show">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5" v-else>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"></path>
                        </svg>                             
                    </button>
                    <!-- Gear Icon -->
                    <button type="button" class="text-gray-500 hover:text-gray-700" @click="toggleSettings(field.id)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div v-if="openSettings[field.id]" class="mt-2 p-4 border rounded bg-gray-100">
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Label</label>
                    <input type="text" v-model="field.label" @keyup.enter="updateField(field)" @blur="updateField(field)" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Placeholder</label>
                    <input type="text" v-model="field.placeholder" @keyup.enter="updateField(field)" @blur="updateField(field)" class="block w-full rounded-md mt-1 border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm focus:ring-1">
                </div>
                <div class="flex items-center">
                    <div class="flex h-6 items-center">
                        <input id="field-first_name-required" type="checkbox" :checked="field.required" @change="field.required = !field.required; updateField(field)" class="h-4 w-4 rounded border-gray-300 text-gray-600 focus:ring-gray-600 focus:outline-none focus:ring-0">
                    </div>
                    <div class="ml-2 text-sm">
                        <label for="field-first_name-required" class="text-gray-600">Make this required?</label>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const openSettings = ref({});

async function updateField(field) {
    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const response = await fetch(`/field/${field.id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                label: field.label,
                placeholder: field.placeholder,
                show: field.show,
                required: field.required
            })
        });
    } catch (error) {
        console.error('Error:', error);
    }
}

function toggleFieldVisibility(field) {
    field.show = !field.show;
    updateField(field);
}

function toggleSettings(fieldId) {
    openSettings.value[fieldId] = !openSettings.value[fieldId];
}
</script>
