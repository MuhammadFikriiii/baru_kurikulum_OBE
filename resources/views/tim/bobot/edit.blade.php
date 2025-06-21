@extends('layouts.tim.app')

@section('content')
    <div class="mx-20">
        <h2 class="text-4xl font-extrabold text-center mb-4">Edit Bobot CPL-MK</h2>
        <hr class="w-full border border-black mb-4">

        <form action="{{ route('tim.bobot.update', ['bobot' => $id_cpl]) }}" method="POST" id="bobotForm">
            @csrf
            @method('PUT')

            <input type="hidden" name="id_cpl" value="{{ $id_cpl }}">

            <label class="text-xl font-semibold">CPL: {{ $id_cpl }}</label>

            <div id="mkSection" class="mt-6">
                <label class="text-xl font-semibold">Atur Bobot Mata Kuliah (Total harus 100%)</label>
                <div id="mkList"
                    class="mt-2 border border-black rounded-lg p-4 bg-gray-50 max-h-[300px] overflow-y-auto">
                    @foreach ($mataKuliahs as $mk)
                        <div class="mb-3 flex items-center justify-between bg-white p-3 border rounded hover:bg-blue-50">
                            <div>
                                <strong>{{ $mk->kode_mk }}</strong> - {{ $mk->nama_mk }}
                            </div>
                            <input type="number" name="bobot[{{ $mk->kode_mk }}]" min="0" max="100"
                                value="{{ $existingBobots[$mk->kode_mk] ?? 0 }}"
                                class="w-24 p-2 border rounded text-center bobot-input">
                            <input type="hidden" name="kode_mk[]" value="{{ $mk->kode_mk }}">
                        </div>
                    @endforeach
                    <div class="mt-4">
                        <button type="button" id="distributeBtn" class="text-sm text-yellow-600 hover:text-yellow-800">Bagi
                            Rata</button>
                    </div>
                </div>
                <div class="mt-2 text-sm text-gray-600">Total Bobot: <span id="totalBobot">0%</span></div>
            </div>

            <button type="submit"
                class="px-4 py-2 bg-yellow-500 rounded-lg text-white hover:bg-yellow-600 mt-6 disabled:opacity-50"
                id="submitBtn">
                Update
            </button>
        </form>
    </div>

    @push('scripts')
        <script>
            function updateTotal() {
                let total = 0;
                document.querySelectorAll('.bobot-input').forEach(input => {
                    total += parseFloat(input.value) || 0;
                });
                totalBobot.textContent = total + '%';
                submitBtn.disabled = total !== 100;
            }

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

            document.getElementById('bobotForm').addEventListener('submit', function(e) {
                const total = parseFloat(totalBobot.textContent);
                if (total !== 100) {
                    e.preventDefault();
                    alert('Total bobot harus 100%');
                }
            });

            updateTotal();
        </script>
    @endpush
@endsection
