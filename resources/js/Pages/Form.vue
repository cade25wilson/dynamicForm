<template>
    <AppLayout title="Dashboard">
      <div class="grid grid-cols-12 h-screen">
        <div class="h-screen overflow-y-auto pb-40 col-span-2 relative px-2 pt-4">
          <div class="flex items-center justify-between px-2 mt-1">
            <div class="flex items-center">
              <h4 class="text-xs text-gray-500">Blocks</h4>
            </div>
            <button class="text-gray-500 cursor-pointer hover:text-gray-600">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
              </svg>
            </button>
          </div>
          <FormSidebar :formSections="data.form_sections" />
        </div>
        <div class="h-screen col-span-7 relative">
          <p class="text-white">{{ data }}</p>
        </div>
        <div class="h-screen col-span-3">
          fdsa
        </div>
      </div>
    </AppLayout>
  </template>
  
  <script>
  import AppLayout from '@/Layouts/AppLayout.vue';
  import FormSidebar from '@/Components/FormSidebar.vue';
  
  export default {
    components: {
      AppLayout,
      FormSidebar,
    },
    props: {
      data: {
        type: Object,
        required: true
      }
    },
    data() {
      return {
        // Your component data here, if needed
      };
    },
    computed: {
      // Add any computed properties here, if needed
    },
    methods: {
      // Add any methods here, if needed
    },
    mounted() {
      // Lifecycle hook if needed
    },
  };
  </script>
  
  <style scoped>
  /* Add your component styles here */
  </style>
  