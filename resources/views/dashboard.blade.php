@extends('layouts.app')

@section('title', 'Dashboard')

@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-2">Total Satuan Units</h2>
        <p class="text-3xl font-bold text-green-600">{{ $totalSatuanUnits }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-2">Total Paket Kuotas</h2>
        <p class="text-3xl font-bold text-green-600">{{ $totalPaketKuotas }}</p>
    </div>
</div>

<div class="mt-8">
    <h2 class="text-2xl font-semibold mb-4">Recent Paket Kuotas</h2>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        @if($recentPaketKuotas->isEmpty())
            <div class="p-6 text-center">
                <p class="text-gray-500">No recent paket kuotas available.</p>
            </div>
        @else
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Berat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Satuan Unit</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cabang</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($recentPaketKuotas as $paketKuota)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $paketKuota->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $paketKuota->berat }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $paketKuota->satuanUnit->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($paketKuota->harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $paketKuota->cabang }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
