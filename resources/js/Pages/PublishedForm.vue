
<template>
  <div
    class="relative lg:mx-6 mt-[4rem] bg-white custom-bg-color rounded-md h-[90vh] bg-cover bg-center bg-no-repeat custom-form-font"
    :style="{
      backgroundColor: page.props.form.design.background,
      backgroundImage: page.props.form.design.background_image ? `url(${page.props.form.design.background_image})` : 'none'
    }"
  >
    <transition name="fade" mode="out-in">
      <div v-if="currentSection" :key="currentSection.id" class="h-full flex items-center justify-center mx-auto">
        <div :class="{
              'text-center': currentSection.text_align === 'center',
              'text-right': currentSection.text_align === 'right',
              'text-left': currentSection.text_align === 'left'
          }" class="w-9/12 transition-all overflow-auto max-h-full py-12">
          <h4 class="text-4xl py-6 text-gray-700 custom-text-color leading-snug">
            {{ currentSection.title }}
          </h4>
          <div class="text-gray-600 custom-text-color-light text-sm md:text-base js_text_description">
            <CoverImage :formSection="currentSection"/>
            <FormSectionName :formSection="currentSection"/>
            <FormSectionDescription :formSection="currentSection"/>
            <WelcomeSection v-if="currentSection.section_type_id === 1" :formSection="currentSection"/>
            <ThankyouSection v-if="currentSection.section_type_id === 2" :formSection="currentSection"/>
            <ContactSection v-if="currentSection.section_type_id === 3" :formSection="currentSection"/>
            <ShortText v-if="currentSection.section_type_id === 4" :formSection="currentSection"/>
            <LongText v-if="currentSection.section_type_id === 5" :formSection="currentSection"/>
            <PhoneSection v-if="currentSection.section_type_id === 6" :formSection="currentSection"/>
            <SingleSelectSection v-if="[8, 9].includes(currentSection.section_type_id)" :formSection="currentSection"/>
            <DropDownSection v-if="[10].includes(currentSection.section_type_id)" :formSection="currentSection"/>
            <DatePicker v-if="[11].includes(currentSection.section_type_id)" :formSection="currentSection"/>
            <SchedulerSection v-if="[12].includes(currentSection.section_type_id)" :formSection="currentSection"/>
            <StarSection v-if="[13].includes(currentSection.section_type_id)" :formSection="currentSection"/>
            <OpinionSection v-if="[14].includes(currentSection.section_type_id)" :formSection="currentSection"/>
            <SignatureSection v-if="[15].includes(currentSection.section_type_id)" :formSection="currentSection"/>
            <FileSection v-if="[16].includes(currentSection.section_type_id)" :formSection="currentSection"/>
          </div>
          <div class="my-6" v-if="currentSection.options.embed">
              <iframe :src="currentSection.options.embed" frameborder="0" class="w-full max-w-2xl aspect-video mx-auto"></iframe>
          </div>
          <div>
            <button
              type="button"
              @click="goToNextSection"
              :style="{ color: page.props.form.design.button_text, backgroundColor: page.props.form.design.buttons }"
              class="inline-flex items-center px-4 py-2 mt-8 border border-transparent text-base font-medium rounded-md text-white bg-gray-700 focus:outline-none"
            >
              {{ currentSection.button_text || 'Next' }}
              &nbsp;
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script setup>
  import { ref, computed } from 'vue';
  import { usePage } from '@inertiajs/vue3';

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

  const page = usePage();
  const currentIndex = ref(0);

  const currentSection = computed(() => {
    return page.props.form_sections[currentIndex.value];
  });

  const goToNextSection = () => {
    if (currentIndex.value < page.props.form_sections.length - 1) {
      currentIndex.value++;
    }
  };
</script>

<style>
  .fade-enter-active, .fade-leave-active {
    transition: opacity 0.75s;
  }
  .fade-enter, .fade-leave-to {
    opacity: 0;
  }
</style>