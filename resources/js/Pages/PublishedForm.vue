<template>
  <!-- {{page}} -->
  <div
    class="relative lg:mx-6 mt-[4rem] bg-white custom-bg-color rounded-md h-[90vh] bg-cover bg-center bg-no-repeat custom-form-font"
    :style="{
      backgroundColor: page.props.form.design.background,
      backgroundImage: page.props.form.design.background_image ? `url(${page.props.form.design.background_image})` : 'none'
    }"
  >
    <transition name="fade" mode="out-in">
      <div v-if="currentSection" :key="currentSection.id" class="h-full flex items-center justify-center mx-auto">
        <div ref="validationContainer" :class="{
              'text-center': currentSection.text_align === 'center',
              'text-right': currentSection.text_align === 'right',
              'text-left': currentSection.text_align === 'left'
          }" class="w-9/12 transition-all overflow-auto max-h-full py-12">
          <h4 class="text-4xl py-6 text-gray-700 custom-text-color leading-snug">
            {{ currentSection.title }}
          </h4>
          <div class="text-gray-600 custom-text-color-light text-sm md:text-base js_text_description">
            <CoverImage :formSection="currentSection" />
            <FormSectionName :formSection="currentSection" />
            <FormSectionDescription :formSection="currentSection" />
            <WelcomeSection v-if="currentSection.section_type_id === 1" :formSection="currentSection" />
            <ThankyouSection v-if="currentSection.section_type_id === 2" :formSection="currentSection" />
            <ContactSection
              v-if="currentSection.section_type_id === 3"
              :formSection="currentSection"
              @updateResponse="handleUpdateResponse"
            />
            <ShortText v-if="currentSection.section_type_id === 4" :formSection="currentSection" @updateResponse="handleUpdateResponse"/>
            <LongText v-if="currentSection.section_type_id === 5" :formSection="currentSection" @updateResponse="handleUpdateResponse"/>
            <PhoneSection @updateResponse="handleUpdateResponse" v-if="currentSection.section_type_id === 6" :formSection="currentSection" />
            <SingleSelectSection @updateResponse="handleUpdateResponse" v-if="[8, 9].includes(currentSection.section_type_id)" :formSection="currentSection" />
            <DropDownSection v-if="[10].includes(currentSection.section_type_id)" :formSection="currentSection" />
            <DatePicker v-if="[11].includes(currentSection.section_type_id)" :formSection="currentSection" />
            <SchedulerSection v-if="[12].includes(currentSection.section_type_id)" :formSection="currentSection" />
            <StarSection v-if="[13].includes(currentSection.section_type_id)" :formSection="currentSection" />
            <OpinionSection v-if="[14].includes(currentSection.section_type_id)" :formSection="currentSection" />
            <SignatureSection v-if="[15].includes(currentSection.section_type_id)" :formSection="currentSection" />
            <FileSection v-if="[16].includes(currentSection.section_type_id)" :formSection="currentSection" />
          </div>

          <div class="my-6" v-if="currentSection.options.embed">
            <iframe :src="currentSection.options.embed" frameborder="0" class="w-full max-w-2xl aspect-video mx-auto"></iframe>
          </div>

          <!-- Next Section Button (Disable if there are validation errors) -->
          <div>
            <button v-if="currentSection.section_type_id != 2"
              type="button"
              @click="goToNextSection"
              :style="{ color: page.props.form.design.button_text, backgroundColor: page.props.form.design.buttons }"
              class="inline-flex items-center px-4 py-2 mt-8 border border-transparent text-base font-medium rounded-md text-white bg-gray-700 focus:outline-none"
              :disabled="hasValidationErrors"
            >
              {{ currentSection.button_text || 'Next' }}
              &nbsp;
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
              </svg>
            </button>
            <template v-else >
              <a v-if="currentSection.options.end == 'button'" :href="currentSection.options.button_link" target="_top" class="inline-flex items-center px-4 py-2 mt-8 border border-transparent text-base font-medium rounded-md focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-gray-500 text-white bg-gray-700 hover:opacity-80 custom-button-background-color custom-button-text-color"
              :style="{ color: page.props.form.design.button_text, backgroundColor: page.props.form.design.buttons }"
              >
                {{ currentSection.button_text || 'Next' }} &nbsp; 
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                  </svg>
              </a>
              <div class="mt-6" v-else>
                <svg class="animate-spin h-5 w-5 text-black custom-text-color mx-auto my-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>

                <p class="text-sm text-gray-600 custom-text-color">
                    {{currentSection.options.redirect_message}}
                </p>
              </div>

            </template>
          </div>
        </div>
      </div>
    </transition>

    <!-- Navigation buttons (Bottom right corner) -->
    <div class="absolute bottom-5 sm:bottom-10 right-10 z-10">
      <button
        type="button"
        title="Go up"
        @click="goToPreviousSection"
        class="inline-flex items-center px-2 py-2 mt-8 border border-transparent text-base font-medium rounded-md text-white bg-gray-700 hover:opacity-80 focus:outline-none custom-button-background-color custom-button-text-color"
        :disabled="currentIndex === 0"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"></path>
        </svg>
      </button>
      <button
        type="button"
        title="Go down"
        @click="goToNextSection"
        class="inline-flex items-center px-2 py-2 mt-8 border border-transparent text-base font-medium rounded-md text-white bg-gray-700 hover:opacity-80 focus:outline-none custom-button-background-color custom-button-text-color"
        :disabled="currentIndex === page.props.form_sections.length - 1 || hasValidationErrors"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
        </svg>
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch, watchEffect } from 'vue';
import { usePage } from '@inertiajs/vue3';

