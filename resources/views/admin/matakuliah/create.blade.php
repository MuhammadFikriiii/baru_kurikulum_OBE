@extends('layouts.app')
@section('content')

    <div class="container mx-auto px-10">
        <h2 class="font-extrabold text-4xl mb-6 text-center">Tambah MataKuliah</h2>
        <hr class="w-full border border-black mb-8">

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.matakuliah.store') }}" method="POST">
            @csrf
            <div id="cplContainer" class="mt-3">
                <label class="text-xl font-semibold">CPL Terisi otomatis setelah memilih bk:</label>
                <ul id="cplList" class="mt-1 w-full p-3 border border-black rounded-lg"></ul>
            </div>

            <label for="id_bks" class="text-xl font-semibold mb-2">BK Terkait:</label>
            <select id="id_bks" name="id_bks[]" size="4"
                class="border border-black p-3 mb-1 w-full rounded-lg mt-1" multiple required>
                @foreach ($bahanKajians as $bk)
                    <option value="{{ $bk->id_bk }}" title="{{ $bk->kode_bk }} - {{ $bk->nama_bk }}">
                        {{ $bk->tahun }}:{{ $bk->nama_prodi }}: {{ $bk->kode_bk }}: {{ $bk->nama_bk }}
                    </option>
                @endforeach
            </select>
            <p class="italic text-red-700 mb-2">*Tekan tombol Ctrl dan klik untuk memilih lebih dari satu item.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="space-y-6">
                    <div>
                        <label for="kode_mk" class="block text-xl font-medium">Kode Mata Kuliah</label>
                        <input type="text" name="kode_mk" id="kode_mk"
                            class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-[#5460B5] focus:border-[#5460B5]">
                    </div>

                    <div>
                        <label for="nama_mk" class="block text-xl font-medium">Nama Mata Kuliah</label>
                        <input type="text" name="nama_mk" id="nama_mk"
                            class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-[#5460B5] focus:border-[#5460B5]">
                    </div>

                    <div>
                        <label for="jenis_mk" class="block text-xl font-medium">Jenis MataKuliah</label>
                        <input type="text" name="jenis_mk" id="jenis_mk"
                            class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-[#5460B5] focus:border-[#5460B5]">
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label for="sks_mk" class="block text-xl font-medium">SKS MataKuliah</label>
                        <input type="number" name="sks_mk" id="sks_mk"
                            class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-[#5460B5] focus:border-[#5460B5]">
                    </div>

                    <div>
                        <label for="semester_mk" class="block text-xl font-medium">Semester MataKuliah</label>
                        <select name="semester_mk" id="semester_mk"
                            class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-[#5460B5] focus:border-[#5460B5]">
                            <option value="" disabled selected>Pilih Semester</option>
                            @for ($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label for="kompetensi_mk" class="block text-xl font-medium">Kompetensi MataKuliah</label>
                        <select name="kompetensi_mk" id="kompetensi_mk"
                            class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-[#5460B5] focus:border-[#5460B5]">
                            <option value="" selected disabled>Pilih Kompetensi MK</option>
                            <option value="pendukung">Pendukung</option>
                            <option value="utama">Utama</option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="flex justify-end space-x-4 mt-8">
                <a href="{{ route('admin.matakuliah.index') }}"
                    class="bg-gray-400 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition duration-200">
                    Kembali
                </a>
                <button type="submit"
                    class="bg-[#5460B5] hover:bg-[#424a8f] text-white px-6 py-2 rounded-lg transition duration-200">
                    Simpan
                </button>
            </div>
        </form>
    </div>
    @push('scripts')
        <script>
            const cplList = document.getElementById('cplList');
            const bkSelect = document.getElementById('id_bks');

            bkSelect.addEventListener('change', function() {
                const selectedBKs = Array.from(this.selectedOptions).map(opt => opt.value);

                // Debug: tampilkan selected BKs
                console.log('Selected BKs:', selectedBKs);

                // Jika tidak ada BK yang dipilih, kosongkan CPL list
                if (selectedBKs.length === 0) {
                    cplList.innerHTML = '<li class="text-gray-500 italic">Pilih BK terlebih dahulu</li>';
                    return;
                }

                // Tampilkan loading
                cplList.innerHTML = '<li class="text-blue-500">Memuat data CPL...</li>';

                // URL yang otomatis menyesuaikan protokol dan environment
                const isLocal = window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1' ||
                    window.location.hostname.includes('local');
                let url;

                if (isLocal) {
                    url = "{{ route('admin.matakuliah.getCplByBk') }}";
                } else {
                    // Untuk hosting, gunakan URL lengkap dengan protokol yang sama
                    url = window.location.protocol + '//' + window.location.host +
                        "{{ route('admin.matakuliah.getCplByBk', [], false) }}";
                }

                console.log('Fetch URL:', url); // Debug URL

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
                            id_bks: selectedBKs
                        })
                    })
                    .then(response => {
                        console.log('Response status:', response.status); // Debug response
                        console.log('Response headers:', response.headers); // Debug headers

                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Response data:', data); // Debug data

                        cplList.innerHTML = "";

                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(cpl => {
                                const li = document.createElement('li');
                                li.textContent = `${cpl.kode_cpl} - ${cpl.deskripsi_cpl}`;
                                li.className = 'mb-1 p-2 bg-gray-50 rounded';
                                cplList.appendChild(li);
                            });
                        } else if (data && data.cpls && Array.isArray(data.cpls)) {
                            // Jika data dibungkus dalam object
                            data.cpls.forEach(cpl => {
                                const li = document.createElement('li');
                                li.textContent = `${cpl.kode_cpl} - ${cpl.deskripsi_cpl}`;
                                li.className = 'mb-1 p-2 bg-gray-50 rounded';
                                cplList.appendChild(li);
                            });
                        } else {
                            const li = document.createElement('li');
                            li.textContent = 'Tidak ada CPL yang ditemukan untuk BK yang dipilih';
                            li.className = 'text-gray-500 italic';
                            cplList.appendChild(li);
                        }
                    })
                    .catch(error => {
                        console.error('Fetch Error:', error);
                        cplList.innerHTML = "";
                        const li = document.createElement('li');
                        li.textContent = `Terjadi kesalahan: ${error.message}`;
                        li.className = 'text-red-500';
                        cplList.appendChild(li);
                    });
            });
        </script>
    @endpush
@endsection
