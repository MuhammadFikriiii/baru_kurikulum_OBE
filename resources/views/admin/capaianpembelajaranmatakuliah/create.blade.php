@extends('layouts.app')

@section('content')
    <div class="mr-20 ml-20">
        <h2 class="text-4xl font-extrabold text-center mb-4">Tambah Capaian Pembelajaran Matakuliah</h2>
        <hr class="w-full border border-black mb-4">

        <form action="{{ route('admin.capaianpembelajaranmatakuliah.store') }}" method="POST">
            @csrf
            <div id="cplContainer" class="mt-3">
                <label class="text-xl font-semibold">CPL Terisi otomatis setelah memilih mk:</label>
                <ul id="cplList" class="mt-1 w-full p-3 border border-black rounded-lg"></ul>
            </div>

            <label for="kode_mks" class="text-xl font-semibold mb-2">MK Terkait</label>
            <select id="kode_mks" name="kode_mks[]" size="2"
                class="border border-black p-3 w-full rounded-lg mt-1 mb-1 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]"
                multiple required>
                @foreach ($mataKuliahs as $mk)
                    <option value="{{ $mk->kode_mk }}" title="{{ $mk->nama_mk }}">
                        {{ $mk->kode_mk }} - {{ $mk->nama_mk }}
                    </option>
                @endforeach
            </select>
            <p class="italic text-red-700 mb-2">*Tekan tombol Ctrl dan klik untuk memilih lebih dari satu item.</p>

            <label for="kode_cpmk">Kode CPMK</label>
            <input type="text" name="kode_cpmk" id="kode_cpmk"
                class="border border-black p-3 w-full rounded-lg mt-1 mb-3" required>

            <label for="deskripsi_cpmk">Deskripsi CPMK</label>
            <input type="text" name="deskripsi_cpmk" id="deskripsi_cpmk"
                class="border border-black p-3 w-full rounded-lg mt-1 mb-3" required>

            <button type="submit" class="px-4 py-2 bg-green-400 rounded-lg hover:bg-green-600 mt-4">simpan</button>
        </form>

        @push('scripts')
            <script>
                const cplList = document.getElementById('cplList');
                const mkSelect = document.getElementById('kode_mks');

                mkSelect.addEventListener('change', function() {
                    const selectedMKs = Array.from(this.selectedOptions).map(opt => opt.value);

                    fetch("{{ route('admin.capaianpembelajaranmatakuliah.getCPLByMK') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                kode_mks: selectedMKs
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
