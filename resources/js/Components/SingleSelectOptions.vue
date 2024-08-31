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

            <div v-if="imageUploader" @open-image-uploader.window="handleOpen()" @keyup.escape.window="handleClose()" @image-uploader-success.window="handleSuccess()" class="z-100 px-10" aria-modal="true" style="">
                <div x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed z-20 inset-0 bg-gray-500 bg-opacity-75 transition-opacity" style=""></div>
                <div class="fixed inset-0 z-30 overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-5 sm:w-full sm:max-w-4xl mx-4" style="">
                            <div class="bg-white px-4 pt-5 pb-4 sm:px-14 sm:py-6">
                                <a href="#" @click.prevent="handleClose()" class="absolute -top-3 -right-3 md:top-6 md:right-10 block p-4 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>              
                                </a>
                                <div class="w-full">
                                    <div>
                                        <div class="block">
                                            <div class="border-b border-gray-200">
                                                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                                    <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700" -->
                                                    <a href="#" @click.prevent="mode = 'upload'" :class="{'border-gray-500 text-gray-600': mode == 'upload', 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700': mode != 'upload'}" class="whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium border-gray-500 text-gray-600">
                                                        Upload
                                                    </a>
                                                    <a href="#" @click.prevent="mode = 'link'" :class="{'border-gray-500 text-gray-600': mode == 'link', 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700': mode != 'link'}" class="whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700">
                                                        Link
                                                    </a>
                                                    <a href="#" @click.prevent="" x-tooltip.raw="Coming soon!" :class="{'border-gray-500 text-gray-600': mode == 'unsplash', 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700': mode != 'unsplash'}" class="whitespace-nowrap cursor-not-allowed border-b-2 py-4 px-1 text-sm font-medium border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700">
                                                        Unsplash
                                                    </a>
                                                    <a href="#" @click.prevent="" x-tooltip.raw="Coming soon!" :class="{'border-gray-500 text-gray-600': mode == 'pexels', 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700': mode != 'pexels'}" class="whitespace-nowrap cursor-not-allowed border-b-2 py-4 px-1 text-sm font-medium border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700">
                                                        Pexels
                                                    </a>
                                                </nav>
                                            </div>
                                        <div>
                                            <div class="my-5 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10 bg-white" v-if="mode=='upload'">
                                                <div class="text-center" v-if="!loading">
                                                    <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                                        <label for="image-uploader" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                        <span>Upload a file</span>
                                                        <input id="image-uploader" name="image-uploader" type="file" accept="image/*" class="sr-only" @change="handleFileChange">
                                                        </label>
                                                        <p class="pl-1">or drag and drop</p>
                                                    </div>
                                                    <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                                                </div>
                                                <p class="text-center text-sm text-gray-500" v-if="loading">
                                                    Uploading...
                                                </p>
                                            </div>
                                            <div v-if="mode == 'link'" x-show="mode == 'link'" class="my-10">
                                                <label class="block text-sm font-medium leading-6 text-gray-900">Add image URL</label>
                                                <div class="mt-2">
                                                    <div class="flex w-full rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-gray-600"> 
                                                        <input v-model="linkInput" x-ref="linkInput" @keydown.enter="addViaLink" type="text" class="block w-full flex-1 border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="https://beautifulimage.com/cat.png">
                                                        <button @click="addViaLink" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-1 rounded-r-md">
                                                            + Add
                                                        </button>
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
            </div>
        </div>          
            <div v-if="showBulkInsertModal" @keydown.escape.window="showBulkInsertModal=false" @keydown.meta.enter.window="insertBulkOptions" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" data-has-alpine-state="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&ZeroWidthSpace;</span>
                    <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                        <div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Bulk Insert Options</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Paste your options below, one per line.</p>
                                    <textarea v-model="bulkInsert" rows="6" class="mt-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 sm:text-sm placeholder-gray-400" placeholder="Option 1
