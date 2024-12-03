<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display the appropriate home page based on user role.
     */
    public function index()
    {
        $user = Auth::user();

        switch ($user->role) {
            case 'admin':
                return view('Admin.Pages.Dashboard.DashboardIndex');
            case 'dokter':
                return view('dokter.Pages.Dashboard.DashboardIndex');
            case 'pasien':
                return view('Pasien.Pages.Dashboard.DashboardIndex');
            default:
                return abort(403, 'Unauthorized action.');
        }
    }
}
