<template>
    <div>
        <Head :title="title" />
        <Banner />
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <nav class="grid grid-cols-12 py-2 px-4 text-gray-700 bg-white border-b border-slate-200 dark:bg-gray-900">
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
                        <!-- <Link :href="`/form/${page.props.form.id}`"  class="inline-block text-center text-xs border border-transparent  bg-white text-blue-600 font-semibold  rounded-lg px-2 py-1 cursor-pointer hover:bg-slate-200 transition-all">  
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mx-auto text-blue-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008Z"></path>
                            </svg>                 
                            <span class="pt-1">Build</span>
                        </Link>
                        <a :href="`/integrations/${page.props.form.id}`" class="inline-block text-center text-xs border border-transparent  rounded-lg px-2 py-1 cursor-pointer hover:bg-slate-200 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mx-auto text-purple-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75"></path>
                            </svg>              
                            <span class="pt-1">Integrate</span>
                        </a>
                        <Link :href="`/settings/${page.props.form.id}`" class="inline-block text-center text-xs border border-transparent  rounded-lg px-2 py-1 cursor-pointer hover:bg-slate-200 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mx-auto text-orange-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                            </svg>                          
                            <span class="pt-1">Settings</span>
                        </Link>
                        <a  class="inline-block text-center text-xs border border-transparent  rounded-lg px-2 py-1 cursor-pointer hover:bg-slate-200 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mx-auto text-pink-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z"></path>
                            </svg>              
                            <span class="pt-1">Share</span>
                        </a> -->
                        <Link :href="`/responses/${page.props.form.id}`" class="inline-block text-center text-xs border border-transparent  rounded-lg px-2 py-1 cursor-pointer hover:bg-slate-200 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mx-auto text-green-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605"></path>
                            </svg>              
                            <span class="pt-1">Results</span>
                        </Link>
                    </div>
                    <div class="col-span-4 flex justify-end items-center">
                        <div class="space-x-4 flex items-center">
                            <!-- <button type="button" class="relative col-span-1 inline-flex items-center px-4 py-2 text-sm leading-4 text-center text-red-800 bg-red-100 border border-transparent rounded-md shadow-sm hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400" data-has-alpine-state="true">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3"></path>
                                </svg>                                
                            </button> -->
                            <button type="button" @click="copyPageUrl" x-tooltip.raw="Click to copy form link" class="relative col-span-1 inline-flex items-center px-4 py-2 text-sm leading-4 text-center text-blue-800 bg-blue-100 border border-transparent rounded-md shadow-sm hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-400" data-has-alpine-state="true">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244"></path>
                                </svg>              
                            </button>
                            <Link :href="`/forms/${page.props.form.id}`" x-tooltip.raw="Open form page" target="_blank" class="relative col-span-1 inline-flex items-center px-4 py-2 text-sm leading-4 text-center text-gray-800 bg-gray-300 border border-transparent rounded-md shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"></path>
                                </svg> 
                            </Link>
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
    <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50 " v-if="showPublished">
    <div @keyup.escape.window="showPublished=false" class="z-100 px-10" aria-modal="true" data-has-alpine-state="true">
        <div class="fixed inset-0 z-30 overflow-y-auto" v-if="showQrCode">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-5 sm:w-full sm:max-w-lg mx-4">
                    <div class="bg-white px-4 pt-5 pb-4 sm:px-14 sm:py-16">
                        <a href="#" @click="showQrCode=false" class="absolute -top-3 -right-3 md:top-4 md:right-4 block p-4 ">
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
                                <div class="qr-code flex items-center justify-center" ref="qrContainer">
                                    <QrcodeVue id="qr-code" render-as="svg" :value="qrCodeValue" :size="200" />
                                </div>
                                <div class="flex items-center justify-center mt-10">
                                    <a @click="downloadQrCode" download="MyForm.png" style="cursor: pointer" class="bg-gray-300 transition-all hover:bg-gray-200 text-black px-4 py-2 text-sm rounded-md shadow-sm flex items-center space-x-1">
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
        <div class="mx-auto w-full max-w-2xl rounded-lg bg-studio-50 px-20 pt-10 pb-16 relative group transition-all bg-white">
            <button @click="showPublished = false" class="absolute top-0 -right-10 bg-white p-2 rounded-full text-gray-600 hover:text-gray-700">
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
                    <input type="text" readonly="" :value="`https://buildmyform.com/forms/${page.props.form.id}`" class="block w-80 rounded-md rounded-r-none border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                    <button @click="copyPageUrl()" class="flex items-center rounded-md rounded-l-none border border-transparent bg-coral px-4 py-1.5 text-sm font-medium text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">                                  
                        Copy
                    </button>
                </div>
            </div>
            <div class="mt-4 flex items-center justify-center space-x-3">
                <Link :href="`https://buildmyform.com/forms/${page.props.form.id}`" target="_blank" class="inline-block p-1" x-tooltip.raw="Open form in new tab">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 30 30" class="w-7 h-7">
                        <path d="M 25.980469 2.9902344 A 1.0001 1.0001 0 0 0 25.869141 3 L 20 3 A 1.0001 1.0001 0 1 0 20 5 L 23.585938 5 L 13.292969 15.292969 A 1.0001 1.0001 0 1 0 14.707031 16.707031 L 25 6.4140625 L 25 10 A 1.0001 1.0001 0 1 0 27 10 L 27 4.1269531 A 1.0001 1.0001 0 0 0 25.980469 2.9902344 z M 6 7 C 4.9069372 7 4 7.9069372 4 9 L 4 24 C 4 25.093063 4.9069372 26 6 26 L 21 26 C 22.093063 26 23 25.093063 23 24 L 23 14 L 23 11.421875 L 21 13.421875 L 21 16 L 21 24 L 6 24 L 6 9 L 14 9 L 16 9 L 16.578125 9 L 18.578125 7 L 16 7 L 14 7 L 6 7 z"></path>
                    </svg>
                </Link>
                <a href="#" class="inline-block p-1" @click="showQrCode = true;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z"></path>
                    </svg>
                </a>    
            </div>
            <p class="mb-4 mt-10 text-center text-gray-600 text-sm">Or choose your next adventure:</p>
            <div class="grid grid-cols-3 gap-4 text-xs transition-all font-semibold">
                <a href="https://app.youform.com/form/8f2hlx5f/share" class="rounded-md bg-pale-violet p-6 hover:bg-contessa-300">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25"></path>
                        </svg>                      
                    </div>
                    <p class="text-center pt-2">
                        Embed <br> in website
                    </p>
                </a>
                <a href="https://app.youform.com/form/8f2hlx5f/integrations" class="rounded-md bg-bright-green-200 p-6 hover:bg-contessa-300">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75"></path>
                        </svg>                      
                    </div>
                    <p class="text-center pt-2">
                        Setup <br> integrations
                    </p>
                </a>
                <a href="https://app.youform.com/form/8f2hlx5f/settings/link-settings" class="rounded-md bg-vivid-yellow p-6 hover:bg-contessa-300">
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
</template>

