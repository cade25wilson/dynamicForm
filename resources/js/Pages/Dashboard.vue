<script setup>
import { Link, router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import FormModal from '@/Components/FormModal.vue';
import WorkspaceModal from '@/Components/WorkspaceModal.vue';

const page = usePage();
const showFormDeleteModal = ref(false);
const showWorkspaceDeleteModal = ref(false);
const renameModal = ref(false);
const selectedFormId = ref(null);
const selectedWorkspaceId = ref(null);

function openFormDeleteModal(formId) {
    showFormDeleteModal.value = true;
    selectedFormId.value = formId;
}

function openWorkspaceDeleteModal(workspaceId) {
    showWorkspaceDeleteModal.value = true;
    selectedWorkspaceId.value = workspaceId;
}

function closeFormDeleteModal() {
    showFormDeleteModal.value = false;
    selectedFormId.value = null;
}

function closeWorkspaceDeleteModal() {
    showWorkspaceDeleteModal.value = false;
    selectedWorkspaceId.value = null;
}

function handleFormDelete() {
    if (!selectedFormId) {
        closeFormDeleteModal();
        return;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`/form/${selectedFormId.value}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                page.props.currentWorkspace.forms = page.props.currentWorkspace.forms.filter(form => form.id !== selectedFormId.value);
                closeFormDeleteModal();
                router.get(`/dashboard?workspace=${page.props.currentWorkspace.id}`);
            }
        })
        .catch(error => {
            console.error('Error occurred during form deletion:', error);
        });
}

function handleWorkspaceDelete() {
    if (!selectedWorkspaceId) {
        closeWorkspaceDeleteModal();
        return;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`/workspace/${selectedWorkspaceId.value}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            },
        })
        .then(response => {
            if (response.ok) {
                router.get('/dashboard');
                return;
            }
        })
        .catch(error => {
            console.error('Error occurred during workspace deletion:', error);
        });
}

async function updateName() {
    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const response = await fetch(`/workspace/${page.props.currentWorkspace.id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }, 
            body: JSON.stringify({
                name: page.props.currentWorkspace.name
            })
        });

        if (!response.ok){
            console.error('failed to update workspace name');
            return;
        }

        renameModal.value = false;
    } catch(error) {
        console.error('Error updating workspace name');
    }
}
</script>

<template>
<AppLayout title="Dashboard">
    <div v-if="showFormDeleteModal" class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-800 opacity-80">
                </div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&ZeroWidthSpace;</span>
            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="w-full mt-3 text-center sm:mt-0 sm:mx-4 sm:text-left">
                            <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-headline">
                                <span>Are you sure you want to delete this form?</span>
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    <span>This action is irreversible.</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" @click.prevent="handleFormDelete()" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white border border-transparent rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm bg-red-600 hover:bg-red-700">Yes! Delete it</button>
                    <button type="button" @click.prevent="closeFormDeleteModal()" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    
    <div v-if="showWorkspaceDeleteModal" class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-800 opacity-80">
                </div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&ZeroWidthSpace;</span>
            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="w-full mt-3 text-center sm:mt-0 sm:mx-4 sm:text-left">
                            <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-headline">
                                <span>Are you sure you want to delete this Workspace?</span>
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    <span>This action is irreversible.</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" @click.prevent="handleWorkspaceDelete()" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white border border-transparent rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm bg-red-600 hover:bg-red-700">Yes! Delete it</button>
                    <button type="button" @click.prevent="closeWorkspaceDeleteModal()" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed inset-0 flex items-center justify-center px-4 pt-4 pb-20 text-center sm:block sm:p-0" v-if="renameModal" @keydown.esc="renameModal=false" tabindex="0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-800 opacity-80"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&ZeroWidthSpace;</span>
        <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="w-full mt-3 text-center sm:mt-0 sm:mx-4 sm:text-left">
                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-headline">
                            <span>Rename Workspace</span>
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                <input @keyup.enter="updateName()" v-model="page.props.currentWorkspace.name" name="prompt-text" type="text" class="block w-full mt-3 border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 sm:text-sm">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                <button @click="updateName()" type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white border border-transparent rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:ml-3 sm:w-auto sm:text-sm bg-gray-600 hover:bg-gray-700">Rename</button>
                <button @click="renameModal=false" type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
    <div class="flex blurable">
        <aside class="w-1/6 bg-gray-100 dark:bg-gray-800 p-4 h-screen overflow-y-auto">
            <!-- Sidebar content -->
            <FormModal />
            <div class="flex items-center justify-between mt-5 mb-1">
                <p class="text-white">Workspaces</p>
                <WorkspaceModal />
            </div>
            <hr>
            <div v-if="page.props.workspaces">
                <div v-for="workspace in page.props.workspaces" :key="workspace.id" class="relative group">
                    <!-- Workspace Name -->
                    <p class="text-white my-3">
                        <Link :href="`/dashboard?workspace=${workspace.id}`">{{ workspace.name }}</Link>
                    </p>
                    
                    <!-- Ellipses (hidden by default) -->
                    <span 
                        class="absolute right-0 top-0 text-gray-400 cursor-pointer hidden group-hover:block"
                        @click="openWorkspaceDeleteModal(workspace.id)"
                    >
                        ...
                    </span>
                </div>
            </div>
        </aside>


        <main class="w-3/4 p-6">
            <h2 class="text-white cursor-pointer" @click="renameModal=true">  {{ page.props.currentWorkspace ? page.props.currentWorkspace.name : '' }}</h2>
            <div v-if="page.props.currentWorkspace && page.props.currentWorkspace.forms.length > 0" class="grid grid-cols-12 mt-7 py-1 gap-6">
                <div v-for="form in page.props.currentWorkspace.forms" :key="form.id" class="bg-white relative rounded-lg mx-4 md:mx-0 shadow-md hover:shadow-lg col-span-12 md:col-span-6 lg:col-span-3">
                    <!-- Form card -->
                    <Link :href="`/form/${form.id}`" class="text-center px-2 h-40 flex items-center justify-center rounded-t-lg bg-cover bg-center bg-no-repeat" :style="{ backgroundColor: '#ffffff !important', color: '#d1a4a4 !important' }">
                    <h1 class="text-2xl font-light px-2 line-clamp-4">{{ form.name }}</h1>
                    </Link>
                    <div class="py-4 px-1 border-t border-gray-200 flex items-center justify-between">
                        <div>
                            <div class="flex items-center">
                                <Link :href="`/responses/${form.id}`" class="cursor-pointer">
                                <span class="text-gray-400 cursor-default inline-block mx-2 text-xs py-1 px-2 cursor-pointer">
                                    {{ form.responses_count === 0 ? 'No Responses' : 
                                        form.responses_count === 1 ? '1 Response' : 
                                        `${form.responses_count} Responses` }}
                                </span>
                                </Link>
                            </div>
                        </div>
                        <div class="relative inline-block text-left">
                            <a href="#" @click.prevent="openFormDeleteModal(form.id)" class="text-red-600 flex items-center hover:bg-red-100 px-4 py-2 text-sm" role="menuitem" tabindex="-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                </svg>
                                <span>Delete</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <div v-else class="text-center text-gray-500">
                No forms available in this workspace.
            </div>
        </main>
    </div>
</AppLayout>
</template>

<style>
.cursor-pointer:hover {
    cursor: pointer;
}

.group:hover .group-hover\:block {
    display: block;
}
</style>
