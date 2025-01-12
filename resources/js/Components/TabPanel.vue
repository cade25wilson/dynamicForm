<template #default="{ activeTab, setActiveTab }">
   <div class="grid grid-cols-4 border-b">
        <button v-for="(tab, index) in tabs" :key="index"
            :class="{ 'border-indigo-500 text-indigo-600': activeTab === tab.name }" 
            @click="setActiveTab(tab.name)"
            class="px-4 py-2 text-sm font-medium text-gray-500 border-b-2 col-span-1">
            {{ tab.name }}
        </button>
        <div class="col-span-1"></div> 
    </div>


    <div v-if="activeTab === 'Content'" class="p-4 bg-white">
        <ContentTab :current_section="current_section" :design="design"/>
    </div>
    <div v-if="activeTab === 'Design'">
        <div class="shadow-md bg-white h-screen overflow-y-auto py-4 px-6 pb-32">
            <div>
                <div>
                    <div>
                        <h4 class="text-xl font-semibold mb-1">
                            Design
                        </h4>

                        <div class="mt-4 flex items-center justify-between">
                            <label class="block text-sm font-medium text-gray-700 pr-1">Background</label>
                            <div class="mt-1">
                                <div class="clr-field" :style="{ color: design.background }"><button type="button"
                                        aria-labelledby="clr-open-label"></button><input v-model="design.background"
                                        id="background-color-selector" data-model="background" type="text"
                                        class="block max-w-32 rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <label class="block text-sm font-medium text-gray-700 pr-1">Questions</label>
                            <div class="mt-1">
                                <div class="clr-field" :style="{ color: design.questions }"><button type="button"
                                        aria-labelledby="clr-open-label"></button><input v-model="design.questions"
                                        data-model="questions" id="text-color-selector" type="text"
                                        class="block max-w-32 rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <label class="block text-sm font-medium text-gray-700 pr-1">Answers</label>
                            <div class="mt-1">
                                <div class="clr-field" :style="{ color: design.answers }"><button type="button"
                                        aria-labelledby="clr-open-label"></button><input v-model="design.answers"
                                        data-model="answers" id="answer-text-color-selector" type="text"
                                        class="block max-w-32 rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <label class="block text-sm font-medium text-gray-700 pr-1">Buttons</label>
                            <div class="mt-1">
                                <div class="clr-field" :style="{ color: design.buttons }"><button type="button"
                                        aria-labelledby="clr-open-label"></button><input v-model="design.buttons"
                                        data-model="buttons" id="button-background-color-selector" type="text"
                                        class="block max-w-32 rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <label class="block text-sm font-medium text-gray-700 pr-1">Button Text</label>
                            <div class="mt-1">
                                <div class="clr-field" :style="{ color: design.button_text }"><button type="button"
                                        aria-labelledby="clr-open-label"></button><input v-model="design.button_text"
                                        data-model="button_text" id="button-text-color-selector" type="text"
                                        class="block max-w-32 rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <label class="block text-sm font-medium text-gray-700 pr-1">Star Rating</label>
                            <div class="mt-1">
                                <div class="clr-field" :style="{ color: design.star_rating }"><button type="button"
                                        aria-labelledby="clr-open-label"></button><input v-model="design.star_rating"
                                        data-model="star_rating" id="rating-color-selector" type="text"
                                        class="block max-w-32 rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <p class="text-xs text-gray-500">
                                Note: Any changes made in the Design tab will be saved &amp; published automatically.
                            </p>
                        </div>
                       
                        <div class="mt-6" ref="dropdown">
                            <div>
                                <label for="font-selector" class="block relative text-sm font-medium text-gray-700">Font</label>
                                <button @click="toggleDropdown" type="button"
                                    class="relative w-full cursor-default rounded-md mt-1 py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-gray-600 sm:text-sm sm:leading-6 bg-transparent">
                                    <span class="block truncate">{{ selectedFont }}</span>
                                    <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                        <svg class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                </button>

                                <input type="text" v-if="opened" @keydown.enter.window="handleEnter" @keydown.esc.window="handleEscape"
                                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm"
                                    @input="handleSearch" placeholder="Search fonts...">

                                <ul v-if="opened" class="fixed inset-auto min-w-72 max-h-80 text-sm scroll-smooth z-10 mt-1 overflow-y-auto rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <li v-for="font in fonts" :key="font" @click="selectFont(font)"
                                        :style="{ fontFamily: font }"
                                        class="relative border hover:bg-gray-100 cursor-pointer select-none mx-10 md:mx-auto py-2 pl-3 pr-9 border-gray-300">
                                        <span :class="selectedFont === font ? 'font-semibold' : 'font-normal'" class="block truncate">{{ font }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="mt-6 pt-6">
                            <div class="flex items-center justify-between">
                                <p class="block text-sm font-medium text-gray-700">
                                    Background Image
                                </p>
                            </div>

                            <!-- Box container for the image -->
                            <div class="relative border border-gray-200 rounded-md p-6 hover:bg-gray-50 flex items-center justify-center">
                                <!-- If no image -->
                                <template v-if="!page.props.form.design.background_image">
                                    <label class="cursor-pointer">
                                        <span class="text-sm text-gray-500">Select Image</span>
                                        <input 
                                            type="file" 
                                            accept="image/png, image/jpeg" 
                                            class="hidden" 
                                            @change="updateSectionBackground">
                                    </label>
                                </template>

                                <!-- If image exists -->
                                <template v-else>
                                    <img 
                                        :src="page.props.form.design.background_image" 
                                        alt="Background Image" 
                                        class="h-32 w-auto object-contain">

                                    <!-- Delete Button in Top-Right Corner of the Box -->
                                    <button
                                        type="button"
                                        @click="deleteSectionBackground"
                                        class="absolute top-0 right-0 bg-white rounded-full p-1 shadow hover:bg-gray-100"
                                        aria-label="Delete Background Image"
                                        style="transform: translate(-10%, 20%);"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>

                                    <!-- Hidden input for changing the image -->
                                    <input 
                                        type="file" 
                                        accept="image/png, image/jpeg" 
                                        class="hidden" 
                                        @change="updateSectionBackground">
                                </template>
                            </div>
                        </div>


                        <div class="mt-6 border-t border-gray-200 pt-6">
                            <div class="flex items-center justify-between">
                                <p class="block text-sm font-medium text-gray-700">
                                    Logo
                                </p>

                                <button @click.prevent="$dispatch('open-pro-plan-modal')"
                                    class="text-xs py-0.5 px-2 font-normal rounded-md bg-red-600 text-white cursor-pointer"
                                    title="Allowed in PREMIUM plan">
                                    PREMIUM
                                </button>
                            </div>

                            <label @click.prevent="$dispatch('open-pro-plan-modal')"
                                class="flex items-center mt-2 justify-center border border-gray-200 rounded-md p-6 hover:bg-gray-50 cursor-pointer">
                                <span class="text-sm text-gray-500">
                                    Select your logo
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <SettingsTab v-if="activeTab === 'Settings'" />
    <LogicTab v-if="activeTab === 'Logic'" />

</template>

<script setup>
import { ref, onMounted, watch, nextTick, onBeforeUnmount } from 'vue';
import ContentTab from '@/Components/ContentTab.vue';
import "@melloware/coloris/dist/coloris.css";
import Coloris from "@melloware/coloris";
import { usePage, router } from '@inertiajs/vue3';
import SettingsTab from './SettingsTab.vue';
import LogicTab from './LogicTab.vue';

const page = usePage();
const dropdown = ref(null);

Coloris.init();

const props = defineProps({
    design: Object,
    current_section: Object,
});

// Define tabs for the interface
const tabs = ref([
    { name: 'Content' },
    { name: 'Design' },
    { name: 'Settings' },
    { name: 'Logic'}
]);

// Manage the active tab state
const activeTab = ref(tabs.value[0].name);

// Original list of fonts
const originalFonts = [
    'Arial', 'Verdana', 'Helvetica', 'Tahoma', 'Trebuchet MS', 'Times New Roman',
    'Georgia', 'Garamond', 'Courier New', 'Brush Script MT', 'Roboto', 'Open Sans',
    'Lato', 'Montserrat', 'Oswald', 'Raleway', 'PT Sans', 'Source Sans Pro',
    'Merriweather', 'Playfair Display', 'Noto Sans', 'Ubuntu', 'Fira Sans',
    'Droid Sans', 'Poppins', 'Exo', 'Quicksand', 'Comfortaa',
    'Pacifico', 'Anton', 'Bebas Neue', 'Archivo', 'Arimo', 'Dancing Script',
    'Muli', 'Nunito', 'Varela Round', 'Zilla Slab', 'Karla', 'Signika',
    'Titillium Web', 'Lora', 'Overpass', 'Bitter', 'Cabin', 'Amiri',
    'Droid Serif', 'Alegreya', 'Kalam', 'Sarabun'
];

// List of fonts for the dropdown
const fonts = ref([...originalFonts]);

// State for the selected font
const selectedFont = ref(props.design.font || fonts.value[0]);

// State to control the font dropdown visibility
const opened = ref(false);

// Function to set the active tab
function setActiveTab(tabName) {
    activeTab.value = tabName;
}

async function handleColorPickerClose() {
    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const response = await fetch(`/design/${page.props.form.design.id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                _token: page.props.csrf_token,
                background: props.design.background,
                questions: props.design.questions,
                answers: props.design.answers,
                buttons: props.design.buttons,
                button_text: props.design.button_text,
                star_rating: props.design.star_rating,
                font: selectedFont.value,
                background_image: props.design.background_image,
                logo: props.design.logo,
                form_id: props.design.form_id
            })
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();
        console.log('Success:', data);

    } catch (error) {
        console.error('Error:', error);
    }
}


// Function to initialize Coloris color pickers
function initializeColorPickers() {
    const colorPickers = [
        '#background-color-selector',
        '#text-color-selector',
        '#answer-text-color-selector',
        '#button-background-color-selector',
        '#button-text-color-selector',
        '#rating-color-selector'
    ];

    colorPickers.forEach(selector => {
        const inputElement = document.querySelector(selector);

        if (inputElement) {
            Coloris({
                el: selector,
                theme: 'large',
            });

            inputElement.addEventListener('change', () => handleColorPickerClose());
        }
    });
}

// Watch for changes in the active tab and initialize color pickers when 'Design' tab is active
watch(activeTab, (newTab) => {
    if (newTab === 'Design') {
        nextTick(() => {
            initializeColorPickers();
        });
    }
});

// Function to select a font
function selectFont(font) {
    selectedFont.value = font;
    opened.value = false;
    handleColorPickerClose();
    router.reload();
}

// Function to filter fonts based on search input
function handleSearch(event) {
    const searchTerm = event.target.value.toLowerCase();
    if (searchTerm) {
        fonts.value = originalFonts.filter(font => font.toLowerCase().includes(searchTerm));
    } else {
        fonts.value = [...originalFonts];
    }
}

// Function to handle Enter key press in the font search input
function handleEnter(event) {
    if (fonts.value.length > 0) {
        selectFont(fonts.value[0]);
    }
}
function toggleDropdown() {
  opened.value = !opened.value;
}
 
// Function to handle Escape key press to close the font dropdown
function handleEscape() {
    opened.value = false;
}
function handleClickOutside(event) {
  if (dropdown.value && !dropdown.value.contains(event.target)) {
    opened.value = false;
  }
}

async function deleteSectionBackground() {
    try{
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const response = await fetch(`/design/background/remove/${page.props.form.id}`, {
            method: 'PUT',
            headers:{
                'X-CSRF-TOKEN': csrfToken
            },
        });

        if (response.ok) {
            page.props.form.design.background_image = null;
        } else {
            console.error('Failed to upload the image');
        }
    } catch (error) {
        console.error('Error uploading the background image');
    }
}

async function updateSectionBackground(event) {
    const file = event.target.files[0];
    if (file) {
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const formData = new FormData();
            formData.append('background_image', file);
            formData.append('_token', csrfToken);

            const response = await fetch(`/design/background/${page.props.form.id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData,
            });

            if (response.ok) {
                const data = await response.json();
                page.props.form.design.background_image = data.background_image;
            } else {
                console.error('Failed to upload the image');
            }
        } catch (error) {
            console.error('Error uploading the background image:');
        }
    }
}

// Initialize color pickers on component mount
onMounted(() => {
    nextTick(() => {
        initializeColorPickers();
    });
    document.addEventListener('click', handleClickOutside);
});
onBeforeUnmount(() => {
  document.removeEventListener('click', handleClickOutside);
});
</script>


<style scoped>
ul {
    position: absolute; /* Change from fixed to absolute */
    z-index: 10; /* Ensure it stays on top of other elements */
    /* max-height: 20vh;  */
    overflow-y: auto; /* Enable scrolling if the list is too long */
}
</style>
