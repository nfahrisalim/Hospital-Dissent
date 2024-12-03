<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PasienDoctorController extends Controller
{
    /**
     * Display the specified doctor's profile.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Find the doctor by id and ensure they have the 'dokter' role
        $doctor = User::where('role', 'dokter')->findOrFail($id);

        // Return the profile view with doctor's data
        return view('Pasien.Dokter.profile', compact('doctor'));
    }
}
