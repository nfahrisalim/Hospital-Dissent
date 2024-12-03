<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use App\Models\User;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of all medical records for a doctor.
     */
    public function index(Request $request)
    {
    $dokterId = Auth::id();
    $query = MedicalRecord::where('dokter_id', $dokterId)->with('pasien', 'medicines');

    // Jika ada parameter pencarian, filter berdasarkan nama pasien
    if ($request->has('search') && $request->search != '') {
        $searchTerm = $request->search;
        $query = $query->whereHas('pasien', function ($query) use ($searchTerm) {
            $query->where('name', 'LIKE', "%{$searchTerm}%");
        });
    }

    $medicalRecords = $query->get();

    return view('Dokter.MedicalRecords.index', compact('medicalRecords'));
    }

    /**
     * Show the form for creating a new medical record.
     */
    public function create()
    {
        $pasiens = User::where('role', 'pasien')->get();
        $medicines = Medicine::all();
        return view('Dokter.MedicalRecords.create', compact('pasiens', 'medicines'));
    }

    /**
     * Store a newly created medical record in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:users,id',
            'tanggal_berobat' => 'required|date',
            'tindakan_medis' => 'required|string',
            'medicines' => 'required|array',
            'medicines.*' => 'exists:medicines,id',
        ]);

        $medicalRecord = MedicalRecord::create([
            'pasien_id' => $request->pasien_id,
            'dokter_id' => Auth::id(),
            'tanggal_berobat' => $request->tanggal_berobat,
            'tindakan_medis' => $request->tindakan_medis,
        ]);

        $medicalRecord->medicines()->attach($request->medicines);

        return redirect()->route('dokter.medical_records.index')->with('success', 'Medical record created successfully.');
    }

    /**
     * Show the form for editing a medical record.
     */
    public function edit($id)
    {
        $medicalRecord = MedicalRecord::where('dokter_id', Auth::id())->findOrFail($id);
        $pasiens = User::where('role', 'pasien')->get();
        $medicines = Medicine::all();
        return view('Dokter.MedicalRecords.edit', compact('medicalRecord', 'pasiens', 'medicines'));
    }

    /**
     * Update the specified medical record in storage.
     */
    public function update(Request $request, $id)
    {
        $medicalRecord = MedicalRecord::where('dokter_id', Auth::id())->findOrFail($id);
        $request->validate([
            'pasien_id' => 'required|exists:users,id',
            'tanggal_berobat' => 'required|date',
            'tindakan_medis' => 'required|string',
            'medicines' => 'required|array',
            'medicines.*' => 'exists:medicines,id',
        ]);

        $medicalRecord->update([
            'pasien_id' => $request->pasien_id,
            'tanggal_berobat' => $request->tanggal_berobat,
            'tindakan_medis' => $request->tindakan_medis,
        ]);

        $medicalRecord->medicines()->sync($request->medicines);

        return redirect()->route('dokter.medical_records.index')->with('success', 'Medical record updated successfully.');
    }

    /**
     * Remove the specified medical record from storage.
     */
    public function destroy($id)
    {
        $medicalRecord = MedicalRecord::where('dokter_id', Auth::id())->findOrFail($id);
        $medicalRecord->delete();

        return redirect()->route('dokter.medical_records.index')->with('success', 'Medical record deleted successfully.');
    }
}
