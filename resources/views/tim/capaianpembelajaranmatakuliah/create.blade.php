@extends('layouts.tim.app')

@section('content')
    <div class="ml-20 mr-20">
        <h1 class="text-4xl font-extrabold mb-6 text-center">Tambah Capaian Pembelajaran Mata Kuliah</h1>
        <hr class="w-full border border-black mb-4">

        @if ($errors->any())
            <div class="text-red-600 mb-4">
                <ul class="list-disc ml-6">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tim.capaianpembelajaranmatakuliah.store') }}" method="POST">
            @csrf

            {{-- CPL Terkait --}}
            <label for="id_cpls" class="text-xl font-semibold">CPL Terkait</label>
            <select id="id_cpls" name="id_cpls[]" size="3"
                class="border border-black p-3 w-full rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]"
                multiple required>
                @foreach ($cpls as $cpl)
                    <option value="{{ $cpl->id_cpl }}">
                        {{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}
                    </option>
                @endforeach
            </select>
            <p class="italic text-red-700 mb-3">*Tekan Ctrl dan klik untuk memilih lebih dari satu CPL</p>

            {{-- MK Terkait (Dinamis) --}}
            <div id="mkContainer" class="mt-3">
                <label class="text-xl font-semibold">MK Terkait:</label>
                <div id="mkList"
                    class="mt-1 w-full p-3 border border-black rounded-lg bg-gray-50 max-h-[300px] overflow-y-auto min-h-[60px] text-sm">
                </div>
                <p class="italic text-blue-600 text-sm mt-1">*Centang mata kuliah yang akan dikaitkan dengan CPMK ini</p>
            </div>

            {{-- Kode CPMK --}}
            <label for="kode_cpmk" class="text-xl font-semibold mt-4 block">Kode CPMK</label>
            <input type="text" name="kode_cpmk" id="kode_cpmk"
                class="border border-black p-3 w-full rounded-lg mt-1 mb-3" required>

            {{-- Deskripsi CPMK --}}
            <label for="deskripsi_cpmk" class="text-xl font-semibold">Deskripsi CPMK</label>
            <input type="text" name="deskripsi_cpmk" id="deskripsi_cpmk"
                class="border border-black p-3 w-full rounded-lg mt-1 mb-3" required>

            {{-- Tombol --}}
            <button type="submit"
                class="px-5 py-2 bg-blue-600 rounded-lg hover:bg-blue-800 text-white font-bold mt-4">Simpan</button>
            <a href="{{ route('tim.capaianpembelajaranmatakuliah.index') }}"
                class="ml-2 bg-gray-600 hover:bg-gray-700 text-white font-bold px-5 py-2 rounded-lg">Kembali</a>
        </form>
    </div>

    @push('scripts')
        <script>
            const mkList = document.getElementById('mkList');
            const cplSelect = document.getElementById('id_cpls');

            cplSelect.addEventListener('change', function() {
                const selectedCPLs = Array.from(this.selectedOptions).map(opt => opt.value);

                if (selectedCPLs.length === 0) {
                    mkList.innerHTML = '<div class="text-gray-500 italic">Pilih CPL terlebih dahulu</div>';
                    return;
                }

                mkList.innerHTML = '<div class="text-blue-500 italic">Memuat mata kuliah...</div>';

                // Deteksi apakah localhost atau production
                const isLocal = window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1' ||
                    window.location.hostname.includes('local');
                let url;

                if (isLocal) {
                    url = "{{ route('tim.capaianpembelajaranmatakuliah.getMKByCPL') }}";
                } else {
                    url = window.location.protocol + '//' + window.location.host +
                        "{{ route('tim.capaianpembelajaranmatakuliah.getMKByCPL', [], false) }}";
                }

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        credentials: 'same-origin',
                        body: JSON.stringify({
                            id_cpls: selectedCPLs
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        mkList.innerHTML = "";

                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach((mk) => {
                                mkList.innerHTML += `
                        <label class="block my-1">
                            <input type="checkbox" name="selected_mks[]" value="${mk.kode_mk}" class="mr-2">
                            ${mk.kode_mk} - ${mk.nama_mk}
                        </label>`;
                            });

                            mkList.innerHTML += `
                    <div class="mt-3 pt-2 border-t">
                        <button type="button" id="selectAllMK" class="text-sm text-blue-600 mr-3">Pilih Semua</button>
                        <button type="button" id="deselectAllMK" class="text-sm text-red-600">Hapus Semua</button>
                    </div>`;

                            document.getElementById('selectAllMK').addEventListener('click', () => {
                                mkList.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked =
                                    true);
                            });

                            document.getElementById('deselectAllMK').addEventListener('click', () => {
                                mkList.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked =
                                    false);
                            });
                        } else {
                            mkList.innerHTML = '<div class="text-red-500 italic">Tidak ada MK terkait</div>';
                        }
                    })
                    .catch(error => {
                        console.error('Fetch Error:', error);
                        mkList.innerHTML =
                            `<div class="text-red-500 italic">Gagal memuat MK: ${error.message}</div>`;
                    });
            });

            // Inisialisasi awal
            mkList.innerHTML = '<div class="text-gray-500 italic">Pilih CPL terlebih dahulu</div>';

            // Validasi sebelum submit (wajib pilih MK)
            document.querySelector('form').addEventListener('submit', function(e) {
                if (document.querySelectorAll('input[name="selected_mks[]"]:checked').length === 0) {
                    e.preventDefault();
                    alert('Pilih minimal satu MK terlebih dahulu!');
                }
            });
        </script>
    @endpush
@endsection
