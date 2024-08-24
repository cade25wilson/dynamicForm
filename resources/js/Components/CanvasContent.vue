<template>
    <div
          class="relative lg:mx-6 mt-[4rem] bg-white custom-bg-color rounded-md h-[calc(100vh_-_13rem)] border border-dashed border-gray-500  bg-cover bg-center bg-no-repeat  custom-form-font">
          <div class="h-full flex items-center justify-center mx-auto overflow-y-auto scrollbar-hide">
            <div class=" text-center  w-9/12 transition-all overflow-auto max-h-full py-12 scrollbar-hide">
              <h4 class="text-4xl py-6 font-bold text-gray-700 custom-text-color leading-snug">
              </h4>
              <div class="text-gray-600 custom-text-color-light text-sm md:text-base js_text_description">
                {{page}}
              </div>
              <div>
                <button type="button"
                  class="inline-flex items-center px-4 py-2 mt-8 border border-transparent text-base font-medium rounded-md text-white bg-gray-700 focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-gray-500 custom-button-background-color custom-button-text-color">
                  {{current_section.button_text}} &nbsp;
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </div>
</template>

<script setup>
import { router, usePage } from '@inertiajs/vue3';
const page = usePage();
const props = defineProps({
    formSections: Object,
    design: Object,
    current_section: Object
});
</script>