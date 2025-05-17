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

<form action="{{ route ('tim.matakuliah.update',$matakuliah->kode_mk)}}" method="POST">
    @csrf
    @method('PUT')

    <label for="id_cpls" class="text-xl font-bold">CPL</label>
    <select name="id_cpls[]" id="id_cpls" size="2" multiple class="border border-black p-3 w-full mt-1 mb-3 rounded-lg">
        @foreach ($capaianprofillulusans as $cpl)
            <option value="{{ $cpl->id_cpl }}" 
                @if (in_array($cpl->id_cpl, $selectedCapaianProfilLulusan ?? [])) selected @endif>
                {{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}
            </option>
        @endforeach
    </select>

    <label for="id_bks" class="text-xl font-bold">BK</label>
    <select name="id_bks[]" id="id_bks" size="2" multiple class="border border-black p-3 w-full mt-1 mb-3 rounded-lg">
    @foreach ($bahankajians as $bk)
        <option value="{{ $bk->id_bk }}" 
            @if (in_array($bk->id_bk, $selectedBahanKajian ?? [])) selected @endif>
            {{ $bk->kode_bk }} - {{ $bk->nama_bk }}
        </option>
    @endforeach
    </select>

    <label for="kode_mk" class="text-xl font-bold">Kode MK</label>
    <input type="text" name="kode_mk" id="kode_mk" value="{{ old ('kode_mk', $matakuliah->kode_mk)}}" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
<br>
    <label for="nama_mk" class="text-xl font-bold">Nama MK</label>
    <input type="text" name="nama_mk" id="nama_mk" value="{{ old ('nama_mk', $matakuliah->nama_mk)}}" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
<br>
    <label for="jenis_mk" class="text-xl font-bold">Jenis MK</label>
    <input type="text" name="jenis_mk" id="jenis_mk" value="{{ old ('jenis_mk', $matakuliah->jenis_mk)}}" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
<br>
    <label for="sks_mk" class="text-xl font-bold">Sks MK</label>
    <input type="number" name="sks_mk" id="sks_mk" value="{{ old ('sks_mk', $matakuliah->sks_mk)}}" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
<br>
    <label for="semester_mk" class="text-xl font-bold">Semester</label>
        <select name="semester_mk" id="semester_mk" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
            @for ($i = 1; $i <= 8; $i++)
                <option value="{{ $i }}" {{ $matakuliah->semester_mk == $i ? 'selected' : '' }}>
                    {{ $i }}
                </option>
            @endfor
        </select>        
    <br>
    <label for="kompetensi_mk" class="text-xl font-bold">Kompetensi MK</label>
        <select name="kompetensi_mk" id="kompetensi_mk" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
            <option value="pendukung" {{ $matakuliah->kompetensi_mk == 'pendukung' ? 'selected' : '' }}>pendukung</option>
            <option value="utama" {{ $matakuliah->kompetensi_mk == 'utama' ? 'selected' : '' }}>utama</option>
        </select>

    <button type="submit" class="mt-3 bg-blue-600 hover:bg-blue-800 px-5 py-2 rounded-lg text-white font-bold">Simpan</button>
    <a href="{{ route('tim.matakuliah.index') }}" class="ml-2 bg-gray-600 hover:bg-gray-800 px-5 py-2 rounded-lg text-white font-bold">Kembali</a>
</form>
</div>
@endsection