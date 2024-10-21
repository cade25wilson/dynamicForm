<template>
  <div class="mt-6 grid grid-cols-10 gap-2">
      <button 
          v-for="number in 10" 
          :key="number" 
          :style="{ 
              borderColor: page.props.form.design.answers, 
              backgroundColor: number === selectedValue ? page.props.form.design.answers + '4d' : page.props.form.design.answers + '1a'
          }" 
          class="text-sm px-3 py-3 transition-all custom-answer-text-color-as-background-color-lightest-hover custom-answer-text-color border border-gray-500 custom-answer-text-color-as-border-color text-center rounded" 
          type="button"
          @click="handleBlur(number)"
      >
          <span>{{ number }}</span>
      </button>
  </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import { defineEmits, ref } from 'vue';

const emit = defineEmits(['updateResponse']);
const page = usePage();

// Define props for the form section
const props = defineProps({
  formSection: {
      type: Object,
      required: false
  }
});

// State to track the selected value
const selectedValue = ref(null);

// Handle button click
function handleBlur(value) {
  selectedValue.value = value;  // Update selected value
  updateResponse(props.formSection.form_fields[0].id, value);  // Emit the selected value
}

// Emit the selected value to parent component
function updateResponse(fieldId, value) {
  emit('updateResponse', { fieldId, value });
}
</script>
