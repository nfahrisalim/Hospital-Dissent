<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tanggal_lahir',
        'jenis_kelamin',
        'role',
        'height',
        'weight',
        'blood_type',
        'family_contact_name',
        'family_contact_phone',
    ];
    
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the medical records for the patient.
     */
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class, 'pasien_id');
        return $this->hasMany(MedicalRecord::class, 'dokter_id');

    }
    public function medicineOrders()
    {
        return $this->hasMany(MedicineOrder::class);
    }
    public function doctor()
    {
        return $this->hasOne(Doctor::class);  // Assuming each user has one doctor
    }
}
