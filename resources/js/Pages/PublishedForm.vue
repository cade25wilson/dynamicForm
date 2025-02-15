<template>
  <template v-if="page.props.is_closed">
    <div class="h-screen flex justify-center items-center">
      <div class="text-center">
          <h4 class="text-lg md:text-2xl lg:text-4xl font-semibold text-gray-700">Sorry! This form is now closed.</h4>
          <div class="mt-6">
              <a href="https://buildmyform.com/" target="_self" class="bg-blue-600 mt-2 bg-coral border-2 border-black drop-shadow-3xl hover:drop-shadow-4xl px-10 py-2 text-black rounded-md block mx-auto text-center">
                  Create Your Own Buildmyform →
              </a>
          </div>
      </div>
    </div>
  </template>
  <template v-else>
    <div v-if="page.props.form.design.progress_bar" class="absolute top-0 left-0 right-0 z-10" @update-progress-bar.window="handleProgressBarUpdate">
      <div>
          <div class="bg-gray-200 custom-bg-color-light-nonhover h-1" role="progressbar" :aria-valuenow="width" aria-valuemin="0" aria-valuemax="100" aria-valuenow="50">
              <div class="bg-gray-700 custom-button-background-color h-1 text-center opacity-80" :style="`width: ${progressPercentage}%; transition: width 1s;`">
              </div>
          </div>
      </div>
  </div>
    <div
      class="relative lg:mx-6 mt-[4rem] rounded-md h-[90vh] bg-cover bg-center bg-no-repeat custom-form-font"
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
            <div class="text-gray-600 custom-text-color-light text-sm md:text-base js_text_description"
            :style="{ fontFamily: page.props.form.design.font }"

            >
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
              <DropDownSection @updateResponse="handleUpdateResponse" v-if="[10].includes(currentSection.section_type_id)" :formSection="currentSection" />
              <DatePicker @updateResponse="handleUpdateResponse" v-if="[11].includes(currentSection.section_type_id)" :formSection="currentSection" />
              <SchedulerSection v-if="[12].includes(currentSection.section_type_id)" :formSection="currentSection" />
              <StarSection @updateResponse="handleUpdateResponse" v-if="[13].includes(currentSection.section_type_id)" :formSection="currentSection" />
              <OpinionSection @updateResponse="handleUpdateResponse" v-if="[14].includes(currentSection.section_type_id)" :formSection="currentSection" />
              <SignatureSection v-if="[15].includes(currentSection.section_type_id)" :formSection="currentSection" />
              <FileSection v-if="[16].includes(currentSection.section_type_id)" :formSection="currentSection" />
              <PaymentSection @updateResponse="handleUpdateResponse" v-if="[17].includes(currentSection.section_type_id)" :formSection="currentSection" />
            </div>

            <div class="my-6" v-if="currentSection.options.embed">
              <iframe :src="currentSection.options.embed" frameborder="0" class="w-full max-w-2xl aspect-video mx-auto"></iframe>
            </div>

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
              <template v-else>
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

      <div v-if="page.props.form.design.navigation" class="absolute bottom-5 sm:bottom-10 right-10 z-10">
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
</template>

<script setup>
import { ref, computed, watch, watchEffect, onMounted, onBeforeUnmount } from 'vue';
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
import PaymentSection from '@/Components/Published/PaymentSection.vue';

// Access the page data
const page = usePage();
// Ref to track current section index
const currentIndex = ref(0);

// Reactive flag to control the "Next" button's disabled state
const hasValidationErrors = ref(false);

// Ref to the container where validation messages might appear
const validationContainer = ref(null);

  onMounted(() => {
    if(!page.props.is_closed){
      SendUtmResponses();
    }
    document.body.style.backgroundColor = page.props.form.design.background;
    if (page.props.form.design.background_image) {
      document.body.style.backgroundImage = `url(${page.props.form.design.background_image})`;
      document.body.style.backgroundSize = 'cover'; // Optional: makes the background cover the entire body
      document.body.style.backgroundPosition = 'center'; // Optional: centers the background image
    }
  });

  // Cleanup on unmount
  onBeforeUnmount(() => {
    document.body.style.backgroundColor = ''; // Reset background color
    document.body.style.backgroundImage = ''; // Reset background image
  });

  // Computed property to get the current section
  const currentSection = computed(() => {
    return page.props.form_sections[currentIndex.value];
  });

  // Computed property to calculate the progress percentage
  const progressPercentage = computed(() => {
    if (page.props.form_sections.length === 0) return 0; // Prevent division by zero
    return ((currentIndex.value + 1) / page.props.form_sections.length) * 100;
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
        const timeout = sectionData.options.redirect_delay * 1000;
        setTimeout(function() {
          window.location.href = sectionData.options.redirect_url;
        }, timeout);
      };

  watch(() => currentSection.value.options.end, (newVal) => {
    if(newVal !== 'button'){
      redirectToLocalhost(currentSection.value);
    }
  });

  // Watch for changes in the current section and check if the section_type_id is 2
  watch(() => currentSection.value, (newSection) => {
    if (newSection.section_type_id === 2) {
      console.log('Current section is a Thank You section.');
      completeResponse();
    }
  });

  async function SendUtmResponses(){
    const utmParameters = page.props.utm_parameters;
    const urlParams = new URLSearchParams(window.location.search);
    const foundUtmValues = {};

    utmParameters.forEach((param) => {
        if (urlParams.has(param)) {
            foundUtmValues[param] = urlParams.get(param);
        }
    });
    console.log(foundUtmValues);
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const response = await fetch(`/utm-response/${page.props.response_id}`,{
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify({
        _token: csrfToken,
        responseId: page.props.responseId,
        utmValues: foundUtmValues,
        formId: page.props.form.form_id
      })
    });
  }

  function completeResponse(){
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`/formresponse/complete`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify({
        _token: csrfToken,
        responseId: page.props.response_id,
        formid: page.props.form.id
      })
    });
  }

  // Handle form field response updates
  function handleUpdateResponse({ fieldId, value }) {
    if(currentSection.value.section_type_id == 17){
      goToNextSection();
    }
    console.log('Field ID:', fieldId);
    console.log('Field Value:', value);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`/formfieldresponse/${page.props.response_id}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify({
        _token: csrfToken,
        fieldId: fieldId,
        value: value
      })
    });
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
