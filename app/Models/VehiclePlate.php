<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehiclePlate extends Model
{
    protected $table = 'vehicle_plates';

    protected $fillable = [
        'numbers', 
        'letters',
        'is_settled'
    ];
}
