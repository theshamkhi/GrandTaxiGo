<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'passengerID',
        'driverID',
        'deparTime',
        'pickupLocation',
        'destination',
        'status',
    ];

    public function passenger()
    {
        return $this->belongsTo(User::class, 'passengerID');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driverID');
    }
}
