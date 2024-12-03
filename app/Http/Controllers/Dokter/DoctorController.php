<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\User;

class DoctorController extends Controller
{
    public function show($id)
    {
        $doctor = Doctor::findOrFail($id); // Get the doctor by ID
        return view('Dokter.profile.index', compact('doctor'));
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('Dokter.profile.edit', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->update($request->all());
        return redirect()->route('doctor.profile', $doctor->id)->with('success', 'Profile updated successfully.');
    }
}
