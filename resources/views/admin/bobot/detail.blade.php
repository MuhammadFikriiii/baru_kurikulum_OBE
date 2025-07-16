@extends('layouts.app')

@section('content')
<div class="mx-20">
    <h2 class="text-4xl font-extrabold text-center mb-4">Detail Bobot CPL-MK</h2>
    <hr class="w-full border border-black mb-4">

    <div>
        <label class="text-xl font-semibold">CPL:</label>
        <div class="p-3 rounded mb-4 border border-black">
            {{ $kode_cpl }}: {{ $deskripsi_cpl }}
        </div>
    </div>

    <div id="mkSection" class="mt-6">
        <label class="text-xl font-semibold">Bobot Mata Kuliah</label>
        <div id="mkList" class="mt-2 border border-black rounded-lg p-4 max-h-[300px] overflow-y-auto">
            @foreach ($mataKuliahs as $mk)
                <div class="mb-3 flex items-center justify-between p-3 border rounded">
                    <div>
                        <strong>{{ $mk->kode_mk }}</strong> - {{ $mk->nama_mk }}
                    </div>
                    <input type="number" disabled readonly min="0" max="100"
                        value="{{ $existingBobots[$mk->kode_mk] ?? 0 }}"
                        class="w-24 p-2 border rounded text-center bobot-input text-gray-700">
                </div>
            @endforeach
        </div>
        <div class="mt-2 text-sm text-gray-600">Total Bobot: <span id="totalBobot">0%</span></div>
    </div>

    <a href="{{ route('admin.bobot.index') }}"
       class="mt-6 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
        Kembali
    </a>
</div>

@push('scripts')
<script>
    function updateTotal() {
        let total = 0;
        document.querySelectorAll('.bobot-input').forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        document.getElementById('totalBobot').textContent = total + '%';
    }

    updateTotal();
</script>
@endpush
@endsection
