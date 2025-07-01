@extends('layouts.tim.app')

@section('content')
    <div class="mx-20">
        <h2 class="font-extrabold text-4xl mb-6 text-center">Tambah Sub CPMK</h2>
        <hr class="w-full border border-black mb-4">

        @if ($errors->any())
            <div class="text-red-600 mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tim.subcpmk.store') }}" method="POST">
            @csrf

            {{-- Pilih Mata Kuliah --}}
            <div>
                <label for="kode_mk" class="text-xl font-semibold">Mata Kuliah:</label>
                <select name="kode_mk" id="kode_mk" required class="w-full mt-1 p-3 border border-black rounded-lg mb-5">
                    <option value="" selected disabled>Pilih Mata Kuliah</option>
                    @foreach ($mks as $mk)
                        <option value="{{ $mk->kode_mk }}">{{ $mk->kode_mk }} - {{ $mk->nama_mk }}</option>
                    @endforeach
                </select>
            </div>

            {{-- CPMK (otomatis muncul, pilih 1) --}}
            <div>
                <label for="id_cpmk" class="text-xl font-semibold">CPMK Terkait:</label>
                <select name="id_cpmk" id="id_cpmk" required class="w-full mt-1 p-3 border border-black rounded-lg mb-5">
                    <option>Pilih Mata Kuliah terlebih dahulu</option>
                </select>
            </div>

            {{-- Sub CPMK --}}
            <div>
                <label for="sub_cpmk" class="text-xl font-semibold">Sub CPMK:</label>
                <input type="text" name="sub_cpmk" id="sub_cpmk" required
                    class="w-full mt-1 p-3 border border-black rounded-lg mb-5">
            </div>

            {{-- Uraian CPMK --}}
            <div>
                <label for="uraian_cpmk" class="text-xl font-semibold">Uraian CPMK:</label>
                <input type="text" name="uraian_cpmk" id="uraian_cpmk" required
                    class="w-full mt-1 p-3 border border-black rounded-lg mb-5">
            </div>

            {{-- Tombol --}}
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white px-5 py-2 font-bold rounded-lg">
                    Simpan
                </button>
                <a href="{{ route('tim.subcpmk.index') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-5 font-bold py-2 rounded-lg ml-2">
                    Kembali
                </a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('kode_mk').addEventListener('change', function() {
            const kodeMk = this.value;
            const cpmkSelect = document.getElementById('id_cpmk');

            cpmkSelect.innerHTML = '<option disabled>Memuat CPMK...</option>';

            fetch(`/tim/subcpmk/getCpmkByMk?kode_mk=${kodeMk}`)
                .then(res => res.json())
                .then(data => {
                    cpmkSelect.innerHTML = '';
                    if (data.length === 0) {
                        cpmkSelect.innerHTML = '<option disabled>Tidak ada CPMK untuk MK ini</option>';
                    } else {
                        cpmkSelect.innerHTML = '<option selected disabled>Pilih CPMK</option>';
                        data.forEach(cpmk => {
                            const option = document.createElement('option');
                            option.value = cpmk.id_cpmk;
                            option.textContent = `${cpmk.kode_cpmk} - ${cpmk.deskripsi_cpmk}`;
                            cpmkSelect.appendChild(option);
                        });
                    }
                })
                .catch(err => {
                    cpmkSelect.innerHTML = '<option disabled>Gagal memuat CPMK</option>';
                    console.error(err);
                });
        });
    </script>
@endpush
