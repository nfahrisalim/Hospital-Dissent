<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\DoctorAvailability;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function findAvailableDoctors(Request $request)
    {
        // Validasi input
        $request->validate([
            'date' => 'required|date|after_or_equal:today', // pastikan tanggal yang dipilih valid dan bukan di masa lalu
        ]);

        // Ambil tanggal yang dipilih
        $date = $request->input('date');

        // Ambil semua dokter yang memiliki ketersediaan pada tanggal tersebut
        $availableDoctors = Doctor::whereHas('availabilities', function ($query) use ($date) {
            $query->where('availability_date', '=', $date)
                  ->where('status', 'Tersedia'); // Pastikan hanya yang tersedia
        })->get();

        // Kirim data dokter yang tersedia ke view
        return view('Pasien.Appointment.index', compact('availableDoctors', 'date'));
    }

    public function create($doctorId)
    {
        // Ambil jadwal dokter yang tersedia
        $doctorAvailabilities = DoctorAvailability::where('doctor_id', $doctorId)
                                                  ->where('status', 'Tersedia') // hanya yang tersedia
                                                  ->get();

        return view('Pasien.Appointment.create', compact('doctorAvailabilities', 'doctorId'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'availability_id' => 'required|exists:doctor_availabilities,id',
        ]);

        // Simpan appointment
        $appointment = new Appointment();
        $appointment->user_id = auth()->id(); // ID pasien
        $appointment->doctor_id = $request->doctor_id;
        $appointment->availability_id = $request->availability_id;
        $appointment->save();

        return redirect()->route('pasien.appointments.create', ['doctorId' => $request->doctor_id])
                         ->with('success', 'Appointment successfully booked');
    }
}
