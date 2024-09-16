<template>
    <div class="mt-6">
        <div class="flex items-center justify-between">
            <label for="text-description-editor" class="block text-sm font-medium text-gray-700">Description</label>
        </div>
        <div class="mt-1">
            <div>
                <!-- <div>
                    <div class="flex items-center p-2 text-xs bg-gray-100 border border-b-0 border-gray-200 rounded rounded-b-none" style="position: relative;" v-if="!youtubeEditor && !linkEditor">
                        <div class="mr-1 text-center lg:mr-5">
                            <button tabindex="-1" type="button" class="px-3 py-2 border border-gray-300 rounded shadow-sm bg-white text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <g fill="none" fill-rule="evenodd">
                                        <rect width="24" height="24"></rect>
                                        <path fill="#222" fill-rule="nonzero" d="M12.5,11 C13.8807119,11 15,9.88071187 15,8.5 C15,7.11928813 13.8807119,6 12.5,6 L10,6 L10,11 L12.5,11 Z M15.7564372,11.6057507 C17.0979396,12.384734 18,13.8370232 18,15.5 C18,17.9852814 15.9852814,20 13.5,20 L6,20 C6,19.3412452 6,19.5522847 6,19 C6,18.4477153 6,18.7690116 6,18 L8,18 L8,6 L6,6 L6,4 L12.5,4 C14.9852814,4 17,6.01471863 17,8.5 C17,9.7043145 16.5269107,10.7981331 15.7564372,11.6057507 Z M12.5,13 L10,13 L10,18 L13.5,18 C14.8807119,18 16,16.8807119 16,15.5 C16,14.1192881 14.8807119,13 13.5,13 L12.5,13 Z"></path>
                                    </g>
                                </svg>
                            </button>
                            <button tabindex="-1" type="button" class="px-3 py-2 border border-gray-300 rounded shadow-sm bg-white text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <g fill="none" fill-rule="evenodd">
                                        <rect width="24" height="24"></rect>
                                        <path fill="#222" fill-rule="nonzero" d="M15.0505677,6 L11.1864113,18 L13,18 L13,20 L7,20 L7,18 L9.08527599,18 L12.9494323,6 L11,6 L11,4 L17,4 L17,6 L15.0505677,6 Z"></path>
                                    </g>
                                </svg>
                            </button>
                        </div>
                        <div class="mr-1 text-center lg:mr-5">
                            <button tabindex="-1" type="button" class="px-3 py-2 text-gray-500 bg-white border border-gray-300 rounded shadow-sm hover:text-gray-800 hover:bg-gray-100" @click="linkEditor = true">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="mr-1 text-center lg:mr-5">
                            <button tabindex="-1" type="button" class="px-3 py-2 text-gray-500 bg-white border border-gray-300 rounded shadow-sm hover:text-gray-800 hover:bg-gray-100" @click="youtubeEditor = true">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 24 24" class="w-4 h-4">
                                    <path d="M21,5c0,0-3-1-9-1S3,5,3,5s-1,3-1,7s1,7,1,7s3,1,9,1s9-1,9-1s1-3,1-7S21,5,21,5z M10,15.464V8.536L16,12L10,15.464z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center p-2 text-xs bg-gray-100 border border-b-0 border-gray-200 rounded rounded-b-none" v-if="linkEditor">
                        <div>
                            <div class="relative flex items-center w-full">
                                <input type="text" placeholder="https://google.com" v-model="urlLink" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" @click="editor=false">
                                <button type="button" class="rounded ml-2 bg-gray-600 px-2 py-2 font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"></path>
                                    </svg>
                                </button>
                                <button @click="linkEditor = false" type="button" class="rounded ml-2 bg-white px-2 py-2 font-semibold text-gray-700 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center p-2 text-xs bg-gray-100 border border-b-0 border-gray-200 rounded rounded-b-none" v-if="youtubeEditor">
                        <div>
                            <div class="relative flex items-center w-full">
                                <input type="text" placeholder="https://youtube.com/watch?v=xvFZjo5PgG0" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                                <button type="button" class="rounded ml-2 bg-gray-600 px-2 py-2 font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"></path>
                                    </svg>
                                </button>
                                <button type="button" class="rounded ml-2 bg-white px-2 py-2 font-semibold text-gray-700 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500" @click="youtubeEditor = false">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div> -->
                <textarea data-editable="1" @keyup.enter="handleInput" @blur="handleInput" class="overflow-auto text-sm md:text-base text-gray-700" v-model="page.props.current_section.description"><div contenteditable="true" translate="no" class="tiptap ProseMirror" tabindex="0"><p><br class="ProseMirror-trailingBreak"></p></div></textarea>
            </div>
        </div>
    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import { defineEmits, ref } from 'vue';

const page = usePage();
const emit = defineEmits(['blur']);
const youtubeEditor = ref(false);
const linkEditor = ref(false);
const urlLink = ref('');

function handleBlur() {
    emit('blur');
}
const handleInput = () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`/section/single/${page.props.current_section.id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken // Pass the CSRF token in the headers
        },
            body: JSON.stringify({
            _token: csrfToken, // Also include the token in the body if needed
            input: 'description',
            value: page.props.current_section.description
        })
    });
}
</script>
