<?php

namespace App\Http\Controllers;

use App\Models\SatuanUnit;
use App\Models\PaketKuota;

class DashboardController extends Controller
{
    public function index()
    {
        
        $totalSatuanUnits = SatuanUnit::count();
        
        $totalPaketKuotas = PaketKuota::count();
        
        $recentPaketKuotas = PaketKuota::with('satuanUnit')->latest()->take(5)->get();

        return view('dashboard', compact('totalSatuanUnits', 'totalPaketKuotas', 'recentPaketKuotas'));
    }
}
