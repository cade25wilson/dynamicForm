<template>
    <div class="mt-8 space-y-8" :style="{ color: page.props.form.design.answers }">
        <!-- First set of fields -->
        <div :class="singleFieldVisible(0, 1) ? 'flex' : 'flex space-x-6'">
            <div :class="singleFieldVisible(0, 1) ? 'w-full' : 'w-1/2'" v-if="formSection.form_fields[0].show">
                <label class="text-sm" :style="{ color: page.props.form.design.answers }">
                    {{formSection.form_fields[0].label}}
                    <sup class="text-red-700" v-if="formSection.form_fields[0].required">*</sup>
                </label>
                <input
                    type="text"
                    name="first_name"
                    class="block w-full px-0 border-0 border-b focus:ring-0 sm:text-sm bg-transparent custom-placeholder"
                    :placeholder="formSection.form_fields[0].placeholder"
                    :style="{ borderColor: page.props.form.design.answers, color: page.props.form.design.answers }"
                >
            </div>
            <div :class="singleFieldVisible(0, 1) ? 'w-full' : 'w-1/2'" v-if="formSection.form_fields[1].show">
                <label class="text-sm" :style="{ color: page.props.form.design.answers }">
                    {{formSection.form_fields[1].label}}
                    <sup class="text-red-700" v-if="formSection.form_fields[1].required">*</sup>
                </label>
                <input
                    type="text"
                    name="last_name"
                    class="block w-full px-0 border-0 border-b focus:ring-0 sm:text-sm bg-transparent custom-placeholder"
                    :placeholder="formSection.form_fields[1].placeholder"
                    :style="{ borderColor: page.props.form.design.answers, color: page.props.form.design.answers }"
                >
            </div>
        </div>

        <!-- Second set of fields -->
        <div :class="singleFieldVisible(2, 3) ? 'flex' : 'flex space-x-6'">
            <div :class="singleFieldVisible(2, 3) ? 'w-full' : 'w-1/2'" v-if="formSection.form_fields[2].show">
                <label class="text-sm" :style="{ color: page.props.form.design.answers }">
                    {{formSection.form_fields[2].label}}
                    <sup class="text-red-700" v-if="formSection.form_fields[2].required">*</sup>
                </label>
                <input
                    type="email"
                    name="email"
                    class="block w-full px-0 border-0 border-b focus:ring-0 sm:text-sm bg-transparent custom-placeholder"
                    :placeholder="formSection.form_fields[2].placeholder"
                    :style="{ borderColor: page.props.form.design.answers, color: page.props.form.design.answers }"
                >
            </div>    
            <div :class="singleFieldVisible(2, 3) ? 'w-full' : 'w-1/2'" v-if="formSection.form_fields[3].show">
                <label class="text-sm" :style="{ color: page.props.form.design.answers }">
                    {{formSection.form_fields[3].label}}
                    <sup class="text-red-700" v-if="formSection.form_fields[3].required">*</sup>
                </label>
                <input
                    type="text"
                    name="phone_number"
                    class="block w-full px-0 border-0 border-b focus:ring-0 sm:text-sm bg-transparent custom-placeholder"
                    :placeholder="formSection.form_fields[3].placeholder"
                    :style="{ borderColor: page.props.form.design.answers, color: page.props.form.design.answers }"
                >
            </div>
        </div>

        <!-- Single field -->
        <div v-if="formSection.form_fields[4].show">
            <label class="text-sm" :style="{ color: page.props.form.design.answers }">
                {{formSection.form_fields[4].label}}
                <sup class="text-red-700" v-if="formSection.form_fields[4].required">*</sup>
            </label>
            <input
                type="text"
                name="company"
                class="block w-full px-0 border-0 border-b focus:ring-0 sm:text-sm bg-transparent custom-placeholder"
                :placeholder="formSection.form_fields[4].placeholder"
                :style="{ borderColor: page.props.form.design.answers, color: page.props.form.design.answers }"
            >
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();

const singleFieldVisible = (index1, index2) => {
    const fields = formSection.form_fields;
    return (fields[index1].show && !fields[index2].show) || (!fields[index1].show && fields[index2].show);
};

const props = defineProps({
    formSection: {
        type: Object,
        required: false
    }
});
</script>


<style scoped>
.custom-placeholder::placeholder {
    color: var(--placeholder-color);
}
</style>
