<template>
<div class="col-span-10">
    <div class="pt-4 text-sm">
        <div class="bg-gray-100 mb-9 flex items-center justify-center rounded-full text-sm text-gray-600 max-w-md mx-auto">
            <!-- Button 1 -->
            <button
                class="w-full py-2 rounded-full border transition-all "
                :class="{
                    'bg-white text-gray-700 border-gray-200': selectedEmail === 'me',
                    'hover:bg-gray-300 hover:text-gray-700 border-gray-50': selectedEmail !== 'me'
                }"
                @click="selectedEmail = 'me'"
            >
                Email to Me
            </button>

            <!-- Button 2 -->
            <button
                class="w-full p-2 rounded-full border transition-all"
                :class="{
                    'bg-white text-gray-700 border-gray-200': selectedEmail === 'responder',
                    'hover:bg-gray-300 hover:text-gray-700 border-gray-50': selectedEmail !== 'responder'
                }"
                @click="selectedEmail = 'responder'"
            >
                Email to Responder
            </button>

        </div>

        <div class="mt-6 space-t-3" v-if="selectedEmail == 'me'">
            <div class="flex items-center justify-between p-4 border border-gray-100 rounded-md">
                <div>
                    <div class="flex items-center space-x-2">
                        <h4>
                            Receive Email Notifications
                        </h4>
                    </div>
                    <p class="text-xs text-gray-500 mt-2 max-w-md">
                        Receive email notifications when someone submits your form.
                    </p>
                </div>
                <div>
                    <!-- <div class="z-100" aria-modal="true"> -->
                    <!-- <div class="absolute inset-0 z-30 overflow-y-auto">
                            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-5 sm:w-full sm:max-w-4xl mx-4">

                                    <div class="bg-white px-4 pt-5 pb-4 sm:px-14 sm:py-8">
                                        <a href="#" class="absolute top-4 right-4 block p-4 ">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </a>

                                        <h4 class="text-lg font-semibold text-center">
                                            Email Notification
                                        </h4>
                                        <div class="mt-6 max-w-lg mx-auto">
                                            <div class="w-full">
                                                <label for="to-emails" class="block text-sm font-medium text-gray-700">
                                                    To
                                                    <p class="text-gray-500 font-normal text-xs inline-block">
                                                        (Who will receive the notifications? Maximum
                                                        <span x-text="maxEmails">5</span>)
                                                    </p>
                                                </label>
                                                <div class="mt-1">
                                                    <tags class="tagify  block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" tabindex="-1">
                                                        <tag title="cade25wilson@gmail.com" contenteditable="false" spellcheck="false" tabindex="-1" class="tagify__tag tagify--noAnim" value="cade25wilson@gmail.com">
                                                            <x title="" tabindex="-1" class="tagify__tag__removeBtn" role="button" aria-label="remove tag"></x>
                                                            <div><span class="tagify__tag-text">cade25wilson@gmail.com</span></div>
                                                        </tag><span  tabindex="0" data-placeholder="Add multiple emails" aria-placeholder="Add multiple emails" class="tagify__input" role="textbox" aria-autocomplete="both" aria-multiline="false"></span>
                                                        &ZeroWidthSpace;
                                                    </tags><input wire:ignore="" type="text" value="cade25wilson@gmail.com" name="to-emails" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" tabindex="-1">
                                                </div>
                                            </div>

                                            <div class="w-full mt-8 pb-8 flex justify-center">
                                                <button type="button"  class="rounded-md bg-gray-700 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-600 w-full">
                                                    <span>
                                                        Save →
                                                    </span>
                                                    <span>
                                                        ...
                                                    </span>
                                                </button>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div> -->
                    <!-- </div> -->
                    <div>
                        <div class="flex items-center justify-end space-x-1">
                            <label class="inline-flex items-center  cursor-pointer ">
                                <input type="checkbox" :checked="page.props.form.email_settings.send_email" @change="handleChange('send_email', $event.target.checked)" class="sr-only peer">
                                <div class="relative w-11 h-6 peer-focus:outline-none peer-focus:ring-0 peer-focus:ring-green-300 rounded-full peer bg-gray-400 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-green-500"></div>
                            </label>
                        </div>

                        <div class="mt-4">
                            <p class="text-xs text-gray-500">
                                Will send to {{ page.props.auth.user.email }}
                                <a href="/subscription-checkout" v-if="!page.props.isPro"><button class="text-blue-600 underline hover:no-underline">Purchase Premium to configure</button></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-y-3 relative group">
                <div class="flex items-center justify-between p-4 border border-gray-100 rounded-md">
                    <div>
                        <div class="flex items-center space-x-2">
                            <h4>
                                Reply To
                            </h4>
                            <span class="text-xs inline-block cursor-pointer py-0.5 px-2 font-normal rounded-md bg-red-600 text-white" title="Allowed in PREMIUM plan">
                                PREMIUM
                            </span>
                        </div>
                        <p class="text-xs text-gray-500 mt-2 max-w-md">
                            Choose an email block from your form and the answer of that field will be set as <strong>Reply To</strong> of the notification email.
                        </p>
                    </div>
                    <div>
                        <select @change="handleSelectChange('reply_to', $event)" 
                        :disabled="!page.props.isPro"
                         class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-gray-600 sm:text-sm sm:leading-6">
                            <option value="null">-- Select an email block from the form --</option>
                            <option v-for="email in page.props.has_email_block" :value="email.id">{{email.label}}</option>
                        </select>
                    </div>
                </div>

                <div class="p-4 border border-gray-100 rounded-md">
                    <div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <h4>
                                    Email Subject
                                </h4>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2 max-w-md">
                            Customize the subject of the notification email using the editor below.
                        </p>
                    </div>
                    <div class="w-full mt-4">
                        <input v-model="page.props.form.email_settings.subject" @keyup.enter="handleChange('subject', page.props.form.email_settings.subject)" @blur="handleChange('subject', page.props.form.email_settings.subject)" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" placeholder="Your subject here...">
                    </div>
                </div>

                <!-- <div class="p-4 border border-gray-100 rounded-md">
                    <div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <h4>
                                    Email Body
                                </h4>
                                <span class="text-xs inline-block cursor-pointer py-0.5 px-2 font-normal rounded-md bg-red-600 text-white" title="Allowed in PRO plan">
                                    PREMIUM
                                </span>
                            </div>

                        </div>
                        <p class="text-xs text-gray-500 mt-2 max-w-md">
                            Customize the body of the notification email using the editor below.
                        </p>
                    </div>
                    <div class="w-full mt-4">
                        <div class="js_tiptap_editor" min-height="20rem" max-height="50rem" show-youtube-button="0" editable="0">
                            <template>
                                <div>
                                    <div class="flex items-center p-2 text-xs bg-gray-100 border border-b-0 border-gray-200 rounded rounded-b-none">
                                        <div class="mr-1 text-center lg:mr-5">
                                            <button tabindex="-1" type="button" class="px-3 py-2 border border-gray-300 rounded shadow-sm ">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <g fill="none" fill-rule="evenodd">
                                                        <rect width="24" height="24"></rect>
                                                        <path fill="#222" fill-rule="nonzero" d="M12.5,11 C13.8807119,11 15,9.88071187 15,8.5 C15,7.11928813 13.8807119,6 12.5,6 L10,6 L10,11 L12.5,11 Z M15.7564372,11.6057507 C17.0979396,12.384734 18,13.8370232 18,15.5 C18,17.9852814 15.9852814,20 13.5,20 L6,20 C6,19.3412452 6,19.5522847 6,19 C6,18.4477153 6,18.7690116 6,18 L8,18 L8,6 L6,6 L6,4 L12.5,4 C14.9852814,4 17,6.01471863 17,8.5 C17,9.7043145 16.5269107,10.7981331 15.7564372,11.6057507 Z M12.5,13 L10,13 L10,18 L13.5,18 C14.8807119,18 16,16.8807119 16,15.5 C16,14.1192881 14.8807119,13 13.5,13 L12.5,13 Z"></path>
                                                    </g>
                                                </svg>
                                            </button>
                                            <button tabindex="-1" type="button" class="px-3 py-2 border border-gray-300 rounded shadow-sm ">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <g fill="none" fill-rule="evenodd">
                                                        <rect width="24" height="24"></rect>
                                                        <path fill="#222" fill-rule="nonzero" d="M15.0505677,6 L11.1864113,18 L13,18 L13,20 L7,20 L7,18 L9.08527599,18 L12.9494323,6 L11,6 L11,4 L17,4 L17,6 L15.0505677,6 Z"></path>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="mr-1 text-center lg:mr-5">
                                            <button tabindex="-1" type="button" class="px-3 py-2 text-gray-500 bg-white border border-gray-300 rounded shadow-sm hover:text-gray-800 hover:bg-gray-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="mr-1 text-center lg:mr-5">
                                            <button tabindex="-1" type="button" class="px-3 py-2 text-gray-500 bg-white border border-gray-300 rounded shadow-sm hover:text-gray-800 hover:bg-gray-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 24 24" class="w-4 h-4">
                                                    <path d="M21,5c0,0-3-1-9-1S3,5,3,5s-1,3-1,7s1,7,1,7s3,1,9,1s9-1,9-1s1-3,1-7S21,5,21,5z M10,15.464V8.536L16,12L10,15.464z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="flex items-center p-2 text-xs bg-gray-100 border border-b-0 border-gray-200 rounded rounded-b-none">
                                        <div>
                                            <div class="relative flex items-center w-full">
                                                <input type="text" placeholder="https://buildmyform.com" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                                                <button type="button" class="rounded ml-2 bg-gray-600 px-2 py-2 font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"></path>
                                                    </svg>
                                                </button>
                                                <button type="button" class="rounded ml-2 bg-white px-2 py-2 font-semibold text-gray-700 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center p-2 text-xs bg-gray-100 border border-b-0 border-gray-200 rounded rounded-b-none">
                                        <div>
                                            <div class="relative flex items-center w-full">
                                                <input type="text" placeholder="https://youtube.com/watch?v=xvFZjo5PgG0" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                                                <button type="button" class="rounded ml-2 bg-gray-600 px-2 py-2 font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"></path>
                                                    </svg>
                                                </button>
                                                <button type="button" class="rounded ml-2 bg-white px-2 py-2 font-semibold text-gray-700 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <div>
                                <div class="flex items-center p-2 text-xs bg-gray-100 border border-b-0 border-gray-200 rounded rounded-b-none" style="position: relative;">
                                    <div class="mr-1 text-center lg:mr-5">
                                        <button tabindex="-1" type="button" class="px-3 py-2 border border-gray-300 rounded shadow-sm bg-white text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <g fill="none" fill-rule="evenodd">
                                                    <rect width="24" height="24"></rect>
                                                    <path fill="#222" fill-rule="nonzero" d="M12.5,11 C13.8807119,11 15,9.88071187 15,8.5 C15,7.11928813 13.8807119,6 12.5,6 L10,6 L10,11 L12.5,11 Z M15.7564372,11.6057507 C17.0979396,12.384734 18,13.8370232 18,15.5 C18,17.9852814 15.9852814,20 13.5,20 L6,20 C6,19.3412452 6,19.5522847 6,19 C6,18.4477153 6,18.7690116 6,18 L8,18 L8,6 L6,6 L6,4 L12.5,4 C14.9852814,4 17,6.01471863 17,8.5 C17,9.7043145 16.5269107,10.7981331 15.7564372,11.6057507 Z M12.5,13 L10,13 L10,18 L13.5,18 C14.8807119,18 16,16.8807119 16,15.5 C16,14.1192881 14.8807119,13 13.5,13 L12.5,13 Z"></path>
                                                </g>
                                            </svg>

                                        </button>
                                        <button tabindex="-1" type="button" class="px-3 py-2 border border-gray-300 rounded shadow-sm bg-white text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <g fill="none" fill-rule="evenodd">
                                                    <rect width="24" height="24"></rect>
                                                    <path fill="#222" fill-rule="nonzero" d="M15.0505677,6 L11.1864113,18 L13,18 L13,20 L7,20 L7,18 L9.08527599,18 L12.9494323,6 L11,6 L11,4 L17,4 L17,6 L15.0505677,6 Z"></path>
                                                </g>
                                            </svg>

                                        </button>

                                    </div>

                                    <div class="mr-1 text-center lg:mr-5">
                                        <button tabindex="-1" type="button" class="px-3 py-2 text-gray-500 bg-white border border-gray-300 rounded shadow-sm hover:text-gray-800 hover:bg-gray-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="mr-1 text-center lg:mr-5" style="display: none;">
                                        <button tabindex="-1" type="button" class="px-3 py-2 text-gray-500 bg-white border border-gray-300 rounded shadow-sm hover:text-gray-800 hover:bg-gray-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 24 24" class="w-4 h-4">
                                                <path d="M21,5c0,0-3-1-9-1S3,5,3,5s-1,3-1,7s1,7,1,7s3,1,9,1s9-1,9-1s1-3,1-7S21,5,21,5z M10,15.464V8.536L16,12L10,15.464z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="flex items-center p-2 text-xs bg-gray-100 border border-b-0 border-gray-200 rounded rounded-b-none" style="display: none; position: relative;">
                                    <div>
                                        <div class="relative flex items-center w-full">
                                            <input type="text" placeholder="https://buildmyform.com" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">

                                            <button type="button" class="rounded ml-2 bg-gray-600 px-2 py-2 font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"></path>
                                                </svg>
                                            </button>
                                            <button type="button" class="rounded ml-2 bg-white px-2 py-2 font-semibold text-gray-700 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center p-2 text-xs bg-gray-100 border border-b-0 border-gray-200 rounded rounded-b-none" style="display: none; position: relative;">
                                    <div>
                                        <div class="relative flex items-center w-full">
                                            <input type="text" placeholder="https://youtube.com/watch?v=xvFZjo5PgG0" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                                            <button type="button" class="rounded ml-2 bg-gray-600 px-2 py-2 font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"></path>
                                                </svg>
                                            </button>
                                            <button type="button" class="rounded ml-2 bg-white px-2 py-2 font-semibold text-gray-700 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div data-editable="0" class="overflow-auto text-sm md:text-base text-gray-700">
                                <div contenteditable="false" translate="no" class="tiptap ProseMirror">
                                    <p>Hi,<br><br>Your form <span class="bg-blue-100 text-blue-700 border border-blue-100 rounded-md px-2 py-1.5 cursor-pointer text-xs" data-type="mention" data-id="formName" data-label="Form Name" contenteditable="false">@Form Name</span> just received a new submission.<br><br>Here are the details:<br><br><span class="bg-blue-100 text-blue-700 border border-blue-100 rounded-md px-2 py-1.5 cursor-pointer text-xs" data-type="mention" data-id="allAnswers" data-label="All Answers" contenteditable="false">@All Answers</span> <br><br>You can <a target="_blank" rel="noopener noreferrer nofollow" class="underline cursor-pointer" :href="'https://buildmyform.com/responses/' + page.props.form.id">View all submissions here</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>

        </div>
        <div class="mt-6 space-y-3" v-else>
            <div class="flex items-center justify-between p-4 border border-gray-100 rounded-md">
                <div>
                    <div class="flex items-center space-x-2">
                        <h4>
                            Send email to respondent
                        </h4>
                    </div>
                    
                    <p class="text-xs text-gray-500 mt-2 max-w-md">
                        Send a customized email to the respondent when they submit the form.
                    </p>
                </div>
                <div>
                    <div @open-email-notification-modal.window="handleOpen()" @keyup.escape.window="handleClose()" @close-email-notification-modal.window="handleClose()" @notification-emails-updated.window="handleNotificationEmailsUpdate" class="z-100" aria-modal="true" style="display: none;">
                        <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute z-20 inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                <!--        <div class="absolute inset-0 z-30 overflow-y-auto">
                            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-5 sm:w-full sm:max-w-4xl mx-4">

                                    <div class="bg-white px-4 pt-5 pb-4 sm:px-14 sm:py-8">
                                        <a href="#" @click.prevent="handleClose()" class="absolute top-4 right-4 block p-4 ">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </a>

                                        <h4 class="text-lg font-semibold text-center">
                                            Email Notification
                                        </h4>
                                        <div class="mt-6 max-w-lg mx-auto">
                                            <div class="w-full">
                                                <label for="to-emails" class="block text-sm font-medium text-gray-700">
                                                    To
                                                    <p class="text-gray-500 font-normal text-xs inline-block">
                                                        (Who will receive the notifications? Maximum
                                                        <span x-text="maxEmails">5</span>)
                                                    </p>
                                                </label>
                                                <div class="mt-1">
                                                    <tags class="tagify  block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" tabindex="-1">
                                                        <tag title="cade25wilson@gmail.com" contenteditable="false" spellcheck="false" tabindex="-1" class="tagify__tag tagify--noAnim" value="cade25wilson@gmail.com">
                                                            <x title="" tabindex="-1" class="tagify__tag__removeBtn" role="button" aria-label="remove tag"></x>
                                                            <div><span class="tagify__tag-text">cade25wilson@gmail.com</span></div>
                                                        </tag><span contenteditable="" tabindex="0" data-placeholder="Add multiple emails" aria-placeholder="Add multiple emails" class="tagify__input" role="textbox" aria-autocomplete="both" aria-multiline="false"></span>
                                                        &ZeroWidthSpace;
                                                    </tags><input wire:ignore="" type="text" value="cade25wilson@gmail.com" x-ref="toEmails" name="to-emails" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" tabindex="-1">
                                                </div>
                                            </div>

                                            <div class="w-full mt-8 pb-8 flex justify-center">
                                                <button type="button" @click="save" class="rounded-md bg-gray-700 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-600 w-full">
                                                    <span wire:loading.remove="" style="display: inline-block;">
                                                        Save →
                                                    </span>
                                                    <span wire:loading="" style="display: none;">
                                                        ...
                                                    </span>
                                                </button>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>-->
                    </div>
                    <div>
                        <div class="flex items-center justify-end space-x-1">
                            <label class="inline-flex items-center  cursor-pointer ">
                                <input type="checkbox" :checked="page.props.form.email_settings.email_form_filler" @change="handleChange('email_form_filler', page.props.form.email_settings.email_form_filler)" class="sr-only peer" v-if="page.props.isPro">
                                <input type="checkbox" class="sr-only peer" disabled v-else>
                                <div class="relative w-11 h-6 peer-focus:outline-none peer-focus:ring-0 peer-focus:ring-green-300 rounded-full peer bg-gray-400 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-green-500"></div>
                            </label>
                        </div> 
                    </div> 

                </div> 
            </div>
            <div class="space-y-3 relative group">

                <div v-if="!page.props.form.email_form_filler" class="absolute inset-0 bg-gray-100 bg-opacity-0 flex items-center justify-center z-10 group-hover:bg-opacity-55 cursor-not-allowed">
                    <div class="bg-black text-white text-xs rounded py-1 px-2 hidden group-hover:block">
                        Please enable email sending from the above toggle first.
                    </div>
                </div>

                <div class="flex items-center justify-between p-4 border border-gray-100 rounded-md">
                    <div>
                        <div class="flex items-center space-x-2">
                            <h4>
                                To
                            </h4>
                        </div>
                        <p class="text-xs text-gray-500 mt-2 max-w-md">
                            Choose an email block from your form and we will send email to that email address when the form is submitted.
                        </p>
                    </div>
                    <div>
                        <select @change="handleSelectChange('form_filler_email', $event)" 
                        :disabled="!page.props.isPro"
                         class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-gray-600 sm:text-sm sm:leading-6">
                            <option value="null">-- Select an email block from the form --</option>
                            <option v-for="email in page.props.has_email_block" :value="email.id">{{email.label}}</option>
                        </select>
                    </div>
                </div>

                <div class="p-4 border border-gray-100 rounded-md flex justify-between">
                    <div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <h4>
                                    From Name
                                </h4>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2 max-w-md">
                            Customize the sender name. Currently sender email is <em>notifications@buildmyform.com</em> and it's not possible to change at the moment. We will soon add a custom SMTP feature for this. You can upvote the feature <a class="text-blue-600" target="_blank">here</a>.
                        </p>
                    </div>
                    <div class="w-80 mt-4">
                        <input v-model="page.props.form.email_settings.from_name" @keyup.enter="handleChange('from_name', page.props.form.email_settings.from_name)" @blur="handleChange('from_name', page.props.form.email_settings.from_name)" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" >
                    </div>
                </div>

                <div class="p-4 border border-gray-100 rounded-md">
                    <div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <h4>
                                    Email Subject
                                </h4>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2 max-w-md">
                            Customize the subject of the notification email.
                        </p>
                    </div>
                    <div class="w-full mt-4">
                        <input type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" placeholder="Your subject here...">
                    </div>
                </div>

                
            </div>

        </div>
    </div>

