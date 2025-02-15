<template>
  <FormLayout title="Dashboard">
    <div class="grid grid-cols-12 h-screen">
      <div class="h-screen overflow-y-auto pb-40 col-span-2 relative px-2 pt-4">
        <FormSidebar @open-modal="showModal" />
      </div>
      <div class="h-screen col-span-7 relative">
        <SectionModal :show="showNewSectionModal" :searchQuery.sync="searchQuery"
          :filteredCategories="filteredCategories" :selectSectionType="selectSectionType"
          :getButtonClass="getButtonClass" :submit="submit" @close="showNewSectionModal = false" />
        <CanvasContent :formSections="form_sections" :design="form.design" :current_section="current_section"/>
        <ProModal :show="showProModal" @closePro="showProModal = false" />
      </div>
      <div class="h-screen col-span-3">
        <TabPanel :tabs="tabs" :design="form.design" :current_section="current_section">
        </TabPanel>
      </div>
    </div>
  </FormLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import FormLayout from '@/Layouts/FormLayout.vue';
import CanvasContent from '@/Components/CanvasContent.vue';
import FormSidebar from '@/Components/FormSidebar.vue';
import ProModal from '@/Components/ProModal.vue';
import SectionModal from '@/Components/SectionModal.vue';
import TabPanel from '@/Components/TabPanel.vue';

const props = defineProps({
  form: Object,
  form_sections: Object,
  groupedSectionTypes: Array,
  current_section: Object
});

const page = usePage();
const showNewSectionModal = ref(false);
const showProModal = ref(false);
const searchQuery = ref('');
const selectedSectionType = ref(null);

const tabs = ref([
  { name: 'Content' },
  { name: 'Design' },
  { name: 'Logic' }
]);

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

function showProModalFunc() {
  showNewSectionModal.value = false;
  showProModal.value = true;
}

function selectSectionType(sectionType) {
  selectedSectionType.value = sectionType.id;
}

function getButtonClass(item) {
  return {
    'bg-blue-500 text-white': selectedSectionType.value === item.id,
    'bg-gray-200 text-gray-700 hover:bg-gray-300': selectedSectionType.value !== item.id
  };
}

function submit() {
  if (selectedSectionType.value === 17 &&!page.props.isPro){
    showProModalFunc();
    return;
  }
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