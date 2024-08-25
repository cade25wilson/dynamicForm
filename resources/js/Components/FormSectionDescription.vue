<template>
    <div class="text-gray-600 custom-text-color-light text-sm md:text-base js_text_description"
        :style="{ color: page.props.form.design.questions}"    
    >
        <p>{{page.props.current_section.description}}</p>
    </div>
</template>
<script setup>
    import { usePage } from "@inertiajs/vue3"
    const page = usePage();

</script>