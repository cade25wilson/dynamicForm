<template>
  <div class="shadow-md bg-white h-screen overflow-y-auto py-4 px-2 pb-32">
    <div>
      <div>
        <div>
          <h4 class="text-xl font-semibold mb-1">
            Settings
          </h4>
        </div>

        <!-- General -->
        <div>
			<button @click="toggleDropdown('general')" class="flex justify-between w-full py-2 text-left">
				<span>General</span>
				<svg :class="dropdowns.general ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
				</svg>
			</button>
          	<div v-show="dropdowns.general" class="ml-4">
				<!-- General Settings Content Here -->
				<div class="mt-6 space-y-3">
					<div class="flex flex-col items-center justify-between p-6 border border-gray-300 shadow-lg rounded-xl bg-gradient-to-r from-indigo-100 via-purple-100 to-pink-100">
						<h4 class="text-xl font-bold text-gray-800 mb-4">
							Progress Bar
						</h4>

						<label class="relative inline-flex items-center cursor-pointer">
							<input type="checkbox" :checked="page.props.form.design.progress_bar" @change="handleChange('progress_bar', $event.target.checked)" class="sr-only peer">
							<div class="w-12 h-12 bg-gray-400 peer-checked:bg-blue-500 rounded-full border-4 border-gray-200 peer-checked:border-blue-600 flex items-center justify-center transition-all duration-300 ease-in-out">
								<svg class="w-6 h-6 text-white transform transition-transform duration-300 ease-in-out peer-checked:rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
								</svg>
							</div>
						</label>

						<p class="mt-4 text-sm text-gray-600">Toggle Progress</p>
					</div>

					<!-- Navigation Arrows -->
					<div class="flex flex-col items-center justify-between p-6 border border-gray-300 shadow-lg rounded-xl bg-gradient-to-r from-indigo-100 via-purple-100 to-pink-100">
						<h4 class="text-xl font-bold text-gray-800 mb-4">
							Navigation Arrows
						</h4>
						<label class="relative inline-flex items-center cursor-pointer">
							<input type="checkbox" :checked="page.props.form.design.navigation" @change="handleChange('navigation', $event.target.checked)" class="sr-only peer">
							<div class="w-12 h-12 bg-gray-400 peer-checked:bg-blue-500 rounded-full border-4 border-gray-200 peer-checked:border-blue-600 flex items-center justify-center transition-all duration-300 ease-in-out">
								<svg class="w-6 h-6 text-white transform transition-transform duration-300 ease-in-out peer-checked:rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
								</svg>
							</div>
						</label>
					</div>

					<!-- Enable reCaptcha -->
					<div class="flex flex-col items-center justify-between p-6 border border-gray-300 shadow-lg rounded-xl bg-gradient-to-r from-indigo-100 via-purple-100 to-pink-100">
						<div class="max-w-md mb-4 text-center">
							<h4 class="text-xl font-bold text-gray-800">
								Enable reCaptcha
							</h4>
							<p class="text-sm text-gray-500 mt-2">
								Please disable it if you are using a custom domain; otherwise, your form won't work. We will soon allow you to add your own reCaptcha key for custom domains.
							</p>
						</div>
						<label class="relative inline-flex items-center cursor-pointer mb-4">
							<input type="checkbox" :checked="page.props.form.design.recaptcha" @change="handleChange('recaptcha', $event.target.checked)" class="sr-only peer">
							<div class="w-12 h-12 bg-gray-400 peer-checked:bg-blue-500 rounded-full border-4 border-gray-200 peer-checked:border-blue-600 flex items-center justify-center transition-all duration-300 ease-in-out">
								<svg class="w-6 h-6 text-white transform transition-transform duration-300 ease-in-out peer-checked:rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
								</svg>
							</div>
						</label>
					</div>

					<div class="flex items-center justify-between p-4 border border-gray-100 rounded-md">
						<div class="flex items-center space-x-2">
							<h4>
								Show "Powered By BuildMyForm" 
							</h4>
							<span class="text-xs py-0.5 px-2 font-normal rounded-md bg-red-600 text-white" title="Allowed in PREMIUM plan">
								PREMIUM
							</span>
						</div>
						<label class="inline-flex items-center  cursor-pointer ">
							<input type="checkbox" :checked="page.props.form.design.powered_by" @change="handleChange('powered_by', $event.target.checked)" class="sr-only peer">
							<div class="relative w-11 h-6 peer-focus:outline-none peer-focus:ring-0 peer-focus:ring-green-300 rounded-full peer bg-gray-400 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-green-500"></div>
						</label>
					</div>
				</div>
			</div>
		</div>

        <!-- Email Settings -->
        <div>
          <button @click="toggleDropdown('emailSettings')" class="flex justify-between w-full py-2 text-left">
            <span>Email Settings</span>
            <svg :class="dropdowns.emailSettings ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div v-show="dropdowns.emailSettings" class="ml-4">
            <!-- Email Settings Content Here -->
            <p>Email settings content goes here...</p>
          </div>
        </div>

        <!-- Access -->
        <div>
          <button @click="toggleDropdown('access')" class="flex justify-between w-full py-2 text-left">
            <span>Access</span>
            <svg :class="dropdowns.access ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div v-show="dropdowns.access" class="ml-4">
            <!-- Access Content Here -->
			<div class="mt-6 space-y-3">
				<div class="flex flex-col items-center justify-between p-6 border border-gray-300 shadow-lg rounded-xl bg-gradient-to-r from-indigo-100 via-purple-100 to-pink-100">
					<h4 class="text-xl font-bold text-gray-800 mb-4">
						Close Form
					</h4>
					<label class="relative inline-flex items-center cursor-pointer">
						<input type="checkbox" v-model="page.props.form.closed" @change="handleCloseForm($event.target.checked)" class="sr-only peer">
						<div class="w-12 h-12 bg-gray-400 peer-checked:bg-blue-500 rounded-full border-4 border-gray-200 peer-checked:border-blue-600 flex items-center justify-center transition-all duration-300 ease-in-out">
							<svg class="w-6 h-6 text-white transform transition-transform duration-300 ease-in-out peer-checked:rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
							</svg>
						</div>
					</label>
					<p class="mt-4 text-sm text-gray-600">Toggle Close Form</p>
				</div>

				<div class="flex flex-col items-center justify-between p-6 border border-gray-300 shadow-lg rounded-xl bg-gradient-to-r from-indigo-100 via-purple-100 to-pink-100">
					<h4 class="text-xl font-bold text-gray-800 mb-4">
						Close Form By Date
					</h4>
					<!-- Toggle Switch to Enable/Disable the Date Input -->
					<label class="relative inline-flex items-center cursor-pointer mb-4">
						<input type="checkbox" v-model="showCloseBy" @change="handlecloseby($event.target.checked)" class="sr-only peer">
						<div class="w-12 h-12 bg-gray-400 peer-checked:bg-blue-500 rounded-full border-4 border-gray-200 peer-checked:border-blue-600 flex items-center justify-center transition-all duration-300 ease-in-out">
							<svg class="w-6 h-6 text-white transform transition-transform duration-300 ease-in-out peer-checked:rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
							</svg>
						</div>
					</label>
					<p class="text-sm text-gray-600" v-if="!page.props.form.close_by">Click to enable date input</p>

					<!-- Date Input -->
					<input type="date" v-model="page.props.form.close_by" @change="checkCloseDate" 
						:disabled="!showCloseBy"
						class="mt-4 p-2 border border-gray-300 rounded-md text-gray-700 focus:outline-none focus:border-blue-500"
					>
				</div>


				<div class="flex flex-col items-center justify-between p-6 border border-gray-300 shadow-lg rounded-xl bg-gradient-to-r from-indigo-100 via-purple-100 to-pink-100">
					<h4 class="text-xl font-bold text-gray-800 mb-4">
						Close Form By Submissions
					</h4>
					<!-- Toggle Switch to Enable/Disable the Submissions Input -->
					<label class="relative inline-flex items-center cursor-pointer mb-4">
						<input type="checkbox" v-model="showCloseBySubmissions" @change="handleCloseBySubmissions($event.target.checked)" class="sr-only peer">
						<div class="w-12 h-12 bg-gray-400 peer-checked:bg-blue-500 rounded-full border-4 border-gray-200 peer-checked:border-blue-600 flex items-center justify-center transition-all duration-300 ease-in-out">
							<svg class="w-6 h-6 text-white transform transition-transform duration-300 ease-in-out peer-checked:rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
							</svg>
						</div>
					</label>
					<p class="text-sm text-gray-600" v-if="!page.props.form.close_by_submissions">Click to enable submission limit input</p>

					<!-- Number Input for Submissions -->
					<input type="number" v-model="page.props.form.close_by_submissions" @blur="handleSubmissionsClose"
					    @keyup.enter="handleSubmissionsClose" 
						:disabled="!showCloseBySubmissions"
						class="mt-4 p-2 border border-gray-300 rounded-md text-gray-700 focus:outline-none focus:border-blue-500"
						placeholder="Enter submission limit"
					>
				</div>
			</div>
		</div>
	</div>

        <!-- Hidden Fields -->
        <div>
			<button @click="toggleDropdown('hiddenFields')" class="flex justify-between w-full py-2 text-left">
				<span>Hidden Fields</span>
				<svg :class="dropdowns.hiddenFields ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
				</svg>
			</button>
			<div v-show="dropdowns.hiddenFields" class="ml-4">
				<HiddenFields />
			</div>
        </div>

        <!-- Link Settings -->
        <div>
			<button @click="toggleDropdown('linkSettings')" class="flex justify-between w-full py-2 text-left">
				<span>Link Settings</span>
				<svg :class="dropdowns.linkSettings ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
				</svg>
			</button>
			<div v-show="dropdowns.linkSettings" class="ml-4">
				<p>Link settings content goes here...</p>
			</div>
        </div>

      </div>
    </div>
  </div>
