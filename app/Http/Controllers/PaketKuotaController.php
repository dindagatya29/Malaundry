<?php

namespace App\Http\Controllers;

use App\Models\PaketKuota;
use App\Models\SatuanUnit;
use Illuminate\Http\Request;

class PaketKuotaController extends Controller
{
    public function index()
{
    // Ambil semua Paket Kuota
    $paketKuotas = PaketKuota::with('satuanUnit')->get();

    // Ambil semua Satuan Unit untuk dropdown di modal
    $satuanUnits = SatuanUnit::all();

    // Ambil Satuan Unit yang aktif untuk dropdown
    $activeSatuanUnits = SatuanUnit::where('is_active', true)->get(); // Only active satuan units

    // Kirim data ke view
    return view('paket_kuotas.index', compact('paketKuotas', 'satuanUnits', 'activeSatuanUnits'));
}


    public function create()
    {
        $satuanUnits = SatuanUnit::where('is_active', true)->get(); // Only active Satuan Units
        return view('paket_kuotas.create', compact('satuanUnits'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'berat' => 'required|numeric|min:0',
            'satuan_unit_id' => 'required|exists:satuan_units,id',
            'harga' => 'required|numeric|min:0',
            'cabang' => 'required|string|max:255',
        ]);

        PaketKuota::create($validated);

        return redirect()->route('paket_kuotas.index')->with('success', 'Paket Kuota created successfully.');
    }

    public function edit(PaketKuota $paketKuota)
    {
        $satuanUnits = SatuanUnit::where('is_active', true)->get();
        return view('paket_kuotas.edit', compact('paketKuota', 'satuanUnits'));
    }

    public function update(Request $request, PaketKuota $paketKuota)
{
    $validatedData = $request->validate([
        'nama' => 'required|string|max:255',
        'berat' => 'required|numeric',
        'satuan_unit_id' => 'required|exists:satuan_units,id',
        'harga' => 'required|numeric',
        'cabang' => 'required|string|max:255',
    ]);

    $paketKuota->update($validatedData);

    return redirect()->route('paket_kuotas.index')->with('success', 'Paket Kuota updated successfully');
}
    public function destroy(PaketKuota $paketKuota)
    {
        $paketKuota->delete();
        return redirect()->route('paket_kuotas.index')->with('success', 'Paket Kuota deleted successfully.');
    }

    public function toggleActive(Request $request, PaketKuota $paketKuota)
    {
        // Toggle the is_active attribute
        $paketKuota->is_active = !$paketKuota->is_active;
        $paketKuota->save();

        return redirect()->route('paket_kuotas.index')->with('success', 'Paket Kuota status updated successfully.');
    }
}
