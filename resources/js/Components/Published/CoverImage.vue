<template>
    <div class="">
        <img class="max-h-64 w-auto mx-auto" :src="formSection.background_image">
    </div>
</template>

<script setup>
    import { usePage } from '@inertiajs/vue3';
    // Define props
    const props = defineProps({
        formSection: {
            type: Object,
            required: false
        }
    });

    const page = usePage();
</script>