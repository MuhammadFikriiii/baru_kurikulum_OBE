@extends('layouts.tim.app')

@section('content')
<div class="mx-20">
    <h2 class="font-extrabold text-4xl mb-6 text-center">Tambah Sub CPMK</h2>
    <hr class="w-full border border-black mb-4">

    @if ($errors->any())
        <div class="text-red-600 mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tim.subcpmk.store') }}" method="POST">
        @csrf
            <div>
                <label for="id_cpmk" class="text-xl font-semibold">CPMK:</label>
                <select name="id_cpmk" id="id_cpmk" required
                    class="w-full mt-1 p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500 mb-5">
                    <option value="" selected disabled>Pilih CPMK</option>
                    @foreach ($cpmks as $cpmk)
                        <option value="{{ $cpmk->id_cpmk }}">{{ $cpmk->kode_cpmk }} - {{ $cpmk->deskripsi_cpmk }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="kode_mk" class="text-xl font-semibold">Mata Kuliah:</label>
                <select name="kode_mk" id="kode_mk" required
                    class="w-full mt-1 p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500 mb-5" disabled>
                    <option value="" selected disabled>Pilih CPMK terlebih dahulu</option>
                </select>
            </div>

            <div>
                <label for="sub_cpmk" class="text-xl font-semibold">Sub CPMK:</label>
                <input type="text" name="sub_cpmk" id="sub_cpmk" required
                    class="w-full mt-1 p-3 border border-black rounded-lg mb-5">
            </div>

            <div>
                <label for="uraian_cpmk" class="text-xl font-semibold">Uraian CPMK:</label>
                <input type="text" name="uraian_cpmk" id="uraian_cpmk" required
                    class="w-full mt-1 p-3 border border-black rounded-lg mb-5">
            </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white px-5 py-2 font-bold rounded-lg">
                Simpan
            </button>
            <a href="{{ route('tim.subcpmk.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-5 font-bold py-2 rounded-lg ml-2">
                Kembali
            </a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cpmkSelect = document.getElementById('id_cpmk');
    const mkSelect = document.getElementById('kode_mk');

    cpmkSelect.addEventListener('change', function() {
        const cpmkId = this.value;
        
        if (cpmkId) {
            // Reset MK dropdown
            mkSelect.innerHTML = '<option value="" selected disabled>Loading...</option>';
            mkSelect.disabled = true;

            // Fetch MK berdasarkan CPMK
            fetch(`{{ route('tim.subcpmk.getMkByCpmk') }}?id_cpmk=${cpmkId}`)
                .then(response => response.json())
                .then(data => {
                    mkSelect.innerHTML = '<option value="" selected disabled>Pilih Mata Kuliah</option>';
                    
                    if (data.length > 0) {
                        data.forEach(mk => {
                            const option = document.createElement('option');
                            option.value = mk.kode_mk;
                            option.textContent = `${mk.kode_mk} - ${mk.nama_mk}`;
                            mkSelect.appendChild(option);
                        });
                        mkSelect.disabled = false;
                    } else {
                        mkSelect.innerHTML = '<option value="" selected disabled>Tidak ada mata kuliah tersedia</option>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    mkSelect.innerHTML = '<option value="" selected disabled>Error loading mata kuliah</option>';
                });
        } else {
            mkSelect.innerHTML = '<option value="" selected disabled>Pilih CPMK terlebih dahulu</option>';
            mkSelect.disabled = true;
        }
    });
});
</script>
@endsection