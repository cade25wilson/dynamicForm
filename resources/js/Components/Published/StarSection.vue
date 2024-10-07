<template>
    <div class="mt-6">
        <div class="flex items-center">
            <svg 
                v-for="index in starsArray" 
                :key="index" 
                @click="handleRatingClick(index)" 
                :style="{ color: page.props.form.design.answers }" 
                class="size-11 cursor-pointer text-gray-700 custom-rating-color" 
                xmlns="http://www.w3.org/2000/svg" 
                fill="none" 
                viewBox="0 0 24 24" 
                stroke-width="1" 
                :fill="getFillColor(index)" 
                :stroke="getStrokeColor(index)"
            >
                <title>{{ index }}</title>
                <path stroke-linecap="round" stroke-linejoin="round" 
                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z">
                </path>
            </svg>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, defineEmits } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const emit = defineEmits(['updateResponse']);

// State to track the current rating
const currentRating = ref(0);

const props = defineProps({
    formSection: {
        type: Object,
        required: false
    }
});

// Create stars array dynamically
const starsArray = computed(() => {
    return Array.from({ length: props.formSection.form_fields[0].options.number_stars }, (_, i) => i + 1);
});

// Function to handle rating click and update the current rating
function handleRatingClick(index) {
    currentRating.value = index;  // Update the current rating
    updateResponse(props.formSection.form_fields[0].id, index);  // Emit the rating value
}

// Function to get the fill color based on the current rating
function getFillColor(index) {
    return index <= currentRating.value ? 'yellow' : 'none';  // Yellow for selected stars, none for others
}

// Function to get the stroke color based on the current rating
function getStrokeColor(index) {
    return index <= currentRating.value ? 'yellow' : 'currentColor';  // Yellow for selected stars, default color for others
}

// Emit the selected value to parent component
function updateResponse(fieldId, value) {
    emit('updateResponse', { fieldId, value });
}
</script>
