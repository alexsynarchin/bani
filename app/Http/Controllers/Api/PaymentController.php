<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function paymentResult(Request $request)
    {
        $data = array(
            'userName' => env('ALFA_USERNAME'),
            'password' => env('ALFA_PASSWORD'),
            'orderId' => $request->get('order_id')
        );
        $text = '';
        $order = Order::where('alfa_order_id', $request->get('order_id')) -> firstOrFail();
        $alfa_pay = new PaymentService();
        $response = $alfa_pay->gateway('getOrderStatus.do', $data);
        if($response['ErrorCode'] != 0) {
            $text = $response['ErrorMessage'];
            $order -> status = 'cancelled';
        } else {
            $order -> status = 'success';
            $text = "Ваш заказ №". $order->id . ' успешно оплачен';
        }
        $order -> save();
        return $text;
    }
}
