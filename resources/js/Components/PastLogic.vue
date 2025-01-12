<script setup>
import { usePage } from '@inertiajs/vue3';
import { defineProps } from 'vue';

// Define the `logics` prop
const props = defineProps({
  beforeFilteredSections: {
    type: Array,
    required: true
  },
  afterFilteredSections: {
    type: Array,
    required: true
  }
});
const page = usePage();
// Create a local reactive copy of `logics`

// Add a new condition to the specified logic by index
const addCondition = (index) => {
  if (page.props.current_section.logic[index]) {
    page.props.current_section.logic[index].condition.push({
      section_id: null,
      operator: "equal",
      value: "",
      connector: page.props.current_section.logic[index].condition.length > 0 ? "and" : null,
    });
  }
};

// Remove a specific condition by index
const removeCondition = (logicIndex, conditionIndex) => {
  if (page.props.current_section.logic[logicIndex]) {
    page.props.current_section.logic[logicIndex].condition.splice(conditionIndex, 1);
  }
};

async function updateLogic(logic) {
    try{
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const response = await fetch(`/logic/${logic.id}`, {
            method: 'PUT',
            headers: {
                'Content-type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(logic)
        });

        if (!response.ok) {
           throw new Error(`Failed to save logic: ${response.statusText}`);
        }
    } catch (error) {
        console.error('Error updating Logic', error);
    }
}

async function deleteLogic(logic, logicIndex) {
    try{
      console.log(logic.id);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const response = await fetch(`/logic/${logic.id}`, {
            method: 'DELETE',
            headers: {
                'Content-type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
        });

        if (!response.ok) {
           throw new Error(`Failed to save logic: ${response.statusText}`);
        }

        page.props.current_section.logic.splice(logicIndex, 1);
    } catch (error){
        console.error(error)
    }
}
</script>
<template>
    <div class="mt-3 space-y-4" v-for="(logic, logicIndex) in page.props.current_section.logic" :key="logicIndex">
      <!-- Logic Conditions -->
      <div class="text-gray-700 bg-gray-50 border-2 rounded-md relative group">
        <div class="max-w-sm mx-auto py-6 px-6">
            <button @click="deleteLogic(logic, logicIndex)" class="bg-red-100 hidden group-hover:block text-red-600 absolute top-3 right-2 p-2 rounded-md hover:bg-red-600 hover:text-white transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"></path>
                </svg>  
            </button>
          <div>
            <select v-model="logic.is_always" class="block rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900">
              <option :value="false">If</option>
              <option :value="true">Always</option>
            </select>
          </div>
          <div v-if="!logic.is_always">
            <div v-for="(condition, conditionIndex) in logic.condition" :key="conditionIndex" class="space-y-2 mt-2">
              <!-- Add AND/OR Selector for conditions starting from the second one -->
              <div v-if="conditionIndex > 0" class="flex items-center space-x-2">
                <select v-model="condition.connector" class="block w-35 rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900">
                  <option value="and">AND</option>
                  <option value="or">OR</option>
                </select>
              </div>
              <!-- Condition Selection -->
              <div class="flex rounded-md shadow-sm">
                <select v-model="condition.section_id" class="block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900">
                  <optgroup label="Questions">
                    <option v-for="section in beforeFilteredSections" :key="section.id" :value="section.id">
                      {{ section.name }}
                    </option>
                  </optgroup>
                </select>
              </div>
              <div class="flex items-center space-x-1">
                <select v-model="condition.operator" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900">
                  <option value="equal">is</option>
                  <option value="not_equal">is not</option>
                </select>
                <input
                  v-model="condition.value"
                  type="text"
                  class="block mt-2 w-full rounded-md border-0 py-1.5 text-gray-900"
                  placeholder="Enter a value..."
                />
              </div>
              <button @click="removeCondition(logicIndex, conditionIndex)" class="text-red-600 hover:underline text-xs">
                Remove
              </button>
            </div>
            <div class="mt-1.5 flex items-center justify-end">
              <button @click="addCondition(logicIndex)" class="text-blue-600 underline text-xs">
                + Add condition
              </button>
            </div>
          </div>
          <div class="mt-4">
            <h4>Then</h4>
          </div>
          <div>
            <div class="mt-2">
              <select v-model="logic.action.type" class="block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900">
                <optgroup label="Transition">
                  <option value="goto">Go to</option>
                </optgroup>
              </select>
            </div>
            <div class="mt-2">
              <select v-model="logic.action.target" class="block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900">
                <option value="">-- Please select --</option>
                <option v-for="section in afterFilteredSections" :key="section.id" :value="section.id">
                  {{ section.formsectionname }}
                </option>
              </select>
            </div>
          </div>
          <!-- Save Button -->
            <div class="mt-4 flex justify-end">
                <button
                    @click="updateLogic(logic)"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                >
                    Update
                </button>
            </div>
        </div>
      </div>
    </div>
  </template>
  