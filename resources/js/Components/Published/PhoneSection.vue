<template>
    <!-- <CoverImage v-if="formSection.background_image != null" /> -->
    <!-- <FormSectionName />
    <FormSectionDescription /> -->
    <div class="mt-6">
    <div class="iti iti--allow-dropdown iti--show-flags">
        <div class="iti__flag-container" :style="{color: page.props.form.design.answers}">
            <div class="iti__selected-flag" role="combobox" aria-haspopup="listbox" aria-controls="iti-21__country-listbox" aria-expanded="false" aria-label="Telephone country code" aria-disabled="true" title="United States: +1">
                <div class="iti__flag iti__us"></div>
                <div class="iti__arrow"></div>
            </div>
        </div>
        <input 
            type="text" 
            disabled 
            class="block w-full border-0 border-b focus:ring-0 sm:text-sm bg-transparent iti__tel-input custom-input"
            autocomplete="off" 
            placeholder="(201) 555-0123" 
            data-intl-tel-input-id="21"
            :style="{
                color: page.props.form.design.answers, 
                borderColor: page.props.form.design.answers
            }"
        >
    </div>
</div>
</template>
<script setup>
import { usePage } from '@inertiajs/vue3';
import CoverImage from './CoverImage.vue';
import FormSectionDescription from './FormSectionDescription.vue';
import FormSectionName from './FormSectionName.vue';

const page = usePage();
const props = defineProps({
    formSection: {
        type: Object,
        required: false
    }
});
</script>

<style scoped>
.iti {
    display: inline-block;
}

.custom-input::placeholder {
    color: var(--custom-placeholder-color);
}

.custom-input {
    --custom-placeholder-color: var(--your-placeholder-color, #ccc); /* Default to #ccc if not set */
    color: var(--your-text-color, #000); /* Set this to your desired text color */
    border-color: var(--your-border-color, #000); /* Set this to your desired underline color */
}
</style>