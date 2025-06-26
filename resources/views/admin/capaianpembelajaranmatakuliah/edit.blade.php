@extends('layouts.app')

@section('content')
    <div class="mr-20 ml-20">
        <h2 class="text-4xl font-extrabold text-center mb-4">Edit Capaian Pembelajaran Mata Kuliah</h2>
        <hr class="w-full border border-black mb-4">

        <form action="{{ route('admin.capaianpembelajaranmatakuliah.update', $cpmks->id_cpmk) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="id_cpls" class="text-xl font-semibold mb-2">CPL Terkait</label>
            <select id="id_cpls" name="id_cpls[]" size="4"
                class="border border-black p-3 w-full rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]"
                multiple required>
                @foreach ($capaianProfilLulusans as $cpl)
                    <option value="{{ $cpl->id_cpl }}"
                        {{ in_array($cpl->id_cpl, old('id_cpls', $selectedCplIds)) ? 'selected' : '' }}>
                        {{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}
                    </option>
                @endforeach
            </select>
            <p class="italic text-red-700 mb-2">*Tekan tombol Ctrl dan klik untuk memilih lebih dari satu item.</p>

            <div id="mkContainer" class="mt-3 mb-4">
                <label class="text-xl font-semibold">MK Terkait (Pilih yang akan dikaitkan dengan CPMK):</label>
                <div id="mkList"
                    class="mt-1 w-full p-3 border border-black rounded-lg min-h-[80px] bg-gray-50 max-h-[300px] overflow-y-auto">
                    {{-- Tampilkan MK yang tersedia berdasarkan CPL yang dipilih --}}
                    @if ($availableMKs->count() > 0)
                        @foreach ($availableMKs as $mk)
                            <div class="mb-2 p-3 bg-white rounded border hover:bg-blue-50 transition-colors">
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="selected_mks[]" value="{{ $mk->kode_mk }}"
                                        class="mr-3 h-4 w-4 text-blue-600 rounded focus:ring-blue-500"
                                        {{ in_array($mk->kode_mk, $selectedMKCodes) ? 'checked' : '' }}>
                                    <span class="text-sm">
                                        <strong>{{ $mk->kode_mk }}</strong> - {{ $mk->nama_mk }}
                                    </span>
                                </label>
                            </div>
                        @endforeach
                        <div class="mt-3 pt-3 border-t border-gray-300">
                            <button type="button" id="selectAllMK" class="text-sm text-blue-600 hover:text-blue-800 mr-4">
                                Pilih Semua
                            </button>
                            <button type="button" id="deselectAllMK" class="text-sm text-red-600 hover:text-red-800">
                                Hapus Semua
                            </button>
                        </div>
                    @else
                        <div class="text-gray-500 italic">
                            @if (empty($selectedCplIds))
                                Pilih CPL terlebih dahulu
                            @else
                                Tidak ada mata kuliah terkait dengan CPL yang dipilih
                            @endif
                        </div>
                    @endif
                </div>
                <p class="italic text-blue-600 text-sm mt-1">*Pilih mata kuliah yang akan dikaitkan dengan CPMK ini</p>
            </div>

            <label for="kode_cpmk" class="text-2xl font-semibold mb-2">Kode CPMK:</label>
            <input type="text" name="kode_cpmk" id="kode_cpmk" value="{{ old('kode_cpmk', $cpmks->kode_cpmk) }}"
                class="border border-gray-300 p-3 w-full rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]"
                required>

            <label for="deskripsi_cpmk" class="text-2xl font-semibold mb-2">Deskripsi CPMK:</label>
            <textarea name="deskripsi_cpmk" id="deskripsi_cpmk" rows="3"
                class="border border-gray-300 p-3 w-full rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]"
                required>{{ old('deskripsi_cpmk', $cpmks->deskripsi_cpmk) }}</textarea>

            <div class="flex gap-3">
                <button type="submit"
                    class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-200">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.capaianpembelajaranmatakuliah.index') }}"
                    class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200">
                    Batal
                </a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            const mkList = document.getElementById('mkList');
            const cplSelect = document.getElementById('id_cpls');

            // Simpan data MK yang sudah dipilih sebelumnya
            const originalSelectedMKs = @json($selectedMKCodes ?? []);

            cplSelect.addEventListener('change', function() {
                const selectedCPLs = Array.from(this.selectedOptions).map(opt => opt.value);

                if (selectedCPLs.length === 0) {
                    mkList.innerHTML = '<div class="text-gray-500 italic">Pilih CPL terlebih dahulu</div>';
                    return;
                }

                // Tampilkan loading state
                mkList.innerHTML = '<div class="text-blue-500 italic">Memuat mata kuliah...</div>';

                fetch("{{ route('admin.capaianpembelajaranmatakuliah.getMKByCPL') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            id_cpls: selectedCPLs
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        mkList.innerHTML = "";

                        if (data.length === 0) {
                            mkList.innerHTML =
                                '<div class="text-red-500 italic">Tidak ada mata kuliah terkait dengan CPL yang dipilih</div>';
                        } else {
                            data.forEach((mk, index) => {
                                const mkItem = document.createElement('div');
                                mkItem.className =
                                    'mb-2 p-3 bg-white rounded border hover:bg-blue-50 transition-colors';

                                // Periksa apakah MK ini sudah dipilih sebelumnya
                                const isSelected = originalSelectedMKs.includes(mk.kode_mk);

                                mkItem.innerHTML = `
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" 
                                               name="selected_mks[]" 
                                               value="${mk.kode_mk}" 
                                               class="mr-3 h-4 w-4 text-blue-600 rounded focus:ring-blue-500"
                                               ${isSelected ? 'checked' : ''}
                                               id="mk_${index}">
                                        <span class="text-sm">
                                            <strong>${mk.kode_mk}</strong> - ${mk.nama_mk}
                                        </span>
                                    </label>
                                `;

                                mkList.appendChild(mkItem);
                            });

                            // Tambahkan tombol select all/none
                            const controlDiv = document.createElement('div');
                            controlDiv.className = 'mt-3 pt-3 border-t border-gray-300';
                            controlDiv.innerHTML = `
                                <button type="button" id="selectAllMK" class="text-sm text-blue-600 hover:text-blue-800 mr-4">
                                    Pilih Semua
                                </button>
                                <button type="button" id="deselectAllMK" class="text-sm text-red-600 hover:text-red-800">
                                    Hapus Semua
                                </button>
                            `;
                            mkList.appendChild(controlDiv);

                            // Event listener untuk select all/none
                            document.getElementById('selectAllMK').addEventListener('click', function() {
                                const checkboxes = mkList.querySelectorAll('input[type="checkbox"]');
                                checkboxes.forEach(cb => cb.checked = true);
                            });

                            document.getElementById('deselectAllMK').addEventListener('click', function() {
                                const checkboxes = mkList.querySelectorAll('input[type="checkbox"]');
                                checkboxes.forEach(cb => cb.checked = false);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        mkList.innerHTML =
                            '<div class="text-red-500 italic">Terjadi kesalahan saat memuat data</div>';
                    });
            });

            // Tambahkan event listener untuk tombol select all/none yang sudah ada di halaman
            const selectAllBtn = document.getElementById('selectAllMK');
            const deselectAllBtn = document.getElementById('deselectAllMK');

            if (selectAllBtn) {
                selectAllBtn.addEventListener('click', function() {
                    const checkboxes = mkList.querySelectorAll('input[type="checkbox"]');
                    checkboxes.forEach(cb => cb.checked = true);
                });
            }

            if (deselectAllBtn) {
                deselectAllBtn.addEventListener('click', function() {
                    const checkboxes = mkList.querySelectorAll('input[type="checkbox"]');
                    checkboxes.forEach(cb => cb.checked = false);
                });
            }

            // Tambahkan event listener untuk mendeteksi perubahan pada form
            const form = document.querySelector('form');
            let isFormChanged = false;

            // Monitor perubahan pada input
            ['input', 'change'].forEach(eventType => {
                form.addEventListener(eventType, function() {
                    isFormChanged = true;
                });
            });

            // Warning jika user mencoba meninggalkan halaman tanpa menyimpan
            window.addEventListener('beforeunload', function(e) {
                if (isFormChanged) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });

            // Reset flag ketika form disubmit
            form.addEventListener('submit', function(e) {
                const selectedMKs = document.querySelectorAll('input[name="selected_mks[]"]:checked');

                if (selectedMKs.length === 0) {
                    e.preventDefault();
                    alert('Pilih minimal satu mata kuliah yang akan dikaitkan dengan CPMK ini!');
                    return false;
                }

                isFormChanged = false;
            });
        </script>
    @endpush
@endsection