</div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const selectedEmail = ref('me');
const page = usePage();

async function handleChange(item, value) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const response = await fetch(`/emailsettings/update/${page.props.form.email_settings.id}`, {
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

async function handleSelectChange(item, event) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const response = await fetch(`/emailsettings/update/${page.props.form.email_settings.id}`, {
        method: 'PUT',
        headers: {
            'Content-type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            'input': item,
            'value': event.target.value
        })
    });

    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
}
</script>

<style scoped>
.js_tiptap_editor .ProseMirror {
    padding: 1rem;
    border: 1px solid #E5E7EB;
    min-height: 20rem;
    max-height: 50rem;
    border-radius: 0 0 0.25rem 0.25rem;
    overflow: auto;
    font-size: 0.9rem;
    outline: #000000;
}

.js_tiptap_editor .ProseMirror h1 {
    font-size: 2em;
}

.js_tiptap_editor .ProseMirror ul {
    list-style-type: disc;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    padding-inline-start: 40px;
}

.js_tiptap_editor .ProseMirror code {
    padding: 0.25rem !important;
    border-radius: 0.25rem;
    --tw-bg-opacity: 1;
    background-color: rgba(251, 207, 232, var(--tw-bg-opacity));
}

.js_tiptap_editor .ProseMirror .data-variable {
    padding: 0.3rem;
    background-color: rgba(252, 231, 243, var(--tw-bg-opacity));
    border-radius: 0.25rem;
}

.subject-line {
    --tag-bg: #FCE7F3;
    --tag-hover: #FCE7F3;
}
</style>
