<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order(Request $request)
    {
        $request -> validate([
            'client.name' =>'required',
            'client.phone' => 'required'
        ], [
            'client.name.required' => 'Введите ваше имя',
            'client.phone.required' => 'Введите ваш телефон',
        ]);
        $data = array(
            'userName' => env('ALFA_USERNAME'),
            'password' => env('ALFA_PASSWORD'),
            'orderNumber' => 3,
            'amount' => 400,
            'returnUrl' => 'http://bani.loc'
        );
        $alfa_pay = new PaymentService();
        $response = $alfa_pay -> gateway('register.do', $data);
        return $response;
    }
}
