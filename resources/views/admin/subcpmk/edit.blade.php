@extends('layouts.app')

@section('content')
    <div class="mx-20">
        <h2 class="font-extrabold text-4xl mb-6 text-center">Edit Sub CPMK</h2>
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

        <form action="{{ route('admin.subcpmk.update', $subcpmk->id_sub_cpmk) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="kode_mk" class="text-xl font-semibold">Mata Kuliah:</label>
                <select name="kode_mk" id="kode_mk" required
                    class="w-full mt-1 p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500 mb-5">
                    <option value="" disabled>Pilih Mata Kuliah</option>
                    @foreach ($mataKuliahs as $mk)
                        <option value="{{ $mk->kode_mk }}"
                            {{ $selectedMataKuliah && $selectedMataKuliah->kode_mk == $mk->kode_mk ? 'selected' : '' }}>
                            {{ $mk->kode_mk }} - {{ $mk->nama_mk }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="id_cpmk" class="text-xl font-semibold">CPMK:</label>
                <select name="id_cpmk[]" id="id_cpmk" multiple required
                    class="w-full mt-1 p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500 mb-5 min-h-[120px]">
                    @if ($cpmks->count() > 0)
                        @foreach ($cpmks as $cpmk)
                            <option value="{{ $cpmk->id_cpmk }}" selected>
                                {{ $cpmk->kode_cpmk }} - {{ $cpmk->deskripsi_cpmk }}
                            </option>
                        @endforeach
                    @else
                        <option value="" disabled>Pilih Mata Kuliah terlebih dahulu</option>
                    @endif
                </select>
                <p class="text-sm text-gray-600 mb-3">*Pilih mata kuliah terlebih dahulu untuk melihat CPMK yang tersedia.
                    Semua CPMK akan otomatis terpilih.</p>
            </div>

            <div>
                <label for="sub_cpmk" class="text-xl font-semibold">Sub CPMK:</label>
                <input type="text" name="sub_cpmk" id="sub_cpmk" required
                    class="w-full mt-1 p-3 border border-black rounded-lg mb-5"
                    value="{{ old('sub_cpmk', $subcpmk->sub_cpmk) }}" placeholder="Contoh: CPMK-1.1">
            </div>

            <div>
                <label for="uraian_cpmk" class="text-xl font-semibold">Uraian CPMK:</label>
                <textarea name="uraian_cpmk" id="uraian_cpmk" required rows="3"
                    class="w-full mt-1 p-3 border border-black rounded-lg mb-5" placeholder="Masukkan uraian atau deskripsi sub CPMK">{{ old('uraian_cpmk', $subcpmk->uraian_cpmk) }}</textarea>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-600 px-5 py-2 rounded-lg hover:bg-blue-800 mt-4 text-white font-bold">
                    Simpan
                </button>
                <a href="{{ route('admin.subcpmk.index') }}"
                    class="ml-2 bg-gray-600 inline-flex px-5 py-2 rounded-lg hover:bg-gray-700 mt-4 text-white font-bold">
                    Kembali
                </a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            const mkSelect = document.getElementById('kode_mk');
            const cpmkSelect = document.getElementById('id_cpmk');
            const currentCpmkIds = [{{ $subcpmk->id_cpmk }}]; // Bisa di-extend untuk multiple

            mkSelect.addEventListener('change', function() {
                const selectedMK = this.value;

                // Reset CPMK select
                cpmkSelect.innerHTML = '<option value="" disabled>Memuat CPMK...</option>';

                if (!selectedMK) {
                    cpmkSelect.innerHTML = '<option value="" disabled>Pilih Mata Kuliah terlebih dahulu</option>';
                    return;
                }

                // Fetch CPMK berdasarkan mata kuliah yang dipilih
                fetch("{{ route('admin.subcpmk.getCpmkByMataKuliah') }}", {
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

                                // Auto select semua CPMK atau pilih yang sudah ada sebelumnya
                                option.selected = true;

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