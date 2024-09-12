<template>
    <div class="mt-6">
        {{formSection}}
        <div :class="{
            'grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3': formSection.form_fields[0].options.align === 'horizontal',
            'space-y-3 inline-block': formSection.form_fields[0].options.align !== 'horizontal'
        }">
            <label class="relative min-w-40 block cursor-pointer rounded-lg border px-4 py-3 shadow-sm focus:outline-none custom-answer-text-color bg-transparent border-gray-700 custom-answer-text-color-as-border-color" :style="{borderColor: page.props.form.design.answers}"
            v-for="(option, index) in formSection.form_fields[0].options.choices" :key="index" @click="handleBlur(formSection.form_fields[0], option.label)">
                <div class="flex flex-1" v-if="!(formSection.form_fields[0].options.hide_label && option.image)">
                    <span class="flex flex-col">
                        <span class="block text-sm pr-4 font-medium text-gray-900 custom-answer-text-color" :style="{color: page.props.form.design.answers}">{{ option.label }}</span>
                    </span>
                </div>
                <span class="pointer-events-none absolute -inset-px rounded-lg" aria-hidden="true"></span> 
                <div v-if="option.image">
                    <img class="w-40 my-2 rounded-md" :src="option.image">
                </div>
            </label>
        </div>
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

function handleBlur(field, value) {
    console.log('field ' + field.id + ' value ' + value);
    updateResponse(field.id, value);    
}

function updateResponse(fieldId, value) {
    emit('updateResponse', { fieldId, value });
}
</script>
