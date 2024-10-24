<?php

namespace App\Http\Controllers;

use App\Models\SatuanUnit;
use Illuminate\Http\Request;

class SatuanUnitController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $satuanUnits = SatuanUnit::query()
        ->where('nama', 'like', "%{$search}%")
        ->orWhere('deskripsi', 'like', "%{$search}%")
        ->paginate(10);

    $totalSatuanUnits = $satuanUnits->total();

    return view('satuan_units.index', compact('satuanUnits', 'totalSatuanUnits'));
}


    public function create()
    {
        return view('satuan_units.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        SatuanUnit::create($validated);

        return redirect()->route('satuan_units.index')->with('success', 'Satuan Unit created successfully.');
    }

    public function edit(SatuanUnit $satuanUnit)
    {
        return view('satuan_units.edit', compact('satuanUnit'));
    }

    public function update(Request $request, SatuanUnit $satuanUnit)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $satuanUnit->update($validated);

        return redirect()->route('satuan_units.index')->with('success', 'Satuan Unit updated successfully.');
    }

    public function destroy(SatuanUnit $satuanUnit)
    {
        $satuanUnit->delete();
        return redirect()->route('satuan_units.index')->with('success', 'Satuan Unit deleted successfully.');
    }

    public function toggleActive(SatuanUnit $satuanUnit)
    {
        $satuanUnit->is_active = !$satuanUnit->is_active;
        $satuanUnit->save();

        return redirect()->route('satuan_units.index')->with('success', 'Satuan Unit status updated successfully.');
    }
    public function search(Request $request)
{
    $query = $request->get('query');
    \Log::info('Search Query: ' . $query); // Log the search query
    $satuanUnits = SatuanUnit::where('nama', 'LIKE', "%{$query}%")
        ->orWhere('deskripsi', 'LIKE', "%{$query}%")
        ->get();

    \Log::info('Search Results: ', $satuanUnits->toArray()); // Log the results
    return response()->json($satuanUnits);
}
public function show($id)
{
    // Find the Satuan Unit by its ID
    $satuanUnit = SatuanUnit::findOrFail($id);

    // Return a view with the Satuan Unit details
    return view('satuan_units.show', compact('satuanUnit'));
}



}