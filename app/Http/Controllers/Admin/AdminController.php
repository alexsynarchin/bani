<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.home.index');
    }

    public function orders()
    {
        $orders = Order::where('status', '!=', 'progress')->with('reservations.reservationable')->get();
        foreach ($orders as $order) {
            $order -> date = Carbon::parse($order -> reservations[0]['date']) -> format('d-m-y');
            $order -> start = Carbon::parse($order -> reservations[0]['start']) -> format('H:i');
            $order -> end = Carbon::parse($order -> reservations[0]['end']) -> format('H:i');
        }
        return $orders;
    }
}
