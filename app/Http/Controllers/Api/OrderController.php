<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cabinet;
use App\Models\Client;
use App\Models\Order;
use App\Models\Place;
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
        $client = Client::updateOrCreate([
            'phone' =>$request->get('client')['phone']
        ], [
            'name' => $request->get('client')['name']
        ]);
        $order = Order::create([
            'status' => 'progress',
            'client_id' => $client -> id,
            'price' => $request->get('reservation')['price']
        ]);
        $reservation_data = [
            'order_id' => $order -> id,
            'start' => $request->get('reservation')['selectedDay'] . ' ' . $request->get('reservation')['startTime'],
            'end' => $request->get('reservation')['selectedDay'] . ' ' . $request->get('reservation')['endTime'],
            'date' => $request->get('reservation')['selectedDay'],
        ];
        foreach ($request->get('reservations') as $reservation_request) {

            if($reservation_request['type'] === 'place') {
                $place = Place::findOrFail($reservation_request['id']);
                $reservation = $place ->reservations() -> create($reservation_data);
            }
            if($reservation_request['type'] === 'cabinet') {
                $cabinet = Cabinet::findOrFail($reservation_request['id']);
                $reservation = $cabinet ->reservations() -> create($reservation_data);
            }
        }
        $data = array(
            'userName' => env('ALFA_USERNAME'),
            'password' => env('ALFA_PASSWORD'),
            'orderNumber' => $order->id,
            'amount' => 1,//$request->get('reservation')['price'] * 100,
            'returnUrl' => env('ALFA_RETURN_URL')
        );
        $alfa_pay = new PaymentService();
        $response = $alfa_pay -> gateway('register.do', $data);
        $order -> alfa_order_id = $response['orderId'];
        $order -> save();
        return $response;
    }
    public function getOrderInf(Request $request) {
        $data = array(
            'userName' => env('ALFA_USERNAME'),
            'password' => env('ALFA_PASSWORD'),
            'orderId' => $request->get('order_id')
        );
        $alfa_pay = new PaymentService();
        $response = $alfa_pay -> gateway('getOrderStatus.do', $data);
        return $response;
    }
}
