<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);  // Assuming each doctor belongs to a user
    }
}

