<script setup>
import FormLayout from '@/Layouts/FormLayout.vue';
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';

const webhookModal = ref(false);
const page = usePage();

async function updateWebhook() {
    if(!page.props.form.form_integration){
        return;
    }
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    const response = await fetch(`/integrations/webhook/${page.props.form.form_integration.id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({
            webhook: page.props.form.form_integration.webhook
        }),
    });

    if (!response.ok) {
        throw new Error('Network response was not ok');
    }

    webhookModal.value = false;
}

</script>

<template>
    <FormLayout title="Connect">
        <div class="fixed inset-0 z-30 overflow-y-auto" aria-modal="true" style="display: none;">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <!-- Modal Content for Form Integrations -->
        <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-5 sm:w-full sm:max-w-4xl mx-4">
            <div class="bg-white px-6 pt-5 pb-4 sm:px-14 sm:py-16">
                <a href="#" @click.prevent="handleClose()" class="absolute top-3 right-3 block p-4 text-gray-500 hover:text-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </a>

                <h4 class="text-center text-2xl font-bold text-gray-800">Connect <strong>My Form</strong> to Slack</h4>

                <form class="mt-10 space-y-6 max-w-md mx-auto text-gray-700">
                    <!-- Slack Workspace Selector -->
                    <div>
                        <label class="block text-sm font-medium text-gray-900">Slack Workspace</label>
                        <select class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring-indigo-600">
                            <option value="new">+ Add New Workspace</option>
                        </select>
                    </div>

                    <!-- Slack Channel Input -->
                    <div>
                        <label class="block text-sm font-medium text-gray-900">Slack Channel</label>
                        <input type="text" placeholder="Enter channel name e.g. #general" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-600 focus:ring-indigo-600">
                        <button class="underline text-xs text-gray-500 mt-1">What's this?</button>
                    </div>

                    <!-- Error Message -->
                    <div class="rounded-md bg-red-50 p-4 hidden">
                        <div class="flex">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd"></path>
                            </svg>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Connection Error!</h3>
                                <p class="mt-1 text-sm text-red-700">Please check the channel name or add a new workspace.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Save and Test Notification -->
                    <div>
                        <button type="submit" class="w-full bg-indigo-600 px-4 py-2 text-white rounded-md hover:bg-indigo-700">Save →</button>
                        <p class="mt-2 text-xs text-center text-gray-500">A test notification will be sent upon saving.</p>
                    </div>
                </form>

                <div x-show="newWorkspaceMode" class="hidden">
                    <h4 class="text-sm font-semibold text-gray-600 my-4">Next, choose your workspace.</h4>
                    <img src="" alt="Slack Workspace Change" class="rounded-md shadow-md my-4">
                    <a href="" class="block w-full text-center bg-indigo-600 text-xs text-white py-1.5 rounded-md hover:bg-indigo-500">Authorize New Slack Workspace →</a>
                    <button class="text-sm text-gray-600 block w-full text-center mt-2" @click="handleOpen">← Or go back</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Integration List Section -->
<div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Email Integration Card -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-5">
            <img class="h-16 w-16 mx-auto" src="/images/R.png" alt="Email Integration">
            <h5 class="mt-4 text-lg font-semibold text-gray-900 text-center">Email</h5>
            <p class="mt-1 text-xs text-gray-500 text-center">Send and receive emails for each submission.</p>
            <a class="mt-2 block text-center text-indigo-600 hover:underline" href="#">Configure from settings →</a>
        </div>

        <!-- Webhook Integration Card -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-5">
            <img class="h-16 w-16 mx-auto" src="/images/webhook.png" alt="Webhook Integration">
            <h5 class="mt-4 text-lg font-semibold text-gray-900 text-center">Webhook</h5>
            <p class="mt-1 text-xs text-gray-500 text-center">Receive a webhook for all submissions.</p>
            <a class="mt-2 block text-center text-indigo-600 hover:underline cursor-pointer" @click="webhookModal=true">Add Webhook</a>
        </div>

        <!-- Google Sheets Integration Card -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-5">
            <img class="h-16 w-16 mx-auto" src="/images/googlesheets.png" alt="Google Sheets Integration">
            <h5 class="mt-4 text-lg font-semibold text-gray-900 text-center">Google Sheets</h5>
            <p class="mt-1 text-xs text-gray-500 text-center">Sync your submissions to a Google Sheet.</p>
            <a class="mt-2 block text-center text-indigo-600 hover:underline" href="#">Connect to Google Sheet →</a>
        </div>

        <!-- Zapier Integration Card -->
        <!-- <div class="bg-white rounded-lg shadow-md border border-gray-200 p-5">
            <img class="h-16 w-16 mx-auto" src="" alt="Zapier Integration">
            <h5 class="mt-4 text-lg font-semibold text-gray-900 text-center">Zapier</h5>
            <p class="mt-1 text-xs text-gray-500 text-center">Automate tasks and connect with other apps.</p>
            <a class="mt-2 block text-center text-indigo-600 hover:underline" href="#">Connect your Zapier account →</a>
        </div> -->
    </div>
</div>

<div class="z-100" aria-modal="true" data-has-alpine-state="true" v-if="webhookModal" @keydown.esc="webhookModal=false" tabindex="0">
    <div class="absolute z-20 inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="absolute inset-0 z-30 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
          <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-5 sm:w-full sm:max-w-4xl mx-4">
            <div class="bg-white px-4 pt-5 pb-4 sm:px-14 sm:py-16">
                <a href="#" @click="webhookModal=false" class="absolute top-4 right-4 block p-4 ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>              
                </a>
                <h4 class="text-2xl font-semibold text-center">
                    Enter your webhook URL
                </h4>
                <div class="flex items-center mt-6 justify-center w-full">
                    <div>
                        <div>
                            <input @keyup.enter="updateWebhook" type="text" v-model="page.props.form.form_integration.webhook" name="webhook" class="block w-96 rounded-md rounded-r-none border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="https://mywebhook.com">
                        </div>
                    </div>  
                    <div>
                        <button type="button" class="rounded-md bg-gray-700 px-3 py-2 text-sm font-semibold text-white rounded-l-none shadow-sm hover:bg-gray-600">
                            <span @click="updateWebhook" style="display: inline-block;">
                                Submit
                            </span>
                        </button>
                    </div>
                </div>
                <div class="text-center mt-8">
                    <a href="" target="_blank" class="text-blue-600 text-sm underline">
                        How to use this?
                    </a>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>
    </FormLayout>
</template>