<template>


<div class="mt-6">
        <div x-data="{
                    showBulkInsertModal: false,
                    bulkInsertOptions: '', 
                    insertBulkOptions() {
                        let options = this.bulkInsertOptions.split('\n').filter(option => option.trim() !== '');
                        if (options.length > 0) {
                            $wire.call('addMultipleOptions', -1, options);
                            this.showBulkInsertModal = false;
                        }
                    }
                }" data-has-alpine-state="true">
            <div class="flex items-center justify-between">
                <label for="options-editor" class="block text-sm font-medium text-gray-700">Options</label>
                <a href="#" wire:click.prevent="addOption" class="text-sm text-gray-500 hover:text-gray-700 inline-block py-1 pl-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                    </svg>                      
                </a>
            </div>

            <div x-data="{
        init() {
            this.$watch('showBulkInsertModal', value => {
                if(value) {
                    this.$nextTick(() => {
                        this.$refs.bulkInsertTextarea.focus();
                    });
                } else {
                    this.bulkInsertOptions = '';
                }
            });
        }
    }" x-show="showBulkInsertModal" @keydown.escape.window="showBulkInsertModal = false" @keydown.meta.enter.window="insertBulkOptions" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;" data-has-alpine-state="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="showBulkInsertModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" style="display: none;"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&ZeroWidthSpace;</span>

        <div x-show="showBulkInsertModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6" style="display: none;">
            <div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Bulk Insert Options</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Paste your options below, one per line.</p>
                        <textarea x-model="bulkInsertOptions" x-ref="bulkInsertTextarea" @input="$refs.bulkInsertTextarea.style.height = 'auto'; $refs.bulkInsertTextarea.style.height = $refs.bulkInsertTextarea.scrollHeight + 'px'" rows="6" class="mt-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 sm:text-sm placeholder-gray-400" placeholder="Option 1
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
                        <div>
                <ul class="space-y-2 mt-2" wire:sortable="updateOptionOrder">
                                        <li x-data="{
                            confirm_id: parseInt(Math.random()*1000000),
                            value: 'Option 1',
                            pasted: false,
                            updateOnServer() {
                                if(this.pasted) return;
                                
                                this.pasted = false;
                                $wire.call('updateValueInOption', 1, this.value);
                            },
                            handlePaste() {
                                
                                let entered_text = this.$event.clipboardData.getData('text');
                                if(! entered_text) return;
                                let multiple_lines = entered_text.split('\n');
                                this.pasted = true;
                                let first_value = multiple_lines[0];
                                
                                $wire.call('addMultipleOptions', 1, multiple_lines); 
                                

                                setTimeout(() => {
                                    this.value = first_value;
                                }, 200);
                            }
                        }" x-key="option-right-dd2bae5f-ef9c-4672-8223-06f785603ec3" wire:key="option-right-dd2bae5f-ef9c-4672-8223-06f785603ec3" wire:sortable.item="dd2bae5f-ef9c-4672-8223-06f785603ec3" class="flex items-center bg-white" data-has-alpine-state="true">
                        <button type="button" wire:sortable.handle="" class="border border-gray-300 border-r-0 shadow-sm py-2.5 px-2 rounded-md rounded-r-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5"></path>
                            </svg>                          
                        </button>
                        <input type="text" x-model="value" @keyup.enter="handleEnter" @paste="handlePaste" @input.debounce="updateOnServer()" class="block w-full rounded-md rounded-l-none rounded-r-none border-l-0 border-r-0 border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm js_dropdown_options">
                        <button type="button" wire:click.prevent="removeOption(1)" class="border border-gray-300 border-l-0 shadow-sm py-2.5 px-2 rounded-md rounded-l-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                            </svg>                          
                        </button>
                    </li>
                                        <li x-data="{
                            confirm_id: parseInt(Math.random()*1000000),
                            value: 'Option 2',
                            pasted: false,
                            updateOnServer() {
                                if(this.pasted) return;
                                
                                this.pasted = false;
                                $wire.call('updateValueInOption', 2, this.value);
                            },
                            handlePaste() {
                                
                                let entered_text = this.$event.clipboardData.getData('text');
                                if(! entered_text) return;
                                let multiple_lines = entered_text.split('\n');
                                this.pasted = true;
                                let first_value = multiple_lines[0];
                                
                                $wire.call('addMultipleOptions', 2, multiple_lines); 
                                

                                setTimeout(() => {
                                    this.value = first_value;
                                }, 200);
                            }
                        }" x-key="option-right-86cb1224-e0f6-40df-8ac4-9c682710457d" wire:key="option-right-86cb1224-e0f6-40df-8ac4-9c682710457d" wire:sortable.item="86cb1224-e0f6-40df-8ac4-9c682710457d" class="flex items-center bg-white" data-has-alpine-state="true">
                        <button type="button" wire:sortable.handle="" class="border border-gray-300 border-r-0 shadow-sm py-2.5 px-2 rounded-md rounded-r-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5"></path>
                            </svg>                          
                        </button>
                        <input type="text" x-model="value" @keyup.enter="handleEnter" @paste="handlePaste" @input.debounce="updateOnServer()" class="block w-full rounded-md rounded-l-none rounded-r-none border-l-0 border-r-0 border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm js_dropdown_options">
                        <button type="button" wire:click.prevent="removeOption(2)" class="border border-gray-300 border-l-0 shadow-sm py-2.5 px-2 rounded-md rounded-l-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                            </svg>                          
                        </button>
                    </li>
                                    </ul>
            </div>
            
            
            <p class="text-xs text-gray-500 pt-4">
                For bulk insert just paste them above or insert <button class="text-blue-600 underline" @click="showBulkInsertModal = true">here</button>
            </p>
            
        </div>
    </div>


</template>