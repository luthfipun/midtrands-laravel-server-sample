<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaymentHistory;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class WebHookController extends Controller
{
    public function index(Request $request){

        if (!$request){
            return $this->respondError(500, 'empty field data');
        }

        $ph = PaymentHistory::insert($request);

        Order::where('id', $request['order_id'])->update([
            'payment_id' => $ph->id,
            'status' => $request['status_code'] == '200' ? 'done' : 'cancel'
        ]);

        return $this->respondOK();
    }

    public function charge(Request $request){

        if (!$request){
            return $this->respondError(204, 'field not found');
        }

        // save to order database

        $productId = $request->get('item_details')[0]['id'];
        $total = $request->get('transaction_details')['gross_amount'];

        $order = Order::create([
            'product_id' => $productId,
            'total' => $total,
            'status' => 'pending'
        ]);

        $request->merge([
            'transaction_details' => [
                'order_id' => $order->id,
                'currency' => $request->get('transaction_details')['currency'],
                'gross_amount' => $request->get('transaction_details')['gross_amount'],
            ]
        ]);

        $midtrans = $this->sendToMidtransServer($request->json()->all());

        if ($midtrans != null){
            return $midtrans;
        }else {
            return $this->respondError(500, 'Error from midtrans servers');
        }
    }

    private function sendToMidtransServer($data){

        $midtransUrl = env('MIDTRANS_URL', '');
        $midtransKey = env('MIDTRANS_KEY', '');

        $client = new Client(['base_uri' => $midtransUrl]);
        $res = $client->request('POST', 'snap/v1/transactions', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic '.base64_encode($midtransKey.':').''
            ],
            'json' => $data
        ]);

        if ($res->getStatusCode() == 201){
            return json_decode($res->getBody(), TRUE);
        }else {
            return null;
        }
    }
}
