<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index($floor) {
        $places = Place::where('floor', $floor) -> get();
        return $places;
    }
}