</template>
<script setup>
import { usePage } from '@inertiajs/vue3';
import { ref, reactive } from 'vue';
import HiddenFields from './HiddenFields.vue';

const page = usePage();

const dropdowns = reactive({
    general: false,
    emailSettings: false,
    access: false,
    hiddenFields: false,
    linkSettings: false,
});

const toggleDropdown = (dropdown) => {
    dropdowns[dropdown] = !dropdowns[dropdown];
};

const showClosed = ref(page.props.form.closed !== null ? true : false);
const showCloseBy = ref(page.props.form.close_by !== null ? true : false);
const showCloseBySubmissions = ref(page.props.form.close_by_submissions !== null ? true : false);

async function handleChange(item, value) {
	const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	const response = await fetch(`/design/settings/${page.props.form.design.id}`, {
		method: 'PUT',
		headers: {
			'Content-type': 'application/json',
			'X-CSRF-TOKEN': csrfToken
		},
		body: JSON.stringify({
			'input': item,
			'value': value
		})
	});

	if (!response.ok) {
		throw new Error('Network response was not ok');
	}
}

async function handleCloseForm(value){
	const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	const response = await fetch(`/form/close/${page.props.form.id}`, {
		method: 'PUT',
		headers: {
			'Content-type': 'application/json',
			'X-CSRF-TOKEN': csrfToken
		},
		body: JSON.stringify({
			closed: value
		})
	});

	if (!response.ok) {
		throw new Error('Network response was not ok');
	}
}

