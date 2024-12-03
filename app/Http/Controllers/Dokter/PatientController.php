<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        // Fetch all patients with the role 'pasien'
        $patients = User::where('role', 'pasien')->get();
        
        // Return the list view with the patients data
        return view('Dokter.Pasien.list', compact('patients'));
    }
    /**
     * Display the specified patient profile.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $patient = User::with('medicalRecords.medicines')->where('role', 'pasien')->findOrFail($id);
        return view('Dokter.Pasien.index', compact('patient'));
    }

    /**
     * Update the family contact details for the specified patient.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateFamilyContact(Request $request, $id)
    {
        $request->validate([
            'family_contact_name' => 'required|string|max:255',
            'family_contact_phone' => 'required|string|max:15',
        ]);

        $patient = User::where('role', 'pasien')->findOrFail($id);
        $patient->update([
            'family_contact_name' => $request->family_contact_name,
            'family_contact_phone' => $request->family_contact_phone,
        ]);

        return redirect()->route('dokter.patients.show', $patient->id)->with('success', 'Family contact updated successfully.');
    }
    public function updateDetails(Request $request, $id)
{
    $request->validate([
        'height' => 'required|numeric',
        'weight' => 'required|numeric',
        'blood_type' => 'required|string|max:3',
    ]);

    $patient = User::findOrFail($id);
    $patient->update([
        'height' => $request->height,
        'weight' => $request->weight,
        'blood_type' => $request->blood_type,
    ]);

    return redirect()->route('dokter.patients.show', $id)->with('success', 'Patient details updated successfully.');
    }


}
