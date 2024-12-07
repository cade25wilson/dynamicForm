<template>
    <div class="space-y-4">
        <div>
            Connect to Stripe&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="/connect" v-if="!page.props.auth.user.stripe_account_id">
                <button
                    type="button"
                    class="inline-flex items-center px-4 py-2 mt-8 border border-transparent text-base font-medium rounded-md text-white bg-gray-700 focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-gray-500"
                >
                    Connect
                </button>
            </a>
            <a href="/connect" v-else>
                <button
                    type="button"
                    class="inline-flex items-center px-4 py-2 mt-8 border border-transparent text-base font-medium rounded-md text-white bg-gray-700 focus:outline-none focus:ring-0 focus:ring-offset-0 focus:ring-gray-500"
                >
                    Change Account
                </button>
            </a>
        </div>

        <!-- Dropdown and Input -->
        <div class="flex items-center space-x-4 mt-6">
            <div>
                <label for="currency" class="block text-sm font-medium text-gray-700">
                    Currency
                </label>
                <select
                    id="currency"
                    v-model="page.props.current_section.options.currency"
                    class="mt-1 block w-40 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm"
                    @change="handleBlur('currency', page.props.current_section.options.currency)"
                >
                    <option value="EUR">EUR</option>
                    <option value="GBP">GBP</option>
                    <option value="USD">USD</option>
                    <option value="AUD">AUD</option>
                    <option value="CAD">CAD</option>
                    <option value="CHF">CHF</option>
                    <option value="NOK">NOK</option>
                    <option value="SEK">SEK</option>
                    <option value="DKK">DKK</option>
                    <option value="MXN">MXN</option>
                    <option value="NZD">NZD</option>
                    <option value="BRL">BRL</option>
                </select>
            </div>
            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700">
                    Amount
                </label>
                <input
                    type="number"
                    id="amount"
                    v-model="page.props.current_section.options.amount"
                    placeholder="Enter amount"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm"
                    pattern="^\d*(\.\d{0,2})?$"
                    min="0"
                    step="0.01"
                    @blur="handleBlur('amount', page.props.current_section.options.amount)"
                    @input="validateAmount"
                />
            </div>
        </div>
    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';

const page = usePage();

function validateAmount(event) {
    // const value = event.target.value;
    const value = event.target.value;
    // Match up to two decimal places
    const regex = /^\d*\.?\d{0,2}$/;
    if (!regex.test(value)) {
        event.target.value = value.slice(0, -1);
    }
    // const validValue = Math.max(0, parseFloat(value).toFixed(2)); // Ensure non-negative and 2 decimal places
    // event.target.value = validValue; // Update input value
    // page.props.current_section.options.amount = validValue; // Sync with model
}

async function handleBlur(type, value) {
    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        await fetch(`/section/payment/${page.props.current_section.id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                type: type,
                value: value
            })
        });
    } catch (error) {
        console.error('Error:', error);
    }
}
</script>
