<template>
    <div class="mt-6">
        <input
            @blur=handleBlur(formSection.form_fields[0])
            type="text" 
            class="custom-input block w-full px-0 border-0 border-b focus:ring-0 sm:text-sm bg-transparent" 
            :placeholder="formSection.form_fields[0].placeholder"
            :style="{
                '--custom-placeholder-color': page.props.form.design.answers,
                color: page.props.form.design.answers, 
                borderColor: page.props.form.design.answers
            }"
        >
    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import { defineEmits } from 'vue';

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
    updateResponse(field.id, value);    
}

function updateResponse(fieldId, value) {
    emit('updateResponse', { fieldId, value });
}
</script>

<style scoped>
.custom-input::placeholder {
    color: var(--custom-placeholder-color);
}

.custom-input {
    --custom-placeholder-color: var(--your-placeholder-color, #ccc); /* Fallback to #ccc */
}
</style>
