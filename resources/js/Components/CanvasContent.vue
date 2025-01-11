<template>
  <!-- {{ page.props }} -->
    <div
          class="relative lg:mx-6 mt-[4rem] bg-white custom-bg-color rounded-md h-[calc(100vh_-_13rem)] border border-gray-500  bg-cover bg-center bg-no-repeat custom-form-font"
          :style="{
            backgroundColor: page.props.form.design.background,
            backgroundImage: page.props.form.design.background_image ? `url(${page.props.form.design.background_image})` : 'none'
          }"
          >
          <div class="h-full flex items-center justify-center mx-auto overflow-y-auto scrollbar-hide">
            <div :class="{
                  'text-center': page.props.current_section.text_align === 'center',
                  'text-right': page.props.current_section.text_align === 'right',
                  'text-left': page.props.current_section.text_align === 'left'
              }"
              :style="{ fontFamily: page.props.form.design.font }"
              class="w-9/12 transition-all overflow-auto max-h-full py-12 scrollbar-hide">
              <h4 class="text-4xl py-6 text-gray-700 custom-text-color leading-snug">
              </h4>
              <div
               class="text-gray-600 custom-text-color-light text-sm md:text-base js_text_description">
                  <WelcomeSection v-if="page.props.current_section.section_type_id === 1"/>
                  <ThankyouSection v-if="page.props.current_section.section_type_id === 2"/>
                  <ContactSection v-if="page.props.current_section.section_type_id === 3"/>
                  <ShortText v-if="page.props.current_section.section_type_id === 4"/>
                  <LongText v-if="page.props.current_section.section_type_id === 5"/>
                  <PhoneSection v-if="page.props.current_section.section_type_id === 6"/>
                  <SingleSelectSection v-if="[8, 9].includes(page.props.current_section.section_type_id)"/>
                  <DropDownSection v-if="[10].includes(page.props.current_section.section_type_id)"/>
                  <DatePicker v-if="[11].includes(page.props.current_section.section_type_id)"/>
                  <SchedulerSection v-if="[12].includes(page.props.current_section.section_type_id)"/>
                  <StarSection v-if="[13].includes(page.props.current_section.section_type_id)"/>
                  <OpinionSection v-if="[14].includes(page.props.current_section.section_type_id)"/>
                  <SignatureSection v-if="[15].includes(page.props.current_section.section_type_id)"/>
                  <FileSection v-if="[16].includes(page.props.current_section.section_type_id)"/>
                  <PaymentSection v-if="[17].includes(page.props.current_section.section_type_id)"/>
              </div>
              <div class="my-6" v-if="page.props.current_section.options.embed">
                  <iframe :src="page.props.current_section.options.embed" frameborder="0" marginheight="0" marginwidth="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" class="w-full max-w-2xl aspect-video mx-auto"></iframe>
              </div>
              <div>
                <button type="button" v-if="page.props.current_section.section_type_id != 2"
                :style="{ color: page.props.form.design.button_text, backgroundColor: page.props.form.design.buttons }"
                  class="inline-flex items-center px-4 py-2 mt-8 border border-transparent text-base font-medium rounded-md text-white bg-gray-700 focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-gray-500 button-text">
                  {{page.props.current_section.button_text}} &nbsp;
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
import DatePicker from './DatePicker.vue';
import DropDownSection from './DropDownSection.vue';
import FileSection from './FileSection.vue';
import LongText from './LongText.vue';
import OpinionSection from './OpinionSection.vue';
import PhoneSection from './PhoneSection.vue';
import SchedulerSection from './SchedulerSection.vue';
import ShortText from './ShortText.vue';
import SignatureSection from './SignatureSection.vue';
import SingleSelectSection from './SingleSelectSection.vue';
import StarSection from './StarSection.vue';
import ThankyouSection from './ThankyouSection.vue';
import WelcomeSection from './WelcomeSection.vue';
import PaymentSection from './PaymentSection.vue';

const page = usePage();
</script>

<style scoped>
.scrollbar-hide::-webkit-scrollbar {
    width: 0px;
    background: transparent; /* Optional: just to hide the scrollbar from view */
}

.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>