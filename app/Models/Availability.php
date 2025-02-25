<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = [
        'driverID',
        'From',
        'To',
    ];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driverID');
    }
}
