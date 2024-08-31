<template>
    <div class="container">
    <div class="scrollable-content">      
        <div class="mt-4">
            <label for="text-title-editor" class="block text-sm font-medium text-gray-700">Title</label>
            <div class="mt-1">
                <input @focus-question-input.window="$el.focus()" @keyup.enter="handleBlur" @blur="handleBlur" v-model="page.props.current_section.name" type="text" name="text-title-editor" id="text-title-editor" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm" placeholder="Write your title here...">
            </div>
        </div>
        <div class="mt-6">
            <div class="flex items-center justify-between">
                <label for="text-description-editor" class="block text-sm font-medium text-gray-700">Description</label>
            </div>
            <div class="mt-1">
                <div>
                    <div >
                        <div class="flex items-center p-2 text-xs bg-gray-100 border border-b-0 border-gray-200 rounded rounded-b-none" style="position: relative;" v-if="!editor">
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
                                <button tabindex="-1" type="button" class="px-3 py-2 text-gray-500 bg-white border border-gray-300 rounded shadow-sm hover:text-gray-800 hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="mr-1 text-center lg:mr-5">
                                <button tabindex="-1" type="button" class="px-3 py-2 text-gray-500 bg-white border border-gray-300 rounded shadow-sm hover:text-gray-800 hover:bg-gray-100" @click="editor=true">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 24 24" class="w-4 h-4">
                                        <path d="M21,5c0,0-3-1-9-1S3,5,3,5s-1,3-1,7s1,7,1,7s3,1,9,1s9-1,9-1s1-3,1-7S21,5,21,5z M10,15.464V8.536L16,12L10,15.464z"></path>
                                    </svg>  
                                </button>
                            </div>
                        </div>
                        <div v-else class="flex items-center p-2 text-xs bg-gray-100 border border-b-0 border-gray-200 rounded rounded-b-none" style=" position: relative;">
                            <div>
                                <div class="relative flex items-center w-full">
                                    <input type="text" placeholder="https://google.com" v-model="urlLink" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" @click="editor=false">
                                    <button type="button" class="rounded ml-2 bg-gray-600 px-2 py-2 font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"></path>
                                        </svg>                          
                                    </button>
                                    <button type="button" class="rounded ml-2 bg-white px-2 py-2 font-semibold text-gray-700 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500" @click="editor=false">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                                        </svg>                          
                                    </button>
                                </div>
                            </div>
                        </div>
                    <div class="flex items-center p-2 text-xs bg-gray-100 border border-b-0 border-gray-200 rounded rounded-b-none" style="display: none; position: relative;">
                        <div>
                            <div class="relative flex items-center w-full">
                                <input type="text" placeholder="https://youtube.com/watch?v=xvFZjo5PgG0" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                                <button type="button" class="rounded ml-2 bg-gray-600 px-2 py-2 font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"></path>
                                    </svg>                          
                                </button>
                                <button type="button" class="rounded ml-2 bg-white px-2 py-2 font-semibold text-gray-700 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500" @click="editor=true">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                                    </svg>                          
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <textarea data-editable="1" @blur="handleBlur" class="overflow-auto text-sm md:text-base text-gray-700" v-model="page.props.current_section.description"><div contenteditable="true" translate="no" class="tiptap ProseMirror" tabindex="0"><p><br class="ProseMirror-trailingBreak"></p></div></textarea>
            </div>
        </div>
    </div>
    <div>
        <div class="mt-6 border-b border-gray-100 pb-4" v-if="![3, 4, 5, 6, 8, 9, 10, 11].includes(page.props.current_section.section_type_id)">
            <div class="flex items-center justify-between">
                <label for="embed-url-editor" class="block text-sm font-medium text-gray-700">
                    Embed 
                </label>
                <div class="flex items-center space-x-2">
                    <button class="bg-gray-100 hover:bg-gray-200 p-1 border border-gray-200 rounded-md" >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                        </svg>
                    </button>
                </div>
            </div>              
            <div class="mt-1" style="display: none;">
                <input type="text"  name="embed-url-editor" id="embed-url-editor" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm" placeholder="E.g https://loom.com/share/a8014d4f0e3143159ea1aec4c85bf6hu">
            </div>
        </div>
    </div>
    <TextAlign v-if="![3, 4, 5, 6, 8, 9, 10, 11].includes(page.props.current_section.section_type_id)" />
    <ContactDesign v-if="page.props.current_section.section_type_id===3" />
    <FormFields v-if="hasOneField && ![8, 9, 10].includes(page.props.current_section.section_type_id)"/>
    <SingleSelect v-if="[8, 9, 10].includes(page.props.current_section.section_type_id)" />
    <div class="mt-6">
        <label for="text-cta-text-editor" class="block text-sm font-medium text-gray-700">
            Button Text 
        </label>
        <div class="mt-1">
            <input type="text" @blur="handleBlur" v-model="page.props.current_section.button_text" name="text-cta-text-editor" id="text-cta-text-editor" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm" placeholder="Next">
        </div>
    </div>
    <div class="mt-6 pt-6" v-if="![8, 9, 10, 11].includes(page.props.current_section.section_type_id)">
        <div class="flex items-center justify-between">
            <p class="block text-sm font-medium text-gray-700">
                Background Image
            </p>
        </div>
        <label class="flex items-center mt-2 justify-center border border-gray-200 rounded-md p-6 hover:bg-gray-50 cursor-pointer">
            <span class="text-sm text-gray-500" v-if="!page.props.current_section.background_image">
                Select Image
            </span>
            <div class="h-10 w-auto" v-else>
                <img :src="page.props.current_section.background_image" alt="Cover Image" class="h-full max-h-full w-auto max-w-full object-contain">
            </div>
            <input type="file" accept="image/png, image/jpeg" class="text-xs hidden" @change="updateBackground">
        </label>
    </div>
