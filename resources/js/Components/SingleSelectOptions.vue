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
            
            <div>
                <ul class="space-y-2 mt-2">
                    <li v-for="(option, index) in page.props.current_section.form_fields[0].options.choices" :key="index" @click.outside="showSetting[index] = false" @image-uploaded-to-owner.window="handleImageUploaded" class="flex items-center bg-white relative">
                        <button type="button" class="border cursor-move border-gray-300 border-r-0 shadow-sm py-2.5 px-2 rounded-md rounded-r-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5"></path>
                            </svg>                          
                        </button>
                        <input type="text" :value="option" class="block w-full px-1 rounded-md rounded-l-none rounded-r-none border-l-0 border-r-0 border-gray-300 shadow-sm focus:border-gray-300 focus:ring-gray-300 sm:text-sm js_radio_options">
                        <button type="button" title="option settings" @click.stop="toggleShowSetting(index)" class="border border-gray-300 border-l-0 shadow-sm py-2.5 px-2 rounded-md rounded-l-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                            </svg>                              
                        </button>

                        <!-- Settings Dropdown -->
                        <div class="absolute right-0 z-10 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" v-if="showSetting[index]">
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
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
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
                        <input @blur="addNewOption()" @keyup.enter="addNewOption()" v-model="optionName" type="text" class="block w-full px-1 rounded-md rounded-l-none rounded-r-none border-l-0 border-r-0 border-gray-300 shadow-sm focus:border-gray-300 focus:ring-gray-300 sm:text-sm js_radio_options">
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
import { usePage, router } from '@inertiajs/vue3';
import { reactive, ref, onMounted } from 'vue';

const page = usePage();

const optionName = ref(null);
const showSetting = reactive({});
const addNew = ref(false);
const showBulkInsertModal = ref(false);

// Initialize showSetting for each option
onMounted(() => {
    page.props.current_section.form_fields[0].options.choices.forEach((_, index) => {
        showSetting[index] = false;
    });
});

function addOption() {
    addNew.value = true;
}

function addNewOption(){
    router.put(`/field/option/${page.props.current_section.form_fields[0].id}`, {
        _token: page.props.csrf_token,
        name: optionName.value
    });
    optionName.value = '';
    addNew.value = false;
}

function toggleShowSetting(index) {
    console.log('toggle ' + index);
    showSetting[index] = !showSetting[index];
    console.log(showSetting[index]);
}
</script>
