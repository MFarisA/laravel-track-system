<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'trip_number',
        'start_time',
        'end_time',
        'start_address',
        'end_address',
        'distance_km',
        'status',
        'driver_id',
        'vehicle_id',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'distance_km' => 'decimal:2',
    ];

    public function deliveryProof()
    {
        return $this->hasOne(DeliveryProof::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
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
