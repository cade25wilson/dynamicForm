<template>
    <div class="mt-6" v-if="![3, 4, 5, 6, 8].includes(page.props.current_section.section_type_id)">
        <div class="flex items-center justify-between">
            <label for="text-align-editor" class="block text-sm font-medium text-gray-700">Text align</label>
        </div>
        <div class="mt-2 flex space-x-2">
            <button
                type="button"
                class="p-2 border rounded"
                :class="{'bg-gray-200': page.props.current_section.text_align === 'left'}"
                @click="page.props.current_section.text_align = 'left'; handleBlur();"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h8m-8 6h16"></path>
                </svg>
            </button>
            <button
                type="button"
                class="p-2 border rounded"
                :class="{'bg-gray-200': page.props.current_section.text_align === 'center'}"
                @click="page.props.current_section.text_align = 'center'; handleBlur();"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M8 12h8m-8 6h8"></path>
                </svg>
            </button>
            <button
                type="button"
                class="p-2 border rounded"
                :class="{'bg-gray-200': page.props.current_section.text_align === 'right'}"
                @click="page.props.current_section.text_align = 'right'; handleBlur();"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M10 12h10m-10 6h10"></path>
                </svg>
            </button>
        </div>
    </div>
</template>

<script setup>
import { usePage, router } from '@inertiajs/vue3';

const page = usePage(); 

function handleBlur(){
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`/section/single/${page.props.current_section.id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken // Pass the CSRF token in the headers
        },
            body: JSON.stringify({
            _token: csrfToken, // Also include the token in the body if needed
            input: 'text_align',
            value: page.props.current_section.text_align
        })
    });
}
</script>