<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'plate_number',
        'device_id',
        'brand',
        'model',
        'type',
        'status',
        'current_driver_id',
    ];

    public function currentDriver()
    {
        return $this->belongsTo(Driver::class, 'current_driver_id');
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function gpsPoints()
    {
        return $this->hasMany(GpsPoint::class);
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }
}
