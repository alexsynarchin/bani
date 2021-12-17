<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order(Request $request)
    {
        $request -> validate([
            'name' =>'required',
            'phone' => 'required'
        ], [
            'name.required' => 'Введите ваше имя',
            'phone.required' => 'Введите ваш телефон',
        ]);
        return $request->all();
    }
}
