@extends('layouts.tim.app')

@section('content')
    <div class="ml-20 mr-20">
        <h2 class="font-extrabold text-4xl mb-6 text-center">Tambah MataKuliah</h2>
        <hr class="w-full border border-black mb-4">

        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tim.matakuliah.store') }}" method="POST">
            @csrf

            <label for="id_bks" class="text-xl font-semibold mb-2">BK Terkait:</label>
            <select id="id_bks" name="id_bks[]" size="5"
                class="border border-black p-3 mb-1 w-full rounded-lg mt-1" multiple required>
                @foreach ($bahanKajians as $bk)
                    <option value="{{ $bk->id_bk }}" title="{{ $bk->kode_bk }} - {{ $bk->nama_bk }}">
                        {{ $bk->kode_bk }} - {{ $bk->nama_bk }}
                    </option>
                @endforeach
            </select>
            
            <p class="italic text-red-700 mb-2">*Tekan tombol Ctrl dan klik untuk memilih lebih dari satu item.</p>
            <div id="cplContainer" class="mt-3">
                <label class="text-xl font-semibold">CPL Terisi otomatis setelah memilih bk:</label>
                <ul id="cplList" class="mt-1 w-full p-3 border border-black rounded-lg"></ul>
            </div>

        

            <div class="mt-3">
                <label for="kode_mk" class="text-xl font-semibold">Kode Mata Kuliah</label>
                <input type="text" name="kode_mk" id="kode_mk" class="mt-1 w-full p-3 border border-black rounded-lg ">
            </div>
            <div class="mt-3">
                <label for="nama_mk" class="text-xl font-semibold">Nama Mata Kuliah</label>
                <input type="text" name="nama_mk" id="nama_mk" class="mt-1 w-full p-3 border border-black rounded-lg ">
            </div>
            <div class="mt-3">
                <label for="jenis_mk" class="text-xl font-semibold">Jenis MataKuliah</label>
                <input type="text" name="jenis_mk" id="jenis_mk"
                    class="mt-1 w-full p-3 border border-black rounded-lg ">
            </div>
            <div class="mt-3">
                <label for="sks_mk" class="text-xl font-semibold">SKS MataKuliah</label>
                <input type="number" name="sks_mk" id="sks_mk" class="mt-1 w-full p-3 border border-black rounded-lg ">
            </div>
            <div class="mt-3">
                <label for="semester_mk" class="text-xl font-semibold">Semester MataKuliah</label>
                <select name="semester_mk" id="semester_mk" class="mt-1 w-full p-3 border border-black rounded-lg ">
                    <option value="" disabled selected>Pilih Semester</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                </select>
            </div>
            <div class="mt-3">
                <label for="kompetensi_mk" class="text-xl font-semibold">kompetensi MataKuliah</label>
                <select name="kompetensi_mk" id="kompetensi_mk" class="mt-1 w-full p-3 border border-black rounded-lg mb-3">
                    <option value="" selected disabled>Pilih Kompetensi MK</option>
                    <option value="pendukung">pendukung</option>
                    <option value="utama">utama</option>
                </select>
            </div>
            <div>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-800 text-white font-bold mt-3 px-5 py-2 rounded-lg">Simpan</button>
                <a href="{{ route('tim.matakuliah.index') }}"
                    class="bg-gray-600 hover:bg-gray-700 px-5 py-2 rounded-lg text-white font-bold ml-2">Kembali</a>
            </div>
        </form>
    </div>
        @push('scripts')
            <script>
                const cplList = document.getElementById('cplList');
                const bkSelect = document.getElementById('id_bks');

                bkSelect.addEventListener('change', function() {
                    const selectedBKs = Array.from(this.selectedOptions).map(opt => opt.value);

                    // Debug
                    console.log('Selected BKs:', selectedBKs);

                    if (selectedBKs.length === 0) {
                        cplList.innerHTML = '<li class="text-gray-500 italic">Pilih BK terlebih dahulu</li>';
                        return;
                    }

                    cplList.innerHTML = '<li class="text-blue-500">Memuat data CPL...</li>';

                    // Penentuan URL otomatis
                    const isLocal = window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1' ||
                        window.location.hostname.includes('local');
                    let url;

                    if (isLocal) {
                        url = "{{ route('tim.matakuliah.getCplByBk') }}";
                    } else {
                        url = window.location.protocol + '//' + window.location.host +
                            "{{ route('tim.matakuliah.getCplByBk', [], false) }}";
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
                            console.log('Response status:', response.status);
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Response data:', data);

                            cplList.innerHTML = "";

                            if (Array.isArray(data) && data.length > 0) {
                                data.forEach(cpl => {
                                    const li = document.createElement('li');
                                    li.textContent = `${cpl.kode_cpl} - ${cpl.deskripsi_cpl}`;
                                    li.className = 'mb-1 p-2 bg-gray-50 rounded';
                                    cplList.appendChild(li);
                                });
                            } else if (data && data.cpls && Array.isArray(data.cpls)) {
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
