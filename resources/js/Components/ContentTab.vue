<template>
    <div class="container">
    <div class="scrollable-content">      
        <div class="mt-4">
            <label for="text-title-editor" class="block text-sm font-medium text-gray-700">Title</label>
            <div class="mt-1">
                <input @focus-question-input.window="$el.focus()" @keyup.enter="updateField('name', page.props.current_section.name)" @blur="updateField('name', page.props.current_section.name)" v-model="page.props.current_section.name" type="text" name="text-title-editor" id="text-title-editor" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm" placeholder="Write your title here...">
            </div>
        </div>
        <DescriptionEditor @blur="handleBlur"/>
    <div>
        <div class="mt-6 border-b border-gray-100 pb-4" v-if="![3, 4, 5, 6, 8, 9, 10, 11, 12, 13, 14, 15, 16].includes(page.props.current_section.section_type_id)">
            <div class="flex items-center justify-between">
                <label for="embed-url-editor" class="block text-sm font-medium text-gray-700">
                    Embed 
                </label>
                <div class="flex items-center space-x-2">
                    <button class="bg-gray-100 hover:bg-gray-200 p-1 border border-gray-200 rounded-md" @click="showEmbed = !showEmbed">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                        </svg>
                    </button>
                </div>
            </div>              
            <div class="mt-1" v-if="showEmbed">
                <input type="text" @blur="handleBlur" v-model="page.props.current_section.options.embed" name="embed-url-editor" id="embed-url-editor" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm" placeholder="E.g https://www.milk.com/">
            </div>
        </div>
    </div>
    <ThankYouSection v-if="page.props.current_section.section_type_id == 2" />
    <TextAlign v-if="![2, 3, 4, 5, 6, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17].includes(page.props.current_section.section_type_id)" />
    <ContactDesign v-if="page.props.current_section.section_type_id===3" />
    <FormFields v-if="hasOneField && ![8, 9, 10].includes(page.props.current_section.section_type_id)"/>
    <SingleSelect v-if="[8, 9, 10].includes(page.props.current_section.section_type_id)" />
    <SchedulerOptions v-if="page.props.current_section.section_type_id == 12" />
    <StarFields v-if="page.props.current_section.section_type_id == 13"/>
    <StripeConnect v-if="page.props.current_section.section_type_id == 17"/>
    <div class="mt-6" v-if="![2].includes(page.props.current_section.section_type_id)">
        <label for="text-cta-text-editor" class="block text-sm font-medium text-gray-700">
            Button Text 
        </label>
        <div class="mt-1">
            <input type="text" @blur="updateField('button_text', page.props.current_section.button_text)" @keyup.enter="updateField('button_text', page.props.current_section.button_text)" v-model="page.props.current_section.button_text" name="text-cta-text-editor" id="text-cta-text-editor" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm" placeholder="Next">
        </div>
    </div>
    <div class="mt-6 pt-6" v-if="![8, 9, 10, 11, 12, 13, 14, 15, 16].includes(page.props.current_section.section_type_id)">
        <div class="flex items-center justify-between">
            <p class="block text-sm font-medium text-gray-700">
                Background Image
            </p>
        </div>
        <label class="flex items-center mt-2 justify-center border border-gray-200 rounded-md p-6 hover:bg-gray-50 cursor-pointer relative">
            <span class="text-sm text-gray-500" v-if="!page.props.current_section.background_image">
                Select Image
            </span>
            <div class="h-10 w-auto" v-else>
                <img :src="page.props.current_section.background_image" alt="Cover Image" class="h-full max-h-full w-auto max-w-full object-contain">
                <!-- Delete Icon -->
                <button
                    type="button"
                    @click="deleteSectionBackground"
                    class="absolute top-2 right-2 bg-white rounded-full p-1 shadow hover:bg-gray-100"
                    aria-label="Delete Background Image"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <input type="file" accept="image/png, image/jpeg" class="text-xs hidden" @change="updateSectionBackground">  
        </label>

    </div>
</div>
</div>
</template>

<script setup>
import { computed, ref } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import ContactDesign from './ContactDesign.vue';
import DescriptionEditor from './DescriptionEditor.vue';
import FormFields from './FormFields.vue';
import SchedulerOptions from './SchedulerOptions.vue';
import SingleSelect from './SingleSelect.vue';
import StarFields from './StarFields.vue';
import TextAlign from './TextAlign.vue';
import ThankYouSection from './ThankYouSection.vue';
import StripeConnect from './StripeConnect.vue';

const page = usePage(); 
const editor = ref(false);
const urlLink = ref(null);
const showEmbed = ref(false);

function updateField(input, value){
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`/section/single/${page.props.current_section.id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            _token: csrfToken,
            input: input,
            value: value
        })
    });
}

function handleBlur(){
    let embed;

    if (page.props.current_section.options) {
        embed = page.props.current_section.options.embed || null;
    } else {
        embed = null;
    }

    router.put(`/section/${page.props.current_section.id}`, {
        _token: page.props.csrf_token,
        embed: embed
    });
}

async function deleteSectionBackground(){
    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        await fetch(`/section/background/remove/${page.props.current_section.id}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        page.props.current_section.background_image = null;
    } catch (error) {
        console.error(error);
    }
}

async function updateSectionBackground(event) {
    const file = event.target.files[0];
    if (file) {
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const formData = new FormData();
            formData.append('background_image', file);
            formData.append('_token', csrfToken);

            const response = await fetch(`/section/background/${page.props.current_section.id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: formData,
            });

            if (response.ok) {
                const data = await response.json();
                page.props.current_section.background_image = data.background_image;
            } else {
                console.error('Failed to upload the image');
            }
        } catch (error) {
            console.error('Error uploading the background image:');
        }
    }
}


const hasOneField = computed(() => {
  return page.props.current_section.form_fields.length === 1;
});

</script>

<style>
    .container {
        height: 92vh;
        overflow: hidden;
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
        overflow-y: auto;
        box-sizing: content-box;
    }
</style>        