<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

const steps = ref([
                { id: 1, title: 'Create Your Form' },
                { id: 2, title: 'Customization' },
                { id: 3, title: 'Set up Logic' },
                { id: 4, title: 'Integrate' },
                { id: 5, title: 'Publish And Collect Responses' }
            ]);

const currentStep = ref(1);
const currentBilling = ref('monthly');

function toggleBilling(billing){
    currentBilling.value = billing;
}
</script>

<template>
<Head title="Welcome" />
    <header class="grid grid-cols-2 items-center gap-2 pb-10 pt-5 lg:grid-cols-8">
        <div class="flex lg:justify-center lg:col-start-5">
            <!-- <svg class="h-12 w-auto text-white lg:h-16 lg:text-[#FF2D20]" viewBox="0 0 62 65" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M61.8548 14.6253C61.8778 14.7102 61.8895 14.7978 61.8897 14.8858V28.5615C61.8898 28.737 61.8434 28.9095 61.7554 29.0614C61.6675 29.2132 61.5409 29.3392 61.3887 29.4265L49.9104 36.0351V49.1337C49.9104 49.4902 49.7209 49.8192 49.4118 49.9987L25.4519 63.7916C25.3971 63.8227 25.3372 63.8427 25.2774 63.8639C25.255 63.8714 25.2338 63.8851 25.2101 63.8913C25.0426 63.9354 24.8666 63.9354 24.6991 63.8913C24.6716 63.8838 24.6467 63.8689 24.6205 63.8589C24.5657 63.8389 24.5084 63.8215 24.456 63.7916L0.501061 49.9987C0.348882 49.9113 0.222437 49.7853 0.134469 49.6334C0.0465019 49.4816 0.000120578 49.3092 0 49.1337L0 8.10652C0 8.01678 0.0124642 7.92953 0.0348998 7.84477C0.0423783 7.8161 0.0598282 7.78993 0.0697995 7.76126C0.0884958 7.70891 0.105946 7.65531 0.133367 7.6067C0.152063 7.5743 0.179485 7.54812 0.20192 7.51821C0.230588 7.47832 0.256763 7.43719 0.290416 7.40229C0.319084 7.37362 0.356476 7.35243 0.388883 7.32751C0.425029 7.29759 0.457436 7.26518 0.498568 7.2415L12.4779 0.345059C12.6296 0.257786 12.8015 0.211853 12.9765 0.211853C13.1515 0.211853 13.3234 0.257786 13.475 0.345059L25.4531 7.2415H25.4556C25.4955 7.26643 25.5292 7.29759 25.5653 7.32626C25.5977 7.35119 25.6339 7.37362 25.6625 7.40104C25.6974 7.43719 25.7224 7.47832 25.7523 7.51821C25.7735 7.54812 25.8021 7.5743 25.8196 7.6067C25.8483 7.65656 25.8645 7.70891 25.8844 7.76126C25.8944 7.78993 25.9118 7.8161 25.9193 7.84602C25.9423 7.93096 25.954 8.01853 25.9542 8.10652V33.7317L35.9355 27.9844V14.8846C35.9355 14.7973 35.948 14.7088 35.9704 14.6253C35.9792 14.5954 35.9954 14.5692 36.0053 14.5405C36.0253 14.4882 36.0427 14.4346 36.0702 14.386C36.0888 14.3536 36.1163 14.3274 36.1375 14.2975C36.1674 14.2576 36.1923 14.2165 36.2272 14.1816C36.2559 14.1529 36.292 14.1317 36.3244 14.1068C36.3618 14.0769 36.3942 14.0445 36.4341 14.0208L48.4147 7.12434C48.5663 7.03694 48.7383 6.99094 48.9133 6.99094C49.0883 6.99094 49.2602 7.03694 49.4118 7.12434L61.3899 14.0208C61.4323 14.0457 61.4647 14.0769 61.5021 14.1055C61.5333 14.1305 61.5694 14.1529 61.5981 14.1803C61.633 14.2165 61.6579 14.2576 61.6878 14.2975C61.7103 14.3274 61.7377 14.3536 61.7551 14.386C61.7838 14.4346 61.8 14.4882 61.8199 14.5405C61.8312 14.5692 61.8474 14.5954 61.8548 14.6253ZM59.893 27.9844V16.6121L55.7013 19.0252L49.9104 22.3593V33.7317L59.8942 27.9844H59.893ZM47.9149 48.5566V37.1768L42.2187 40.4299L25.953 49.7133V61.2003L47.9149 48.5566ZM1.99677 9.83281V48.5566L23.9562 61.199V49.7145L12.4841 43.2219L12.4804 43.2194L12.4754 43.2169C12.4368 43.1945 12.4044 43.1621 12.3682 43.1347C12.3371 43.1097 12.3009 43.0898 12.2735 43.0624L12.271 43.0586C12.2386 43.0275 12.2162 42.9888 12.1887 42.9539C12.1638 42.9203 12.1339 42.8916 12.114 42.8567L12.1127 42.853C12.0903 42.8156 12.0766 42.7707 12.0604 42.7283C12.0442 42.6909 12.023 42.656 12.013 42.6161C12.0005 42.5688 11.998 42.5177 11.9931 42.4691C11.9881 42.4317 11.9781 42.3943 11.9781 42.3569V15.5801L6.18848 12.2446L1.99677 9.83281ZM12.9777 2.36177L2.99764 8.10652L12.9752 13.8513L22.9541 8.10527L12.9752 2.36177H12.9777ZM18.1678 38.2138L23.9574 34.8809V9.83281L19.7657 12.2459L13.9749 15.5801V40.6281L18.1678 38.2138ZM48.9133 9.14105L38.9344 14.8858L48.9133 20.6305L58.8909 14.8846L48.9133 9.14105ZM47.9149 22.3593L42.124 19.0252L37.9323 16.6121V27.9844L43.7219 31.3174L47.9149 33.7317V22.3593ZM24.9533 47.987L39.59 39.631L46.9065 35.4555L36.9352 29.7145L25.4544 36.3242L14.9907 42.3482L24.9533 47.987Z" fill="currentColor"/></svg> -->
        </div>
        <nav v-if="canLogin" class="mx-3 p-1 flex flex-1 justify-end">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class=" px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            >
                Dashboard
            </Link>

            <template v-else>
                <Link
                    :href="route('login')"
                    class="mx-3 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Log in
                </Link>

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="mx-3 m2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Register
                </Link>
            </template>
        </nav>
    </header>


