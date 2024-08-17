<template>
    <div class="h-screen col-span-7 relative">
        <div class="z-100" aria-modal="true" style="display: none;">
            <div class="absolute z-10 inset-0 bg-gray-500 bg-opacity-75 transition-opacity" style="display: none;"></div>
            <div class="absolute inset-x-0 top-6 z-20 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:w-full sm:max-w-4xl mx-4" style="height: 42rem; display: none;">
                        <div class="bg-white px-4 pt-5 pb-4 sm:px-14 sm:py-16">
                            <button tabindex="-1" class="absolute top-4 right-4 block p-4 hover:text-gray-500 ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                            <div class="w-full">
                    
                                <div class="text-center sm:mt-0 sm:text-left">
                                    <h3 class="text-xl font-medium leading-6 text-gray-900">
                                        Choose your block
                                    </h3>
                                    <div class="mt-6 space-y-4">
                                        <div class="grid grid-cols-12 gap-8 text-sm">
                                            <div class="col-span-4 relative overflow-y-scroll pb-6" style="height: 33rem;">
                                                <div class="sticky top-0">
                                                    <div class="mb-6">
                                                        <div class="mt-1 px-1">
                                                            <input type="search" x-model="search" class="block w-full rounded-full border-gray-300 px-4 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm" placeholder="Search blocks...">
                                                        </div>
                                                    </div>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>