</div>
</div>
</template>

<script setup>
import { computed, ref, onMounted, watch, nextTick, onBeforeUnmount } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import ContactDesign from './ContactDesign.vue';
import FormFields from './FormFields.vue';
import SingleSelect from './SingleSelect.vue';
import TextAlign from './TextAlign.vue';

const page = usePage(); 
const editor = ref(false);
const urlLink = ref(null);

function handleBlur(){
    let embed;

    // Check if 'options' exists and is not null
    if (page.props.current_section.options) {
        embed = page.props.current_section.options.embed || null;
    } else {
        embed = null;
    }

    router.put(`/section/${page.props.current_section.id}`, {
        _token: page.props.csrf_token,
        button_text: page.props.current_section.button_text,
        name: page.props.current_section.name,
        description: page.props.current_section.description,
        text_align: page.props.current_section.text_align,
        embed: embed
    });
}

function updateBackground(event) {
    const file = event.target.files[0];
    if (file) {
        page.props.current_section.background_image = file;
        router.put(`/background/${page.props.current_section.id}`, {
            background_image: file,
        });
    }
}

const hasOneField = computed(() => {
  return page.props.current_section.form_fields.length === 1;
});

</script>

<style>
    .container {
        height: 88vh; /* Full viewport height */
        overflow: hidden; /* Prevent the page from scrolling */
    }

    .ProseMirror {
        padding: 1rem;
        border: 1px solid #E5E7EB;
        min-height: 5rem;
        max-height: 25rem;
        border-radius: 0 0 0.25rem 0.25rem;
        overflow: auto;
        font-size: 0.9rem;
        outline: #000000;
    }

    .ProseMirror h1 {
        font-size: 2em;
    }

    .ProseMirror ul {
        list-style-type: disc;
        margin-block-start: 1em;
        margin-block-end: 1em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
        padding-inline-start: 40px;
    }

    .ProseMirror code {
        padding: 0.25rem !important;
        border-radius: 0.25rem;
        --tw-bg-opacity: 1;
        background-color: rgba(251, 207, 232, var(--tw-bg-opacity));
    }

    .ProseMirror .data-variable {
        padding: 0.3rem;
        background-color: rgba(252, 231, 243, var(--tw-bg-opacity));
        border-radius: 0.25rem;
    }

    .subject-line {
        --tag-bg : #FCE7F3;
        --tag-hover : #FCE7F3;
    }

    textarea {
        width: 100%;
        min-height: 150px;
        padding: 8px;
        border: 1px solid #e2e8f0;
        border-radius: 0.375rem;
        background-color: #f9fafb;
        font-size: 0.875rem;
        color: #4a5568;
        overflow: auto;
        resize: vertical;
    }

    .scrollable-content {
        height: 100%;
        overflow-y: auto; /* Enable vertical scrolling */
        padding-right: 16px; /* Adjust padding to prevent scrollbar overlap */
        box-sizing: content-box; /* Ensure padding doesn't affect the width */
    }
</style>        