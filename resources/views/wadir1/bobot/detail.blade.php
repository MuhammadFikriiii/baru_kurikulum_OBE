@extends('layouts.wadir1.app')

@section('content')
    <div class="mx-4 md:mx-20">
        <h2 class="text-4xl font-extrabold text-center mb-4">Detail Bobot CPL-MK</h2>
        <hr class="w-full border border-black mb-4">

        <div>
            <label class="text-xl font-semibold">CPL:</label>
            <div class="p-2 bg-gray-100 border rounded mb-4">
                {{ $kode_cpl }}
            </div>
        </div>

        @if ($mataKuliahs->isEmpty())
            <div class="p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 rounded">
                Tidak ada mata kuliah terkait CPL ini.
            </div>
        @else
            <div id="mkSection" class="mt-6">
                <label class="text-xl font-semibold">Distribusi Bobot Mata Kuliah</label>
                <div class="mt-2 border border-black rounded-lg p-4 bg-gray-50 max-h-[300px] overflow-y-auto">
                    @foreach ($mataKuliahs as $mk)
                        <div class="mb-3 flex items-center justify-between bg-white p-3 border rounded">
                            <div>
                                <strong>{{ $mk->kode_mk }}</strong> - {{ $mk->nama_mk }}
                            </div>
                            <input type="number" disabled readonly min="0" max="100"
                                value="{{ isset($existingBobots[$mk->kode_mk]) ? $existingBobots[$mk->kode_mk] : 0 }}"
                                class="w-24 p-2 border rounded text-center bobot-input bg-gray-100 text-gray-700">
                        </div>
                    @endforeach
                </div>
                <div class="mt-2 text-sm text-gray-600">Total Bobot: <span id="totalBobot">0%</span></div>
            </div>
        @endif

        <a href="{{ route('wadir1.bobot.index') }}"
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
