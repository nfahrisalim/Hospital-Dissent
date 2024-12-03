<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $fillable = [
        'pasien_id',
        'dokter_id',
        'tanggal_berobat',
        'tindakan_medis',
    ];

    /**
     * The medicines that belong to the medical record.
     */
    public function medicines()
    {
        return $this->belongsToMany(Medicine::class, 'medical_record_medicine');
    }
    public function pasien()
    {
        return $this->belongsTo(User::class, 'pasien_id');
    }
    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }
    public function medicineOrders()
    {
        return $this->hasMany(MedicineOrder::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
