<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use Braintree\Gateway;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // FUNCTION PER GENERARE TOKEN
    public function generate(Request $request, Gateway $gateway)
    {
        // ASSEGNIAMO TOKEN 
        $token = ($gateway->clientToken()->generate());

        $data = [
            'token' => $token
        ];
        // VISUALIZZAZIONE TOKEN 
        return response()->json($data, 200);
    }
    // FUNCTION PER FARE IL PAGAMENTO
    public function makepayment(StoreOrderRequest $request, Gateway $gateway)
    {
        // GENERIAMO IL PAGAMENTO
        $result = $gateway->transaction()->sale([
            // TOKEN PRESO DAL F.END
            'amount' => '10.00',
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
        $data = [
            'success' => false,
            'message' => "",
        ];
        if ($result->success) {
            $data['success'] = true;
            $data['messagge'] = "Transazione avvenuta con successo. ";
            return response()->json($data, 200);
        } else {
            $data['message'] = 'La transazione ha fallito: ';
            $errors = $result->errors->deepAll();

            if (!empty($errors)) {
                // Aggiungi gli errori alla risposta JSON
                $errorMessages = [];
                foreach ($errors as $error) {
                    $errorMessages[] = $error->message;
                }
                $data['errors'] = $errorMessages;
            }

            return response()->json($data, 401);
        }
    }
}