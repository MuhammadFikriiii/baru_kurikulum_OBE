@extends('layouts.tim.app')
@section('content')

<h1>Edit Mata Kuliah</h1>

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

    @if($selectedCapaianProfilLulusan)
    <div>   
        <h3 class="text-xl font-semibold mb-2">Profil Lulusan yang sebelumnya terkait:</h3>
        <ul class="list-disc pl-5 text-gray-700" disabled>
            @foreach($selectedCapaianProfilLulusan as $id_cpl)
                @php
                    $cplDetail = $capaianprofillulusans->firstWhere('id_cpl', $id_cpl);
                @endphp
                @if($cplDetail)
                    <li>
                        <strong>{{ $cplDetail->kode_cpl }}</strong>: {{ $cplDetail->deskripsi_cpl }}
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
    @endif

    @if($selectedBahanKajian)
    <div>
        
        <h3 class="text-xl font-semibold mb-2">Bahan Kajian yang sebelumnya terkait:</h3>
        <ul class="list-disc pl-5 text-gray-700" disabled>
            @foreach($selectedBahanKajian as $id_bk)
                @php
                    $bkDetail = $bahankajians->firstWhere('id_bk', $id_bk);
                @endphp
                @if($bkDetail)
                    <li>
                        <strong>{{ $bkDetail->kode_bk }}</strong>: {{ $bkDetail->nama_bk }}
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
    @endif

    <label for="id_cpls" class="text-2xl">Capaian Profil Lulusan CPL</label>
    <select name="id_cpls[]" id="id_cpls" multiple class="border border-black p-3 w-full mt-1 mb-3 rounded-lg">
        @foreach ($capaianprofillulusans as $cpl)
            <option value="{{ $cpl->id_cpl }}" 
                @if (in_array($cpl->id_cpl, $selectedCapaianProfilLulusan ?? [])) selected @endif>
                {{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}
            </option>
        @endforeach
    </select>

    <label for="id_bks" class="text-2xl">BK</label>
    <select name="id_bks[]" id="id_bks" multiple class="border border-black p-3 w-full mt-1 mb-3 rounded-lg">
    @foreach ($bahankajians as $bk)
        <option value="{{ $bk->id_bk }}" 
            @if (in_array($bk->id_bk, $selectedBahanKajianBahan ?? [])) selected @endif>
            {{ $bk->kode_bk }} - {{ $bk->nama_bk }}
        </option>
    @endforeach
    </select>

    <label for="kode_mk" class="text-2xl">Kode MK</label>
    <input type="text" name="kode_mk" id="kode_mk" value="{{ old ('kode_mk', $matakuliah->kode_mk)}}" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
<br>
    <label for="nama_mk" class="text-2xl">Nama MK</label>
    <input type="text" name="nama_mk" id="nama_mk" value="{{ old ('nama_mk', $matakuliah->nama_mk)}}" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
<br>
    <label for="jenis_mk" class="text-2xl">Jenis MK</label>
    <input type="text" name="jenis_mk" id="jenis_mk" value="{{ old ('jenis_mk', $matakuliah->jenis_mk)}}" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
<br>
    <label for="sks_mk" class="text-2xl">Sks MK</label>
    <input type="number" name="sks_mk" id="sks_mk" value="{{ old ('sks_mk', $matakuliah->sks_mk)}}" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
<br>
    <label for="semester_mk">Semester</label>
        <select name="semester_mk" id="semester_mk" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
            @for ($i = 1; $i <= 8; $i++)
                <option value="{{ $i }}" {{ $matakuliah->semester_mk == $i ? 'selected' : '' }}>
                    {{ $i }}
                </option>
            @endfor
        </select>        
    <br>
    <label for="kompetensi_mk">Kompetensi MK</label>
        <select name="kompetensi_mk" id="kompetensi_mk" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
            <option value="pendukung" {{ $matakuliah->kompetensi_mk == 'pendukung' ? 'selected' : '' }}>pendukung</option>
            <option value="utama" {{ $matakuliah->kompetensi_mk == 'utama' ? 'selected' : '' }}>utama</option>
        </select>


    <button type="submit" class="btn btn-primary bg-green-400 hover:bg-green-800 px-5 py-2 rounded-lg">simpan</button>
</form>
@endsection