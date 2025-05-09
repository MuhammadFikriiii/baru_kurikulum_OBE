@extends('layouts.app')

@section('content')
<div class="mx-20">
    <h2 class="font-extrabold text-4xl mb-6 text-center">Edit Sub CPMK</h2>
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

    <form action="{{ route('admin.subcpmk.update', $subcpmk->id_sub_cpmk) }}" method="POST">
        @csrf
        @method('PUT')
            <div>
                <label for="id_cpmk" class="text-xl font-semibold">CPMK:</label>
                <select name="id_cpmk" id="id_cpmk" required
                    class="w-full mt-1 p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500 mb-5">
                    <option value="" disabled>Pilih CPMK</option>
                    @foreach ($cpmks as $cpmk)
                        <option value="{{ $cpmk->id_cpmk }}" {{ $subcpmk->id_cpmk == $cpmk->id_cpmk ? 'selected' : '' }}>
                            {{ $cpmk->kode_cpmk }} - {{ $cpmk->deskripsi_cpmk }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="sub_cpmk" class="text-xl font-semibold">Sub CPMK:</label>
                <input type="text" name="sub_cpmk" id="sub_cpmk" required
                    class="w-full mt-1 p-3 border border-black rounded-lg mb-5"
                    value="{{ old('sub_cpmk', $subcpmk->sub_cpmk) }}">
            </div>

            <div>
                <label for="uraian_cpmk" class="text-xl font-semibold">Uraian CPMK:</label>
                <input type="text" name="uraian_cpmk" id="uraian_cpmk" required
                    class="w-full mt-1 p-3 border border-black rounded-lg mb-5"
                    value="{{ old('uraian_cpmk', $subcpmk->uraian_cpmk) }}">
            </div>

        <div class="mt-6">
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white px-6 py-2 rounded-lg">
                Update
            </button>
            <a href="{{ route('admin.subcpmk.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-6 py-2 rounded-lg ml-4">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection
