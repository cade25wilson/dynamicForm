<template>
    <AppLayout title="Dashboard">
      <div class="grid grid-cols-12 h-screen">
        <div class="h-screen overflow-y-auto pb-40 col-span-2 relative px-2 pt-4">
          <FormSidebar :formSections="form_sections" :formID="form.id" @open-modal="showModal" />
        </div>
        <div class="h-screen col-span-7 relative">
          <SectionModal
            :show="showNewSectionModal"
            :searchQuery.sync="searchQuery"
            :filteredCategories="filteredCategories"
            :selectSectionType="selectSectionType"
            :getButtonClass="getButtonClass"
            :submit="submit"
            @close="showNewSectionModal = false"
          />
          <p class="text-white">{{ formFields }}</p>
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
  