@extends('layouts.app')

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

        <form action="{{ route('admin.subcpmk.store') }}" method="POST">
            @csrf

            <div>
                <label for="kode_mk" class="text-xl font-semibold">Mata Kuliah:</label>
                <select name="kode_mk" id="kode_mk" required
                    class="w-full mt-1 p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500 mb-5">
                    <option value="" selected disabled>Pilih Mata Kuliah</option>
                    @foreach ($mataKuliahs as $mk)
                        <option value="{{ $mk->kode_mk }}">{{ $mk->kode_mk }} - {{ $mk->nama_mk }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="id_cpmk" class="text-xl font-semibold">CPMK:</label>
                <select name="id_cpmk[]" id="id_cpmk" multiple required
                    class="w-full mt-1 p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500 mb-5 min-h-[120px]">
                    <option value="" disabled>Pilih Mata Kuliah terlebih dahulu</option>
                </select>
                <p class="text-sm text-gray-600 mb-3">*Pilih mata kuliah terlebih dahulu untuk melihat CPMK yang tersedia.
                    Semua CPMK akan otomatis terpilih.</p>
            </div>

            <div>
                <label for="sub_cpmk" class="text-xl font-semibold">Sub CPMK:</label>
                <input type="text" name="sub_cpmk" id="sub_cpmk" required
                    class="w-full mt-1 p-3 border border-black rounded-lg mb-5" placeholder="Contoh: Sub CPMK 011">
            </div>

            <div>
                <label for="uraian_cpmk" class="text-xl font-semibold">Uraian CPMK:</label>
                <textarea name="uraian_cpmk" id="uraian_cpmk" required rows="3"
                    class="w-full mt-1 p-3 border border-black rounded-lg mb-5" placeholder="Masukkan uraian atau deskripsi sub CPMK"></textarea>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white px-6 py-2 rounded-lg">
                    Simpan
                </button>
                <a href="{{ route('admin.subcpmk.index') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white px-6 py-2 rounded-lg ml-4">
                    Kembali
                </a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            const mkSelect = document.getElementById('kode_mk');
            const cpmkSelect = document.getElementById('id_cpmk');

            mkSelect.addEventListener('change', function() {
                const selectedMK = this.value;

                // Reset CPMK select
                cpmkSelect.innerHTML = '<option value="" disabled>Memuat CPMK...</option>';

                if (!selectedMK) {
                    cpmkSelect.innerHTML = '<option value="" disabled>Pilih Mata Kuliah terlebih dahulu</option>';
                    return;
                }

                // SOLUSI: Menggunakan protokol relatif untuk menghindari mixed content error
                fetch("{{ str_replace(['http://', 'https://'], '//', url(route('admin.subcpmk.getCpmkByMataKuliah'))) }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            kode_mk: selectedMK
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        cpmkSelect.innerHTML = '';

                        if (data.length === 0) {
                            cpmkSelect.innerHTML =
                                '<option value="" disabled>Tidak ada CPMK untuk mata kuliah ini</option>';
                        } else {
                            data.forEach(cpmk => {
                                const option = document.createElement('option');
                                option.value = cpmk.id_cpmk;
                                option.textContent = `${cpmk.kode_cpmk} - ${cpmk.deskripsi_cpmk}`;
                                option.selected = true; // Auto select semua CPMK
                                cpmkSelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        cpmkSelect.innerHTML =
                            '<option value="" disabled>Terjadi kesalahan saat memuat CPMK</option>';
                    });
            });
        </script>
    @endpush
@endsection
