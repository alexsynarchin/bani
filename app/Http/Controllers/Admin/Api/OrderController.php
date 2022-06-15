<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', '!=', 'progress')->with('reservations.reservationable')->orderBy('created_at','DESC')->get();
        foreach ($orders as $order) {
            if($order->reservations()->exists()) {
                $order -> date = Carbon::parse($order -> reservations[0]['date']) -> format('d-m-y');
                $order -> start = Carbon::parse($order -> reservations[0]['start']) -> format('H:i');
                $order -> end = Carbon::parse($order -> reservations[0]['end']) -> format('H:i');
            }

        }
        return $orders;
    }
}