<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import Banner from '@/Components/Banner.vue';
import QrcodeVue from 'qrcode.vue'

defineProps({
    title: String,
});

const page = usePage();
const showPublished = ref(false);
const showQrCode = ref(false);
const qrCodeValue = ref(`https://buildmyform.com/forms/${page.props.form.id}`);

const publish = () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const hasPublished = page.props.has_published_form;
    fetch(`/publish/${page.props.form.id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
    })
    .then(data => {
        console.log('Success:', data);
        if(!hasPublished){
            showPublished.value = true;
            generateDownloadLink();
        }
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
};

function copyPageUrl(){
    navigator.clipboard.writeText(`https://buildmyform.com/forms/${page.props.form.id}`)
    .then(() => {
        console.log('Text copied to clipboard');
    })
    .catch(err => {
        console.error('Failed to copy text: ', err);
    });
}

function downloadQrCode(){
    const svgElement = document.querySelector('#qr-code');
    downloadSvgAsPng(svgElement, 'qr-code.png');
}

function downloadSvgAsPng(svgElement, filename = 'image.png') {
    const serializer = new XMLSerializer();
    const svgString = serializer.serializeToString(svgElement);

    const svgBlob = new Blob([svgString], { type: 'image/svg+xml;charset=utf-8' });
    const url = URL.createObjectURL(svgBlob);

    const canvas = document.createElement('canvas');
    const context = canvas.getContext('2d');
    const img = new Image();

    img.onload = function() {
        canvas.width = img.width;
        canvas.height = img.height;
        context.drawImage(img, 0, 0);

        const pngUrl = canvas.toDataURL('image/png');
        const downloadLink = document.createElement('a');
        downloadLink.href = pngUrl;
        downloadLink.download = filename;

        document.body.appendChild(downloadLink);
        downloadLink.click();

        document.body.removeChild(downloadLink);
        URL.revokeObjectURL(url);
    };

    img.src = url;
}

</script>