// Import form section components
import ContactSection from '@/Components/Published/ContactSection.vue';
import CoverImage from '@/Components/Published/CoverImage.vue';
import DatePicker from '@/Components/Published/DatePicker.vue';
import DropDownSection from '@/Components/Published/DropDownSection.vue';
import FileSection from '@/Components/Published/FileSection.vue';
import FormSectionDescription from '@/Components/Published/FormSectionDescription.vue';
import FormSectionName from '@/Components/Published/FormSectionName.vue';
import LongText from '@/Components/Published/LongText.vue';
import OpinionSection from '@/Components/Published/OpinionSection.vue';
import PhoneSection from '@/Components/Published/PhoneSection.vue';
import SchedulerSection from '@/Components/Published/SchedulerSection.vue';
import ShortText from '@/Components/Published/ShortText.vue';
import SignatureSection from '@/Components/Published/SignatureSection.vue';
import SingleSelectSection from '@/Components/Published/SingleSelectSection.vue';
import StarSection from '@/Components/Published/StarSection.vue';
import ThankyouSection from '@/Components/Published/ThankyouSection.vue';
import WelcomeSection from '@/Components/Published/WelcomeSection.vue';

// Access the page data
const page = usePage();

// Ref to track current section index
const currentIndex = ref(0);

// Reactive flag to control the "Next" button's disabled state
const hasValidationErrors = ref(false);

// Ref to the container where validation messages might appear
const validationContainer = ref(null);

// Computed property to get the current section
const currentSection = computed(() => {
  return page.props.form_sections[currentIndex.value];
});

// Function to go to the next section
const goToNextSection = () => {
  const errorElements = validationContainer.value.querySelectorAll('.text-red-600');
  if (errorElements.length > 0){
    console.log('errors');
   return; 
  }
  if (!hasValidationErrors.value && currentIndex.value < page.props.form_sections.length - 1) {
    currentIndex.value++;
  }
};

// Function to go to the previous section
const goToPreviousSection = () => {
  if (currentIndex.value > 0) {
    currentIndex.value--;
  }
};

// Watch for validation messages in the DOM and update the flag
watchEffect(() => {
  if (validationContainer.value) {
    const errorElements = validationContainer.value.querySelectorAll('.text-red-600');
    hasValidationErrors.value = errorElements.length > 0;
  }
});

const redirectToLocalhost = (sectionData) => {
      // Function to redirect and pass currentSection data
      const timeout = sectionData.options.redirect_delay * 1000;
      setTimeout(function() {
        window.location.href = sectionData.options.redirect_url;
      }, timeout);
    };

watch(() => currentSection.value.options.end, (newVal) => {
    if (newVal !== 'button') {
      redirectToLocalhost(currentSection.value); // Pass currentSection data to the function
    }
  });

// Handle form field response updates
function handleUpdateResponse({ fieldId, value }) {
  console.log('Field ID:', fieldId);
  console.log('Field Value:', value);
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  fetch(`/formfieldresponse/${page.props.response_id}`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken // Pass the CSRF token in the headers
    },
    body: JSON.stringify({
      _token: csrfToken, // Also include the token in the body if needed
      fieldId: fieldId,
      value: value
    })
  });
  console.log(currentSection);
  if(currentSection.value.section_type_id == 8){
    goToNextSection();
  }
}
</script>

<style>
  .fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s;
  }
  .fade-enter-from, .fade-leave-to {
    opacity: 0;
  }
</style>
