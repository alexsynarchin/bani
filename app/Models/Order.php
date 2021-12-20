<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['client_id', 'status'];
    public function client()
    {
        return $this -> belongsTo('App/Models/Client', 'client_id');
    }

    public function reservations()
    {
        return $this -> hasMany('App/Models/Reservation', 'order_id');
    }
}
