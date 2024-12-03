<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index($id)
    {
        // Ambil rekam medis pasien berdasarkan ID pasien yang login
        $medicalRecords = MedicalRecord::where('pasien_id', $id)->get();

        // Ambil rekam medis terbaru (rekam medis pertama yang diurutkan berdasarkan tanggal berobat)
        $latestMedicalRecord = MedicalRecord::where('pasien_id', $id)
            ->latest('tanggal_berobat') // Menyortir berdasarkan tanggal berobat terbaru
            ->first();

        return view('Pasien.Records.index', compact('medicalRecords', 'latestMedicalRecord'));
    }
}