<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GpsPoint extends Model
{
    protected $fillable = [
        'latitude',
        'longitude',
        'speed_kmh',
        'heading',
        'recorded_at',
        'vehicle_id',
        'trip_id',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'speed_kmh' => 'decimal:2',
        'heading' => 'decimal:2',
        'recorded_at' => 'datetime',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
