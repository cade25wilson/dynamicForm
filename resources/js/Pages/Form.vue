<template>
	<AppLayout title="Dashboard">
		<div class="grid grid-cols-12 h-screen">
			<div class="h-screen overflow-y-auto pb-40 col-span-2 relative px-2 pt-4">
				<FormSidebar :formSections="form_sections" :formID="form.id" @open-modal="showModal" />
			</div>
			<div class="h-screen col-span-7 relative">
				<TransitionRoot as="template" :show="showNewSectionModal">
    <Dialog class="relative z-10" @close="showNewSectionModal = false">
        <TransitionChild
            as="template"
            enter="ease-out duration-300"
            enter-from="opacity-0"
            enter-to="opacity-100"
            leave="ease-in duration-200"
            leave-from="opacity-100"
            leave-to="opacity-0"
        >
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
        </TransitionChild>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:items-center sm:p-0">
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to="opacity-100 translate-y-0 sm:scale-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100 translate-y-0 sm:scale-100"
                    leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                >
                    <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-3xl sm:max-h-screen sm:h-3/4">
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                    <DialogTitle as="h3" class="text-lg font-semibold leading-6 text-gray-900">
                                        Form Name
                                    </DialogTitle>
                                    <div class="mt-2">
                                        <input
                                            type="text"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            placeholder="Enter form name"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button
                                type="button"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-blue-500 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-600 sm:ml-3 sm:w-auto"
                                @click="submit"
                            >
                                Create Form
                            </button>
                            <button
                                type="button"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                                @click="showNewSectionModal = false"
                            >
                                Cancel
                            </button>
                        </div>
                    </DialogPanel>
                </TransitionChild>
            </div>
        </div>
    </Dialog>
</TransitionRoot>


				<p class="text-white">{{form}}</p>
			</div>
			<div class="h-screen col-span-3">
				fdsa
			</div>
		</div>
	</AppLayout>
</template>


<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import FormSidebar from '@/Components/FormSidebar.vue';
import { Dialog, DialogPanel, DialogTitle, TransitionRoot, TransitionChild } from '@headlessui/vue';

// Props
const props = defineProps({
    form: {
		type: Object,
		required: true
	},
    formFields: {
		type: Object,
		required: true
	},
    form_sections: {
		type: Object,
		required: true
	},
    groupedSectionTypes: {
        type: Object,
        required: true
    },
});

const showNewSectionModal = ref(false);

// Components
const components = {
	AppLayout,
	FormSidebar,
	Dialog,
	DialogPanel,
	DialogTitle,
	TransitionRoot,
	TransitionChild
};

function showModal() {
	console.log('showModal called');
	showNewSectionModal.value = true;
}

function submit() {
	// Add form submission logic here
}
</script>
