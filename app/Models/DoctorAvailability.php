<?php

// App\Models\DoctorAvailability.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorAvailability extends Model
{
    use HasFactory;

    protected $fillable = ['doctor_id', 'availability_date', 'status'];

    // Relasi dengan Appointment
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
