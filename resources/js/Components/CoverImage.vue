<template>
    <div class="">
        <img class="max-h-64 w-auto mx-auto" :src="page.props.current_section.background_image">
    </div>
</template>

<script setup>
    import { usePage } from '@inertiajs/vue3';
    const page = usePage();
</script>