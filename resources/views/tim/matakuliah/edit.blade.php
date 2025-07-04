@extends('layouts.tim.app')
@section('content')

    <div class="ml-20 mr-20">
        <h1 class="text-4xl text-center font-extrabold mb-4">Edit Mata Kuliah</h1>
        <hr class="border border-black mb-3">
        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tim.matakuliah.update', $matakuliah->kode_mk) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="id_bks" class="text-xl font-semibold">BK Terkait:</label>
            <select name="id_bks[]" id="id_bks" size="5" multiple
                class="border border-black p-3 w-full mt-1 mb-3 rounded-lg">
                @foreach ($bahankajians as $bk)
                    <option value="{{ $bk->id_bk }}" @if (in_array($bk->id_bk, $selectedBahanKajian ?? [])) selected @endif>
                        {{ $bk->kode_bk }} - {{ $bk->nama_bk }}
                    </option>
                @endforeach
            </select>

            <div id="cplContainer" class="mt-3">
                <label class="text-xl font-semibold">CPL Terisi otomatis setelah memilih bk:</label>
                <ul id="cplList" class="mt-1 w-full p-3 border border-black rounded-lg">
                    {{-- Tampilkan CPL awal jika ada --}}
                    @foreach ($selectedCpls as $cpl)
                        <li>{{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}</li>
                    @endforeach
                </ul>
            </div>


            <label for="kode_mk" class="text-xl font-semibold">Kode MK</label>
            <input type="text" name="kode_mk" id="kode_mk" value="{{ old('kode_mk', $matakuliah->kode_mk) }}"
                class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
            <br>
            <label for="nama_mk" class="text-xl font-semibold">Nama MK</label>
            <input type="text" name="nama_mk" id="nama_mk" value="{{ old('nama_mk', $matakuliah->nama_mk) }}"
                class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
            <br>
            <label for="jenis_mk" class="text-xl font-semibold">Jenis MK</label>
            <input type="text" name="jenis_mk" id="jenis_mk" value="{{ old('jenis_mk', $matakuliah->jenis_mk) }}"
                class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
            <br>
            <label for="sks_mk" class="text-xl font-semibold">Sks MK</label>
            <input type="number" name="sks_mk" id="sks_mk" value="{{ old('sks_mk', $matakuliah->sks_mk) }}"
                class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
            <br>
            <label for="semester_mk" class="text-xl font-semibold">Semester</label>
            <select name="semester_mk" id="semester_mk" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg"
                required>
                @for ($i = 1; $i <= 8; $i++)
                    <option value="{{ $i }}" {{ $matakuliah->semester_mk == $i ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
            <br>
            <label for="kompetensi_mk" class="text-xl font-semibold">Kompetensi MK</label>
            <select name="kompetensi_mk" id="kompetensi_mk" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg"
                required>
                <option value="pendukung" {{ $matakuliah->kompetensi_mk == 'pendukung' ? 'selected' : '' }}>pendukung
                </option>
                <option value="utama" {{ $matakuliah->kompetensi_mk == 'utama' ? 'selected' : '' }}>utama</option>
            </select>

            <button type="submit"
                class="mt-3 bg-blue-600 hover:bg-blue-800 px-5 py-2 rounded-lg text-white font-semibold">Simpan</button>
            <a href="{{ route('tim.matakuliah.index') }}"
                class="ml-2 bg-gray-600 hover:bg-gray-800 px-5 py-2 rounded-lg text-white font-semibold">Kembali</a>
        </form>
    </div>
    @push('scripts')
        <script>
            const cplList = document.getElementById('cplList');
            const bkSelect = document.getElementById('id_bks');

            bkSelect.addEventListener('change', function() {
                const selectedBKs = Array.from(this.selectedOptions).map(opt => opt.value);

                // Tampilkan loading
                cplList.innerHTML = '<li class="text-blue-500">Memuat data CPL...</li>';

                // Tentukan URL fetch (local atau production)
                const isLocal = window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1' ||
                    window.location.hostname.includes('local');
                let url;

                if (isLocal) {
                    url = "{{ route('tim.matakuliah.getCplByBk') }}";
                } else {
                    url = window.location.protocol + '//' + window.location.host +
                        "{{ route('tim.matakuliah.getCplByBk', [], false) }}";
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
                            id_bks: selectedBKs
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
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
