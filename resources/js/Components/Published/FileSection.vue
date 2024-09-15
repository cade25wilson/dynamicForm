<template>
	<div class="mt-6">
	  <div class="w-full">
		<div
		  :style="{ 
			borderColor: page.props.form.design.answers, 
			backgroundColor: page.props.form.design.answers + '1a' 
		  }" 
		  class="mt-2 text-center rounded-lg border border-dashed border-gray-800 custom-answer-text-color-as-border-color px-6 py-10 custom-answer-text-color-as-background-color-lightest-hover custom-answer-text-color cursor-pointer transition-all"
		  @click="handleDivClick"
		>
		  <input 
			id="fileUpload" 
			ref="fileInput"
			type="file" 
			:multiple="formSection.form_fields[0].options.multiple"
			class="hidden" 
			@change="handleFileUpload" 
		  />    
		  <p class="flex items-center justify-center">
			<svg :style="{color: page.props.form.design.answers}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
			  <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"></path>
			</svg>                          
			<span class="pl-1" :style="{color: page.props.form.design.answers}">
			  Upload a file
			</span>
		  </p>
		  <p class="text-xs mt-4" :style="{color: page.props.form.design.answers}">
			Maximum file size: 10MB
		  </p>
		</div>
	  </div>
	</div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { usePage } from '@inertiajs/vue3';
  
  const page = usePage();
  const fileInput = ref(null);  // Reference to the hidden file input
  
  const props = defineProps({
	formSection: {
	  type: Object,
	  required: true
	}
  });
  
  const handleFileUpload = (event) => {
	const files = event.target.files;  // Access the selected files
	const formData = new FormData();
	
	// Add CSRF token and fieldId to formData
	formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
	formData.append('fieldId', props.formSection.form_fields[0].id);
  
	// Loop through the selected files and append them to formData
	for (let i = 0; i < files.length; i++) {
	  formData.append('files[]', files[i]);  // Add each file under the 'files' array
	}
  
	// Send the FormData in the fetch request
	fetch(`/formfieldresponse/files/${page.props.response_id}`, {
	  method: 'POST',
	  body: formData
	})
	.then(response => response.json())
	.then(data => {
	  console.log('Success:', data);
	})
	.catch(error => {
	  console.error('Error:', error);
	});
  };
  
  // Trigger the file input click when the div is clicked
  const handleDivClick = () => {
	if (fileInput.value) {
	  fileInput.value.click();
	}
  };
  </script>
  