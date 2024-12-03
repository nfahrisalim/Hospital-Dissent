<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\DoctorAvailability;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    // Menampilkan ketersediaan dokter
    public function index()
    {
        $doctorAvailabilities = DoctorAvailability::where('status', 'Tersedia')->get(); // Menampilkan hanya yang statusnya "Tersedia"
        
        return view('Pasien.Appointment.index', compact('doctorAvailabilities'));
    }

    // Menangani penjadwalan janji temu
    public function store(Request $request, $availabilityId)
    {
        // Validasi data request
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'availability_id' => 'required|exists:doctor_availabilities,id',
        ]);

        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Menyimpan janji temu baru
        $appointment = new Appointment();
        $appointment->user_id = $user->id; // Menyimpan ID user (pasien)
        $appointment->doctor_availability_id = $availabilityId;
        $appointment->status = 'Pending'; // Status awal bisa 'Pending'
        $appointment->save();

        return redirect()->route('pasien.appointments.index')->with('success', 'Appointment successfully scheduled');
    }
}
