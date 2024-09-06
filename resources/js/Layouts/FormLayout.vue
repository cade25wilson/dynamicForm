<template>
    <div>
        <Head :title="title" />

        <Banner />

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <nav class="grid grid-cols-12 py-2 px-4 text-gray-700 bg-white border-b border-slate-200 dark:bg-gray-900">
                <div @form-first-published.window="handleOpen()" class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50" style="display: none;" data-has-alpine-state="true">
                    <div @open-qr-code-modal.window="handleOpen()" @keyup.escape.window="handleClose()" class="z-100 px-10" aria-modal="true" style="display: none;" data-has-alpine-state="true">
                        <div x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed z-20 inset-0 bg-gray-500 bg-opacity-75 transition-opacity" style="display: none;"></div>
                        <div class="fixed inset-0 z-30 overflow-y-auto">
                            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                <div x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-5 sm:w-full sm:max-w-lg mx-4" style="display: none;">
                                    <div class="bg-white px-4 pt-5 pb-4 sm:px-14 sm:py-16">
                                        <a href="#" @click.prevent="handleClose()" class="absolute -top-3 -right-3 md:top-4 md:right-4 block p-4 ">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>              
                                        </a>
                                        <div class="w-full">
                                            <div class="text-center">
                                                <h4>
                                                    Scan or download the QR code
                                                </h4>
                                            </div>
                                            <div class="mt-10 max-w-md mx-auto text-gray-700">
                                                <div class="qr-code flex items-center justify-center">
                                                    <canvas width="200" height="200" style="display: none;"></canvas><img style="display: block;" src="data:image/png;base64,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"></div>
                                                    <div class="flex items-center justify-center mt-10">
                                                        <a x-show="qrcodeLink" :href="qrcodeLink" download="My Form.png" class="bg-gray-300 transition-all hover:bg-gray-200 text-black px-4 py-2 text-sm rounded-md shadow-sm flex items-center space-x-1" href="data:image/png;base64,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" style="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"></path>
                                                            </svg>                                  
                                                            <span>Download</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mx-auto w-full max-w-2xl rounded-lg bg-studio-50 px-20 pt-10 pb-16 relative group transition-all">
                            <button @click="open = false" class="absolute top-0 -right-10 bg-white p-2 rounded-full text-gray-600 hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                            <div class="mb-3 text-center">
                                <h2 class="text-2xl font-bold">Your masterpiece is now live 🚀</h2>
                                <p class="text-gray-600 pt-10 text-sm">Share it with the world:</p>
                            </div>
                            <div class="max-w-md mx-auto">
                                <div class="flex items-center mt-2 justify-center" data-has-alpine-state="true">
                                    <input type="text" readonly="" class="block w-80 rounded-md rounded-r-none border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                                    <button @click="copyPageUrl()" class="flex items-center rounded-md rounded-l-none border border-transparent bg-coral px-4 py-1.5 text-sm font-medium text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">                                  
                                        Copy
                                    </button>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center justify-center space-x-3"  data-has-alpine-state="true">
                                <a target="_blank" class="inline-block p-1" x-tooltip.raw="Open form in new tab">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 30 30" class="w-7 h-7">
                                        <path d="M 25.980469 2.9902344 A 1.0001 1.0001 0 0 0 25.869141 3 L 20 3 A 1.0001 1.0001 0 1 0 20 5 L 23.585938 5 L 13.292969 15.292969 A 1.0001 1.0001 0 1 0 14.707031 16.707031 L 25 6.4140625 L 25 10 A 1.0001 1.0001 0 1 0 27 10 L 27 4.1269531 A 1.0001 1.0001 0 0 0 25.980469 2.9902344 z M 6 7 C 4.9069372 7 4 7.9069372 4 9 L 4 24 C 4 25.093063 4.9069372 26 6 26 L 21 26 C 22.093063 26 23 25.093063 23 24 L 23 14 L 23 11.421875 L 21 13.421875 L 21 16 L 21 24 L 6 24 L 6 9 L 14 9 L 16 9 L 16.578125 9 L 18.578125 7 L 16 7 L 14 7 L 6 7 z"></path>
                                    </svg>
                                </a>
                                <a  target="_blank" class="inline-block p-1" x-tooltip.raw="Share on Facebook">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 30 30" class="w-7 h-7">
                                        <path d="M15,3C8.373,3,3,8.373,3,15c0,6.016,4.432,10.984,10.206,11.852V18.18h-2.969v-3.154h2.969v-2.099c0-3.475,1.693-5,4.581-5 c1.383,0,2.115,0.103,2.461,0.149v2.753h-1.97c-1.226,0-1.654,1.163-1.654,2.473v1.724h3.593L19.73,18.18h-3.106v8.697 C22.481,26.083,27,21.075,27,15C27,8.373,21.627,3,15,3z"></path>
                                    </svg>
                                </a>
                                <a  target="_blank" class="inline-block p-1" x-tooltip.raw="Share on X (Twitter)">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 30 30" class="w-7 h-7">
                                    <path d="M 6 4 C 4.895 4 4 4.895 4 6 L 4 24 C 4 25.105 4.895 26 6 26 L 24 26 C 25.105 26 26 25.105 26 24 L 26 6 C 26 4.895 25.105 4 24 4 L 6 4 z M 8.6484375 9 L 13.259766 9 L 15.951172 12.847656 L 19.28125 9 L 20.732422 9 L 16.603516 13.78125 L 21.654297 21 L 17.042969 21 L 14.056641 16.730469 L 10.369141 21 L 8.8945312 21 L 13.400391 15.794922 L 8.6484375 9 z M 10.878906 10.183594 L 17.632812 19.810547 L 19.421875 19.810547 L 12.666016 10.183594 L 10.878906 10.183594 z"></path>
                                    </svg>
                                </a>
                                <a  class="inline-block p-1" target="_blank" x-tooltip.raw="Share LinkedIn">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 30 30" class="w-7- h-7">
                                    <path d="M24,4H6C4.895,4,4,4.895,4,6v18c0,1.105,0.895,2,2,2h18c1.105,0,2-0.895,2-2V6C26,4.895,25.105,4,24,4z M10.954,22h-2.95 v-9.492h2.95V22z M9.449,11.151c-0.951,0-1.72-0.771-1.72-1.72c0-0.949,0.77-1.719,1.72-1.719c0.948,0,1.719,0.771,1.719,1.719 C11.168,10.38,10.397,11.151,9.449,11.151z M22.004,22h-2.948v-4.616c0-1.101-0.02-2.517-1.533-2.517 c-1.535,0-1.771,1.199-1.771,2.437V22h-2.948v-9.492h2.83v1.297h0.04c0.394-0.746,1.356-1.533,2.791-1.533 c2.987,0,3.539,1.966,3.539,4.522V22z"></path>
                                    </svg>
                                </a>
                                <a href="#" @click.prevent="$dispatch('open-qr-code-modal')" class="inline-block p-1" x-tooltip.raw="Get QR Code">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z"></path>
                                    </svg>
                                </a>
                            </div>
                            <p class="mb-4 mt-10 text-center text-gray-600 text-sm">Or choose your next adventure:</p>
                            <div class="grid grid-cols-3 gap-4 text-xs transition-all font-semibold">
                                <a class="rounded-md bg-pale-violet p-6 hover:bg-contessa-300">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mx-auto">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25"></path>
                                        </svg>                      
                                    </div>
                                    <p class="text-center pt-2">
                                        Embed <br> in website
                                    </p>
                                </a>
                                <a class="rounded-md bg-bright-green-200 p-6 hover:bg-contessa-300">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mx-auto">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75"></path>
                                        </svg>                      
                                    </div>
                                    <p class="text-center pt-2">
                                        Setup <br> integrations
                                    </p>
                                </a>
                                <a class="rounded-md bg-vivid-yellow p-6 hover:bg-contessa-300">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mx-auto">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244"></path>
                                        </svg>                      
                                    </div>
                                    <p class="text-center pt-2">
                                        Customize <br> form link
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center col-span-4">
                        <Link href="/dashboard"  class="block p-2 text-indigo-600 transition ease-in-out delay-150 hover:-translate-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                        </Link>
                        <div class="block pl-2 border-l border-gray-200">
                            <h1 class="font-semibold text-gray-600 truncate cursor-pointer hover:border-b hover:border-gray-300 dark:text-white">
                                {{page.props.form.name}}
                            </h1>
                        </div>
                    </div>
                    <div class="grid grid-cols-6 col-span-4 px-1 py-1 space-x-1 text-sm font-medium tracking-normal text-center rounded-lg  d-none">
                        <!-- <a href=""  class="inline-block text-center text-xs border border-transparent  bg-white text-blue-600 font-semibold  rounded-lg px-2 py-1 cursor-pointer hover:bg-slate-200 transition-all">  
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mx-auto text-blue-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008Z"></path>
                            </svg>                 
                            <span class="pt-1">Build</span>
                        </a>
                        <a  class="inline-block text-center text-xs border border-transparent  rounded-lg px-2 py-1 cursor-pointer hover:bg-slate-200 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mx-auto text-purple-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75"></path>
                            </svg>              
                            <span class="pt-1">Integrate</span>
                        </a>
                        <a  class="inline-block text-center text-xs border border-transparent  rounded-lg px-2 py-1 cursor-pointer hover:bg-slate-200 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mx-auto text-orange-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                            </svg>                          
                            <span class="pt-1">Settings</span>
                        </a>
                        <a  class="inline-block text-center text-xs border border-transparent  rounded-lg px-2 py-1 cursor-pointer hover:bg-slate-200 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mx-auto text-pink-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z"></path>
                            </svg>              
                            <span class="pt-1">Share</span>
                        </a>
                        <a  class="inline-block text-center text-xs border border-transparent  rounded-lg px-2 py-1 cursor-pointer hover:bg-slate-200 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mx-auto text-green-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605"></path>
                            </svg>              
                            <span class="pt-1">Results</span>
                        </a> -->
                    </div>
                    <div class="col-span-4 flex justify-end items-center">
                        <div class="space-x-4 flex items-center">
                            <button type="button" class="relative col-span-1 inline-flex items-center px-4 py-2 text-sm leading-4 text-center text-red-800 bg-red-100 border border-transparent rounded-md shadow-sm hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400" data-has-alpine-state="true">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3"></path>
                                </svg>                                
                            </button>
                            <button type="button" @click="copyPageUrl" x-tooltip.raw="Click to copy form link" class="relative col-span-1 inline-flex items-center px-4 py-2 text-sm leading-4 text-center text-blue-800 bg-blue-100 border border-transparent rounded-md shadow-sm hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-400" data-has-alpine-state="true">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244"></path>
                                </svg>              
                            </button>
                            <a x-tooltip.raw="Open form page" target="_blank" class="relative col-span-1 inline-flex items-center px-4 py-2 text-sm leading-4 text-center text-gray-800 bg-gray-300 border border-transparent rounded-md shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"></path>
                                </svg> 
                            </a>
                            <button  @click="publish()" x-tooltip.raw="Hitting this button will make your changes available to your users." type="button" class="relative text-center col-span-1 inline-flex text-white items-center px-3 py-2 text-sm font-medium leading-4  bg-gray-700 hover:bg-gray-800  border border-transparent rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400" data-has-alpine-state="true">
                                <span class="flex items-center">
                                    <svg class="mr-2 -ml-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zM12 2.25V4.5m5.834.166l-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243l-1.59-1.59"></path>
                                    </svg>
                                    Publish Now
                                </span>
                            </button>
                        </div>
                    </div>
                </nav>
            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import Banner from '@/Components/Banner.vue';

defineProps({
    title: String,
});

const page = usePage();

const publish = () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`/publish/${page.props.form.id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log('Success:', data);
        // Handle the response data as needed
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });

};
</script>