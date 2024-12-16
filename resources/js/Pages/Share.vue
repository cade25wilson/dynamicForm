<template>
    <FormLayout title="Share">
        <div class="py-10">
    <div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
        <div class=" flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="bg-white rounded-md shadow-md border border-gray-200 py-10 md:px-6 lg:px-8 mx-auto">
                    <div class="flex items-center mt-2">
                        <input type="text" :value="`https://buildmyform.com/forms/${page.props.form.id}`" readonly="" class="block w-80 rounded-md rounded-r-none border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                        <button @click="copyPageUrl()" class="flex items-center rounded-md rounded-l-none border border-transparent bg-gray-600 px-4 py-1.5 text-sm font-medium text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184"></path>
                            </svg>   
                            &nbsp;                                   
                            Copy Link
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 py-1 px-1">
                        Make sure your form is published before you share it to the world.
                    </p>
                    <div class="mt-6">
                        <a href="#" @click.prevent="$dispatch('open-qr-code-modal')" class="inline-block p-1">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z"></path>
                          </svg>
                        </a>
                    </div>

                    <div class="mt-10 border-t border-gray-200 pt-10">
                      <div class="flex items-center">
                        <div class="flex items-center">
                          <h4 class="font-semibold text-gray-700">
                            Embed in your website as
                          </h4>
                          <div>
                            <select v-model="selection" class="ml-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-gray-600 sm:text-sm sm:leading-6">
                              <option value="inlineembed">Inline embed</option>
                              <option value="popup">Popup</option>
                              <option value="fullpage">Full page</option>
                            </select>
                          </div>
                        </div>

                        <template>
                          <div class="flex items-center ml-8">
                            <h4 class="font-normal text-gray-700">
                              Select popup position
                            </h4>
                            
                            <div>
                              <select class="ml-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-gray-600 sm:text-sm sm:leading-6">
                                <option value="center">Center (as a modal)</option>
                                <option value="bottom-right">Bottom right</option>
                              </select>
                            </div>
                          </div>
                        </template>
                      </div>
                      <div class="mt-6">
                        <div v-if="selection == 'inlineembed'">
                          <p class="text-sm text-gray-600 leading-loose">
                            Works with WordPress, Squarespace, Wix, Shopify, Webflow, Carrd, and all other website builders.
                            <br>
                            Paste the below code snippet in your page where you want to show it:
                          </p>
                          <div class="mt-2 bg-gray-800 text-white p-6 font-light rounded-md relative">
                            <code class="block mb-2" v-html="embedCode"></code>
                            <button @click="copyEmbedCode" class="absolute right-2 bottom-2">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75"></path>
                              </svg>                                      
                            </button>
                          </div>
                          <p class="text-xs text-gray-600 mt-2">
                            You may change the height according to your need but we recommend it to be at least 600px
                          </p>
                        </div>

                        <div v-if="selection == 'popup'">
                          <p class="text-sm text-gray-600">
                            Paste the below code snippet in the <code>head</code> section of your website:
                          </p>
                          <div class="mt-2 bg-gray-800 text-white p-6 font-light rounded-md relative">
                            <code class="block mb-2">
                              &lt;script src="https://www.buildmyform.com/widgets/widget.js"&gt;&lt;/script&gt;
                            </code>

                            <button @click="copyJSCode" class="absolute right-2 bottom-2">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75"></path>
                              </svg>                                      
                            </button>
                          </div>
                          <p class="text-sm text-gray-600 mt-4">
                            Then you can add the following attribute to any button or anchor tag from which you want to open the popup:
                          </p>

                          <div class="mt-2 bg-gray-800 text-white p-6 font-light rounded-md relative">
                            <code class="block">
                              data-buildmyform-open="{{page.props.form.id}}" 
                              
                              data-buildmyform-position="<span>center</span>" 
                            </code>
                          </div>

                        </div>

                        <div v-if="selection == 'fullpage'">
                          <p class="text-sm text-gray-600">
                            Paste the below code snippet in a new page:
                          </p>
                          <div class="mt-2 bg-gray-800 text-white p-6 font-light rounded-md relative">
                            <code class="block mb-2">
                              &lt;html&gt;  &lt;head&gt;      &lt;meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"&gt;      &lt;title&gt;My Form&lt;/title&gt;      &lt;style type="text/css"&gt;          html { margin: 0; height: 100%; overflow: hidden; }           iframe { position: absolute; top: 0; right: 0; bottom: 0; left: 0; border: 0; }      &lt;/style&gt;  &lt;/head&gt;  &lt;body&gt;      &lt;iframe src="https://app.youform.com/forms/7lkj4fvr" loading="lazy" width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0"&gt;&lt;/iframe&gt;  &lt;/body&gt;&lt;/html&gt;
                            </code>
                            <button @click="copyFullPageCode" class="absolute right-2 bottom-2">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75"></path>
                              </svg>                                      
                            </button>
                          </div>

                        </div>

                      </div>
                    </div>

                    <!-- <div class="mt-10 border-t border-gray-200 pt-10">
                      <div class="flex items-center">
                            <h4 class="font-semibold text-gray-700 mr-2">
                                Custom Domain
                            </h4>
                            <button @click.prevent="$dispatch('open-pro-plan-modal')" class="text-xs py-0.5 px-2 font-normal rounded-md bg-pink-600 text-white cursor-pointer" title="Allowed in PREMIUM plan">
                                PREMIUM
                            </button>
                        </div>
                        <p class="text-sm mt-4 text-gray-500 cursor-pointer" @click.prevent="$dispatch('open-pro-plan-modal')">
                            Please buy a PREMIUM plan to add your own custom domain.
                        </p>
                    </div> -->
                    <!-- <div class="mt-10 border-t border-gray-200 pt-10">
                      <p class="text-sm text-gray-500">
                        To change form Title, share image or favicon go to <a class="text-blue-700 hover:underline">Link Settings</a>
                      </p>
                    </div> -->
                </div>
            </div>
        </div>
    </div>    
</div>
    </FormLayout>
</template>
<script setup>
import FormLayout from '@/Layouts/FormLayout.vue';
import { usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const page = usePage();
const selection = ref('inlineembed');

function copyPageUrl(){
    navigator.clipboard.writeText(`https://buildmyform.com/forms/${page.props.form.id}`); 
}

function copyEmbedCode(){
    navigator.clipboard.writeText(embedCode.value);
}

function copyJSCode(){
	navigator.clipboard.writeText('<script>src="https://www.buildmyform.com/widgets/widget.js"</script');	
}

function copyFullPageCode(){
	navigator.clipboard.writeText(`<html> <head> <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"> <title>My Form</title> <style type="text/css"> html { margin: 0; height: 100%; overflow: hidden; } iframe { position: absolute; top: 0; right: 0; bottom: 0; left: 0; border: 0; } </style> </head> <body> <iframe src="https://www.buildmyform.com/forms/${page.props.form.id}" loading="lazy" width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0"></iframe> </body></html>`);
}

const embedCode = computed(() => {
  return `&lt;iframe src="https://www.buildmyform.com/forms/${page.props.form.id}" loading="lazy" width="100%" height="700" frameborder="0" marginheight="0" marginwidth="0"&gt;&lt;/iframe&gt;`;
});

</script>