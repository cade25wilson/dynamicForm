<template>
    <div class="py-6 text-sm bg-white rounded-lg shadow-md p-6">
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-gray-900">
          Hidden Fields
        </h2>
      </div>
  
      <p class="text-sm text-gray-500 mb-6">
        Use hidden fields to fill data using URL parameters, including UTM parameters.
      </p>
  
      <div class="mb-4">
        <div class="relative w-full">
            <tags class="tagify w-full flex flex-wrap items-center rounded-md border border-gray-300 p-2 shadow-sm focus-within:border-indigo-500 focus-within:ring-indigo-500 sm:text-sm bg-gray-50">
                <tag v-for="utmParameter in utmParameters" class="tagify__tag inline-flex items-center bg-gray-200 text-gray-700 px-2 py-1 mr-1 mb-1 rounded-full">
                    <x class="tagify__tag__removeBtn text-gray-500 hover:text-gray-700 cursor-pointer mr-1" role="button" aria-label="remove tag" @click="removeParam(utmParameter)">✖</x>
                    <span class="tagify__tag-text">
                        {{ utmParameter }}
                    </span>
                </tag>
                <!-- The input field inside the same box -->
                <input 
                v-model="newUtmText"
                class="tagify__input flex-grow bg-transparent outline-none border-none focus:ring-0 px-2 py-1" 
                placeholder="Add a new hidden field"
                @blur="AddParam"
                @keyup.enter="AddParam"
                >
            </tags>
        </div>
        <div class="mt-2 text-xs text-gray-500">
          <p>Select from the dropdown or enter your own custom hidden fields.</p>
        </div>
      </div>
  
      <!-- Optional Info Section -->
      <!-- <div class="mt-6 bg-blue-50 p-4 rounded-md">
        <div class="flex items-start">
          <svg class="h-5 w-5 text-blue-400 mr-3" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd"></path>
          </svg>
          <div class="text-sm text-blue-700">
            <p>Note: Your URL should look like the following. Replace XXX with the appropriate values.</p>
            <p class="mt-2 font-mono text-xs bg-gray-100 p-2 rounded">
              https://app.youform.com/forms/7lkj4fvr?utm_source=XXX&amp;utm_term=XXX&amp;utm_content=XXX&amp;utm_medium=XXX&amp;utm_campaign=XXX&amp;email=XXX
            </p>
          </div>
        </div>
      </div> -->
    </div>
  </template>
  
<script setup>
    import { usePage } from '@inertiajs/vue3';
    import { ref } from 'vue';

    const newUtmText = ref(null);
    const page = usePage();
    const utmParameters = ref([...page.props.utm_parameters]);

    async function AddParam() {
        if(!newUtmText.value){
            return;
        }
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const response = await fetch(`/utmfields/${page.props.form.id}`, {
            method: 'POST',
            headers: {
                'Content-type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                field: newUtmText.value
            })
        });

        if(!response.ok) {
            throw new Error('Network response was not ok');
        }

        utmParameters.value.push(newUtmText.value);
        newUtmText.value = null;
    }

    async function removeParam(value) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const response = await fetch(`/utmfields/${page.props.form.id}`, {
            method: 'DELETE',
            headers: {
                'Content-type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                field: value
            })
        });

        if(!response.ok) {
            throw new Error('Network response was not ok');
        }
        utmParameters.value = utmParameters.value.filter(param => param !== value);
    }
</script>
  