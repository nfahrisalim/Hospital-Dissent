<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorManagementController extends Controller
{
    /**
     * Display the list of doctors (users with 'dokter' role).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch doctors with the role 'dokter'
        $doctors = User::where('role', 'dokter')->get();

        // Return the list view with the doctors' data
        return view('Admin.Dokter.index', compact('doctors'));
    }

    /**
     * Display the specified doctor's profile.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Ambil data dokter berdasarkan ID
        $doctor = User::with('medicalRecords.pasien', 'medicalRecords.medicines')->findOrFail($id);

        // Return view dengan data dokter dan medicalRecords
        return view('Admin.Dokter.profile', compact('doctor'));
    }

    /**
     * Show the form for editing a doctor's profile.
     */
    public function edit($id)
    {
        $doctor = User::findOrFail($id);
        return view('Admin.Dokter.edit', compact('doctor'));
    }

    /**
     * Update the doctor's profile.
     */
    public function update(Request $request, $id)
{
    $doctor = User::findOrFail($id);

    // Validasi input
    $request->validate([
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'specialization' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'address' => 'nullable|string|max:255',
    ]);

    // Proses foto jika ada
    if ($request->hasFile('photo')) {
        // Menghapus foto lama jika ada
        if ($doctor->photo && file_exists(storage_path('app/public/' . $doctor->photo))) {
            unlink(storage_path('app/public/' . $doctor->photo));
        }

        // Menyimpan foto baru
        $path = $request->file('photo')->store('doctor_photos', 'public');
        $doctor->photo = $path;
    }

    // Update data lainnya
    $doctor->specialization = $request->specialization;
    $doctor->description = $request->description;
    $doctor->address = $request->address;

    // Simpan perubahan
    $doctor->save();

    // Redirect ke halaman detail dokter atau ke halaman yang sesuai
    return redirect()->route('admin.doctors.show', $doctor->id)->with('success', 'Doctor profile updated successfully.');
}


    /**
     * Delete a doctor's profile.
     */
    public function destroy($id)
    {
        $doctor = User::findOrFail($id);
        $doctor->delete();

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}
