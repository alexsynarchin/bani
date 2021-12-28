<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Cabinet;
use App\Models\Place;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function index(Request $request)
    {
        $date = json_decode($request-> get('date'));
        $date = $date -> date;
        $places = Place::whereHas('reservations', function($query) use ($date) {
            $query->where('date', $date);
            $query->whereHas('order', function($query){
                $query->where('status', 'success');
            });
        }) -> with(['reservations' => function($query) use ($date){
            $query->where('date', $date);
            $query->whereHas('order', function($query){
                $query->where('status', 'success');
            });
            $query->with('order.client');
        }]) -> get();
        $cabinets = Cabinet::whereHas('reservations', function($query) use ($date){
            $query->where('date', $date);
            $query->whereHas('order', function($query){
                $query -> where('status', 'success');
            } );

        }) -> with(['reservations' => function($query) use ($date){
            $query->where('date', $date);
            $query->whereHas('order', function($query){
                $query->where('status', 'success');
            });
            $query->with('order.client');
        }]) -> get();
        return ['places' => $places, 'cabinets' => $cabinets];
    }
}
