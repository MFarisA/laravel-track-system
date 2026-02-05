<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $fillable = [
        'type',
        'severity',
        'latitude',
        'longitude',
        'metadata',
        'acknowledged',
        'vehicle_id',
        'driver_id',
        'trip_id',
    ];

    protected $casts = [
        'metadata' => 'array',
        'acknowledged' => 'boolean',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
