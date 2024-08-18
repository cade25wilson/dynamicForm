<template>
	<AppLayout title="Dashboard">
		<div class="grid grid-cols-12 h-screen">
			<div class="h-screen overflow-y-auto pb-40 col-span-2 relative px-2 pt-4">
				<FormSidebar :formSections="data.form_sections" />
			</div>
			<div class="h-screen col-span-7 relative">
				
				<p class="text-white">{{ data }}</p>
			</div>
			<div class="h-screen col-span-3">
				fdsa
			</div>
		</div>
	</AppLayout>
</template>

<script setup>
import { computed } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import FormSidebar from '@/Components/FormSidebar.vue';

// Props
const props = defineProps({
	data: {
		type: Object,
		required: true
	}
});

// Components
const components = {
	AppLayout,
	FormSidebar,
};
</script>