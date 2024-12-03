<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\MedicalRecord;
use App\Models\MedicineOrder;
use Illuminate\Http\Request;

class MedicineOrderController extends Controller
{
    // Menampilkan form pemesanan obat
    public function create($medicalRecordId)
    {
        $medicalRecord = MedicalRecord::findOrFail($medicalRecordId);
        $prescribedMedicines = $medicalRecord->medicines;  // Obat yang diresepkan

        return view('Pasien.MedicineOrder.create', compact('medicalRecord', 'prescribedMedicines'));
    }

    // Menyimpan pemesanan obat
    public function store(Request $request, $medicalRecordId)
    {
        // Validasi input
        $request->validate([
            'medicine_id' => 'required|array',
            'quantity' => 'required|array',
        ]);

        $medicalRecord = MedicalRecord::findOrFail($medicalRecordId);

        // Menyimpan pemesanan obat ke database
        foreach ($request->medicine_id as $index => $medicineId) {
            $medicine = Medicine::findOrFail($medicineId);

            MedicineOrder::create([
                'medical_record_id' => $medicalRecordId,
                'medicine_id' => $medicineId,
                'quantity' => $request->quantity[$medicineId],
                'status' => 'Pending', // Status pemesanan awal
            ]);
        }

        // Menambahkan notifikasi sukses
        return redirect()->route('pasien.medicine_order.index', ['medicalRecordId' => $medicalRecordId])
                         ->with('success', 'Obat berhasil dipesan!');
    }

    // Menampilkan daftar pemesanan obat
    public function index($medicalRecordId)
    {
        $medicalRecord = MedicalRecord::findOrFail($medicalRecordId);
        $medicineOrders = MedicineOrder::where('medical_record_id', $medicalRecordId)->get();

        return view('Pasien.MedicineOrder.index', compact('medicalRecord', 'medicineOrders'));
    }
}
