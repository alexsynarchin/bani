<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'start', 'end', 'reservationable_type, reservationable_id', 'date'];
    protected $appends = [
        'status',
    ];
    public function order()
    {
        return $this -> belongsTo(Order::class, 'order_id');
    }

    public function reservationable()
    {
        return $this->morphTo();
    }
    public function getStatusAttribute()
    {
        return $this -> order -> status;
    }
}
