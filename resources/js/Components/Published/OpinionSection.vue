<template>
    <div class="mt-6 grid grid-cols-10 gap-2">
        <button 
      v-for="number in 10" 
      :key="number" 
      :style="{ 
        borderColor: page.props.form.design.answers, 
        backgroundColor: page.props.form.design.answers + '1a' 
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
import { defineEmits } from 'vue';

const emit = defineEmits(['updateResponse']);
const page = usePage();
const props = defineProps({
    formSection: {
        type: Object,
        required: false
    }
});

function handleBlur(value) {
    updateResponse(props.formSection.form_fields[0].id, value);    
}

function updateResponse(fieldId, value) {
    emit('updateResponse', { fieldId, value });
}
</script>
