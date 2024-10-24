@extends('layouts.app')

@section('title', 'Paket Kuotas')

@section('header', 'Paket Kuota')

@section('content')
<div class="bg-white shadow-md rounded my-6 p-6">
    <div class="flex flex-wrap mb-4">
        <div class="w-full md:w-1/2 lg:w-1/3 pr-4 mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="from_date">
                From
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="from_date" type="date" placeholder="dd/mm/yyyy">
        </div>
        <div class="w-full md:w-1/2 lg:w-1/3 pr-4 mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="to_date">
                To
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="to_date" type="date" placeholder="dd/mm/yyyy">
        </div>
        <div class="w-full md:w-1/2 lg:w-1/3 mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="filter">
                Filter
            </label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="filter">
                <option>All</option>
                <!-- Add more filter options here -->
            </select>
        </div>
    </div>
    <div class="flex flex-wrap items-center mb-4">
        <div class="w-full sm:w-auto mb-2 sm:mb-0 sm:mr-2">
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                EXCEL
            </button>
        </div>
        <div class="w-full sm:w-auto mb-2 sm:mb-0 sm:mr-2">
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                PDF
            </button>
        </div>
        <div class="w-full sm:w-auto mb-2 sm:mb-0 sm:mr-2">
            <a href="{{ route('paket_kuotas.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                REFRESH
            </a>
        </div>
        <div class="w-full sm:w-auto">
            <button onclick="openCreateModal()" class="bg-[#51C228] hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                + Create
            </button>
        </div>
    </div>
    <div class="mb-4 flex justify-between items-center">
        <div>
            <span class="mr-2">Show</span>
            <select class="border rounded p-1">
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>
            <span class="ml-2">entries</span>
        </div>
        <div class="flex items-center">
            <span class="mr-2">Search:</span>
            <input type="text" id="searchInput" class="border rounded p-1 w-64" placeholder="Search...">
        </div>
    </div>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-[#51C228]">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Paket Kuota</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Berat</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Harga</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Cabang</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Created At</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Aktif</th>
                <th class="bg-[#51C228] px-6 py-3 text-left text-xs font-medium text-gray-00 uppercase tracking-wider">ACTION</th>
            </tr>
        </thead>
        <tbody id="paketKuotaTable" class="bg-white divide-y divide-gray-200">
            @foreach ($paketKuotas as $paketKuota)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $paketKuota->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $paketKuota->berat }} Kg</td>
                    <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($paketKuota->harga, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $paketKuota->cabang }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $paketKuota->created_at->format('d-m-Y H:i:s') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $paketKuota->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $paketKuota->is_active ? 'AKTIF' : 'NONAKTIF' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Action
                                <svg class="w-4 h-4 inline-block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50" x-transition>
                                <button onclick="openEditModal({{ $paketKuota }})" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</button>
                                <form action="{{ route('paket_kuotas.toggle-active', $paketKuota) }}" method="POST" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        {{ $paketKuota->is_active ? 'Nonaktif' : 'Aktif' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Pop-up for Creating New Paket Kuota -->
<div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded shadow-lg w-1/2">
        <h2 class="text-xl font-bold mb-4">Add New Paket Kuota</h2>
        <form action="{{ route('paket_kuotas.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Name</label>
                <input type="text" name="nama" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Berat</label>
                <input type="number" name="berat" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Satuan Unit</label>
                <select name="satuan_unit_id" class="w-full px-4 py-2 border rounded" required>
                    @foreach($activeSatuanUnits as $satuanUnit)
                        <option value="{{ $satuanUnit->id }}">{{ $satuanUnit->nama }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700">Harga</label>
                <input type="number" name="harga" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Cabang</label>
                <input type="text" name="cabang" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="flex justify-end">
                <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" onclick="closeCreateModal()">Cancel</button>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2">Create</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Pop-up for Editing Paket Kuota -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded shadow-lg w-1/2">
        <h2 class="text-xl font-bold mb-4">Edit Paket Kuota</h2>
        <form id="editForm" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700">Name</label>
                <input type="text" name="nama" id="editNama" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Berat</label>
                <input type="number" name="berat" id="editBerat" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Satuan Unit</label>
                <select name="satuan_unit_id" id="editSatuanUnitId" class="w-full px-4 py-2 border rounded" required>
                    @foreach($satuanUnits as $satuanUnit)
                        <option value="{{ $satuanUnit->id }}">{{ $satuanUnit->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Harga</label>
                <input type="number" name="harga" id="editHarga" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Cabang</label>
                <input type="text" name="cabang" id="editCabang" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="flex justify-end">
                <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded" onclick="closeEditModal()">Cancel</button>
                <button type="submit" class="bg-[#51C228] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- Script for Live Search -->
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let input = this.value.toLowerCase();
        let rows = document.querySelectorAll('#paketKuotaTable tr');

        rows.forEach(row => {
            let cells = row.querySelectorAll('td');
            let rowContainsSearchText = Array.from(cells).some(cell => 
                cell.textContent.toLowerCase().includes(input)
            );

            row.style.display = rowContainsSearchText ? '' : 'none';
        });
    });

    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
    }

    function closeCreateModal() {
        document.getElementById('createModal').classList.add('hidden');
    }

    function openEditModal(paketKuota) {
        // Implement the function to open edit modal and pre-fill fields with paketKuota data
    }

    function openEditModal(paketKuota) {
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editForm').action = `/paket_kuotas/${paketKuota.id}`;
        document.getElementById('editNama').value = paketKuota.nama;
        document.getElementById('editBerat').value = paketKuota.berat;
        document.getElementById('editSatuanUnitId').value = paketKuota.satuan_unit_id;
        document.getElementById('editHarga').value = paketKuota.harga;
        document.getElementById('editCabang').value = paketKuota.cabang;
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>
@endsection