<template>
    <CoverImage v-if="page.props.current_section.background_image != null" />
    <FormSectionName />
    <FormSectionDescription />
    <div class="mt-6">
        <div :class="{
            'grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3': page.props.current_section.form_fields[0].options.align === 'horizontal',
            'space-y-3 inline-block': page.props.current_section.form_fields[0].options.align !== 'horizontal'
        }"
    >            <label class="relative min-w-40 block cursor-pointer rounded-lg border px-4 py-3 shadow-sm focus:outline-none custom-answer-text-color bg-transparent border-gray-700 custom-answer-text-color-as-border-color" :style="{borderColor: page.props.form.design.answers}"
             v-for="(option, index) in page.props.current_section.form_fields[0].options.choices" :key="index">
                <div class="flex flex-1">
                    <span class="flex flex-col">
                        <span class="block text-sm pr-4 font-medium text-gray-900 custom-answer-text-color" :style="{color: page.props.form.design.answers}">{{ option }}</span>
                    </span>
                </div>
                <span class="pointer-events-none absolute -inset-px rounded-lg" aria-hidden="true"></span> 
            </label>
        </div>
    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import CoverImage from './CoverImage.vue';
import FormSectionDescription from './FormSectionDescription.vue';
import FormSectionName from './FormSectionName.vue';

const page = usePage();
</script>
