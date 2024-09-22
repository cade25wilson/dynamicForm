<template>
    <FormLayout title="Responses">
        <div class="py-10">
            <header>
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 md:flex md:items-center justify-between">
                    <div class="flex items-center col-span-1">
                        <h1 class="truncate pr-2 leading-tight tracking-tight text-gray-700">
                            Submissions of {{page.props.form.name}}
                        </h1>
                        <svg class="animate-spin h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle  cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button v-if="checkedResponses.length" @click="showDeleteModal = true" type="button" class="inline-flex mt-4 md:mt-0 items-center rounded-md border border-transparent bg-red-600 text-white px-4 py-2 text-xs  shadow-sm hover:bg-red-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"></path>
                            </svg>                      
                            <span>
                                Delete <span>{{checkedResponses.length}}</span>
                            </span>
                        </button>
                        <button @click="collapseRows()" class="bg-gray-200 px-4 py-1.5 rounded-md" style="display: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 9V4.5M9 9H4.5M9 9 3.75 3.75M9 15v4.5M9 15H4.5M9 15l-5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5 5.25 5.25"></path>
                            </svg>                                         
                        </button>
                        <button @click="downloadResponses()" type="button" class="inline-flex mt-4 md:mt-0 items-center rounded-md border border-transparent bg-gray-600 px-4 py-1.5 text-xs text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"></path>
                            </svg>                                 
                            <span>
                                Download
                            </span>
                        </button>
                    </div>
                </div>
            </header>
        </div>
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mt-4 flex flex-col font-light">
                <div class="bg-white px-6 rounded-md mx-1 mb-3 border-b border-gray-200">
                    <div class="">
                        <div class="">
                            <nav x-data="" class="-mb-px flex space-x-8" aria-label="Tabs">                            
                                <a href="#" x-tooltip.raw="Completed submissions only." @click.prevent="resetSelection" class=" border-indigo-500 text-indigo-600  flex whitespace-nowrap border-b-2 py-4 px-1 text-sm">
                                    Completed
                                    <span class=" bg-indigo-100 text-indigo-600  ml-3 rounded-full py-0.5 px-2.5 text-xs inline-block">{{page.props.tableData.rows.length}}</span>
                                </a>
                                <a href="#" x-tooltip.raw="In this tab you can view even those submissions which were not completed by your users. Only available in Youform PRO." class=" border-transparent text-gray-500 hover:border-gray-200 hover:text-gray-700  flex whitespace-nowrap border-b-2 py-4 px-1 text-sm" aria-current="page">
                                    Partial
                                    <span class=" bg-gray-100 text-gray-900  ml-3 rounded-full py-0.5 px-2.5 text-xs inline-block">0</span>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>  
                <div class="-my-2 overflow-x-auto">
                    <div class="inline-block min-w-full max-w-6xl py-2 align-middle">
                        <div class="overflow-auto shadow mx-1 ring-1 ring-black md:rounded-lg relative">
                            <table class="min-w-full break-words border-collapse border border-gray-200">
                                <thead class="bg-gray-50">
                                    <tr class="h-1">
                                        <th scope="col" class="border border-gray-200 text-left text-sm text-gray-700 sticky left-0 z-10 bg-gray-50 w-8 p-0" style="height: inherit">
                                            <div class=" w-full h-full" style="box-shadow: rgb(227, 227, 227) 1px 0px 0px;">
                                                <div class="px-2 py-5 flex items-center truncate invisible">
                                                    Action
                                                </div>
                                            </div>
                                        </th>
                                        <th scope="col" class="border border-gray-200 py-3 font-normal pl-4 pr-4 text-left text-sm text-gray-700 sm:pl-6 " v-for="header in tableData.headers"> 
                                            <div class="flex items-center min-w-40 truncate max-w-96">
                                                <div class="bg-amber-300 px-1.5 py-1 rounded-md">
                                                    <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15"></path>
                                                    </svg></span>
                                                </div>
                                                <div class="pl-2">
                                                    {{header}}
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <tr 
                                        class="cursor-pointer hover:bg-gray-100 group h-1" 
                                        v-for="(row, rowIndex) in tableData.rows" 
                                        :key="row.response_id"
                                        @click="openModal(row.response_id)" 
                                    >
                                        <td class="text-sm text-gray-900 sticky left-0 z-10 bg-white group-hover:bg-gray-100 w-8 border border-gray-200 p-0" >
                                            <div class="w-full h-full flex items-center justify-center" style="box-shadow: rgb(227, 227, 227) 1px 0px 0px;">
                                                <label @click.stop="" class="cursor-pointer py-5 px-2 block text-center">
                                                    <input v-model="checkedResponses" type="checkbox" :value="row.response_id" class="h-4 w-4 mx-auto rounded border-gray-300 text-gray-600 focus:ring-gray-600 focus:ring-0 cursor-pointer">
                                                </label>
                                            </div>
                                        </td>
                                        <template v-for="(field, index) in row">
                                            <td 
                                                class="text-sm text-gray-900 sticky left-0 z-10 bg-white group-hover:bg-gray-100 w-8 border border-gray-200 p-0" 
                                                v-if="index !== 'response_id'"
                                                :key="index"
                                            >
                                                <div class="w-full h-full flex items-center justify-center" style="box-shadow: rgb(227, 227, 227) 1px 0px 0px;">
                                                    <p class="truncate" v-if="field && field.includes('/signature/')">
                                                        <a :href="field" class="underline hover:bg-gray-100 block w-full h-full rounded-md" target="_blank">
                                                            <img :src="field" class="h-10">
                                                        </a>
                                                    </p>
                                                    <label v-if="field && !field.includes('/signature/')" class="cursor-pointer py-5 px-2 block text-center">
                                                        {{ field.length > 100 ? field.slice(0, 100) + '...' : field }}
                                                    </label>
                                                </div>
                                            </td>
                                        </template>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-4 mx-4">
                    <p class="text-xs text-gray-500 text-center">
                        Scroll horizontally to view all columns and click on a row to see the response if truncated.
                    </p>
                <div>
            </div>
        </div>
    </div>

    <div v-if="showDeleteModal" class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-800 opacity-80"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&ZeroWidthSpace;</span>
            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="w-full mt-3 text-center sm:mt-0 sm:mx-4 sm:text-left">
                            <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-headline">
                                <span x-text="title">Are you sure you want to delete this submission?</span>
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    <span x-text="body">This action is irreversible.</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button @click="deleteSubmissions" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white border border-transparent rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm bg-red-600 hover:bg-red-700" x-text="confirmBtnText">Yes! Delete it</button>
                    <button @click="showDeleteModal=false" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div v-if="showModal" class="z-100" aria-modal="true">
        <div class="fixed inset-0 z-30 overflow-y-auto font-light">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-5 sm:w-full sm:max-w-4xl mx-4">
                    <div class="bg-white px-4 pt-5 pb-4 sm:px-14 sm:py-8" v-if="responseData">
                        <div class="absolute mt-3 top-4 right-6 flex items-center justify-center space-x-3">
                            <div class="flex items-center justify-center">
                                <a href="#" @click.prevent="toggleDropdown()" class="inline-block p-1 hover:bg-gray-100 rounded-full">  
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244"></path>
                                    </svg>                                                               
                                </a>
                            </div>
                            <a href="#" @click.prevent="close()" class="inline-block p-1 hover:bg-gray-100 rounded-full">  
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                                </svg>                                      
                            </a>
                        </div>
                        <h4 class="text-lg font-normal text-center">
                            Submission Detail
                        </h4>
                        <div class="my-10 max-w-lg mx-auto">
                            <div>
                                <div class="text-sm mb-4 text-gray-500">
                                    <span>
                                        {{responseData.time}}
                                    </span>
                                    •
                                    <span>
                                        <!-- 16 hours ago -->
                                    </span>
                                </div>
                                <div class="py-4"
                                    v-for="(row, rowIndex) in responseData.data"
                                >
                                    <strong class="font-normal flex items-center mb-1"> 
                                        <span class="pl-2">
                                            {{rowIndex}}
                                        </span>
                                    </strong> 
                                    <div class="pl-6 text-gray-600">
                                        <template v-if="row && row.includes('/signature/')">
                                            <a :href="row" target="_blank" download="" class="py-2 hover:bg-gray-50 w-40 min-h-10 mt-2 inline-block border border-gray-300 border-dashed rounded-md">
                                                <img :src="row">
                                            </a>
                                        </template>
                                        <div v-else>{{ row }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</FormLayout>
    
</template>

<script setup>
    import { usePage } from '@inertiajs/vue3'
    import { ref } from 'vue';
    import FormLayout from '@/Layouts/FormLayout.vue';

    const props = defineProps({
        tableData: Object,
    });

    const page = usePage()
    const showModal = ref(false);
    const showDeleteModal = ref(false);
    const responseData = ref(null);
    const checkedResponses = ref([]);
    async function openModal(responseId) {
        showModal.value = true;
        try {
            const response = await fetch(`/responses/${page.props.form.id}/${responseId}`, {
                method: 'GET',
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            responseData.value = data;
            console.log(data);

        } catch (error) {
            console.error('There was a problem with the fetch operation:', error);
        }
    }
    function close(){
        showModal.value = false;
        responseData.value = null;
    }

    async function downloadResponses() {
        const response = await fetch(`/responses/download/${page.props.form.id}`, {
            method: 'POST',
            headers: {
                'Accept': '*/*',
                'Content-Type': 'application/json', // Add this line
                'X-CSRF-TOKEN': getCsrfToken()
            },
            body: JSON.stringify({
                responses: checkedResponses.value
            })
        });

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        const blob = await response.blob();
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'responses-file.xlsx';
        document.body.appendChild(a);
        a.click();
        a.remove();
    }

    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }

    async function deleteSubmissions() {
        const response = await fetch('/responses/destroy', {
            method: 'DELETE',
            headers: {
                'Accept': '*/*',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken()
            },
            body: JSON.stringify({
                responses: checkedResponses.value
            })
        });

        if (!response.ok) {
            showDeleteModal.value = false;
            throw new Error('Network response was not ok');
        }

        // Filter out the deleted responses from tableData.rows
        props.tableData.rows = props.tableData.rows.filter(row => !checkedResponses.value.includes(row.response_id));
        checkedResponses.value = [];
        showDeleteModal.value = false;
    }

</script>