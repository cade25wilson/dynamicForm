<template>
            {{ page }}
    <FormLayout title="Responses">
        <div class="py-10">
            <header>
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 md:flex md:items-center justify-between">
                    <div class="flex items-center col-span-1">
                        <h1 class="truncate pr-2 leading-tight tracking-tight text-gray-700">
                            Submissions of My Form
                        </h1>
                        <svg class="animate-spin h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle  cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button @click="deleteSubmissions" type="button" class="inline-flex mt-4 md:mt-0 items-center rounded-md border border-transparent bg-red-600 text-white px-4 py-2 text-xs  shadow-sm hover:bg-red-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2" style="display: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"></path>
                            </svg>                      
                            <span>
                                Delete <span>0</span>
                            </span>
                        </button>
                        <button @click="expandRows()" class="bg-gray-200 px-4 py-1.5 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"></path>
                            </svg>                      
                        </button>
                        <button @click="collapseRows()" class="bg-gray-200 px-4 py-1.5 rounded-md" style="display: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 9V4.5M9 9H4.5M9 9 3.75 3.75M9 15v4.5M9 15H4.5M9 15l-5.25 5.25M15 9h4.5M15 9V4.5M15 9l5.25-5.25M15 15h4.5M15 15v4.5m0-4.5 5.25 5.25"></path>
                            </svg>                                         
                        </button>
                        <button type="button" class="inline-flex mt-4 md:mt-0 items-center rounded-md border border-transparent bg-gray-600 px-4 py-1.5 text-xs text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"></path>
                            </svg>                                 
                            <span>
                                Download
                            </span>
                            <span>
                                Downloading...
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
                            <nav x-data="" class="-mb-px flex space-x-8" aria-label="Tabs" data-has-alpine-state="true">                            
                                <a href="#" x-tooltip.raw="Completed submissions only." @click.prevent="resetSelection" class=" border-indigo-500 text-indigo-600  flex whitespace-nowrap border-b-2 py-4 px-1 text-sm">
                                    Completed
                                    <span class=" bg-indigo-100 text-indigo-600  ml-3 rounded-full py-0.5 px-2.5 text-xs inline-block">2</span>
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
                                            <div class=" w-full h-full" :class="{ 'border-r border-gray-300': scrolledRight }" style="box-shadow: rgb(227, 227, 227) 1px 0px 0px;">
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
                                        @click="$dispatch('open-submission-modal', { submission_id: row.response_id })" 
                                        v-for="(row, rowIndex) in tableData.rows" 
                                        :key="row.response_id"
                                    >
                                        <td class="text-sm text-gray-900 sticky left-0 z-10 bg-white group-hover:bg-gray-100 w-8 border border-gray-200 p-0" >
                                            <div class="w-full h-full flex items-center justify-center" :class="{ 'border-r border-gray-300': scrolledRight }" style="box-shadow: rgb(227, 227, 227) 1px 0px 0px;">
                                                <label @click.stop="" class="cursor-pointer py-5 px-2 block text-center">
                                                    <input type="checkbox" :value="row.response_id" class="h-4 w-4 mx-auto rounded border-gray-300 text-gray-600 focus:ring-gray-600 focus:ring-0 cursor-pointer">
                                                </label>
                                            </div>
                                        </td>
                                        <template v-for="(field, index) in row">
                                            <td 
                                                class="text-sm text-gray-900 sticky left-0 z-10 bg-white group-hover:bg-gray-100 w-8 border border-gray-200 p-0" 
                                                v-if="index !== 'response_id'"
                                                :key="index"
                                            >
                                                <div class="w-full h-full flex items-center justify-center" :class="{ 'border-r border-gray-300': scrolledRight }" style="box-shadow: rgb(227, 227, 227) 1px 0px 0px;">
                                                    <label @click.stop="" class="cursor-pointer py-5 px-2 block text-center">
                                                        {{ index }}
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
</div>
</FormLayout>
    
</template>

<script setup>
    import { usePage } from '@inertiajs/vue3'
    const page = usePage()
    import FormLayout from '@/Layouts/FormLayout.vue';

    const props = defineProps({
        tableData: Object,
    })
</script>