<template>
    <!-- <CoverImage v-if="formSection.background_image != null" /> -->
    <!-- <FormSectionName />
    <FormSectionDescription /> -->
    <div class="mt-6">
      <div class="w-full">
        <div class="mt-2 transition-all">
          <div>
            <canvas 
              ref="signaturePadCanvas" 
              class="custom-bg-color-light-nonhover custom-text-color rounded-md shadow-sm border-dashed border custom-answer-text-color-as-border-color" 
              :width="canvasWidth" 
              :height="canvasHeight" 
              :style="{borderColor: page.props.form.design.answers}"
              style="touch-action: none; user-select: none;"
            >
              Please sign...
            </canvas>
          </div>
  
          <div class="flex items-center">
            <button 
              :class="{ 'invisible': !showClear }" 
              class="text-xs mt-4 flex font-semibold items-center space-x-1 text-gray-700 ml-3 custom-answer-text-color" 
              @click="clearSignature"
              type="button"
            >
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"></path>
              </svg>
              <span>Clear</span>                                                    
            </button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted, onBeforeUnmount } from 'vue';
  import { usePage } from '@inertiajs/vue3';
  import SignaturePad from 'signature_pad';
  import CoverImage from './CoverImage.vue';
  import FormSectionDescription from './FormSectionDescription.vue';
  import FormSectionName from './FormSectionName.vue';
  
  const page = usePage();
  const signaturePadCanvas = ref(null); // Reference to the canvas element
  const signaturePadInstance = ref(null); // SignaturePad instance
  const showClear = ref(false);
  const canvasWidth = ref(500);
  const canvasHeight = ref(250);
  
  const setCanvasDimensions = () => {
    const width = window.innerWidth || screen.width;
    if (width > 600) {
      canvasWidth.value = 500;
      canvasHeight.value = 250;
    } else {
      canvasWidth.value = 300;
      canvasHeight.value = 150;
    }
  
    if (signaturePadInstance.value) {
      signaturePadInstance.value.clear();
      signaturePadInstance.value.canvas.width = canvasWidth.value;
      signaturePadInstance.value.canvas.height = canvasHeight.value;
    }
  };
  
  const clearSignature = () => {
    if (signaturePadInstance.value) signaturePadInstance.value.clear();
    showClear.value = false;
  };
  
  onMounted(() => {
    setCanvasDimensions();
    if (signaturePadCanvas.value) {
      signaturePadInstance.value = new SignaturePad(signaturePadCanvas.value, {
        backgroundColor: 'white',
      });
  
      signaturePadInstance.value.addEventListener('beginStroke', () => {
        showClear.value = true;
      });
    }
  
    window.addEventListener('resize', setCanvasDimensions);
  });
  
  onBeforeUnmount(() => {
    window.removeEventListener('resize', setCanvasDimensions);
  });

  const props = defineProps({
    formSection: {
        type: Object,
        required: false
    }
});
  </script>