async function handlecloseby(value){
	if(value==false){
		const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
		const response = await fetch(`/form/close_by/${page.props.form.id}`, {
			method: 'PUT',
			headers: {
				'Content-type': 'application/json',
				'X-CSRF-TOKEN': csrfToken
			},
			body: JSON.stringify({
				close_by: null
			})
		});

		if (!response.ok) {
			throw new Error('Network response was not ok');
		}
	}
}

async function handleCloseBySubmissions(value){
	if(value==false){
		const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
		const response = await fetch(`/form/close_by/${page.props.form.id}`, {
			method: 'PUT',
			headers: {
				'Content-type': 'application/json',
				'X-CSRF-TOKEN': csrfToken
			},
			body: JSON.stringify({
				close_by: page.props.form.close_by
			})
		});

		if (!response.ok) {
			throw new Error('Network response was not ok');
		}
	}
}
async function checkCloseDate(){
	const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	const response = await fetch(`/form/close_by/${page.props.form.id}`, {
		method: 'PUT',
		headers: {
			'Content-type': 'application/json',
			'X-CSRF-TOKEN': csrfToken
		},
		body: JSON.stringify({
			close_by: page.props.form.close_by
		})
	});

	if (!response.ok) {
		throw new Error('Network response was not ok');
	}
}

async function handleSubmissionsClose(){
	const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	const response = await fetch(`/form/close_by_submission/${page.props.form.id}`, {
		method: 'PUT',
		headers: {
			'Content-type': 'application/json',
			'X-CSRF-TOKEN': csrfToken
		},
		body: JSON.stringify({
			close_by_submission: page.props.form.close_by_submissions
		})
	});

	if (!response.ok) {
		throw new Error('Network response was not ok');
	}
}

</script>