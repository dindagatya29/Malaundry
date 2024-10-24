@extends('layouts.app')

@section('title', 'Satuan Units')

@section('header', 'Satuan Units')

@section('content')

@if (session('success'))
    <div class="mb-4 text-green-600">
        {{ session('success') }}
    </div>
@endif

<div>
    <h1>
        Satuan Unit
    </h1>
</div>

<div class="flex justify-between items-center mb-3">
    <div class="flex items-center">
        <span class="mr-2">Show</span>
        <select class="border rounded p-1">
            <option>10</option>
            <option>25</option>
            <option>50</option>
            <option>100</option>
        </select>
        <span class="ml-2">entries</span>
    </div>

    <!-- Create and Refresh Buttons -->
    <div>
        <button onclick="openCreateModal()" class="bg-[#51C228] hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
            </svg>
            Create
        </button>

        <a href="{{ route('satuan_units.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center ml-2">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.204 7.204a6 6 0 00-9.408 0M12 6v6l6-6m-6 0h6a9 9 0 01-9 9H3"></path>
            </svg>
            Refresh
        </a>
    </div>
</div>

<!-- Search Form -->
<div class="mb-4 flex justify-end">
    <form action="{{ route('satuan_units.index') }}" method="GET" class="flex items-center">
        <input type="text" id="searchInput" name="search" placeholder="Search Satuan Unit..." class="border border-gray-300 rounded-md py-2 px-4">
        <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Search
        </button>
    </form>
</div>

<!-- Satuan Units Table -->
<div class="bg-white shadow-md rounded my-6">
    <div class="px-6 py-4">
        <h2 class="text-lg font-semibold">Total Satuan Units: <strong>{{ $totalSatuanUnits }}</strong></h2>
    </div>
    <table class="min-w-full divide-y divide-green-00" id="satuanUnitTable">
        <thead class="bg-[#51C228]">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Satuan Unit</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Deskripsi</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Aktif</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-100 uppercase tracking-wider">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200" id="satuanUnitBody">
            @foreach ($satuanUnits as $satuanUnit)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $satuanUnit->nama }}</td>
                    <td class="px-6 py-4">{{ $satuanUnit->deskripsi }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $satuanUnit->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $satuanUnit->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div x-data="{ open: false }" class="relative">
                            <!-- Button to toggle the dropdown -->
                            <button @click="open = !open" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Action
                                <svg class="w-4 h-4 inline-block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <!-- Dropdown content (only shown when clicked) -->
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50">
                                <a href="#" onclick="openEditModal({{ $satuanUnit }})" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Detail</a>
                                <form action="{{ route('satuan_units.toggle-active', $satuanUnit) }}" method="POST" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        {{ $satuanUnit->is_active ? 'Nonaktif' : 'Aktif' }}
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

<!-- Modal Pop-up for Creating New Satuan Unit -->
<div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded shadow-lg w-1/2">
        <h2 class="text-xl font-bold mb-4">Add New Satuan Unit</h2>
        <form action="{{ route('satuan_units.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Satuan Unit</label>
                <input type="text" name="nama" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Description</label>
                <textarea name="deskripsi" class="w-full px-4 py-2 border rounded" required></textarea>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeCreateModal()" class="bg-gray-500 text-white py-2 px-4 rounded mr-2">Cancel</button>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Pop-up for Editing Satuan Unit -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded shadow-lg w-1/2">
        <h2 class="text-xl font-bold mb-4">Edit Satuan Unit</h2>
        <form id="editForm" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700">Satuan Unit</label>
                <input type="text" name="nama" id="editNama" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Description</label>
                <textarea name="deskripsi" id="editDeskripsi" class="w-full px-4 py-2 border rounded" required></textarea>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeEditModal()" class="bg-gray-500 text-white py-2 px-4 rounded mr-2">Cancel</button>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Alpine.js and Modal Scripts -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
    }

    function closeCreateModal() {
        document.getElementById('createModal').classList.add('hidden');
    }

    function openEditModal(satuanUnit) {
        document.getElementById('editNama').value = satuanUnit.nama;
        document.getElementById('editDeskripsi').value = satuanUnit.deskripsi;
        document.getElementById('editForm').action = `/satuan_units/${satuanUnit.id}`;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    // Live search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#satuanUnitBody tr');

        rows.forEach(function(row) {
            let cells = row.getElementsByTagName('td');
            let found = false;

            for (let i = 0; i < cells.length; i++) {
                if (cells[i].innerText.toLowerCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }

            if (found) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

@endsection
