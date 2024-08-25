<template>
    <h4 class="text-4xl py-6 font-bold text-gray-700 custom-text-color leading-snug">{{ page.props.current_section.name }}</h4>
</template>
<script setup>
    import { usePage } from "@inertiajs/vue3"
    const page = usePage();
</script>