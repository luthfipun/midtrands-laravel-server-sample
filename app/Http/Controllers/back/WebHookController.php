<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaymentHistory;
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
}
