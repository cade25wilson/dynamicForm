<template>
    <div class="mt-8 space-y-8" :style="{ color: page.props.form.design.answers }">
        <div class="flex space-x-8">
            <div class="w-1/2" v-if="page.props.current_section.form_fields[0].show">
                <label class="text-sm" :style="{ color: page.props.form.design.answers }">
                    {{page.props.current_section.form_fields[0].label}}
                </label>
                <input
                    type="text"
                    name="first_name"
                    class="block w-full px-0 border-0 border-b focus:ring-0 sm:text-sm bg-transparent custom-placeholder"
                    :placeholder="page.props.current_section.form_fields[0].placeholder"
                    :style="{ borderColor: page.props.form.design.answers, color: page.props.form.design.answers }"
                >
            </div>
            <div class="w-1/2" v-if="page.props.current_section.form_fields[1].show">
                <label class="text-sm" :style="{ color: page.props.form.design.answers }">
                    {{page.props.current_section.form_fields[1].label}}
                    <sup class="text-red-700" v-if="page.props.current_section.form_fields[1].required">*</sup>
                </label>
                <input
                    type="text"
                    name="last_name"
                    class="block w-full px-0 border-0 border-b focus:ring-0 sm:text-sm bg-transparent custom-placeholder"
                    :placeholder="page.props.current_section.form_fields[1].placeholder"
                    :style="{ borderColor: page.props.form.design.answers, color: page.props.form.design.answers }"
                >
            </div>
        </div>
        <div class="flex space-x-6">        
            <div class="w-1/2" v-if="page.props.current_section.form_fields[2].show">
                <label class="text-sm" :style="{ color: page.props.form.design.answers }">
                    {{page.props.current_section.form_fields[2].label}}
                </label>
                <input
                    type="email"
                    name="email"
                    class="block w-full px-0 border-0 border-b focus:ring-0 sm:text-sm bg-transparent custom-placeholder"
                    :placeholder="page.props.current_section.form_fields[2].placeholder"
                    :style="{ borderColor: page.props.form.design.answers, color: page.props.form.design.answers }"
                >
            </div>    
            <div class="w-1/2" v-if="page.props.current_section.form_fields[3].show">
                <label class="text-sm" :style="{ color: page.props.form.design.answers }">
                    {{page.props.current_section.form_fields[3].label}}
                </label>
                <input
                    type="text"
                    name="phone_number"
                    class="block w-full px-0 border-0 border-b focus:ring-0 sm:text-sm bg-transparent custom-placeholder"
                    :placeholder="page.props.current_section.form_fields[3].placeholder"
                    :style="{ borderColor: page.props.form.design.answers, color: page.props.form.design.answers }"
                >
            </div>
        </div>
        <div v-if="page.props.current_section.form_fields[4].show">
            <label class="text-sm" :style="{ color: page.props.form.design.answers }">
                {{page.props.current_section.form_fields[4].label}}
            </label>
            <input
                type="text"
                name="company"
                class="block w-full px-0 border-0 border-b focus:ring-0 sm:text-sm bg-transparent custom-placeholder"
                :placeholder="page.props.current_section.form_fields[4].placeholder"
                :style="{ borderColor: page.props.form.design.answers, color: page.props.form.design.answers }"
            >
        </div>
    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
const page = usePage();
</script>

<style scoped>
.custom-placeholder::placeholder {
    color: var(--placeholder-color);
}
</style>
