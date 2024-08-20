<template #default="{ activeTab, setActiveTab }">
    <div class="flex justify-between border-b">
        <button v-for="(tab, index) in tabs" :key="index"
            :class="{ 'border-indigo-500 text-indigo-600': activeTab === tab.name }" @click="setActiveTab(tab.name)"
            class="px-4 py-2 text-sm font-medium text-gray-500 border-b-2">
            {{ tab.name }}
        </button>
    </div>

    <div v-if="activeTab === 'Content'" class="p-4">
        <!-- Content for Content tab goes here -->
    </div>
    <div v-if="activeTab === 'Design'">
        <!-- <p class="text-white">{{design}}</p> -->
        <div class="shadow-md bg-white h-screen overflow-y-auto py-4 px-6 pb-32">
            <div>
                <div>
                    <div>
                        <h4 class="text-xl font-semibold mb-1">
                            Design
                        </h4>
                        <p class="text-sm text-gray-500 mb-8">
                            Use light or dark theme or make Youform your own by adding your brand color and logo.
                        </p>

                        <div>
                            <div class="grid grid-cols-3 gap-2">
                                <button @click="saveTheme('light')"
                                    class="col-span-1 p-2 rounded-md bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-auto" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                                        </path>
                                    </svg>
                                    <span class="text-xs text-center">
                                        Light
                                    </span>
                                </button>
                                <button @click="saveTheme('dark')"
                                    class="col-span-1 p-2 rounded-md bg-gray-700 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-auto" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                                        </path>
                                    </svg>
                                    <span class="text-xs text-center">
                                        Dark
                                    </span>
                                </button>
                                <button @click="saveTheme('custom')"
                                    class="col-span-1 p-2 rounded-md bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-gray-500 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-auto" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5">
                                        </path>
                                    </svg>
                                    <span class="text-xs text-center">
                                        Custom
                                    </span>
                                </button>
                            </div>
                        </div>

                        <!-- <div class="mt-4 flex items-center justify-between">
                            <label class="block text-sm font-medium text-gray-700 pr-1">Background</label>
                            <div class="mt-1" >
                                <div class="clr-field" style="color: rgb(255, 255, 255);"><button type="button"
                                        aria-labelledby="clr-open-label"></button><input v-model="design.background" id="background-color-selector" type="text"
                                        class="block max-w-32 rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
                                </div>
                            </div>
                        </div> -->

                        <div class="mt-4 flex items-center justify-between">
                <label class="block text-sm font-medium text-gray-700 pr-1">Background</label>
                <div class="mt-1">
                    <input v-model="design.background" id="background-color-selector" type="text"
                        class="block max-w-32 rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
                </div>
            </div>

                        <div class="mt-4 flex items-center justify-between">
                            <label class="block text-sm font-medium text-gray-700 pr-1">Questions</label>
                            <div class="mt-1" >
                                <div class="clr-field" style="color: rgb(0, 0, 0);"><button type="button"
                                        aria-labelledby="clr-open-label"></button><input v-model="design.questions" id="text-color-selector" type="text"
                                        class="block max-w-32 rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <label class="block text-sm font-medium text-gray-700 pr-1">Answers</label>
                            <div class="mt-1" >
                                <div class="clr-field" style="color: rgb(0, 0, 0);"><button type="button"
                                        aria-labelledby="clr-open-label"></button><input v-model="design.answers" id="answer-text-color-selector" type="text"
                                        class="block max-w-32 rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <label class="block text-sm font-medium text-gray-700 pr-1">Buttons</label>
                            <div class="mt-1" >
                                <div class="clr-field" style="color: rgb(41, 41, 41);"><button type="button"
                                        aria-labelledby="clr-open-label"></button><input v-model="design.buttons" id="button-background-color-selector" type="text"
                                        class="block max-w-32 rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <label class="block text-sm font-medium text-gray-700 pr-1">Button Text</label>
                            <div class="mt-1" >
                                <div class="clr-field" style="color: rgb(255, 255, 255);"><button type="button"
                                        aria-labelledby="clr-open-label"></button><input v-model="design.button_text" id="button-text-color-selector" type="text"
                                        class="block max-w-32 rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <label class="block text-sm font-medium text-gray-700 pr-1">Star Rating</label>
                            <div class="mt-1" >
                                <div class="clr-field" style="color: rgb(196, 196, 196);"><button type="button"
                                        aria-labelledby="clr-open-label"></button><input v-model="design.star_rating" id="rating-color-selector" type="text"
                                        class="block max-w-32 rounded-md border-gray-300 text-gray-800 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <p class="text-xs text-gray-500">
                                Note: Any changes made in the Design tab will be saved &amp; published automatically.
                            </p>
                        </div>

                        <div class="mt-6">

                            <div @click.away="opened = false">
                                <label for="font-selector"
                                    class="block relative text-sm font-medium text-gray-700">Font</label>
                                <button  @click="opened = !opened" type="button"
                                    class="relative w-full cursor-default rounded-md mt-1 py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-gray-600 sm:text-sm sm:leading-6 bg-transparent">
                                    <span class="block truncate" x-text="selectedFont">Inter</span>
                                    <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                        <svg class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                </button>
                                <input type="text"
                                    @keydown.enter.window="handleEnter" @keydown.esc.window="handleEscape"
                                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm"
                                    @input="handleSearch" placeholder="Search fonts..." style="display: none;">
                                <ul class="absolute inset-auto min-w-72 h-auto max-h-80 text-sm scroll-smooth z-10 mt-1 overflow-auto rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    style="left: 910.5px; top: 751px; position: absolute; display: none;">

                                    <template >
                                        <li class="relative border hover:bg-gray-100 [&amp;:nth-child(2)]:rounded-t-md last:rounded-b-md cursor-pointer select-none mx-10 md:mx-auto py-2 pl-3 pr-9 border-gray-300">
                                            <span :class="selectedFont == value ? 'font-semibold' : 'font-normal'"
                                                class="block truncate" x-text="font"></span>
                                        </li>
                                    </template>
                                    <li class="relative border hover:bg-gray-100 [&amp;:nth-child(2)]:rounded-t-md last:rounded-b-md cursor-pointer select-none mx-10 md:mx-auto py-2 pl-3 pr-9 border-gray-300"
                                        data-has-alpine-state="true">
                                        <span :class="selectedFont == value ? 'font-semibold' : 'font-normal'"
                                            class="block truncate font-normal">Roboto</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="mt-6 border-t border-gray-200 pt-6">
                            <div class="flex items-center justify-between">
                                <p class="flex items-center text-sm font-medium text-gray-700">
                                    <span class="pr-1">Background Image </span>
                                    <svg class="animate-spin h-5 w-5 text-black"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </p>

                            </div>

                            <label
                                class="flex items-center mt-2 justify-center border border-gray-200 rounded-md p-6 hover:bg-gray-50 cursor-pointer">
                                <span class="text-sm text-gray-500">
                                    Select image
                                </span>

                                <input type="file" accept="image/*" class="text-xs hidden" >
                            </label>


                        </div>

                        <div class="mt-6 border-t border-gray-200 pt-6">
                            <div class="flex items-center justify-between">
                                <p class="block text-sm font-medium text-gray-700">
                                    Logo
                                </p>

                                <button @click.prevent="$dispatch('open-pro-plan-modal')"
                                    class="text-xs py-0.5 px-2 font-normal rounded-md bg-pink-600 text-white cursor-pointer"
                                    title="Allowed in PRO plan">
                                    PRO
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
    <div v-if="activeTab === 'Logic'" class="p-4">
        <!-- Content for Logic tab goes here -->
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import "@melloware/coloris/dist/coloris.css";
import Coloris from "@melloware/coloris";
Coloris.init();

const props = defineProps({
    design: Object,
});

// Define the tabs
const tabs = ref([
    { name: 'Content' },
    { name: 'Design' },
    { name: 'Logic' },
]);

// Manage the active tab
const activeTab = ref(tabs.value[0].name);

// Function to set the active tab
function setActiveTab(tabName) {
    activeTab.value = tabName;
}

// Initialize Coloris after the component is mounted
onMounted(() => {
    Coloris({
        el: '#background-color-selector',
        theme: 'large',
    });
    Coloris({
        el: '#text-color-selector',
        theme: 'large',
    });
    Coloris({
        el: '#answer-text-color-selector',
        theme: 'large',
    });
    Coloris({
        el: '#button-background-color-selector',
        theme: 'large',
    });
    Coloris({
        el: '#button-text-color-selector',
        theme: 'large',
    });
    Coloris({
        el: '#rating-color-selector',
        theme: 'large',
    });
});
</script>