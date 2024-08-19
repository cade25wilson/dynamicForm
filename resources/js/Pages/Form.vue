<template>
  <AppLayout title="Dashboard">
    <div class="grid grid-cols-12 h-screen">
      <div class="h-screen overflow-y-auto pb-40 col-span-2 relative px-2 pt-4">
        <FormSidebar :formSections="form_sections" :formID="form.id" @open-modal="showModal" />
      </div>
      <div class="h-screen col-span-7 relative">
        <SectionModal :show="showNewSectionModal" :searchQuery.sync="searchQuery"
          :filteredCategories="filteredCategories" :selectSectionType="selectSectionType"
          :getButtonClass="getButtonClass" :submit="submit" @close="showNewSectionModal = false" />
        <!-- <p class="text-white">{{ formFields }}</p> -->
        <div
          class="relative lg:mx-6 mt-[4rem] bg-white custom-bg-color rounded-md h-[calc(100vh_-_13rem)] border border-dashed border-gray-500  bg-cover bg-center bg-no-repeat  custom-form-font">
          <div class="h-full flex items-center justify-center mx-auto overflow-y-auto scrollbar-hide">
            <div class=" text-center  w-9/12 transition-all overflow-auto max-h-full py-12 scrollbar-hide">
              <h4 class="text-4xl py-6 font-bold text-gray-700 custom-text-color leading-snug">
                Thank you for submitting this form.
              </h4>
              <div class="text-gray-600 custom-text-color-light text-sm md:text-base js_text_description">
                You may now close this window.
              </div>
              <div>
                <button type="button"
                  class="inline-flex items-center px-4 py-2 mt-8 border border-transparent text-base font-medium rounded-md text-white bg-gray-700 focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-gray-500 custom-button-background-color custom-button-text-color"
                  >
                  Create your own Youform &nbsp;
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                  </svg>
                </button>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="h-screen col-span-3">
        <!-- Your additional content here -->
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import FormSidebar from '@/Components/FormSidebar.vue';
import SectionModal from '@/Components/SectionModal.vue';

const props = defineProps({
  form: Object,
  formFields: Object,
  form_sections: Object,
  groupedSectionTypes: Array,
});

const showNewSectionModal = ref(false);
const searchQuery = ref('');
const selectedSectionType = ref(null);

const filteredCategories = computed(() => {
  if (!searchQuery.value) return props.groupedSectionTypes;
  return props.groupedSectionTypes.map(category => ({
    ...category,
    section_types: category.section_types.filter(type =>
      type.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    ),
  })).filter(category => category.section_types.length > 0);
});

function showModal() {
  showNewSectionModal.value = true;
}

function selectSectionType(sectionType) {
  selectedSectionType.value = sectionType.id;
  console.log('Selected Section Type:', sectionType.name);
}

function getButtonClass(item) {
  return {
    'bg-blue-500 text-white': selectedSectionType.value === item.id,
    'bg-gray-200 text-gray-700 hover:bg-gray-300': selectedSectionType.value !== item.id
  };
}

function submit() {
  console.log('Form created with Section Type ID:', selectedSectionType.value);
  const page = usePage();
  router.post('/section', {
    _token: page.props.csrf_token,
    SectionId: selectedSectionType.value,
    FormId: page.props.form.id
  }, {
    onSuccess: () => {
      showNewSectionModal.value = false;
    }
  });
}
</script>