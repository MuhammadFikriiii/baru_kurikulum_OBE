@extends('layouts.app')

@section('content')
    <div class="mr-20 ml-20">
        <h2 class="text-4xl font-extrabold text-center mb-4">Tambah Capaian Pembelajaran Matakuliah</h2>
        <hr class="w-full border border-black mb-4">

        <form action="{{ route('admin.capaianpembelajaranmatakuliah.store') }}" method="POST">
            @csrf

            <label for="id_cpls" class="text-xl font-semibold mb-2">CPL Terkait</label>
            <select id="id_cpls" name="id_cpls[]" size="4"
                class="border border-black p-3 w-full rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]"
                multiple required>
                @foreach ($capaianProfilLulusans as $cpl)
                    <option value="{{ $cpl->id_cpl }}">
                        {{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}
                    </option>
                @endforeach
            </select>
            <p class="italic text-red-700 mb-2">*Tekan tombol Ctrl dan klik untuk memilih lebih dari satu item.</p>

            <div id="mkContainer" class="mt-3">
                <label class="text-xl font-semibold">MK Terkait (Pilih yang akan dikaitkan dengan CPMK):</label>
                <div id="mkList"
                    class="mt-1 w-full p-3 border border-black rounded-lg min-h-[80px] bg-gray-50 max-h-[300px] overflow-y-auto">
                </div>
                <p class="italic text-blue-600 text-sm mt-1">*Pilih mata kuliah yang akan dikaitkan dengan CPMK ini</p>
            </div>

            <label for="kode_cpmk">Kode CPMK</label>
            <input type="text" name="kode_cpmk" id="kode_cpmk"
                class="border border-black p-3 w-full rounded-lg mt-1 mb-3" required>

            <label for="deskripsi_cpmk">Deskripsi CPMK</label>
            <input type="text" name="deskripsi_cpmk" id="deskripsi_cpmk"
                class="border border-black p-3 w-full rounded-lg mt-1 mb-3" required>

            <button type="submit" class="px-4 py-2 bg-green-400 rounded-lg hover:bg-green-600 mt-4">Simpan</button>
        </form>

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

                    // Tampilkan loading state
                    mkList.innerHTML = '<div class="text-blue-500 italic">Memuat mata kuliah...</div>';

                    // SOLUSI: Menggunakan protokol relatif untuk menghindari mixed content error
                    fetch("{{ str_replace(['http://', 'https://'], '//', url(route('admin.capaianpembelajaranmatakuliah.getMKByCPL'))) }}", {
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

                                    mkItem.innerHTML = `
                                        <label class="flex items-center cursor-pointer">
                                            <input type="checkbox" 
                                                   name="selected_mks[]" 
                                                   value="${mk.kode_mk}" 
                                                   class="mr-3 h-4 w-4 text-blue-600 rounded focus:ring-blue-500"
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

                // Initialize dengan pesan default
                mkList.innerHTML = '<div class="text-gray-500 italic">Pilih CPL terlebih dahulu</div>';

                // Validasi form sebelum submit
                document.querySelector('form').addEventListener('submit', function(e) {
                    const selectedMKs = document.querySelectorAll('input[name="selected_mks[]"]:checked');

                    if (selectedMKs.length === 0) {
                        e.preventDefault();
                        alert('Pilih minimal satu mata kuliah yang akan dikaitkan dengan CPMK ini!');
                        return false;
                    }
                });
            </script>
        @endpush
    </div>
@endsection
