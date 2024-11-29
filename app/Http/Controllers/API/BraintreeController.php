<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Http\Controllers\Controller;

class BraintreeController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key'),
        ]);
    }

    // Genera un client token
    public function generateToken()
    {
        $clientToken = $this->gateway->clientToken()->generate();
        return response()->json(['clientToken' => $clientToken]);
    }

    // Gestisce il pagamento
    public function processPayment(Request $request)
    {
        $nonce = $request->input('nonce');
        $amount = $request->input('amount');

        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);

        if ($result->success) {
            return response()->json(['success' => true, 'transaction' => $result->transaction]);
        } else {
            return response()->json(['success' => false, 'error' => $result->message], 500);
        }
    }
}
