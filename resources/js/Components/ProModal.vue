<template>
    <TransitionRoot as="template" :show="show">
      <Dialog class="relative z-10" @close="handleClose">
        <TransitionChild
          as="template"
          enter="ease-out duration-300"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="ease-in duration-200"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
        </TransitionChild>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
          	<div class="flex min-h-full items-center justify-center p-4 text-center sm:items-center sm:p-0">
				<TransitionChild
				as="template"
				enter="ease-out duration-300"
				enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
				enter-to="opacity-100 translate-y-0 sm:scale-100"
				leave="ease-in duration-200"
				leave-from="opacity-100 translate-y-0 sm:scale-100"
				leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
				>
              		<DialogPanel class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-5xl">            
            <div class="bg-white px-4 pt-5 pb-4 sm:px-14 sm:py-16">
                <a href="#" @click.prevent="handleClose()" class="absolute -top-3 -right-3 md:top-4 md:right-4 block p-4 ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>              
                </a>
                <div class="w-full">

                    <div class="text-center">
                        

                        <h4 class="text-2xl font-bold block md:flex items-center space-x-2 justify-center">
                            <span>Buy</span> 
                            <img src="/images/favico.jpg" class="h-8 inline mt-1" alt="">
 
                            <span class="bg-red-600 text-black py-1.5 px-3 text-sm rounded-md">PREMIUM</span>
                        </h4>
                        <p class="mt-2 text-gray-600">
                            and enjoy the following benefits...
                        </p>
                    </div>

                    <div class="mt-10 max-w-md mx-auto text-gray-700">
                        <ul class="text-left space-y-2 pb-4">
                            <li class="flex items-center">
                                <CheckSvg />                                 
                                <span class="pl-2">
                                    Remove <span class="font-semibold">Powered By BuildMyForm</span> branding.
                                </span>
                            </li>

                            <li class="flex items-center">
								<CheckSvg />                                
                                <span class="pl-2">
                                    Add your own brand logo.
                                </span>
                            </li>

                            <li class="flex items-center">
                                <CheckSvg />                               
                                <span class="pl-2">
                                    Fully customize "Thank you" pages. 
                                </span>
                            </li>

                            <li class="flex items-center">
                                <CheckSvg />                                 
                                <span class="pl-2">
                                    Remove 10MB file upload limit.
                                </span>
                            </li>

                            <li class="flex items-center">
                                <CheckSvg />                                 
                                <span class="pl-2">
                                    Send email to respondent on submission.
                                </span>
                            </li>

                            <li class="flex items-center">
                                <CheckSvg />                                 
                                <span class="pl-2">
                                    Configure email for notification of submissions.
                                </span>
                            </li>

                            <li class="flex items-center">
                                <CheckSvg />                                 
                                <span class="pl-2">
                                    View &amp; download partial submissions.
                                </span>
                            </li>

                            <li class="flex items-center">
                                <CheckSvg />                                 
                                <span class="pl-2">
                                    Add your own domain for form pages.
                                </span>
                            </li>

                            <li class="flex items-center">
                                <CheckSvg />                                 
                                <span class="pl-2">
                                    Integrate with 6000+ apps with Zapier or Make.
                                </span>
                            </li>

                            <li class="flex items-center">
                                <CheckSvg />                                 
                                <span class="pl-2">
                                    Send submission refill links to your users.
                                </span>
                            </li>

                            <li class="flex items-center">
                                <CheckSvg />                                 
                                <span class="pl-2">
                                    Collect payments using Stripe.
                                </span>
                            </li>

                            <li class="flex items-center">
                                <CheckSvg />                                 
                                <span class="pl-2">
                                    Invite &amp; collaborate with team members (coming soon).
                                </span>
                            </li>
                        </ul>           
                        <a href="" class="mt-6 bg-coral border-2 border-black drop-shadow-3xl hover:drop-shadow-4xl px-10 py-2 text-black rounded-md block mx-auto text-center">
                            Buy PREMIUM for $20/month →
                        </a>
                        <div class="text-center mt-4">
                            <p class="flex items-center justify-center space-x-2">
                                <span class="hidden md:inline">
                                    🚨 Get 2 months FREE by paying
                                </span> 
                                <a href="" class="text-blue-600 underline hover:no-underline">
                                    $200 for a year
                                </a> 
                            </p>
                        </div>
                    </div>
                </div>
            </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                  <button
                    type="button"
                    class="mt-3 inline-flex w-full justify-center rounded-md bg-gray-500 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-600 sm:ml-3 sm:w-auto"
                    @click="handleClose"
                  >
                    Cancel
                  </button>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
</template>
  
<script setup>
  import { Dialog, DialogPanel, TransitionRoot, TransitionChild } from '@headlessui/vue';
  import { defineEmits } from 'vue';
import CheckSvg from '@/Components/CheckSvg.vue';
  const props = defineProps({
    show: Boolean,
  });

  const emit = defineEmits(['handleClose']);

  
  function handleClose() {
    emit('closePro');
  }
  </script>
  