<main id="skip" class="min-h-[calc(100dvh-4rem)] md:min-h[calc(100dvh-5rem)] -mt-28 pt-12 dark:bg-zinc-900 dark:text-white/50">
    <div class="relative isolate px-10 pt-8 lg:pt-10 xl:pt-10 md:pt-10 lg:px-10">
        <div class="absolute inset-x-10 -z-10 transform-gpu overflow-hidden blur-3xl sm:top-12 md:top-12 xl:top-10" aria-hidden="true">
            <!-- <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] mt-80 -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[green] to-[blue] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]">

            </div> -->
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] mt-80 -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]">

            </div>
        </div>
        <div class="mx-auto max-w-2xl py-16 sm:py-20 lg:pt-24 lg:pb-0">
            <div class="text-center">
                <!-- <div class="inline-flex items-center bg-blue-100 rounded-full px-6 py-2 text-blue-700 font-medium mb-8">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Try free for 7 days - Cancel anytime
                </div> -->
                <h1 class="text-4xl font-bold tracking-tight text-[#4D3300] dark:text-white/100 sm:text-6xl">Effortless Form Building for Your Business Needs</h1>
                <p class="mt-6 mb-6 text-lg leading-8 text-[#4D3300] dark:text-white/100">Create and share powerful, customizable forms in minutes. Our platform simplifies data collection, automates workflows, and enhances user engagement—all while keeping you in control.</p>
                <div>
                    <div class="relative mb-12 px-4 sm:px-0">
                        <div class="mx-auto max-w-2xl">
                            <div class="rounded-xl bg-white/90 backdrop-blur-sm shadow-lg p-6 sm:p-8">
                                <div class="flex flex-col sm:grid sm:grid-cols-3 gap-4 sm:gap-2">
                                    <div class="flex flex-col items-center text-center sm:flex-row sm:justify-center px-4 sm:px-0 py-2">
                                        <!-- <div class="shrink-0 mb-2 sm:mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-5 h-5 text-blue-700 flex-shrink-0">
                                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="9" cy="7" r="4"></circle>
                                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                            </svg></div> -->
                                            <span class="text-[#4D3300] font-semibold text-sm sm:text-base sm:ml-3 leading-tight">🔧 100+ Businesses Served</span>
                                    </div>
                                    <div class="flex flex-col items-center text-center sm:flex-row sm:justify-center px-4 sm:px-0 py-2">
                                        <!-- <div class="shrink-0 mb-2 sm:mb-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle w-5 h-5 text-blue-700 flex-shrink-0">
                                                <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
                                            </svg>
                                        </div> -->
                                        <span class="text-[#4D3300] font-semibold text-sm sm:text-base sm:ml-3 leading-tight">📊 50,000+ Submissions Processed</span>
                                    </div>
                                    <div class="flex flex-col items-center text-center sm:flex-row sm:justify-center px-4 sm:px-0 py-2">
                                        <!-- <div class="shrink-0 mb-2 sm:mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search w-5 h-5 text-blue-700 flex-shrink-0">
                                                <circle cx="11" cy="11" r="8"></circle>
                                                <path d="m21 21-4.3-4.3"></path>
                                            </svg></div> -->
                                            <span class="text-[#4D3300] font-semibold text-sm sm:text-base sm:ml-3 leading-tight">⚡ Streamline Your Workflows Today</span>
                                    </div>
                                </div>
                                <div class="text-center mt-6">
                                    <p class="text-base sm:text-lg font-medium text-[#4D3300] px-4 sm:px-0">Join businesses worldwide streamlining their operations with our form builder!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-y-4 sm:gap-x-6"><a href="/dashboard" class="w-full sm:w-auto transition ease-in-out delay-50 hover-border-right-bottom rounded-md bg-blue-700 px-2.5 py-2.5 text-xl font-semibold text-white shadow-md hover:-translate-y-1 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-600">Start 7-Day Free Trial</a><a href="#how-it-works-section" class="text-md font-semibold leading-6 text-[#4D3300]">Learn more <span aria-hidden="true">→</span></a><a href="/guide" class="text-md font-semibold leading-6 text-[#4D3300]">Starting Guide <span aria-hidden="true">→</span></a></div> -->
            </div>
        </div>
        <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
            <!-- <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"></div> -->

            <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"></div>
        </div>
    </div>
    <section class="py-16 px-4 md:px-8 lg:px-16">
        <div class="container mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-extrabold text-[#4D3300] md:text-6xl dark:text-white/100">Transform Your Data Collection Process</h2>
                <p class="max-w-2xl mx-auto mt-4 text-lg sm:text-xl text-[#4D3300] lg:text-2xl dark:text-white/100">See how our Form Builder revolutionizes the way you gather manage, and automate information. strategy</p>
            </div>
            <div class="flex flex-col md:flex-row gap-6 mt-8">
                <div class="w-full md:w-1/2 p-6 rounded-lg transform transition-all duration-300 hover:scale-105 bg-[#1a1100]">
                    <div class="flex justify-center mb-6 "><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-frown w-12 h-12 text-blue-200/50">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M16 16s-1.5-2-4-2-4 2-4 2"></path>
                            <line x1="9" x2="9.01" y1="9" y2="9"></line>
                            <line x1="15" x2="15.01" y1="9" y2="9"></line>
                        </svg></div>
                    <h3 class="text-2xl font-bold mb-6 text-center text-blue-200/70">Without Our Form Builder</h3>
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4 p-4 rounded-lg transition-all duration-300 hover:transform hover:translate-x-2 bg-[#3a2a00]/30 hover:bg-[#3a2a00]/50">
                            <div class="p-2 rounded-lg bg-[#3a2a00]/50"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-5 h-5 text-blue-200/50">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg></div>
                            <div>
                                <h4 class="font-semibold mb-1 text-blue-200/70">❌ 2+ Hours Daily</h4>
                                <p class="text-sm text-blue-200/50">Manually creating forms, collecting responses, and organizing data.</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4 p-4 rounded-lg transition-all duration-300 hover:transform hover:translate-x-2 bg-[#3a2a00]/30 hover:bg-[#3a2a00]/50">
                            <div class="p-2 rounded-lg bg-[#3a2a00]/50"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search w-5 h-5 text-blue-200/50">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <path d="m21 21-4.3-4.3"></path>
                                </svg></div>
                            <div>
                                <h4 class="font-semibold mb-1 text-blue-200/70">❌ Limited Reach</h4>
                                <p class="text-sm text-blue-200/50">Struggling to share forms efficiently and collect enough responses.</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4 p-4 rounded-lg transition-all duration-300 hover:transform hover:translate-x-2 bg-[#3a2a00]/30 hover:bg-[#3a2a00]/50">
                            <div class="p-2 rounded-lg bg-[#3a2a00]/50"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square w-5 h-5 text-blue-200/50">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                </svg></div>
                            <div>
                                <h4 class="font-semibold mb-1 text-blue-200/70">❌ Generic Design</h4>
                                <p class="text-sm text-blue-200/50">Bland, outdated forms that don’t align with your brand.</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4 p-4 rounded-lg transition-all duration-300 hover:transform hover:translate-x-2 bg-[#3a2a00]/30 hover:bg-[#3a2a00]/50">
                            <div class="p-2 rounded-lg bg-[#3a2a00]/50"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up w-5 h-5 text-blue-200/50">
                                    <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
                                    <polyline points="16 7 22 7 22 13"></polyline>
                                </svg></div>
                            <div>
                                <h4 class="font-semibold mb-1 text-blue-200/70">❌ Inconsistent Results</h4>
                                <p class="text-sm text-blue-200/50">Difficulty in managing and analyzing collected data.</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4 p-4 rounded-lg transition-all duration-300 hover:transform hover:translate-x-2 bg-[#3a2a00]/30 hover:bg-[#3a2a00]/50">
                            <div class="p-2 rounded-lg bg-[#3a2a00]/50"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-frown w-5 h-5 text-blue-200/50">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="M16 16s-1.5-2-4-2-4 2-4 2"></path>
                                    <line x1="9" x2="9.01" y1="9" y2="9"></line>
                                    <line x1="15" x2="15.01" y1="9" y2="9"></line>
                                </svg></div>
                            <div>
                                <h4 class="font-semibold mb-1 text-blue-200/70">❌ Form Fatigue</h4>
                                <p class="text-sm text-blue-200/50">The repetitive grind of building forms manually every time.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 p-6 rounded-lg transform transition-all duration-300 hover:scale-105 bg-gradient-to-br from-blue-500 to-blue-700 shadow-lg">
                    <div class="flex justify-center mb-6 animate-bounce"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-smile w-12 h-12 text-white">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                            <line x1="9" x2="9.01" y1="9" y2="9"></line>
                            <line x1="15" x2="15.01" y1="9" y2="9"></line>
                        </svg></div>
                    <h3 class="text-2xl font-bold mb-6 text-center text-white">With Our Form Builder</h3>
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4 p-4 rounded-lg transition-all duration-300 hover:transform hover:translate-x-2 bg-white/10 hover:bg-white/20">
                            <div class="p-2 rounded-lg bg-white/20"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-5 h-5 text-white">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg></div>
                            <div>
                                <h4 class="font-semibold mb-1 text-white">✅ Just 10 Minutes to Launch</h4>
                                <p class="text-sm text-white/90">Drag-and-drop tools make building forms fast and simple.</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4 p-4 rounded-lg transition-all duration-300 hover:transform hover:translate-x-2 bg-white/10 hover:bg-white/20">
                            <div class="p-2 rounded-lg bg-white/20"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search w-5 h-5 text-white">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <path d="m21 21-4.3-4.3"></path>
                                </svg></div>
                            <div>
                                <h4 class="font-semibold mb-1 text-white">✅ Reach More People</h4>
                                <p class="text-sm text-white/90">Share forms instantly via links, embeds, and social platforms.</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4 p-4 rounded-lg transition-all duration-300 hover:transform hover:translate-x-2 bg-white/10 hover:bg-white/20">
                            <div class="p-2 rounded-lg bg-white/20"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square w-5 h-5 text-white">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                </svg></div>
                            <div>
                                <h4 class="font-semibold mb-1 text-white">✅ Customizable Designs</h4>
                                <p class="text-sm text-white/90">Create beautiful, branded forms that reflect your identity.</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4 p-4 rounded-lg transition-all duration-300 hover:transform hover:translate-x-2 bg-white/10 hover:bg-white/20">
                            <div class="p-2 rounded-lg bg-white/20"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up w-5 h-5 text-white">
                                    <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
                                    <polyline points="16 7 22 7 22 13"></polyline>
                                </svg></div>
                            <div>
                                <h4 class="font-semibold mb-1 text-white">✅ Consistent Results</h4>
                                <p class="text-sm text-white/90">Automated workflows and real-time analytics ensure efficiency.</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4 p-4 rounded-lg transition-all duration-300 hover:transform hover:translate-x-2 bg-white/10 hover:bg-white/20">
                            <div class="p-2 rounded-lg bg-white/20"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-smile w-5 h-5 text-white">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                                    <line x1="9" x2="9.01" y1="9" y2="9"></line>
                                    <line x1="15" x2="15.01" y1="9" y2="9"></line>
                                </svg></div>
                            <div>
                                <h4 class="font-semibold mb-1 text-white">✅ Peace of Mind</h4>
                                <p class="text-sm text-white/90">Save time and focus on growing your business while we handle the data.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="relative py-10 mt-24 md:py-16 px-4 md:px-8 lg:px-16 z-100" id="how-it-works-section">
        <div class="container mx-auto">
            <div class="sm:flex sm:flex-col sm:align-center mt-12 mb-8 md:mb-12">
                <h1 class="text-3xl md:text-4xl font-extrabold text-[#4D3300] text-center md:text-6xl dark:text-white/100">How Build My Form Works</h1>
                <p class="max-w-2xl mx-auto mt-4 text-lg sm:text-xl text-[#4D3300] text-center lg:text-2xl dark:text-white/100">Streamline form creation and data collection in just five simple steps...</p>
            </div>
            <div class="flex flex-col md:flex-row justify-between items-stretch space-y-8 md:space-y-0 md:space-x-8">
                <div class="w-full md:w-1/3 bg-[#1a1100] p-4 rounded-lg shadow-md flex flex-col justify-between">
                    <div class="p-4 mb-2 rounded-lg cursor-pointer transition-all duration-300 flex items-center bg-[#1a1100] text-white hover:bg-[#3a2a00]" v-for="step in steps"  @click="currentStep = step.id">

                        <div class="w-8 h-8 rounded-full flex items-center justify-center mr-4 bg-blue-700 text-white">{{step.id}}</div>
                            <h3 class="text-lg font-semibold">{{step.title}}</h3>
                    </div>
                </div>
                <div class="w-full md:w-2/3 bg-white p-6 md:p-8 rounded-lg shadow-lg flex flex-col justify-between transition-all duration-300 hover:shadow-2xl hover:scale-105 group">
                    <!-- <div class="bg-gradient-to-br from-blue-100 to-blue-200 p-6 md:p-8 rounded-lg text-center flex flex-col justify-between h-full">
                        <div>
                            <div class="text-5xl md:text-7xl mb-4 md:mb-6 transform group-hover:scale-125 transition-transform duration-300">🚀</div>
                            <h3 class="text-2xl md:text-3xl font-bold mb-3 md:mb-4 text-[#4D3300]">Bring in Leads</h3>
                            <p class="text-[#4D3300] text-base md:text-lg leading-relaxed">Post your replies to attract people who are genuinely interested in what you offer.</p>
                        </div>
                    </div> -->

                    <div v-if="currentStep === 1" class="bg-gradient-to-br from-blue-100 to-blue-200 p-6 md:p-8 rounded-lg text-center flex flex-col justify-between h-full">
                        <div>
                            <div class="text-5xl md:text-7xl mb-4 md:mb-6 transform group-hover:scale-125 transition-transform duration-300">📝</div>
                            <h3 class="text-2xl md:text-3xl font-bold mb-3 md:mb-4 text-[#4D3300]">Create Your Form</h3>
                            <p class="text-[#4D3300] text-base md:text-lg leading-relaxed">Start by creating a custom form to capture the data you need. Choose from various question types and customize the fields.</p>
                        </div>
                    </div>

                    <div v-if="currentStep === 2" class="bg-gradient-to-br from-blue-100 to-blue-200 p-6 md:p-8 rounded-lg text-center flex flex-col justify-between h-full">
                        <div>
                            <div class="text-5xl md:text-7xl mb-4 md:mb-6 transform group-hover:scale-125 transition-transform duration-300">🎨</div>
                            <h3 class="text-2xl md:text-3xl font-bold mb-3 md:mb-4 text-[#4D3300]">Customize Your Form</h3>
                            <p class="text-[#4D3300] text-base md:text-lg leading-relaxed">Customize the design and layout of your form to match your brand. Choose from different themes, colors, and fonts.</p>
                        </div>
                    </div>

                    <div v-if="currentStep === 3" class="bg-gradient-to-br from-blue-100 to-blue-200 p-6 md:p-8 rounded-lg text-center flex flex-col justify-between h-full">
                        <div>
                            <div class="text-5xl md:text-7xl mb-4 md:mb-6 transform group-hover:scale-125 transition-transform duration-300">⚙️</div>
                            <h3 class="text-2xl md:text-3xl font-bold mb-3 md:mb-4 text-[#4D3300]">Set Up Logic and Conditions</h3>
                            <p class="text-[#4D3300] text-base md:text-lg leading-relaxed">Create advanced logic to show or hide questions based on previous answers. Tailor the form flow to each user's needs.</p>
                        </div>
                    </div>

                    <div v-if="currentStep === 4" class="bg-gradient-to-br from-blue-100 to-blue-200 p-6 md:p-8 rounded-lg text-center flex flex-col justify-between h-full">
                        <div>
                            <div class="text-5xl md:text-7xl mb-4 md:mb-6 transform group-hover:scale-125 transition-transform duration-300">🔌</div>
                            <h3 class="text-2xl md:text-3xl font-bold mb-3 md:mb-4 text-[#4D3300]">Integrate with Your Tools</h3>
                            <p class="text-[#4D3300] text-base md:text-lg leading-relaxed">Connect your form to various third-party tools like CRM systems, email marketing, or Google Sheets to automate workflows.</p>
                        </div>
                    </div>

                    <div v-if="currentStep === 5" class="bg-gradient-to-br from-blue-100 to-blue-200 p-6 md:p-8 rounded-lg text-center flex flex-col justify-between h-full">
                        <div>
                            <div class="text-5xl md:text-7xl mb-4 md:mb-6 transform group-hover:scale-125 transition-transform duration-300">📈</div>
                            <h3 class="text-2xl md:text-3xl font-bold mb-3 md:mb-4 text-[#4D3300]">Publish and Collect Responses</h3>
                            <p class="text-[#4D3300] text-base md:text-lg leading-relaxed">Publish your form and start collecting responses. Share your form via email, embed it on your website, or share a link directly.</p>
                        </div>
                    </div>

                    <div class="mt-6 md:mt-8 flex justify-between w-full"><button @click="currentStep = currentStep - 1" :disabled="currentStep === 1" class="bg-blue-700 text-white px-4 py-2 md:px-6 md:py-3 rounded-lg hover:bg-blue-600 transition-colors duration-300 text-sm md:text-base">Previous</button></div>
                </div>
            </div>
        </div>
    </section>
    <div class="relative isolate px-6 my-24 py-12 sm:py-16 lg:px-8 bg-[#1a1100]">
        <div class="mx-auto max-w-2xl text-center">
            <div class="flex justify-center mb-6">
                <div class="flex items-center gap-2 bg-blue-100 text-blue-700 px-4 py-2 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-5 h-5">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg><span class="font-medium">Save Hours Every Week</span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bot w-5 h-5">
                        <path d="M12 8V4H8"></path>
                        <rect width="16" height="12" x="4" y="8" rx="2"></rect>
                        <path d="M2 14h2"></path>
                        <path d="M20 14h2"></path>
                        <path d="M15 13v2"></path>
                        <path d="M9 13v2"></path>
                    </svg></div>
            </div>
            <h2 class="text-3xl font-bold tracking-tight text-blue-100 sm:text-4xl">Stop Manually Creating Forms</h2>
            <p class="mt-6 text-lg leading-8 text-blue-100">Simplify your workflow. Subtle makes it easy to design, customize, and manage forms effortlessly—so you can focus on growing your business.</p>
            <div class="mt-10 flex items-center justify-center gap-x-6"><Link href="/login" class="rounded-md bg-blue-700 px-8 py-3 text-lg font-semibold text-white shadow-sm hover:-translate-y-1 transition-all duration-200">Get Started Now</Link></div>
        </div>
    </div>
    <section id="features-section">
        <div class="px-4 py-8 mx-auto sm:py-16 sm:px-6 lg:px-8 max-w-7xl">
            <div class="sm:flex sm:flex-col sm:align-center mb-8 sm:mb-16">
                <h1 class="text-4xl font-extrabold text-[#4D3300] sm:text-center sm:text-6xl mb-8 dark:text-white/100">Features</h1>
                <p class="max-w-2xl mx-auto mt-4 text-lg sm:text-xl text-[#4D3300] text-center lg:text-2xl dark:text-white/100">Your subscribtion comes with a set of features to ensure you get the best leads...</p>
            </div>
            <div class="shadow-sm bg-[#1a1100] rounded-lg p-4 sm:p-6 lg:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                    <div class="relative cursor-pointer w-full h-full"><span class="absolute top-0 left-0 w-full h-full mt-1 sm:mt-2 ml-1 sm:ml-2 bg-blue-500 rounded-lg"></span>
                        <div class="relative p-4 sm:p-6 bg-white border-2 border-indigo-500 hover:border-blue-500 rounded-lg transform transition duration-500 hover:scale-105 h-full flex flex-col">
                            <div class="flex items-center mb-3"><span class="text-2xl sm:text-3xl">📝</span>
                                <h3 class="ml-3 text-lg sm:text-xl font-bold text-gray-800">Easy Form Creation</h3>
                            </div>
                            <p class="text-gray-600 text-base sm:text-lg flex-grow">Build custom forms quickly with a simple, user-friendly interface—no technical expertise required.</p>
                        </div>
                    </div>
                    <div class="relative cursor-pointer w-full h-full"><span class="absolute top-0 left-0 w-full h-full mt-1 sm:mt-2 ml-1 sm:ml-2 bg-blue-500 rounded-lg"></span>
                        <div class="relative p-4 sm:p-6 bg-white border-2 border-indigo-500 hover:border-blue-500 rounded-lg transform transition duration-500 hover:scale-105 h-full flex flex-col">
                            <div class="flex items-center mb-3"><span class="text-2xl sm:text-3xl">⚡</span>
                                <h3 class="ml-3 text-lg sm:text-xl font-bold text-gray-800">Fast Performance</h3>
                            </div>
                            <p class="text-gray-600 text-base sm:text-lg flex-grow">Forms load instantly and handle submissions seamlessly, improving user experience.</p>
                        </div>
                    </div>
                    <div class="relative cursor-pointer w-full h-full"><span class="absolute top-0 left-0 w-full h-full mt-1 sm:mt-2 ml-1 sm:ml-2 bg-blue-500 rounded-lg"></span>
                        <div class="relative p-4 sm:p-6 bg-white border-2 border-indigo-500 hover:border-blue-500 rounded-lg transform transition duration-500 hover:scale-105 h-full flex flex-col">
                            <div class="flex items-center mb-3"><span class="text-2xl sm:text-3xl">🔒</span>
                                <h3 class="ml-3 text-lg sm:text-xl font-bold text-gray-800">Secure Data Collection</h3>
                            </div>
                            <p class="text-gray-600 text-base sm:text-lg flex-grow">Keep your submissions safe with SSL encryption, GDPR compliance, and secure data storage.</p>
                        </div>
                    </div>
                    <div class="relative cursor-pointer w-full h-full"><span class="absolute top-0 left-0 w-full h-full mt-1 sm:mt-2 ml-1 sm:ml-2 bg-blue-500 rounded-lg"></span>
                        <div class="relative p-4 sm:p-6 bg-white border-2 border-indigo-500 hover:border-blue-500 rounded-lg transform transition duration-500 hover:scale-105 h-full flex flex-col">
                            <div class="flex items-center mb-3"><span class="text-2xl sm:text-3xl">🔗</span>
                                <h3 class="ml-3 text-lg sm:text-xl font-bold text-gray-800">Powerful Integrations</h3>
                            </div>
                            <p class="text-gray-600 text-base sm:text-lg flex-grow">Automatically send form data to tools like Google Sheets, Slack, or via Webhooks to streamline your workflows.</p>
                        </div>
                    </div>
                    <div class="relative cursor-pointer w-full h-full"><span class="absolute top-0 left-0 w-full h-full mt-1 sm:mt-2 ml-1 sm:ml-2 bg-blue-500 rounded-lg"></span>
                        <div class="relative p-4 sm:p-6 bg-white border-2 border-indigo-500 hover:border-blue-500 rounded-lg transform transition duration-500 hover:scale-105 h-full flex flex-col">
                            <div class="flex items-center mb-3"><span class="text-2xl sm:text-3xl">📱</span>
                                <h3 class="ml-3 text-lg sm:text-xl font-bold text-gray-800">Mobile Friendly</h3>
                            </div>
                            <p class="text-gray-600 text-base sm:text-lg flex-grow">Your forms adapt perfectly to any device—desktop, tablet, or mobile—so your users can submit anywhere.</p>
                        </div>
                    </div>
                    <div class="relative cursor-pointer w-full h-full"><span class="absolute top-0 left-0 w-full h-full mt-1 sm:mt-2 ml-1 sm:ml-2 bg-blue-500 rounded-lg"></span>
                        <div class="relative p-4 sm:p-6 bg-white border-2 border-indigo-500 hover:border-blue-500 rounded-lg transform transition duration-500 hover:scale-105 h-full flex flex-col">
                            <div class="flex items-center mb-3"><span class="text-2xl sm:text-3xl">🧠</span>
                                <h3 class="ml-3 text-lg sm:text-xl font-bold text-gray-800">Smart Logic & Validation</h3>
                            </div>
                            <p class="text-gray-600 text-base sm:text-lg flex-grow">Use field validation and conditional visibility to ensure clean, relevant, and high-quality submissions.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--$-->
    <section class="py-20" id="pricing-section">
        <div class="container mx-auto px-4">
            <div class="sm:flex sm:flex-col sm:align-center">
                <!-- <div class="mb-8 text-center">
                    <div class="inline-flex items-center bg-blue-100 rounded-full px-6 py-2 text-blue-700 font-medium"><svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>Try free for 7 days - Cancel anytime</div>
                </div> -->
                <h1 class="text-4xl font-extrabold text-[#4D3300] sm:text-center sm:text-6xl mb-8 dark:text-white/100">Pricing Plans</h1>
                <p class="max-w-2xl m-auto mt-5 text-xl text-[#4D3300] sm:text-center sm:text-2xl mb-12 dark:text-white/100">Simple pricing that works for any scale.</p>
                <!-- <div class="relative self-center mt-6 rounded-lg p-0.5 flex border-2 border-[#4D3300] sm:mt-8">
                    <button type="button" class="relative w-1/2 bg-blue-700 shadow-sm text-white rounded-md m-1 py-2 text-sm font-medium whitespace-nowrap focus:outline-none sm:w-auto sm:px-8">Monthly billing</button>
                    <button type="button" class="ml-0.5 relative w-1/2 border border-transparent text-[#4D3300] rounded-md m-1 py-2 text-sm font-medium whitespace-nowrap focus:outline-none sm:w-auto sm:px-8 dark:text-white/100">Yearly billing
                        <span class="ml-0.5 relative w-1/2 bg-blue-700 border border-transparent text-white text-xs p-1 rounded">2 months free!</span>
                    </button>
                </div> -->

                <div id="app" class="relative self-center mt-6 rounded-lg p-0.5 flex border-2 border-[#4D3300] sm:mt-8">
                    <button
                        type="button"
                        :class="[
                            'relative w-1/2 shadow-sm text-sm font-medium whitespace-nowrap rounded-md m-1 py-2 sm:w-auto sm:px-8 focus:outline-none dark:text-white/100',
                            currentBilling === 'monthly' ? 'bg-blue-700 text-white' : 'bg-transparent text-[#4D3300]'
                        ]"
                        @click="toggleBilling('monthly')"
                    >
                        Monthly billing
                    </button>
                    <button
                        type="button"
                        :class="[
                            'relative w-1/2 shadow-sm text-sm font-medium whitespace-nowrap rounded-md m-1 py-2 sm:w-auto sm:px-8 focus:outline-none dark:text-white/100',
                            currentBilling === 'yearly' ? 'bg-blue-700 text-white' : 'bg-transparent text-[#4D3300]'
                        ]"
                        @click="toggleBilling('yearly')"
                    >
                        Yearly billing
                        <span
                            :class="[
                                'ml-0.5 text-xs p-1 rounded',
                                currentBilling === 'yearly' ? 'bg-white text-blue-700' : 'bg-blue-700 text-white'
                            ]"
                        >
                            2 months free!
                        </span>
                    </button>
                </div>
            </div>
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
                <div class="flex flex-col p-8 rounded-lg shadow-lg bg-[#1a1100] relative">
                    <h2 class="text-2xl font-semibold mb-4 text-white">Build My Form</h2>
                    <p class="text-4xl font-bold mb-6 text-white">$0<span class="text-base font-medium text-zinc-300">/
                            month</span></p>
                    <ul class="mb-8 flex-grow">
                        <li class="flex items-start mb-2 text-zinc-300"><svg class="w-5 h-5 flex-shrink-0 text-blue-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M5 13l4 4L19 7"></path>
                            </svg><span class="ml-2">Collect Signatures</span></li>
                        <li class="flex items-start mb-2 text-zinc-300"><svg class="w-5 h-5 flex-shrink-0 text-blue-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M5 13l4 4L19 7"></path>
                            </svg><span class="ml-2">Webhooks</span></li>
                        <li class="flex items-start mb-2 text-zinc-300"><svg class="w-5 h-5 flex-shrink-0 text-blue-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M5 13l4 4L19 7"></path>
                            </svg><span class="ml-2">3 subreddits/campaign</span></li>
                        <li class="flex items-start mb-2 text-zinc-300"><svg class="w-5 h-5 flex-shrink-0 text-blue-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M5 13l4 4L19 7"></path>
                            </svg><span class="ml-2">Unlimited Responses</span></li>
                        <li class="flex items-start mb-2 text-zinc-300"><svg class="w-5 h-5 flex-shrink-0 text-blue-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M5 13l4 4L19 7"></path>
                            </svg><span class="ml-2">Hidden fields</span></li>
                    </ul><Link href="/login"><button data-variant="flat" class="block w-full py-2 mt-4 text-sm font-semibold text-center text-white rounded-md bg-blue-700" type="button">Subscribe</button></Link>
                </div>
                <div class="flex flex-col p-8 rounded-lg shadow-lg bg-[#1a1100] relative ">
                    
                    <h2 class="text-2xl font-semibold mb-4 text-white">Build My Form Plus</h2>
                    <p class="text-4xl font-bold mb-6 text-white" v-if="currentBilling == 'monthly'">$20<span class="text-base font-medium text-zinc-300">/month</span></p>

                    <p class="text-4xl font-bold mb-6 text-white" v-else>$200<span class="text-base font-medium text-zinc-300">/month</span></p>

                    <ul class="mb-8 flex-grow">
                        <li class="flex items-start mb-2 text-zinc-300"><svg class="w-5 h-5 flex-shrink-0 text-blue-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M5 13l4 4L19 7"></path>
                            </svg><span class="ml-2">Accept Payments</span></li>
                        <li class="flex items-start mb-2 text-zinc-300"><svg class="w-5 h-5 flex-shrink-0 text-blue-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M5 13l4 4L19 7"></path>
                            </svg><span class="ml-2">Remove "Build My Form" Branding</span></li>
                        <li class="flex items-start mb-2 text-zinc-300"><svg class="w-5 h-5 flex-shrink-0 text-blue-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M5 13l4 4L19 7"></path>
                            </svg><span class="ml-2">Redirect to a URL</span></li>
                        <li class="flex items-start mb-2 text-zinc-300"><svg class="w-5 h-5 flex-shrink-0 text-blue-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M5 13l4 4L19 7"></path>
                            </svg><span class="ml-2">View Partial Submissions</span></li>
                        <li class="flex items-start mb-2 text-zinc-300"><svg class="w-5 h-5 flex-shrink-0 text-blue-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M5 13l4 4L19 7"></path>
                            </svg><span class="ml-2">Unlimited File upload size</span></li>
                    </ul><a href="/subscription-checkout"><button data-variant="flat" class="block w-full py-2 mt-4 text-sm font-semibold text-center text-white rounded-md bg-blue-700" type="button">Subscribe</button></a>
                </div>
            </div>
        </div>
    </section>
    <!-- <div class="relative isolate px-6 py-20 sm:px-12 sm:py-24 lg:px-12 overflow-hidden">
        <div class="absolute inset-x-0 top-0 -z-10 transform-gpu overflow-hidden pt-32 blur-3xl sm:pt-40 xl:pt-48" aria-hidden="true">
            <div class="relative left-[calc(50%-3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-3rem)] sm:w-[72.1875rem]" style="clip-path:polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
        <h1 class="text-4xl font-extrabold text-[#4D3300] sm:text-center sm:text-6xl mb-8 relative z-10 dark:text-white/100">Frequently Asked Questions</h1>
        <div class="max-w-3xl mx-auto relative z-10">
            <div class="mb-4"><button class="flex justify-between items-center w-full text-left p-4 bg-[#1a1100] text-white rounded-lg focus:outline-none"><span class="font-medium">What is Subtle?</span><span class="ml-6"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg></span></button></div>
            <div class="mb-4"><button class="flex justify-between items-center w-full text-left p-4 bg-[#1a1100] text-white rounded-lg focus:outline-none"><span class="font-medium">How does the campaign system work?</span><span class="ml-6"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg></span></button></div>
            <div class="mb-4"><button class="flex justify-between items-center w-full text-left p-4 bg-[#1a1100] text-white rounded-lg focus:outline-none"><span class="font-medium">Can I upgrade or downgrade my plan?</span><span class="ml-6"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg></span></button></div>
            <div class="mb-4"><button class="flex justify-between items-center w-full text-left p-4 bg-[#1a1100] text-white rounded-lg focus:outline-none"><span class="font-medium">Is there a free trial available?</span><span class="ml-6"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg></span></button></div>
            <div class="mb-4"><button class="flex justify-between items-center w-full text-left p-4 bg-[#1a1100] text-white rounded-lg focus:outline-none"><span class="font-medium">How does billing work?</span><span class="ml-6"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg></span></button></div>
            <div class="mb-4"><button class="flex justify-between items-center w-full text-left p-4 bg-[#1a1100] text-white rounded-lg focus:outline-none"><span class="font-medium">What Reddit account will the posts be from?</span><span class="ml-6"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg></span></button></div>
        </div>
    </div> -->
    <div class="relative isolate px-6 py-20 sm:px-12 sm:py-24 lg:px-12 overflow-hidden bg-blue-700">
        <div class="mx-auto max-w-2xl text-center relative z-10">
            <h1 class="text-4xl font-extrabold text-white sm:text-center sm:text-6xl mb-8 relative z-10">Ready to Simplify Form Creation?</h1>
            <p class="text-lg leading-8 text-white mb-8">Join Subtle today and start building powerful, professional forms effortlessly to grow your business.</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4"><button class="w-full sm:w-auto delay-50 rounded-md bg-blue-500 px-5 py-3 text-xl font-semibold text-white shadow-md hover:border-[#4D3300] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"><Link href="/login">Get Started Now</Link></button></div>
        </div>
    </div>
</main>
</template>
