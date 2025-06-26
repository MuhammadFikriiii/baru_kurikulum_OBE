@extends('layouts.app')

@section('content')
    <div class="mx-20">
        <h2 class="text-4xl font-extrabold text-center mb-4">Tambah Bobot CPL-MK</h2>
        <hr class="w-full border border-black mb-4">

        @if ($errors->any())
            <div id="alert"
                class="bg-red-500 text-white px-4 py-2 rounded-md mb-6 text-center relative max-w-4xl mx-auto">
                <span class="font-bold">{{ $errors->first() }}</span>
                <button onclick="document.getElementById('alert').style.display='none'"
                    class="absolute top-1 right-3 text-white font-bold text-lg">&times;</button>
            </div>
        @endif

        <form action="{{ route('admin.bobot.store') }}" method="POST" id="bobotForm">
            @csrf

            <label for="id_cpl" class="text-xl font-semibold mb-2">Pilih CPL</label>
            <select id="id_cpl" name="id_cpl"
                class="border border-black p-3 w-full rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-[#f7faff]"
                required>
                <option value="">-- Pilih CPL --</option>
                @foreach ($capaianProfilLulusans as $cpl)
                    <option value="{{ $cpl->id_cpl }}">{{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}</option>
                @endforeach
            </select>

            <div id="notifSudahAda"
                class="hidden bg-red-500 text-white px-4 py-2 rounded-md mb-6 text-center relative max-w-4xl mx-auto">
                <span class="font-bold">Bobot untuk CPL ini sudah ditambahkan sebelumnya.</span>
                <button onclick="document.getElementById('notifSudahAda').style.display='none'"
                    class="absolute top-1 right-3 text-white font-bold text-lg">&times;</button>
            </div>

            <div id="mkSection" class="mt-6 hidden">
                <label class="text-xl font-semibold">Atur Bobot Mata Kuliah (Total harus 100%)</label>
                <div id="loadingMK" class="mt-3 text-blue-500 italic">Memuat mata kuliah...</div>
                <div id="mkList"
                    class="mt-2 border border-black rounded-lg p-4 bg-gray-50 max-h-[300px] overflow-y-auto"></div>
                <div class="mt-2 text-sm text-gray-600">Total Bobot: <span id="totalBobot">0%</span></div>
                <p class="italic text-blue-600 text-sm mt-1">Gunakan tombol bagi rata jika ingin mendistribusikan secara
                    merata</p>
            </div>

            <button type="submit"
                class="px-4 py-2 bg-green-500 rounded-lg text-white hover:bg-green-600 mt-6 disabled:opacity-50"
                id="submitBtn" disabled>
                Simpan
            </button>
        </form>
    </div>

    @php
        $mkByCplUrl = request()->isSecure()
            ? secure_url(route('admin.capaianpembelajaranmatakuliah.getMKByCPL', [], false))
            : route('admin.capaianpembelajaranmatakuliah.getMKByCPL');
    @endphp

    @push('scripts')
        <script>
            const cplSelect = document.getElementById('id_cpl');
            const mkList = document.getElementById('mkList');
            const mkSection = document.getElementById('mkSection');
            const loadingMK = document.getElementById('loadingMK');
            const totalBobot = document.getElementById('totalBobot');
            const submitBtn = document.getElementById('submitBtn');
            const notifSudahAda = document.getElementById('notifSudahAda');

            cplSelect.addEventListener('change', function() {
                const idCPL = this.value;
                if (!idCPL) {
                    mkSection.classList.add('hidden');
                    mkList.innerHTML = '';
                    totalBobot.textContent = '0%';
                    submitBtn.disabled = true;
                    notifSudahAda.classList.add('hidden');
                    return;
                }

                mkSection.classList.remove('hidden');
                loadingMK.classList.remove('hidden');
                mkList.innerHTML = '';
                notifSudahAda.classList.add('hidden');

                fetch("{{ $mkByCplUrl }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            id_cpls: [idCPL]
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        loadingMK.classList.add('hidden');
                        mkList.innerHTML = '';

                        if (data.length === 0) {
                            mkList.innerHTML =
                                '<div class="text-red-500 italic">Tidak ada MK terkait atau semua MK sudah diberi bobot</div>';
                            notifSudahAda.classList.remove('hidden');
                            submitBtn.disabled = true;
                            return;
                        }

                        data.forEach(mk => {
                            const mkItem = document.createElement('div');
                            mkItem.className =
                                'mb-3 flex items-center justify-between bg-white p-3 border rounded hover:bg-blue-50';
                            mkItem.innerHTML = `
                            <div><strong>${mk.kode_mk}</strong> - ${mk.nama_mk}</div>
                            <input type="number" name="bobot[${mk.kode_mk}]" min="0" max="100" value="0"
                                class="w-24 p-2 border rounded text-center bobot-input">
                            <input type="hidden" name="kode_mk[]" value="${mk.kode_mk}">
                        `;
                            mkList.appendChild(mkItem);
                        });

                        mkList.innerHTML += `
                        <div class="mt-4">
                            <button type="button" id="distributeBtn"
                                class="text-sm text-yellow-600 hover:text-yellow-800">Bagi Rata</button>
                        </div>
                    `;

                        document.querySelectorAll('.bobot-input').forEach(input => {
                            input.addEventListener('input', updateTotal);
                            input.addEventListener('change', updateTotal);
                        });

                        document.getElementById('distributeBtn').addEventListener('click', () => {
                            const inputs = document.querySelectorAll('.bobot-input');
                            const equal = Math.floor(100 / inputs.length);
                            const rem = 100 % inputs.length;
                            inputs.forEach((input, i) => input.value = equal + (i < rem ? 1 : 0));
                            updateTotal();
                        });
                    })
                    .catch(err => {
                        loadingMK.classList.add('hidden');
                        mkList.innerHTML = '<div class="text-red-500 italic">Terjadi kesalahan</div>';
                        console.error(err);
                    });
            });

            function updateTotal() {
                let total = 0;
                document.querySelectorAll('.bobot-input').forEach(input => {
                    total += parseFloat(input.value) || 0;
                });
                totalBobot.textContent = total + '%';
                submitBtn.disabled = total !== 100;
            }

            document.getElementById('bobotForm').addEventListener('submit', function(e) {
                const total = parseFloat(totalBobot.textContent);
                if (total !== 100) {
                    e.preventDefault();
                    alert('Total bobot harus 100%');
                }
            });
        </script>
    @endpush
@endsection
