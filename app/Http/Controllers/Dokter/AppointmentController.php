<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\DoctorAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function index()
    {
        // Get doctor availabilities for the currently logged-in doctor
        $doctorAvailabilities = DoctorAvailability::where('doctor_id', Auth::id())->get();

        // Pass the variable to the view
        return view('Dokter.Appointments.index', compact('doctorAvailabilities'));
    }

    public function store(Request $request)
    {
        // Validate the inputs
        $request->validate([
            'availability_date' => 'required|date',
            'availability_time' => 'required|date_format:H:i',
            'finish_date' => 'required|date',
            'finish_time' => 'required|date_format:H:i',
            'status' => 'required|string',
        ]);
    
        // Combine the date and time to create the full datetime for start and finish
        $start_datetime = \Carbon\Carbon::parse($request->availability_date . ' ' . $request->availability_time);
        $finish_datetime = \Carbon\Carbon::parse($request->finish_date . ' ' . $request->finish_time);
    
        // Save the availability in the database
        DoctorAvailability::create([
            'doctor_id' => Auth::id(),
            'availability_date' => $start_datetime,
            'finish_time' => $finish_datetime,
            'status' => $request->status,
        ]);
    
        return redirect()->back()->with('success', 'Availability set successfully!');
    }

    public function destroy($id)
    {
        $availability = DoctorAvailability::findOrFail($id);
        $availability->delete();

        return redirect()->back()->with('success', 'Availability deleted successfully!');
    }
}
