<?php

namespace App\Http\Controllers;

use App\Models\FormSection;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function paymentintent(string $id)
    {
        try{
            $formSection = FormSection::with('form.user')
                ->where('id', $id)
                ->firstOrFail();
            
            $options = json_decode($formSection->options, true);
            $amount = $options['amount'];

            // Truncate the value to two decimal places by flooring the number
            $formattedAmount = floor($amount * 100) / 100;
            Stripe::setApiKey(env('STRIPE_SECRET'));
            
            $paymentIntent = PaymentIntent::create([
                'amount' => $formattedAmount * 100, // Amount in cents
                'currency' => $options['currency'], // e.g., "usd"
                'transfer_data' => [
                    'destination' => $formSection->form->user->stripe_account_id,
                ],
            ]);
            return response()->json([
                'client_secret' => $paymentIntent->client_secret,
            ]);
        } catch(Exception $e){
            Log::error($e);
            return response(null, 500);
        }
    }
}
