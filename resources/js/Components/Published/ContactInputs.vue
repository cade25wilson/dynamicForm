<template>
    <div class="mt-8 space-y-8" :style="{ color: page.props.form.design.answers }">
        <!-- First set of fields -->
        <div :class="singleFieldVisible(0, 1) ? 'flex' : 'flex space-x-6'">
            <div :class="singleFieldVisible(0, 1) ? 'w-full' : 'w-1/2'" v-if="formSection.form_fields[0].show">
                <label class="text-sm" :style="{ color: page.props.form.design.answers }">
                    {{ formSection.form_fields[0].label }}
                    <sup class="text-red-700" v-if="formSection.form_fields[0].required">*</sup>
                </label>
                <input
                    type="text"
                    name="first_name"
                    class="block w-full px-0 border-0 border-b focus:ring-0 sm:text-sm bg-transparent custom-placeholder"
                    :placeholder="formSection.form_fields[0].placeholder"
                    :style="{ borderColor: page.props.form.design.answers, color: page.props.form.design.answers }"
                    @blur="handleBlur(formSection.form_fields[0])"
                >
                <small v-if="errors[formSection.form_fields[0].id]" class="text-red-600">{{ errors[formSection.form_fields[0].id] }}</small>
            </div>
            <div :class="singleFieldVisible(0, 1) ? 'w-full' : 'w-1/2'" v-if="formSection.form_fields[1].show">
                <label class="text-sm" :style="{ color: page.props.form.design.answers }">
                    {{ formSection.form_fields[1].label }}
                    <sup class="text-red-700" v-if="formSection.form_fields[1].required">*</sup>
                </label>
                <input
                    type="text"
                    name="last_name"
                    class="block w-full px-0 border-0 border-b focus:ring-0 sm:text-sm bg-transparent custom-placeholder"
                    :placeholder="formSection.form_fields[1].placeholder"
                    :style="{ borderColor: page.props.form.design.answers, color: page.props.form.design.answers }"
                    @blur="handleBlur(formSection.form_fields[1])"
                >
                <small v-if="errors[formSection.form_fields[1].id]" class="text-red-600">{{ errors[formSection.form_fields[1].id] }}</small>
            </div>
        </div>

        <!-- Second set of fields -->
        <div :class="singleFieldVisible(2, 3) ? 'flex' : 'flex space-x-6'">
            <div :class="singleFieldVisible(2, 3) ? 'w-full' : 'w-1/2'" v-if="formSection.form_fields[2].show">
                <label class="text-sm" :style="{ color: page.props.form.design.answers }">
                    {{ formSection.form_fields[2].label }}
                    <sup class="text-red-700" v-if="formSection.form_fields[2].required">*</sup>
                </label>
                <input
                    type="email"
                    name="email"
                    class="block w-full px-0 border-0 border-b focus:ring-0 sm:text-sm bg-transparent custom-placeholder"
                    :placeholder="formSection.form_fields[2].placeholder"
                    :style="{ borderColor: page.props.form.design.answers, color: page.props.form.design.answers }"
                    @blur="handleBlur(formSection.form_fields[2])"
                >
                <small v-if="errors[formSection.form_fields[2].id]" class="text-red-600">{{ errors[formSection.form_fields[2].id] }}</small>
            </div>    
            <div :class="singleFieldVisible(2, 3) ? 'w-full' : 'w-1/2'" v-if="formSection.form_fields[3].show">
                <label class="text-sm" :style="{ color: page.props.form.design.answers }">
                    {{ formSection.form_fields[3].label }}
                    <sup class="text-red-700" v-if="formSection.form_fields[3].required">*</sup>
                </label>
                <input
                    type="tel"
                    name="phone_number"
                    class="block w-full px-0 border-0 border-b focus:ring-0 sm:text-sm bg-transparent custom-placeholder"
                    :placeholder="formSection.form_fields[3].placeholder"
                    :style="{ borderColor: page.props.form.design.answers, color: page.props.form.design.answers }"
                    @blur="handleBlur(formSection.form_fields[3])"
                >
                <small v-if="errors[formSection.form_fields[3].id]" class="text-red-600">{{ errors[formSection.form_fields[3].id] }}</small>
            </div>
        </div>

        <!-- Single field -->
        <div v-if="formSection.form_fields[4].show">
            <label class="text-sm" :style="{ color: page.props.form.design.answers }">
                {{ formSection.form_fields[4].label }}
                <sup class="text-red-700" v-if="formSection.form_fields[4].required">*</sup>
            </label>
            <input
                type="text"
                name="company"
                class="block w-full px-0 border-0 border-b focus:ring-0 sm:text-sm bg-transparent custom-placeholder"
                :placeholder="formSection.form_fields[4].placeholder"
                :style="{ borderColor: page.props.form.design.answers, color: page.props.form.design.answers }"
                @blur="handleBlur(formSection.form_fields[4])"
            >
            <small v-if="errors[formSection.form_fields[4].id]" class="text-red-600">{{ errors[formSection.form_fields[4].id] }}</small>
        </div>
    </div>
</template>

<script setup>
import { defineEmits, defineProps, reactive, ref } from 'vue';
import { usePage } from '@inertiajs/vue3';

// Define the emit function
const emit = defineEmits(['updateResponse']);
const isValid = ref(true); // Track if this section is valid
const page = usePage();

const props = defineProps({
    formSection: {
        type: Object,
        required: false
    }
});

// Define a reactive object to store validation errors
const errors = reactive({});

// Helper method for conditional classes
const singleFieldVisible = (index1, index2) => {
    const fields = props.formSection.form_fields;
    return (fields[index1].show && !fields[index2].show) || (!fields[index1].show && fields[index2].show);
};

// Function to handle the blur event and perform validation
// function handleBlur(field) {
//     const value = event.target.value;

//     // Validate input based on field type and requirements
//     if (field.required && !value) {
//         errors[field.id] = `${field.label} is required.`;
//     } else if (field.type === 'email' && !isValidEmail(value)) {
//         errors[field.id] = `Please enter a valid email address.`;
//     } else if (field.type === 'tel' && !isValidPhoneNumber(value)) {
//         errors[field.id] = `Please enter a valid phone number.`;
//     } else {
//         delete errors[field.id];
//         updateResponse(field.id, value);
//     }
// }

function handleBlur(field) {
    const value = event.target.value;

    // Validate input based on field type and requirements
    if (field.required && !value) {
        errors[field.id] = `${field.label} is required.`;
    } else if (field.type === 'email' && !isValidEmail(value)) {
        errors[field.id] = `Please enter a valid email address.`;
    } else if (field.type === 'tel' && !isValidPhoneNumber(value)) {
        errors[field.id] = `Please enter a valid phone number.`;
    } else {
        delete errors[field.id];
        updateResponse(field.id, value); // Call the response update when valid
    }

    // Update the isValid state based on whether there are any errors
    isValid.value = Object.keys(errors).length === 0;

    // Emit the validation state to the parent
    emit('validationState', isValid.value);
}


// Function to validate phone numbers (basic validation)
function isValidPhoneNumber(phone) {
    const re = /^\+?[0-9\s\-().]{7,15}$/; // Basic regex to match common phone formats
    return re.test(String(phone));
}


// Basic email validation
function isValidEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(email).toLowerCase());
}

// Function to handle the updateResponse event and emit it to the parent
function updateResponse(fieldId, value) {
    emit('updateResponse', { fieldId, value });
}
</script>

<style scoped>
.custom-placeholder::placeholder {
    color: var(--placeholder-color);
}

.text-red-600 {
    color: red;
}
</style>
