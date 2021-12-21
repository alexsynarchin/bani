<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;


class PlaceController extends Controller
{
    public function index(Request $request, $floor) {
        $places = Place::where('floor', $floor) -> get();
        foreach ($places as $place) {
            $place -> reserved = false;
           $reservations = $place ->reservations()
               ->whereDate('date', '=', $request->get('date'))
               ->whereTime('start', '<=', \Carbon\Carbon::parse($request->get('startDate')))
               -> whereTime('end' , '>', \Carbon\Carbon::parse($request->get('startDate'))->addMinutes(30))
               ->whereHas('order', function ($query) {
               $query->where('status','success');
           }) -> get();
           if(count($reservations) > 0) {
               $place -> reserved = true;
           }
        }
        return $places;
    }
}
