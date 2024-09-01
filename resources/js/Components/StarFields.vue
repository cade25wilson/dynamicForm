<template>
<div class="mt-6">
    <label for="star-rating-placeholder-text-editor-5271453a-51c6-4c72-8a65-63f1808354a9" class="block text-sm font-medium text-gray-700">Max Rating</label>
    <div class="mt-1">
        <select v-model="page.props.current_section.form_fields[0].options.number_stars" @change="updateMaxRating()" name="star-rating-redirect-delay-editor-5271453a-51c6-4c72-8a65-63f1808354a9" id="star-rating-redirect-delay-editor-5271453a-51c6-4c72-8a65-63f1808354a9" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
            <option v-for="value in optionsRange" :key="value" :value="value">{{ value }}</option>
        </select>
    </div>
</div>
</template>
<script setup>
import { usePage, router } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();

const optionsRange = computed(() => {
    const min = 3;
    const max = 10;
    return Array.from({ length: max - min + 1 }, (_, i) => i + min);
});

function updateMaxRating(){
    fetch(`/field/star/${page.props.current_section.form_fields[0].id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Assuming your CSRF token is in a meta tag
        },
        body: JSON.stringify({
            number_stars: page.props.current_section.form_fields[0].options.number_stars
        })
    });
}
</script>