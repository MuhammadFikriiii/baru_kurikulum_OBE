@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-10">
        <h2 class="font-extrabold text-4xl mb-6 text-center">Edit Mata Kuliah</h2>
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

        <form action="{{ route('admin.matakuliah.update', $matakuliah->kode_mk) }}" method="POST">
            @csrf
            @method('PUT')

            <div id="cplContainer" class="mt-3">
                <label class="text-xl font-semibold">CPL Terisi otomatis setelah memilih bk:</label>
                <ul id="cplList" class="mt-1 w-full p-3 border border-black rounded-lg">
                    {{-- Tampilkan CPL awal jika ada --}}
                    @foreach ($selectedCpls as $cpl)
                        <li>{{ $cpl->kode_cpl }}: {{ $cpl->deskripsi_cpl }}</li>
                    @endforeach
                </ul>
            </div>

            <label for="id_bks" class="text-xl font-semibold">BK</label>
            <select name="id_bks[]" id="id_bks" size="4" multiple
                class="border border-black p-3 w-full mt-1 mb-3 rounded-lg">
                @foreach ($bahanKajians as $bk)
                    <option value="{{ $bk->id_bk }}" @if (in_array($bk->id_bk, $selectedBahanKajian ?? [])) selected @endif>
                        {{ $bk->kode_bk }} - {{ $bk->nama_bk }}
                    </option>
                @endforeach
            </select>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="space-y-6">
                    <div>
                        <label for="kode_mk" class="block text-xl font-medium">Kode Mata Kuliah</label>
                        <input type="text" name="kode_mk" id="kode_mk"
                            value="{{ old('kode_mk', $matakuliah->kode_mk) }}"
                            class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-[#5460B5] focus:border-[#5460B5]"
                            required>
                    </div>

                    <div>
                        <label for="nama_mk" class="block text-xl font-medium">Nama Mata Kuliah</label>
                        <input type="text" name="nama_mk" id="nama_mk"
                            value="{{ old('nama_mk', $matakuliah->nama_mk) }}"
                            class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-[#5460B5] focus:border-[#5460B5]"
                            required>
                    </div>

                    <div>
                        <label for="jenis_mk" class="block text-xl font-medium">Jenis MataKuliah</label>
                        <input type="text" name="jenis_mk" id="jenis_mk"
                            value="{{ old('jenis_mk', $matakuliah->jenis_mk) }}"
                            class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-[#5460B5] focus:border-[#5460B5]"
                            required>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label for="sks_mk" class="block text-xl font-medium">SKS MataKuliah</label>
                        <input type="number" name="sks_mk" id="sks_mk"
                            value="{{ old('sks_mk', $matakuliah->sks_mk) }}"
                            class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-[#5460B5] focus:border-[#5460B5]"
                            required>
                    </div>

                    <div>
                        <label for="semester_mk" class="block text-xl font-medium">Semester</label>
                        <select name="semester_mk" id="semester_mk"
                            class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-[#5460B5] focus:border-[#5460B5]"
                            required>
                            @for ($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}"
                                    {{ old('semester_mk', $matakuliah->semester_mk) == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label for="kompetensi_mk" class="block text-xl font-medium">Kompetensi MK</label>
                        <select name="kompetensi_mk" id="kompetensi_mk"
                            class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-[#5460B5] focus:border-[#5460B5]"
                            required>
                            <option value="pendukung"
                                {{ old('kompetensi_mk', $matakuliah->kompetensi_mk) == 'pendukung' ? 'selected' : '' }}>
                                Pendukung</option>
                            <option value="utama"
                                {{ old('kompetensi_mk', $matakuliah->kompetensi_mk) == 'utama' ? 'selected' : '' }}>Utama
                            </option>
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
                    Simpan Perubahan
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

                fetch("{{ route('admin.matakuliah.getCplByBk') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            id_bks: selectedBKs
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        cplList.innerHTML = "";
                        data.forEach(cpl => {
                            const li = document.createElement('li');
                            li.textContent = `${cpl.kode_cpl} - ${cpl.deskripsi_cpl}`;
                            cplList.appendChild(li);
                        });
                    });
            });
        </script>
    @endpush
@endsection
