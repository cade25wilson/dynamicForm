<template>
    <TransitionRoot as="template" :show="show">
      <Dialog class="relative z-10" @close="handleClose">
        <TransitionChild
          as="template"
          enter="ease-out duration-300"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="ease-in duration-200"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
        </TransitionChild>
  
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
          <div class="flex min-h-full items-center justify-center p-4 text-center sm:items-center sm:p-0">
            <TransitionChild
              as="template"
              enter="ease-out duration-300"
              enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
              enter-to="opacity-100 translate-y-0 sm:scale-100"
              leave="ease-in duration-200"
              leave-from="opacity-100 translate-y-0 sm:scale-100"
              leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
              <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-5xl">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                  <!-- Search Bar -->
                  <div class="mb-4">
                    <input
                      type="text"
                      v-model="localSearchQuery"
                      class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                      placeholder="Find a content type"
                    />
                  </div>
  
                  <div class="grid grid-cols-4 gap-8">
                    <!-- Categories and Section Types -->
                    <div v-for="(category, index) in filteredCategories" :key="index">
                      <h4 class="text-md font-semibold text-gray-700 mb-4">
                        {{ category.category_name }}
                      </h4>
                      <ul class="space-y-4">
                        <li v-for="(sectionType, idx) in category.section_types" :key="idx">
                          <button
                            @click="selectSectionType(sectionType)"
                            @dblclick="submit(sectionType)"
                            :class="getButtonClass(sectionType)"
                            class="w-full rounded-md px-4 py-2 text-left flex items-center"
                          >
                            <span :class="sectionType.iconClass"></span>
                            {{ sectionType.name }}
                          </button>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                  <button
                    type="button"
                    class="mt-3 inline-flex w-full justify-center rounded-md bg-blue-500 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-600 sm:ml-3 sm:w-auto"
                    @click="submit"
                    id="createsectionbutton"
                  >
                    Create Section
                  </button>
                  <button
                    type="button"
                    class="mt-3 inline-flex w-full justify-center rounded-md bg-gray-500 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-600 sm:ml-3 sm:w-auto"
                    @click="handleClose"
                  >
                    Cancel
                  </button>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </template>
  
  <script setup>
  import { ref, watch } from 'vue';
  import { Dialog, DialogPanel, TransitionRoot, TransitionChild } from '@headlessui/vue';
  
  const props = defineProps({
    show: Boolean,
    searchQuery: String,
    filteredCategories: Array,
    selectSectionType: Function,
    getButtonClass: Function,
    submit: Function,
  });
  
  const emit = defineEmits(['close', 'update:searchQuery']);
  const localSearchQuery = ref(props.searchQuery);
  
  watch(localSearchQuery, (newVal) => {
    emit('update:searchQuery', newVal);
  });
  
  function handleClose() {
    emit('close');
  }
  </script>
  