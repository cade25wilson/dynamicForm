<template>
    <div class="mt-6">
    <div class="iti iti--allow-dropdown iti--show-flags">
        <div class="iti__flag-container" :style="{color: page.props.form.design.answers}">
            <div class="iti__selected-flag" role="combobox" aria-haspopup="listbox" aria-controls="iti-21__country-listbox" aria-expanded="false" aria-label="Telephone country code" aria-disabled="true" title="United States: +1">
                <div class="iti__flag iti__us"></div>
                <div class="iti__arrow"></div>
            </div>
        </div>
        <input 
            @blur=handleBlur(formSection.form_fields[0])
            type="text" 
            class="block w-full border-0 border-b focus:ring-0 sm:text-sm bg-transparent iti__tel-input custom-input"
            autocomplete="off" 
            placeholder="(201) 555-0123" 
            data-intl-tel-input-id="21"
            :style="{
                color: page.props.form.design.answers, 
                borderColor: page.props.form.design.answers
            }"
        >
        <small v-if="errors[formSection.form_fields[0].id]" class="text-red-600">{{ errors[formSection.form_fields[0].id] }}</small>
    </div>
</div>
</template>
<script setup>
import { usePage } from '@inertiajs/vue3';
import { defineEmits, reactive, ref } from 'vue';

const page = usePage();
const props = defineProps({
    formSection: {
        type: Object,
        required: false
    }
});

const emit = defineEmits(['updateResponse']);
const isValid = ref(true); // Track if this section is valid
const errors = reactive({});

function handleBlur(field) {
    const value = event.target.value;
    if (field.type === 'tel' && !isValidPhoneNumber(value)) {
        errors[field.id] = `Please enter a valid phone number.`;
    } else {
        delete errors[field.id];
        updateResponse(field.id, value); // Call the response update when valid
    }

    isValid.value = Object.keys(errors).length === 0;
    emit('validationState', isValid.value);
}

function isValidPhoneNumber(phone) {
    const re = /^\+?[0-9\s\-().]{7,15}$/; // Basic regex to match common phone formats
    return re.test(String(phone));
}

function updateResponse(fieldId, value) {
    emit('updateResponse', { fieldId, value });
}
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