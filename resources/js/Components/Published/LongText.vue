<template>
    <div class="mt-6">
        <textarea 
            @blur=handleBlur(formSection.form_fields[0])
            style="max-height: 24rem; height: 110px" 
            class="block w-full min-h-6 rounded-md shadow-sm sm:text-sm bg-transparent custom-textarea"
            :style="{
                color: page.props.form.design.answers, 
                borderColor: page.props.form.design.answers
            }"
        ></textarea>
        <p class="text-right mt-2 text-gray-600 custom-text-color-light" 
            v-if="length"
            :style="{ color: page.props.form.design.answers }">
            <span>0</span>/<span>{{ formSection.form_fields[0].options.length }}</span>
        </p>
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

const length = ref(false);

if (!isNaN(props.formSection.form_fields[0].options.length) && props.formSection.form_fields[0].options.length !== '') {
    length.value = true;
}
function handleBlur(field) {
    const value = event.target.value;
    updateResponse(field.id, value);    
}

function updateResponse(fieldId, value) {
    emit('updateResponse', { fieldId, value });
}
</script>
