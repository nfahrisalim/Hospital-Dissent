<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    // Define the relationship to DoctorAvailability (if not done yet)
    public function doctorAvailabilities()
    {
        return $this->hasMany(DoctorAvailability::class);
    }
}
