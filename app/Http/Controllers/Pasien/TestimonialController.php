<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function show(Doctor $doctor)
    {
        $doctor->load('testimonials');

        return view('pasien.dokterProfile', compact('doctor'));
    }
    /**
     * Show the form to create a testimonial for a doctor.
     *
     * @param  Doctor $doctor
     * @return \Illuminate\View\View
     */
    public function create(Doctor $doctor)
    {
        // Ensure the doctor exists
        if (!$doctor) {
            return redirect()->route('pasien.doctors.index')->with('error', 'Dokter tidak ditemukan.');
        }

        return view('pasien.testimonials.create', compact('doctor'));
    }

    /**
     * Store a newly created testimonial in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Doctor $doctor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // Mendapatkan user yang sedang login
        $user = auth()->user();

        // Membuat testimoni baru
        $testimonial = new Testimonial();
        $testimonial->testimoni = $request->content; // Menyimpan testimoni
        $testimonial->user_id = $user->id; // Menyimpan user_id (pasien atau pengunjung)
        
        // Tidak menyertakan doctor_id (kolom ini bisa nullable)
        $testimonial->save();

        // Mengarahkan kembali ke profil dokter
        return redirect()->route('pasien.doctor.show', ['doctorId' => $user->doctor->id])
            ->with('success', 'Testimoni berhasil ditambahkan');
    }
}

