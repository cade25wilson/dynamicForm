<template>
    <div class="mt-6">
        <div>
            <div class="flex items-center justify-between">
                <label for="options-editor" class="block text-sm font-medium text-gray-700">Options</label>
                <a href="#" @click="addOption" class="text-sm text-gray-500 hover:text-gray-700 inline-block py-1 pl-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                    </svg>                      
                </a>
            </div>
            <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" style="display: none;"></div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&ZeroWidthSpace;</span>
                    <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6" style="display: none;">
                        <div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Bulk Insert Options</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Paste your options below, one per line.</p>
                                    <textarea x-model="bulkInsertOptions" x-ref="bulkInsertTextarea" @input="$refs.bulkInsertTextarea.style.height = 'auto'; $refs.bulkInsertTextarea.style.height = $refs.bulkInsertTextarea.scrollHeight + 'px'" rows="6" class="mt-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 sm:text-sm placeholder-gray-400" placeholder="Option 1
                                            Option 2
                                            Option 3">
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                            <button type="button" @click="insertBulkOptions" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-gray-600 text-base font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:ml-3 sm:w-auto sm:text-sm">Insert</button>
                            <button type="button" @click="showBulkInsertModal = false;" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto sm:text-sm">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>            
            <div>
                <ul class="space-y-2 mt-2" wire:sortable="updateOptionOrder" x-key="1efa9db2-7656-4051-aa4c-5c400493f03f-radio" wire:key="1efa9db2-7656-4051-aa4c-5c400493f03f-radio">
                    <li v-for="(option, index) in options.choices" :key="index" @click.outside="showSetting = false" @image-uploaded-to-owner.window="handleImageUploaded" x-key="1efa9db2-7656-4051-aa4c-5c400493f03f-radio-option-f54e5fc9-18ee-47f9-8953-b770a0fc7b2e" wire:key="1efa9db2-7656-4051-aa4c-5c400493f03f-radio-option-f54e5fc9-18ee-47f9-8953-b770a0fc7b2e" wire:sortable.item="f54e5fc9-18ee-47f9-8953-b770a0fc7b2e" class="flex items-center bg-white relative">
                        <button type="button" wire:sortable.handle="" class="border cursor-move border-gray-300 border-r-0 shadow-sm py-2.5 px-2 rounded-md rounded-r-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5"></path>
                            </svg>                          
                        </button>
                        <input type="text" :value="option" class="block w-full px-1 rounded-md rounded-l-none rounded-r-none border-l-0 border-r-0 border-gray-300 shadow-sm focus:border-gray-300 focus:ring-gray-300 sm:text-sm js_radio_options">
                        <button type="button" title="option settings" x-ref="settingButton" @click.prevent="showSetting = !showSetting" class="border border-gray-300 border-l-0 shadow-sm py-2.5 px-2 rounded-md rounded-l-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                            </svg>                              
                        </button>
                        <div class="absolute right-0 z-10 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" style="display: none; left: 1125px; top: 604px; position: absolute;">
                            <div class="py-1 divide-y divide-gray-200" role="none">
                                <button @click="openImageUploader" class="text-gray-700 flex items-center hover:bg-gray-100 px-4 py-2 text-sm w-full" role="menuitem" tabindex="-1" id="menu-item-0">
                                    <div class="flex items-center justify-between w-full">
                                        <div class="inline-flex items-center justify-between">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"></path>
                                            </svg>                                                                              
                                            <span>
                                                Image
                                            </span>
                                        </div>
                                    </div>
                                </button>
                                <button class="text-red-700 flex items-center hover:bg-gray-100 px-4 py-2 text-sm w-full" role="menuitem" tabindex="-1" id="menu-item-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                    </svg>                                          
                                    <span>Delete</span>
                                </button>
                            </div>
                        </div>
                    </li>
                    <li v-if="addNew" class="flex items-center bg-white relative">
                        <button type="button" class="border cursor-move border-gray-300 border-r-0 shadow-sm py-2.5 px-2 rounded-md rounded-r-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5"></path>
                            </svg>                          
                        </button>
                        <input type="text" class="block w-full px-1 rounded-md rounded-l-none rounded-r-none border-l-0 border-r-0 border-gray-300 shadow-sm focus:border-gray-300 focus:ring-gray-300 sm:text-sm js_radio_options"> 
                        <button type="button" title="option settings" class="border border-gray-300 border-l-0 shadow-sm py-2.5 px-2 rounded-md rounded-l-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                            </svg>                              
                        </button>

                        <div class="absolute right-0 z-10 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" style="display: none; left: 1125px; top: 696px; position: absolute;">
                            <div class="py-1 divide-y divide-gray-200" role="none">
                                <button @click="openImageUploader" class="text-gray-700 flex items-center hover:bg-gray-100 px-4 py-2 text-sm w-full" role="menuitem" tabindex="-1" id="menu-item-0">
                                    <div class="flex items-center justify-between w-full">
                                        <div class="inline-flex items-center justify-between">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"></path>
                                            </svg>                                                                              
                                            <span>
                                                Image
                                            </span>
                                        </div>
                                    </div>
                                </button>
                                <button class="text-red-700 flex items-center hover:bg-gray-100 px-4 py-2 text-sm w-full" role="menuitem" tabindex="-1" id="menu-item-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                    </svg>                                          
                                    <span>Delete</span>
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <p class="text-xs text-gray-500 pt-4">
                For bulk insert just paste them above or insert <button class="text-blue-600 underline" @click="showBulkInsertModal = true">here</button>
            </p>
        </div>
    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const page = usePage();

const options = ref(JSON.parse(page.props.current_section.form_fields[0].options));
const addNew = ref(false);
const showBulkInsertModal = ref(false);

function addOption() {
    addNew.value = true;
}
</script>
