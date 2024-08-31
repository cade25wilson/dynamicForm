<template>
    <div class="mt-6">
        <div>
            <label class="block text-sm font-medium leading-6 text-gray-900">Schedule with</label>
            <select v-model="page.props.current_section.form_fields[0].options.schedule_provider" @change="updatePlatform()" name="schedulerPlatform" class="mt-1 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-gray-600 sm:text-sm sm:leading-6">
              <option value="Calendly">Calendly</option>
              <option value="Cal.com">Cal.com</option>
              <option value="SavvyCal">SavvyCal</option>
            </select>
        </div>         
    </div>

    <div class="mt-6">
        <div class="flex items-center justify-between">
            <label for="date-cta-text-editor-2cfa8b5f-5f14-4f48-a549-69d9c884d7f1" class="block text-sm font-medium text-gray-700">
                {{page.props.current_section.form_fields[0].options.schedule_provider}} link
            </label>
            <a href="https://youform.com/blog/calendly-integration-in-youform-cly3306z9001x52otg0px4jer" target="_blank" class="text-xs font-semibold text-blue-800">
                What's this?
            </a>
        </div>
        <div class="mt-1">
            <input type="text" v-model="page.props.current_section.form_fields[0].options.schedule_link" @blur="updatePlatformLink()" @keyup.enter="updatePlatformLink()" name="date-cta-text-editor-2cfa8b5f-5f14-4f48-a549-69d9c884d7f1" id="date-cta-text-editor-2cfa8b5f-5f14-4f48-a549-69d9c884d7f1" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm" placeholder="https://calendly.com/username">
        </div>
    </div>

    <div class="mt-6">
        <label for="date-cta-text-editor-2cfa8b5f-5f14-4f48-a549-69d9c884d7f1" class="block text-sm font-medium text-gray-700">Calendar Opener Text</label>
        <div class="mt-1">
            <input type="text" v-model="page.props.current_section.form_fields[0].label" @blur="updateOpenerBtnText()" @keyup.enter="updateOpenerBtnText()" name="date-cta-text-editor-2cfa8b5f-5f14-4f48-a549-69d9c884d7f1" id="date-cta-text-editor-2cfa8b5f-5f14-4f48-a549-69d9c884d7f1" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm" placeholder="Choose a slot">
        </div>
    </div>


</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
const page = usePage();

function updatePlatform(){
    fetch(`/field/schedule/platform/${page.props.current_section.form_fields[0].id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            schedule_provider: page.props.current_section.form_fields[0].options.schedule_provider
        })
    });
}

function updatePlatformLink(){
    fetch(`/field/schedule/link/${page.props.current_section.form_fields[0].id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            schedule_link: page.props.current_section.form_fields[0].options.schedule_link
        })
    });
}

function updateOpenerBtnText(){
    fetch(`/field/label/${page.props.current_section.form_fields[0].id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            label: page.props.current_section.form_fields[0].label
        })
    });
}   
</script>