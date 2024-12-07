<template>
    <div>
        <CoverImage v-if="page.props.current_section.background_image != null" />
        <FormSectionName />
        <FormSectionDescription />
        <div class="mt-6">
            <div class="w-full">
                <div>
                    Your credit card will be charged: ${{ page.props.current_section.options.amount }}<br>
                    We never store your card number or CVC number                    
                </div>
            </div>
        </div>

        <!-- Card Input Form -->
        <div class="payment-form">
            <h2 class="title">Secured by <span class="stripe-logo">Stripe</span></h2>
            <div class="card-container">
            <div id="card-element" class="stripe-input"></div>
            </div>
            <button class="submit-button" @click="handlePayment">Pay</button>
        </div>

    </div>
</template>

<script setup>

import { ref } from "vue";
import { loadStripe } from "@stripe/stripe-js";
import { usePage } from "@inertiajs/vue3";
import CoverImage from "./CoverImage.vue";
import FormSectionName from "./FormSectionName.vue";
import FormSectionDescription from "./FormSectionDescription.vue";

const page = usePage();
const stripePromise = loadStripe("pk_test_51Q1sZDKy0dYEsuj8JRmbuCo3JRnTgQgOZaYDuDMNwP51p1qNB5ylYvAxcVOtlqrQYrbBN4fqgU2n5t8m9nYrzyOV00DdaV3gTX");
const cardElement = ref(null);
const clientSecret = ref(null);

const setupStripe = async () => {
  await fetchClientSecret();
  const stripe = await stripePromise;
  const elements = stripe.elements();

  const style = {
    base: {
      color: "#32325d",
      fontFamily: "'Roboto', sans-serif",
      fontSize: "16px",
      "::placeholder": {
        color: "#aab7c4",
      },
    },
    invalid: {
      color: "#fa755a",
    },
  };

  cardElement.value = elements.create("card", { style });
  cardElement.value.mount("#card-element");
};

const handlePayment = async () => {
  return;
  // const stripe = await stripePromise;

  // try {
  //   const { error, paymentIntent } = await stripe.confirmCardPayment(clientSecret.value, {
  //     payment_method: {
  //       card: cardElement.value,
  //     },
  //   });

  //   if (error) {
  //     console.error("Payment error:", error.message);
  //   } else {
  //     console.log("Payment successful:", paymentIntent);
  //   }
  // } catch (err) {
  //   console.error("Stripe error:", err);
  // }
};


const fetchClientSecret = async () => {
  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const response = await fetch(`/payment-intent/${page.props.current_section.id}`, {
      method: 'POST',
      headers: { 
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
       },
    });
    const data = await response.json();
    clientSecret.value = data.client_secret;
  } catch (error) {
    console.error('Failed to fetch clientSecret:', error);
  }
};

setupStripe();
</script>

<style scoped>
.payment-section {
  max-width: 500px;
  margin: 40px auto;
  padding: 20px;
  background: #f9fafb;
  border-radius: 10px;
  box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
}

.form-header h3 {
  font-size: 18px;
  font-weight: 600;
  color: #4a5568;
  margin-bottom: 10px;
}

.form-header p {
  font-size: 14px;
  color: #718096;
  margin-bottom: 20px;
}

.payment-form {
  background: #ffffff;
  padding: 20px;
  border-radius: 8px;
  border: 1px solid #e2e8f0;
}

.title {
  font-size: 16px;
  color: #2d3748;
  margin-bottom: 15px;
}

.stripe-logo {
  color: #6772e5;
  font-weight: bold;
}

.card-container {
  padding: 15px;
  background: #f7fafc;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  margin-bottom: 20px;
}

.stripe-input {
  height: 50px;
}

.submit-button {
  width: 100%;
  background: #32325d;
  color: #fff;
  border: none;
  border-radius: 6px;
  padding: 12px 16px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.3s;
}

.submit-button:hover {
  background: #43458b;
}

.submit-button:active {
  background: #232659;
}

.submit-button:disabled {
  background: #a0aec0;
  cursor: not-allowed;
}
</style>