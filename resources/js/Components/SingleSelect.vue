<template>
    <SingleSelectOptions />



    <div class="relative flex items-center mt-6">
        <div class="flex h-6 items-center">
          <input x-model="randomize" @input.debounce="updateRandomize()" id="radio-randomize-checkbox-editor-1efa9db2-7656-4051-aa4c-5c400493f03f" aria-describedby="radio-randomize-checkbox-editor-1efa9db2-7656-4051-aa4c-5c400493f03f-description" name="radio-randomize-checkbox-editor-1efa9db2-7656-4051-aa4c-5c400493f03f" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-gray-600 focus:ring-gray-600" value="">
        </div>
        <div class="ml-3 text-sm leading-6 flex items-center justify-between">
            <label for="radio-randomize-checkbox-editor-1efa9db2-7656-4051-aa4c-5c400493f03f" class="text-sm font-medium text-gray-700">
                <span>Randomize options</span>
            </label>
            <p x-data="" x-tooltip.raw="If checked, options will be presented in a random order. This helps in reducing bias towards selections that are listed first." class="text-gray-500 cursor-pointer hover:text-gray-600 ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"></path>
                </svg>                          
            </p>
        </div>
    </div>













    <div class="relative flex items-start mt-6">
        <div class="flex h-6 items-center">
          <input x-model="horizontal" @input.debounce="updateHorizontal()" id="radio-horizontal-checkbox-editor-1efa9db2-7656-4051-aa4c-5c400493f03f" aria-describedby="radio-horizontal-checkbox-editor-1efa9db2-7656-4051-aa4c-5c400493f03f-description" name="radio-horizontal-checkbox-editor-1efa9db2-7656-4051-aa4c-5c400493f03f" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-gray-600 focus:ring-gray-600" value="">
        </div>
        <div class="ml-3 text-sm leading-6">
          <label for="radio-horizontal-checkbox-editor-1efa9db2-7656-4051-aa4c-5c400493f03f" class="text-sm font-medium text-gray-700">Horizontally align options</label>
        </div>
    </div>



    <div class="relative flex items-center mt-6">
        <div class="flex h-6 items-center">
          <input x-model="hideLabels" @input.debounce="updateHideLabels()" id="radio-hide-labels-checkbox-editor-1efa9db2-7656-4051-aa4c-5c400493f03f" aria-describedby="radio-hide-labels-checkbox-editor-1efa9db2-7656-4051-aa4c-5c400493f03f-description" name="radio-hide-labels-checkbox-editor-1efa9db2-7656-4051-aa4c-5c400493f03f" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-gray-600 focus:ring-gray-600">
        </div>
        <div class="ml-3 text-sm leading-6 flex items-center justify-between">
            <label for="radio-hide-labels-checkbox-editor-1efa9db2-7656-4051-aa4c-5c400493f03f" class="text-sm font-medium text-gray-700">
                <span>Hide labels</span>
            </label>
            <a href="https://youform.com/blog/hiding-labels-in-picture-choice-questions-in-youform" target="_blank" x-data="" x-tooltip.raw="If checked, option labels will be hidden. Only works when the options have images. Click to learn more." class="text-gray-500 inline-block cursor-pointer hover:text-gray-600 ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"></path>
                </svg>                          
            </a>
        </div>
    </div>



</template>

<script setup>
import SingleSelectOptions from './SingleSelectOptions.vue';
</script>