<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function paymentResult(Request $request)
    {
        $order = Order::where('alfa_order_id', $request->get('order_id')) -> firstOrFail();
        $order -> status = 'success';
        $order -> save();
        $text = "Ваш заказ №". $order->id . ' успешно оплачен';
        return $text;
    }
}
