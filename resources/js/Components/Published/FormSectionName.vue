<template>
    <h4 class="text-4xl py-3 text-gray-700 custom-text-color leading-snug"
        :style="{ color: page.props.form.design.questions }"
    >{{ formSection.name }}</h4>
</template>
<script setup>
    import { usePage } from "@inertiajs/vue3"
    const page = usePage();
    const props = defineProps({
        formSection: {
            type: Object,
            required: false
        }
    });
</script>