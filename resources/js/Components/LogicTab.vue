<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed, ref, reactive } from 'vue';
import axios from 'axios';

const page = usePage();
const actionType = ref("goto");

const nextSection = computed(() => {
	return page.props.form_sections.find(
		(section) => section.order === page.props.current_section.order + 1
	);
});

// Form data for logic
const logicData = reactive({
	form_section_id: page.props.current_section.id,	
	condition: [
		{ section_id: null, operator: "equal", value: "", connector: null },
	],
	action: {
		type: "goto",
		target: null,
	},
	default_action: {
		type: "goto",
		target: nextSection.id,
	},
});


const addCondition = () => {
  logicData.condition.push({
    section_id: null,
    operator: "equal",
    value: "",
    connector: "and",
  });
};

const removeCondition = (index) => {
  logicData.condition.splice(index, 1);
};

// Flag for always condition
const isAlways = ref(false);

const afterFilteredSections = computed(() => {
  return page.props.form_sections.filter(
    (section) => section.order > page.props.current_section.order
  );
});

const beforeFilteredSections = computed(() => {
  return page.props.form_sections.filter(
    (section) => section.order < page.props.current_section.order
  );
});

// Submit logic data to backend
async function saveLogic() {
	try {
		await axios.post('/logic', logicData);
	} catch (error) {
		console.error('Error saving logic:', error);
		alert('Failed to save logic. Please try again.');
	}
}
</script>


<template>
	<!-- {{ logicData }} -->
	  {{ afterFilteredSections }}
    <div>
      	<div class="z-100" aria-modal="true">
			<a
			href="#"
			class="absolute top-4 right-4 block p-2 bg-white rounded-full hover:bg-gray-50"
			style="z-index: 1000"
			>
				<svg
					xmlns="http://www.w3.org/2000/svg"
					fill="none"
					viewBox="0 0 24 24"
					stroke-width="1.5"
					stroke="currentColor"
					class="w-6 h-6"
				>
					<path
					stroke-linecap="round"
					stroke-linejoin="round"
					d="M6 18L18 6M6 6l12 12"
					></path>
				</svg>
			</a>
        	<div class="relative transform overflow-hidden bg-white text-left shadow-xl transition-all">
          		<div>
					<div class="flex items-center justify-between sticky top-0 bg-white z-50 px-4 pt-10 sm:px-14 pb-4">
              			<div class="flex items-center space-x-2 justify-center">
                			<img src="https://buildmyform.com/images/icons/branch.png" alt="" />
							<span>Add Logic for</span>
                			<div class="flex items-center text-sm border border-dashed border-blue-600 px-3 py-1 rounded-md max-w-96 bg-studio-300">
                  				<span>
									<svg
									xmlns="http://www.w3.org/2000/svg"
									fill="none"
									viewBox="0 0 24 24"
									stroke-width="1.5"
									stroke="currentColor"
									class="size-4"
									>
										<path
											stroke-linecap="round"
											stroke-linejoin="round"
											d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
										></path>
									</svg>
                  				</span>
								<p class="pl-1 truncate">{{ page.props.current_section.name }}</p>
                			</div>
						</div>
						<button
							@click="saveLogic"
							type="button"
							class="rounded-md bg-gray-700 px-3 py-1.5 text-xs text-white shadow-sm hover:bg-gray-600"
						>
							<span>Save</span>
						</button>
					</div>
					<div
						class="bg-white pt-2 px-14 pb-6 overflow-y-auto"
						style="max-height: 40rem;"
					>
              		<div class="w-full">
                		<div class="mt-3 space-y-4">
	                  		<!-- Logic Conditions -->
                  			<div class="text-gray-700 bg-gray-50 rounded-md relative group">
    			                <div class="max-w-sm mx-auto py-6">
                			        <div>
										<select
										v-model="isAlways"
										class="block rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900"
										>
											<option :value="false">If</option>
											<option :value="true">Always</option>
										</select>
                        			</div>  
                        			<div v-if="!isAlways">
										<div
											v-for="(condition, index) in logicData.condition"
											:key="index"
											class="space-y-2 mt-2"
										>
											<!-- Add AND/OR Selector for conditions starting from the second one -->
											<div v-if="index > 0" class="flex items-center space-x-2">
												<select
													v-model="condition.connector"
													class="block w-20 rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-400 focus:ring-1 focus:ring-gray-600 sm:text-sm sm:leading-6"
												>
													<option value="and">AND</option>
													<option value="or">OR</option>
												</select>
                                				<span class="text-gray-500 text-sm">Condition {{ index + 1 }}</span>
                                			</div>
											<!-- Condition Selection -->
											<div class="flex rounded-md shadow-sm">
											<select
												v-model="condition.section_id"
												class="block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-400 focus:ring-1 focus:ring-gray-600 sm:text-sm sm:leading-6"
											>
                                    			<optgroup label="Questions">
												<option
													v-for="section in beforeFilteredSections"
													:key="section.id"
													:value="section.id"
												>
													{{ section.name }}
												</option>
												</optgroup>
                                			</select>
                                		</div>
                                		<div class="flex items-center space-x-1">
											<select
												v-model="condition.operator"
												class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-400 focus:ring-1 focus:ring-gray-600 sm:text-sm sm:leading-6"
											>
												<option value="equal">is</option>
												<option value="not_equal">is not</option>
											</select>
											<input
												v-model="condition.value"
												type="text"
												class="block mt-2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6"
												placeholder="enter a value..."
											/>
										</div>
										<button
										@click="removeCondition(index)"
										class="text-red-600 hover:underline text-xs"
										>
										Remove
										</button>
									</div>
									<div class="mt-1.5 flex items-center justify-end">
										<button
										@click="addCondition"
										class="text-blue-600 underline text-xs"
										>
										+ Add condition
										</button>
									</div>
								</div>
								<div class="mt-4">
									<h4>Then</h4>
								</div>
								<div>
									<div class="mt-2">
										<select v-model="actionType" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-400 focus:ring-1 focus:ring-gray-600 sm:text-sm sm:leading-6">
											<optgroup label="Transition">
												<option value="goto">Go to</option>
											</optgroup>
										</select>
									</div>
									<div class="mt-2">
										<select
											v-model="logicData.action.target"
											class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-400 focus:ring-1 focus:ring-gray-600 sm:text-sm sm:leading-6"
											>
											<option value="">-- Please select --</option>
											<option
												v-for="section in afterFilteredSections"
												:key="section.id"
												:value="section.id"
											>
												{{ section.formsectionname }}
											</option>
										</select>
									</div>
								</div>
                    		</div>
                  		</div>
                	</div>
					<!-- Default Action -->
					<div class="text-gray-700 bg-gray-50 rounded-md relative group mb-6">
                  		<div class="max-w-sm mx-auto py-6">
                    		<span>In all other cases go to</span>
							<select
								v-model="logicData.default_action.target"
								class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900"
							>
								<option value="">the next block</option>
								<option
								v-for="section in afterFilteredSections"
								:key="section.id"
								:value="section.id"
								>
								{{ section.name }}
								</option>
							</select>
                  		</div>
                	</div>
              	</div>
			</div>
		</div>
	</div>
</div>
</div>
  </template>
  