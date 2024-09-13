<template>
    <div class="mt-6">
        <input 
            type="date" 
            class="block w-1/2 border-0 border-b focus:ring-0 sm:text-sm custom-input bg-transparent"
            placeholder="Select date..."
            @change="handleBlur(props.formSection.form_fields[0])"
            :style="{
                '--your-placeholder-color': page.props.form.design.answers,
                '--your-border-color': page.props.form.design.answers,
                color: page.props.form.design.answers
            }"
        >
    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import { defineEmits, ref } from 'vue';

const page = usePage();
const props = defineProps({
    formSection: {
        type: Object,
        required: false
    }
});

const emit = defineEmits(['updateResponse']);

function handleBlur(field) {
    const value = event.target.value;
    console.log('field ' + field.id + ' value ' + value);
    updateResponse(field.id, value);    
}

function updateResponse(fieldId, value) {
    emit('updateResponse', { fieldId, value });
}
</script>

<style scoped>
.custom-input::placeholder {
    color: var(--your-placeholder-color);
}

.custom-input {
    --your-placeholder-color: var(--your-placeholder-color, #ccc);
    color: var(--your-text-color, #000);
    border-color: var(--your-border-color, #000);
}
</style>