Option 2
Option 3"></textarea>
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

            <!-- <BulkInsertModal /> -->


            <div>
                <ul class="space-y-2 mt-2">
                    <li v-for="(option, index) in page.props.current_section.form_fields[0].options.choices" :key="index" @click.outside="showSetting[index] = false" @image-uploaded-to-owner.window="handleImageUploaded" class="flex items-center bg-white relative">
                        <button type="button" class="border cursor-move border-gray-300 border-r-0 shadow-sm py-2.5 px-2 rounded-md rounded-r-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5"></path>
                            </svg>
                        </button>
                        <input type="text" v-model="page.props.current_section.form_fields[0].options.choices[index].label" @blur="updateOption(page.props.current_section.form_fields[0].options.choices[index].label, index)" @keyup.enter="updateOption(page.props.current_section.form_fields[0].options.choices[index].label, index)" class="block w-full px-1 rounded-md rounded-l-none rounded-r-none border-l-0 border-r-0 border-gray-300 shadow-sm focus:border-gray-300 focus:ring-gray-300 sm:text-sm js_radio_options">
                        <button type="button" title="option settings" @click.stop="toggleShowSetting(index)" class="border border-gray-300 border-l-0 shadow-sm py-2.5 px-2 rounded-md rounded-l-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                            </svg>
                        </button>

                        <!-- Settings Dropdown -->
                        <div class="absolute right-0 z-10 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" v-if="showSetting[index]">
                            <div class="py-1 divide-y divide-gray-200" role="none">
                                <button @click="openImageUploader(index)" class="text-gray-700 flex items-center hover:bg-gray-100 px-4 py-2 text-sm w-full" role="menuitem" tabindex="-1" id="menu-item-0">
                                    <div class="flex items-center justify-between w-full">
                                        <div class="inline-flex items-center justify-between">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"></path>
                                            </svg>                                                                              
                                            <span>
                                                Image
                                            </span>
                                        </div>
                                        <a v-if="page.props.current_section.form_fields[0].options.choices[index].image" href="#" class="text-xs underline" @click.prevent.stop="handleImageDelete(index)">
                                            Remove
                                        </a>
                                    </div>
                                </button>
                                <button class="text-red-700 flex items-center hover:bg-gray-100 px-4 py-2 text-sm w-full" role="menuitem" tabindex="-1" id="menu-item-1" @click="deleteOption(index)">
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
const bulkInsert = ref(null);
const imageUploader = ref(false);
const addImageTo = ref(null);
const mode = ref('upload');
const linkInput = ref(null);

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

function updateOption(value, option){
    console.log(value + ' ' + option);
    router.put(`/field/update/option/${page.props.current_section.form_fields[0].id}`,{
        _token: page.props.csrf_token,
        index: option,
        value: value
    });
}

function deleteOption(option){
    router.put(`/field/option/choice/${page.props.current_section.form_fields[0].id}`,{
        _token: page.props.csrf_token,
        index: option
    });
}

const insertBulkOptions = () => {
    const optionsArray = bulkInsert.value.split('\n').filter(option => option.trim() !== '');
    router.put(`/field/option/bulk/${page.props.current_section.form_fields[0].id}`,{
        _token: page.props.csrf_token,
        items: optionsArray
    });
    bulkInsert.value = null;
    showBulkInsertModal.value = false;
};

function openImageUploader(index){
    addImageTo.value = index
    imageUploader.value = true;
}

function handleFileChange(event) {
    const file = event.target.files[0];
    if (!file) {
        return
    }
    router.put(`/field/update/image/${page.props.current_section.form_fields[0].id}`, {
        image: file,
        index: addImageTo.value
    });
    handleClose();
}

function handleClose(){
    addImageTo.value = null;
    imageUploader.value = false;
}

function handleImageDelete(index){
    router.put(`/field/delete/image/${page.props.current_section.form_fields[0].id}`, {
        index: index
    });
}

function addViaLink(){
    router.put(`/field/update/imagelink/${page.props.current_section.form_fields[0].id}`, {
        image: linkInput.value,
        index: addImageTo.value
    });
    linkInput.value = null;
    handleClose();
}
</script>
