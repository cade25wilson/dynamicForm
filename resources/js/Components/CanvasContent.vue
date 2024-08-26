<template>
    <div
          class="relative lg:mx-6 mt-[4rem] bg-white custom-bg-color rounded-md h-[calc(100vh_-_13rem)] border border-dashed border-gray-500  bg-cover bg-center bg-no-repeat custom-form-font"
          :style="{ backgroundColor: design.background }"
          >
          <div class="h-full flex items-center justify-center mx-auto overflow-y-auto scrollbar-hide">
            <div :class="{
                  'text-center': page.props.current_section.text_align === 'center',
                  'text-right': page.props.current_section.text_align === 'right',
                  'text-left': page.props.current_section.text_align === 'left'
              }" class="w-9/12 transition-all overflow-auto max-h-full py-12 scrollbar-hide">
              <h4 class="text-4xl py-6 text-gray-700 custom-text-color leading-snug">
              </h4>
              <div class="text-gray-600 custom-text-color-light text-sm md:text-base js_text_description">
                  <template v-if="page.props.current_section.section_type_id === 1">
                    <WelcomeSection />
                  </template>
                  <template v-if="page.props.current_section.section_type_id === 3">
                    <ContactSection />
                  </template>
                  <template v-if="page.props.current_section.section_type_id === 4">
                    <ShortText />
                  </template>
                  <template v-if="page.props.current_section.section_type_id === 5">
                    <LongText />
                  </template>
                  <template v-if="page.props.current_section.section_type_id === 6">
                    <PhoneSection />
                  </template>
              </div>
              <div>
                <button type="button"
                :style="{ color: design.button_text, backgroundColor: design.buttons }"
                  class="inline-flex items-center px-4 py-2 mt-8 border border-transparent text-base font-medium rounded-md text-white bg-gray-700 focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-gray-500 button-text">
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
import { usePage } from '@inertiajs/vue3';
import ContactSection from './ContactSection.vue';
import LongText from './LongText.vue';
import PhoneSection from './PhoneSection.vue';
import ShortText from './ShortText.vue';
import WelcomeSection from './WelcomeSection.vue';

const page = usePage();
const props = defineProps({
    formSections: Object,
    design: Object,
    current_section: Object
});
</script>

<style scoped>
.scrollbar-hide::-webkit-scrollbar {
    width: 0px;
    background: transparent; /* Optional: just to hide the scrollbar from view */
}

.scrollbar-hide {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}
</style>