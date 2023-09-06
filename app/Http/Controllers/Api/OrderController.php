<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\Product;
use Braintree\Gateway;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        // STEP 1 RICAVARE PRODOTTI DALLA REQUEST
        $products = $request->input("products");
        $data = $request->input("data");
        $newOrder = new Order();

        // INIZIALIZZO LA VARIABILE PER LA SOMMA
        $totalAmount = 0;
        // CICLO FOR PER RICAVARE IL PRICE DAL DB E CALCOLARE IL TOTAL AMOUNT
        foreach ($products as $product) {
            $productFromDB = Product::findOrFail($product["id"]);
            $totalAmount += $productFromDB->price * $product["quantity"];
        }
        $newOrder->total_amount = $totalAmount;
        $newOrder->fill($data);
        $newOrder->save();
        foreach ($products as $product) {
            // Supponiamo che il campo 'quantity' sia presente nella richiesta per ogni prodotto
            $quantity = $product['quantity'];
            $newOrder->products()->attach([$product['id'] => ['quantity' => $quantity]]);
        }
        $newOrder = Order::with('products')->findOrFail($newOrder->id);

        $data = [
            "order" => $newOrder
        ];

        return response()->json($data, 200);
    }
    // FUNCTION PER GENERARE TOKEN
    public function generate(Request $request, Gateway $gateway)
    {
        // ASSEGNIAMO TOKENk 
        $token = ($gateway->clientToken()->generate());
        $data = [
            'token' => $token
        ];
        // VISUALIZZAZIONE TOKEN 
        return response()->json($data, 200);
    }
    // FUNCTION PER FARE IL PAGAMENTO
    public function makepayment(Request $request, Gateway $gateway)
    {
        // return response()->json($request, 200);
        // CREO UNA VARIABILE PER LA REQUEST DEI DATI
        $data = $request->all();

        $order_found = Order::find($request->order);

        // GENERIAMO IL PAGAMENTO
        $result = $gateway->transaction()->sale([
            // TOKEN PRESO DAL F.END
            'amount' => $order_found->total_amount,
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);


        // VISUALIZZAZIONE RISULTATO TRANSAZIONE
        $data = [
            'success' => false,
            'message' => "",
            'order' => $data['order']
        ];
        if ($result->success) {
            $data['success'] = true;
            $data['message'] = "Transazione avvenuta con successo. ";
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