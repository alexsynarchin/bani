<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cabinet;
use Illuminate\Http\Request;

class CabinetController extends Controller
{
    public function index($floor)
    {
        $cabinets = Cabinet::where('floor',$floor)->get();
        return $cabinets;
    }
}
