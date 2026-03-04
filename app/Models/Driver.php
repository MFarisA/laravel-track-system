<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'user_id',
        'employee_id',
        'license_number',
        'license_expiry',
        'status',
    ];

    protected $casts = [
        'license_expiry' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

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
