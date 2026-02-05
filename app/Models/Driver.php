<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'employee_id',
        'name',
        'phone',
        'license_number',
        'license_expiry',
        'status',
    ];

    protected $casts = [
        'license_expiry' => 'date',
    ];

    public function currentVehicle()
    {
        return $this->hasOne(Vehicle::class, 'current_driver_id');
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }
}
