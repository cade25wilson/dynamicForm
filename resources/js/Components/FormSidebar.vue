<template>
    {{currentSection}}
              <div class="flex items-center justify-between px-2 mt-1">
            <div class="flex items-center">
              <h4 class="text-xs text-gray-500">Blocks</h4>
            </div>
            <button class="text-gray-500 cursor-pointer hover:text-gray-600" @click="handleClick">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
              </svg>
            </button>
          </div>
    <div>
        <div v-for="formSection in nonThankYouSections" :key="formSection.id" class="group">
            <a 
        @click="changeSection(formSection.id)"
        :class="[
          'px-2 h-10 relative flex items-center justify-between text-xs py-2 m-2 rounded-md bg-pink-300',
          {
            'border border-dashed border-blue-600': currentSection === formSection.id
          }
        ]"
      >
        <span class="p-1 -pl-1">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z">
                </path>
            </svg>
        </span>
        <div class="flex-1 truncate ml-1">
            {{ formSection.order }}. {{ formSection.name }}
        </div>
        <div class="relative hidden group-hover:inline-block">
            <button class="p-0.5 hover:bg-gray-200 rounded-md" @click.stop="toggleMenu(formSection.id)">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z">
                    </path>
                </svg>
            </button>
            <div v-if="showMenu[formSection.id]"
                 class="absolute w-40 z-50 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                 role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1"
                 style="right:-5px">
                <div class="py-1" role="none">
                    <button type="button"
                            class="text-gray-700 flex items-center justify-between hover:bg-gray-50 w-full text-left px-4 py-2 text-sm"
                            role="menuitem"
                            @click.stop="Duplicate(formSection.id)">
                        <span>Duplicate</span>
                        <span class="text-xs text-gray-400">
                            <span>Ctrl</span> Shift D
                        </span>
                    </button>
                    <button type="button"
                            class="text-red-700 hover:bg-gray-50 block w-full text-left px-4 py-2 text-sm"
                            role="menuitem"
                            @click.stop="Delete(formSection.id)">Delete</button>
                </div>
            </div>
        </div>
    </a>
</div>


        <div v-for="formSection in thankYouSections" :key="formSection.id" class="mt-10 pt-6">
            <div class="flex items-center justify-between px-2">
                <div class="flex items-center">
                    <h4 class="text-xs text-gray-500">Thank you page</h4>
                </div>
                <button class="text-gray-500 cursor-pointer hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                    </svg>
                </button>
            </div>
            <!-- <a href="#"
                class="group px-2 h-10 relative flex items-center justify-between text-xs py-2 m-2 rounded-md bg-pink-300"> -->
                <a
        @click="changeSection(formSection.id)"
        :class="[
          'px-2 h-10 relative flex items-center justify-between text-xs py-2 m-2 rounded-md bg-pink-300',
          {
            'border border-dashed border-blue-600': currentSection === formSection.id
          }
        ]"
      >
                <div class="flex-1 truncate ml-1">{{ formSection.name }}</div>
                <div class="relative hidden group-hover:inline-block">
                    <button class="p-0.5 hover:bg-gray-200 rounded-md" @click="toggleMenu(formSection.id)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z">
                            </path>
                        </svg>
                    </button>
                    <div v-if="showMenu[formSection.id]"
                        class="absolute w-40 z-50 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1"
                        style="right:-5px">
                        <div class="py-1" role="none">
                            <button type="button"
                                class="text-gray-700 flex items-center justify-between hover:bg-gray-50 w-full text-left px-4 py-2 text-sm"
                                role="menuitem"
                                @click="Duplicate(formSection.id)">
                                <span>Duplicate</span>
                                <span class="text-xs text-gray-400">
                                    <span>Ctrl</span> Shift D
                                </span>
                            </button>
                            <button type="button"
                                class="text-red-700 hover:bg-gray-50 block w-full text-left px-4 py-2 text-sm"
                                role="menuitem"
                                @click="Delete(formSection.id)">
                                Delete
                            </button>
                        </div>
                    </div>

                </div>
            </a>
        </div>
    </div>
</template>


<script setup>
import { computed, reactive, defineEmits, ref } from 'vue';
import { router, usePage } from '@inertiajs/vue3';

const props = defineProps({
    formSections: {
        type: Array,
        required: true,
    },
    formID: {
        type: String,
        required: true
    },
});

const showMenu = reactive({});
const showNewSectionModal = ref(false);

const currentSection = computed(() => {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('section') || null;
});

const nonThankYouSections = computed(() => 
    props.formSections
        .filter((section) => section.section_type_id !== 2)
        .sort((a, b) => a.order - b.order)
);

const thankYouSections = computed(() => 
    props.formSections
        .filter((section) => section.section_type_id === 2)
        .sort((a, b) => a.order - b.order)
);

const emit = defineEmits(['open-modal']);

function handleClick() {
  emit('open-modal');
}

function toggleMenu(id) {
    showMenu[id] = !showMenu[id];
}

function Duplicate(id){
    const page = usePage();
    router.post(`/section/${id}`, {
        _token: page.props.csrf_token,
    });
}

function Delete(id){
    const page = usePage();
    router.delete(`/section/${id}`, {
        _token: page.props.csrf_token,
    });
}

function changeSection(id){
    const page = usePage();
    router.get(`/form/${props.formID}?section=${id}`, {
        _token: page.props.csrf_token,
    })
    .then(() => {
        window.history.pushState(null, '', `/form/${props.formID}?section=${id}`);
    });
}
</script>

<style scoped>
a:hover{
    cursor: pointer;
}
</style>