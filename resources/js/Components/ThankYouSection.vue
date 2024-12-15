<template>
    <div class="mt-8">
        <nav class="isolate flex divide-x divide-gray-200 rounded-lg shadow" aria-label="Tabs">
            <button type="button" @click="updatePostSubmissionAction('end', 'button')" :class="{'text-gray-900': postSubmissionAction == 'button', 'text-gray-500 hover:text-gray-700': postSubmissionAction != 'button'}" class="rounded-l-lg group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10 text-gray-900">
                <span>Button</span>
                <span aria-hidden="true" :class="{'bg-gray-500': postSubmissionAction == 'button', 'bg-transparent': postSubmissionAction != 'button'}" class="absolute inset-x-0 bottom-0 h-0.5 bg-gray-500"></span>
            </button>
            <button type="button" @click="updatePostSubmissionAction('end', 'redirect')" :class="{'text-gray-900': postSubmissionAction == 'redirect', 'text-gray-500 hover:text-gray-700': postSubmissionAction != 'redirect'}" class="rounded-r-lg group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-4 text-center text-sm font-medium hover:bg-gray-50 focus:z-10 text-gray-500 hover:text-gray-700">
                <span>Redirect</span>
                <span aria-hidden="true" :class="{'bg-gray-500': postSubmissionAction == 'redirect', 'bg-transparent': postSubmissionAction != 'redirect'}" class="absolute inset-x-0 bottom-0 h-0.5 bg-transparent"></span>
            </button>
        </nav>
        <div v-if="page.props.current_section.options.end === 'button'" class="bg-gray-50 px-4 py-6">
            <p class="text-xs text-gray-600">
                Show a button to your users after they have submitted the form. 
            </p>
            <div class="mt-6">
                <label for="text-cta-text-editor" class="block text-sm font-medium text-gray-700">
                    Button Text 
                    <button class="text-xs py-0.5 px-2 font-normal rounded-md bg-pink-600 text-white cursor-pointer" title="Allowed in PREMIUM plan">
                        PREMIUM
                    </button>
                </label>
                <div class="mt-1">
                    <input type="text" v-model="page.props.current_section.button_text" name="text-cta-text-editor" id="text-cta-text-editor" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm" placeholder="Next">
                </div>
            </div>
            <div class="mt-4">
                <label for="text-cta-link-editor" class="block text-sm font-medium text-gray-700">
                    Button Link 
                    <button class="text-xs py-0.5 px-2 font-normal rounded-md bg-pink-600 text-white cursor-pointer" title="Allowed in PREMIUM plan">
                        PREMIUM
                    </button>
                </label>
                <div class="mt-1">
                    <input type="text" @blur="updateProp('button_link', page.props.current_section.options.button_link)" v-model="page.props.current_section.options.button_link" name="text-cta-link-editor" id="text-cta-link-editor" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm" placeholder="youform.com">
                </div>
            </div>
        </div>
        <div v-else class="bg-gray-50 px-4 py-6">
            <p class="text-xs text-gray-600">
                Redirect your users after they have submitted the form.
            </p>
            <div class="mt-6">
                <label for="text-redirect-url-editor" class="block text-sm font-medium text-gray-700">
                    Redirect URL 
                    <button class="text-xs py-0.5 px-2 font-normal rounded-md bg-pink-600 text-white cursor-pointer" title="Allowed in PREMIUM plan">
                        PREMIUM
                    </button>
                </label>
                <div class="mt-1">
                    <input type="text" @blur="updateProp('redirect_url', page.props.current_section.options.redirect_url)" v-model="page.props.current_section.options.redirect_url" name="text-redirect-url-editor" id="text-redirect-url-editor" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm" placeholder="youform.com">
                </div>
            </div>
            <div class="mt-4">
                <label for="text-redirect-message-editor" class="block text-sm font-medium text-gray-700">
                    Redirect Message
                    <button class="text-xs py-0.5 px-2 font-normal rounded-md bg-pink-600 text-white cursor-pointer" title="Allowed in PREMIUM plan">
                        PREMIUM
                    </button>
                </label>
                <div class="mt-1">
                    <input type="text" @blur="updateProp('redirect_message', page.props.current_section.options.redirect_message)" v-model="page.props.current_section.options.redirect_message" name="text-redirect-message-editor" id="text-redirect-message-editor" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm" placeholder="Redirecting...">
                </div>
            </div>
            <div class="mt-4">
                <label for="text-redirect-delay-editor" class="block text-sm font-medium text-gray-700">
                    Redirect Delay (in seconds)
                    <button class="text-xs py-0.5 px-2 font-normal rounded-md bg-pink-600 text-white cursor-pointer" title="Allowed in PREMIUM plan">
                        PREMIUM
                    </button>
                </label>
                <div class="mt-1">
                    <select @change="updateProp('redirect_delay', page.props.current_section.options.redirect_delay)" v-model="page.props.current_section.options.redirect_delay" name="text-redirect-delay-editor" id="text-redirect-delay-editor" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';

const page = usePage(); 

function updatePostSubmissionAction(type, value){
    updateProp(type, value);
    page.props.current_section.options.end = value;
}

function updateProp(type, value){
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`/section/ending/${page.props.current_section.id}`,{
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            _token: csrfToken,
            jsonKey: type,
            value: value,
        })
    })
}
</script>