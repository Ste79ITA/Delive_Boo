<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderRequest;
use Braintree\Gateway;
use Illuminate\Http\Request;



class PaymentController extends Controller
{
    public function generate(Request $request, Gateway $gateway)
    {
        $token = $gateway->clientToken()->generate();

        $data = [
            'token' => $token
        ];

        return response()->json([
            'success' => true,
            'messaggio' => 'Invio Token',
            'data' => $data

        ]);
    }
    public function makePayment(OrderRequest $request, Gateway $gateway)
    {
        $result = $gateway->transaction()->sale([
            'amount' => $request->amount,
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $data = [
                'success' => true,
                'message' => 'Transazione eseguita con Successo!'
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'success' => false,
                'message' => 'Transazione Fallita!'
            ];

            return response()->json($data, 401);
        }
    }
}
