<template>
  <div>
    <div class="relative mt-2">
      <button 
        @click="showOptions = !showOptions"
        type="button"
        class="relative w-full cursor-default rounded-md py-1.5 pl-3 pr-10 text-left shadow-sm ring-1 ring-inset ring-gray-700 focus:outline-none focus:ring-0 custom-border-color sm:text-sm sm:leading-6 bg-transparent custom-text-color"
        aria-haspopup="listbox"
        :aria-expanded="showOptions"
        aria-labelledby="listbox-label"
      >
        <span class="block truncate" :style="{ color: page.props.form.design.questions }">
          {{ selectedOption || 'Please select an option' }}
        </span>
        <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
          <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path
              fill-rule="evenodd"
              d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"
              clip-rule="evenodd"
            />
          </svg>
        </span>
      </button>

      <ul 
        v-if="formSection?.form_fields?.[0]?.options?.choices && showOptions"
        class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
        tabindex="-1"
        role="listbox"
        aria-labelledby="listbox-label"
      >
        <li
          v-for="(choice, index) in formSection.form_fields[0].options.choices"
          :key="index"
          @click="selectOption(choice)"
          class="text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9 hover:bg-gray-200 hover:text-gray-800"
          role="option"
        >
          <span class="block truncate">{{ choice.label }}</span>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import { defineEmits, ref } from 'vue';

const showOptions = ref(false);
const selectedOption = ref(null);

const page = usePage();
const props = defineProps({
  formSection: {
    type: Object,
    required: false,
  },
});

const selectOption = (choice) => {
  handleBlur(props.formSection.form_fields[0], choice.label);
  selectedOption.value = choice.label;
  showOptions.value = false;
};

const emit = defineEmits(['updateResponse']);

function handleBlur(field, value) {
    console.log('field ' + field.id + ' value ' + value);
    updateResponse(field.id, value);    
}

function updateResponse(fieldId, value) {
    emit('updateResponse', { fieldId, value });
}
</script>
<style scoped>
li{
  cursor: pointer;
}
</style>