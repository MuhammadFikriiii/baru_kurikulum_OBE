<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Log;

class ExportKptController extends Controller
{
    public function export(Request $request)
    {
        $kodeProdi = $request->kode_prodi;
        $idTahun = $request->id_tahun;

        // Ambil prodi dan nama jurusan
        $prodi = DB::table('prodis')
            ->join('jurusans', 'prodis.id_jurusan', '=', 'jurusans.id_jurusan')
            ->where('prodis.kode_prodi', $kodeProdi)
            ->select('prodis.*', 'jurusans.nama_jurusan')
            ->first();

        // Tahun
        $tahun = DB::table('tahun')->where('id_tahun', $idTahun)->first();

        // Visi Misi berdasarkan prodi
        $visiMisi = DB::table('visi_misi')->latest()->first();

        // Profil Lulusan
        $pls = DB::table('profil_lulusans')
            ->where('kode_prodi', $kodeProdi)
            ->where('id_tahun', $idTahun)
            ->select('kode_pl', 'deskripsi_pl')
            ->orderBy('kode_pl')
            ->get();

        // CPL - PERBAIKAN: Pastikan menggunakan DISTINCT untuk menghindari duplikasi
        $cpl = DB::table('cpl_pl')
            ->join('profil_lulusans as pl', 'pl.id_pl', '=', 'cpl_pl.id_pl')
            ->join('capaian_profil_lulusans as cpl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->where('pl.kode_prodi', $kodeProdi)
            ->where('pl.id_tahun', $idTahun)
            ->select('cpl.kode_cpl', 'cpl.deskripsi_cpl')
            ->distinct()
            ->orderBy('cpl.kode_cpl')
            ->orderBy('pl.kode_pl')
            ->get();

        // BK via CPL - PERBAIKAN: Tambahkan DISTINCT dan error handling
        $bk = DB::table('bahan_kajians as bk')
            ->join('cpl_bk', 'bk.id_bk', '=', 'cpl_bk.id_bk')
            ->join('capaian_profil_lulusans as cpl', 'cpl.id_cpl', '=', 'cpl_bk.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'pl.id_pl', '=', 'cpl_pl.id_pl')
            ->where('pl.kode_prodi', $kodeProdi)
            ->where('pl.id_tahun', $idTahun)
            ->select('bk.kode_bk', 'bk.nama_bk', 'bk.deskripsi_bk')
            ->distinct()
            ->orderBy('bk.kode_bk')
            ->get();

        // PERBAIKAN: Mata Kuliah - Ambil semua mata kuliah yang terkait dengan prodi dan tahun
        $mk = DB::table('mata_kuliahs as mk')
            ->join('cpl_mk', 'mk.kode_mk', '=', 'cpl_mk.kode_mk')
            ->join('capaian_profil_lulusans as cpl', 'cpl.id_cpl', '=', 'cpl_mk.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'pl.id_pl', '=', 'cpl_pl.id_pl')
            ->where('pl.kode_prodi', $kodeProdi)
            ->where('pl.id_tahun', $idTahun)
            ->select('mk.kode_mk', 'mk.nama_mk')
            ->distinct()
            ->orderBy('mk.kode_mk')
            ->get();

        $kodePlList = $pls->pluck('kode_pl')->values()->all();
        $kodeCplList = $cpl->pluck('kode_cpl')->values()->all();

        // PERBAIKAN UTAMA: Siapkan data relasi CPL ↔ PL dengan query yang lebih sederhana
        $cplPlRel = DB::table('cpl_pl')
            ->join('profil_lulusans as pl', 'pl.id_pl', '=', 'cpl_pl.id_pl')
            ->join('capaian_profil_lulusans as cpl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->where('pl.kode_prodi', $kodeProdi)
            ->where('pl.id_tahun', $idTahun)
            ->select('cpl.kode_cpl', 'pl.kode_pl')
            ->get();

        // TAMBAHAN: Siapkan data relasi CPL ↔ MK
        $cplMkRel = DB::table('cpl_mk')
            ->join('mata_kuliahs as mk', 'mk.kode_mk', '=', 'cpl_mk.kode_mk')
            ->join('capaian_profil_lulusans as cpl', 'cpl.id_cpl', '=', 'cpl_mk.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'pl.id_pl', '=', 'cpl_pl.id_pl')
            ->where('pl.kode_prodi', $kodeProdi)
            ->where('pl.id_tahun', $idTahun)
            ->select('cpl.kode_cpl', 'mk.kode_mk')
            ->distinct()
            ->get();

        // Debug logging untuk memastikan data relasi benar
        Log::info('CPL Data: ' . json_encode($cpl->toArray()));
        Log::info('PL Data: ' . json_encode($pls->toArray()));
        Log::info('BK Data Count: ' . $bk->count());
        Log::info('MK Data: ' . json_encode($mk->toArray()));
        Log::info('CPL-PL Relations Raw: ' . json_encode($cplPlRel->toArray()));
        Log::info('CPL-MK Relations Raw: ' . json_encode($cplMkRel->toArray()));

        // Load template
        $template = new TemplateProcessor(storage_path('app/template/templateword.docx'));

        // Isikan field dasar
        $template->setValue('nama_prodi', $prodi->nama_prodi ?? '-');
        $template->setValue('fakultas', $prodi->nama_jurusan ?? '-');
        $template->setValue('tahun', $tahun->tahun ?? '-');
        $template->setValue('nama_jurusan', $prodi->nama_jurusan ?? '-');
        $template->setValue('peringkat_akreditasi', $prodi->peringkat_akreditasi ?? '-');
        $template->setValue('telepon_prodi', $prodi->telepon_prodi ?? '-');
        $template->setValue('website_prodi', $prodi->website_prodi ?? '-');
        $template->setValue('visi', $visiMisi->visi ?? '-');
        $template->setValue('misi', $visiMisi->misi ?? '-');

        // Handle Profil Lulusan
        if ($pls->count() > 0) {
            try {
                $replacements = [];
                foreach ($pls as $index => $pl) {
                    $replacements[] = [
                        'no_pl' => $index + 1,
                        'kode_pl' => $pl->kode_pl,
                        'deskripsi_pl' => $pl->deskripsi_pl,
                    ];
                }
                $template->cloneRowAndSetValues('no_pl', $replacements);
            } catch (\Exception $e) {
                Log::error('cloneRowAndSetValues failed for PL: ' . $e->getMessage());
                try {
                    $template->cloneRow('no_pl', $pls->count());
                    foreach ($pls as $index => $pl) {
                        $i = $index + 1;
                        $template->setValue("no_pl#{$i}", $i);
                        $template->setValue("kode_pl#{$i}", $pl->kode_pl);
                        $template->setValue("deskripsi_pl#{$i}", $pl->deskripsi_pl);
                    }
                } catch (\Exception $e2) {
                    Log::error('cloneRow also failed for PL: ' . $e2->getMessage());
                    $firstPl = $pls->first();
                    $template->setValue('no_pl', '1');
                    $template->setValue('kode_pl', $firstPl->kode_pl);
                    $template->setValue('deskripsi_pl', $firstPl->deskripsi_pl);

                    if ($pls->count() > 1) {
                        $additionalData = '';
                        foreach ($pls->slice(1) as $index => $pl) {
                            $no = $index + 2;
                            $additionalData .= "\n{$no}. {$pl->kode_pl} - {$pl->deskripsi_pl}";
                        }
                        $template->setValue('deskripsi_pl', $firstPl->deskripsi_pl . $additionalData);
                    }
                }
            }
        } else {
            $template->setValue('no_pl', '-');
            $template->setValue('kode_pl', '-');
            $template->setValue('deskripsi_pl', 'Tidak ada data profil lulusan');
        }

        // Handle CPL
        if ($cpl->count() > 0) {
            try {
                $replacements = [];
                foreach ($cpl as $index => $item) {
                    $replacements[] = [
                        'no_cpl' => $index + 1,
                        'kode_cpl' => $item->kode_cpl,
                        'deskripsi_cpl' => $item->deskripsi_cpl,
                    ];
                }
                $template->cloneRowAndSetValues('no_cpl', $replacements);
            } catch (\Exception $e) {
                Log::error('cloneRowAndSetValues failed for CPL: ' . $e->getMessage());
                try {
                    $template->cloneRow('no_cpl', $cpl->count());
                    foreach ($cpl as $index => $item) {
                        $i = $index + 1;
                        $template->setValue("no_cpl#{$i}", $i);
                        $template->setValue("kode_cpl#{$i}", $item->kode_cpl);
                        $template->setValue("deskripsi_cpl#{$i}", $item->deskripsi_cpl);
                    }
                } catch (\Exception $e2) {
                    Log::error('cloneRow also failed for CPL: ' . $e2->getMessage());
                    $firstCpl = $cpl->first();
                    $template->setValue('no_cpl', '1');
                    $template->setValue('kode_cpl', $firstCpl->kode_cpl);
                    $template->setValue('deskripsi_cpl', $firstCpl->deskripsi_cpl);
                }
            }
        } else {
            $template->setValue('no_cpl', '-');
            $template->setValue('kode_cpl', '-');
            $template->setValue('deskripsi_cpl', 'Tidak ada data CPL');
        }

        // PERBAIKAN UTAMA: Handle matriks CPL-PL dengan logika yang diperbaiki
        if ($pls->count() > 0 && $cpl->count() > 0) {

            // STEP 1: Isi header kolom PL
            foreach ($kodePlList as $i => $kodePl) {
                $template->setValue("kode_pl#" . ($i + 1), $kodePl);
            }

            // STEP 2: Buat mapping relasi CPL-PL untuk akses cepat
            $relationMap = [];
            foreach ($cplPlRel as $rel) {
                $relationMap[$rel->kode_cpl][$rel->kode_pl] = true;
            }

            Log::info('Relation Map: ' . json_encode($relationMap));

            // STEP 3: Buat data matriks CPL-PL
            $cplPlReplacements = [];
            foreach ($cpl as $index => $item) {
                $row = [
                    'no_cplpl' => $index + 1,
                    'kode_cpl' => $item->kode_cpl,
                ];

                // Isi kolom relasi untuk setiap PL
                foreach ($kodePlList as $i => $kodePl) {
                    $key = 'pl_rel' . ($i + 1);

                    // Cek apakah ada relasi antara CPL dan PL ini
                    $hasRelation = isset($relationMap[$item->kode_cpl][$kodePl]);
                    $row[$key] = $hasRelation ? 'v' : '';

                    // Debug log untuk setiap relasi
                    Log::info("Checking relation: CPL={$item->kode_cpl}, PL={$kodePl}, Result=" . ($hasRelation ? 'TRUE' : 'FALSE'));
                }

                $cplPlReplacements[] = $row;
            }

            Log::info('CPL-PL Replacements: ' . json_encode($cplPlReplacements));

            // STEP 4: Clone baris matriks CPL-PL
            try {
                $template->cloneRowAndSetValues('no_cplpl', $cplPlReplacements);
            } catch (\Exception $e) {
                Log::error('Error cloning CPL-PL matrix: ' . $e->getMessage());

                // Fallback: clone row biasa
                try {
                    $template->cloneRow('no_cplpl', count($cplPlReplacements));

                    foreach ($cplPlReplacements as $index => $row) {
                        $i = $index + 1;
                        foreach ($row as $key => $value) {
                            $template->setValue("{$key}#{$i}", $value);
                        }
                    }
                } catch (\Exception $e2) {
                    Log::error('Fallback cloning also failed: ' . $e2->getMessage());

                    // Ultimate fallback: set single row
                    if (count($cplPlReplacements) > 0) {
                        $firstRow = $cplPlReplacements[0];
                        foreach ($firstRow as $key => $value) {
                            $template->setValue($key, $value);
                        }
                    }
                }
            }
        } else {
            // Jika tidak ada data CPL atau PL
            $template->setValue('no_cplpl', '-');
            $template->setValue('kode_cpl', '-');

            // Set nilai default untuk kolom relasi
            for ($i = 1; $i <= 10; $i++) {
                $template->setValue("pl_rel{$i}", '-');
            }
        }

        // FIXED: Handle matriks CPL-MK dengan template yang sesuai
        if ($mk->count() > 0 && $cpl->count() > 0) {

            // STEP 1: Set header CPL (maksimal 9 kolom sesuai template)
            $maxCplColumns = 9;
            for ($i = 1; $i <= $maxCplColumns; $i++) {
                if (isset($kodeCplList[$i - 1])) {
                    $template->setValue("kode_cpl#{$i}", $kodeCplList[$i - 1]);
                } else {
                    $template->setValue("kode_cpl#{$i}", '');
                }
            }

            $cplMkRelationMap = [];
            foreach ($cplMkRel as $rel) {
                $cplMkRelationMap[$rel->kode_mk][$rel->kode_cpl] = true;
            }

            Log::info('CPL-MK Relation Map: ' . json_encode($cplMkRelationMap));

            $cplMkReplacements = [];
            foreach ($mk as $index => $item) {
                $row = [
                    'kode_mk' => $item->kode_mk,
                    'nama_mk' => $item->nama_mk,
                ];

                for ($i = 1; $i <= $maxCplColumns; $i++) {
                    $key = 'cpl_rel' . $i;

                    if (isset($kodeCplList[$i - 1])) {
                        $kodeCpl = $kodeCplList[$i - 1];
                        // Cek apakah ada relasi antara MK dan CPL ini
                        $hasRelation = isset($cplMkRelationMap[$item->kode_mk][$kodeCpl]);
                        $row[$key] = $hasRelation ? 'v' : '';

                        // Debug log untuk setiap relasi
                        Log::info("Checking CPL-MK relation: MK={$item->kode_mk}, CPL={$kodeCpl}, Result=" . ($hasRelation ? 'TRUE' : 'FALSE'));
                    } else {
                        $row[$key] = '';
                    }
                }

                $cplMkReplacements[] = $row;
            }

            Log::info('CPL-MK Replacements: ' . json_encode($cplMkReplacements));

            try {
                $template->cloneRowAndSetValues('kode_mk', $cplMkReplacements);
            } catch (\Exception $e) {
                Log::error('Error cloning CPL-MK matrix: ' . $e->getMessage());

                try {
                    $template->cloneRow('kode_mk', count($cplMkReplacements));

                    foreach ($cplMkReplacements as $index => $row) {
                        $i = $index + 1;
                        foreach ($row as $key => $value) {
                            $template->setValue("{$key}#{$i}", $value);
                        }
                    }
                } catch (\Exception $e2) {
                    Log::error('Fallback cloning also failed for CPL-MK: ' . $e2->getMessage());

                    if (count($cplMkReplacements) > 0) {
                        $firstRow = $cplMkReplacements[0];
                        foreach ($firstRow as $key => $value) {
                            $template->setValue($key, $value);
                        }
                    }
                }
            }
        } else {
            // Jika tidak ada data CPL atau MK
            $template->setValue('kode_mk', '-');
            $template->setValue('nama_mk', 'Tidak ada data mata kuliah');

            for ($i = 1; $i <= 9; $i++) {
                $template->setValue("cpl_rel{$i}", '-');
                $template->setValue("kode_cpl#{$i}", '-');
            }
        }

        try {
            Log::info('Processing BK data. Count: ' . $bk->count());

            if ($bk->count() > 0) {
                try {
                    $bkReplacements = [];
                    foreach ($bk as $index => $item) {
                        $bkReplacements[] = [
                            'no_bk' => $index + 1,
                            'kode_bk' => $item->kode_bk ?? '-',
                            'nama_bk' => $item->nama_bk ?? '-',
                            'deskripsi_bk' => $item->deskripsi_bk ?? '-',
                        ];
                    }

                    Log::info('BK Replacements: ' . json_encode($bkReplacements));
                    $template->cloneRowAndSetValues('kode_bk', $bkReplacements);
                    Log::info('BK cloneRowAndSetValues successful');
                } catch (\Exception $e) {
                    Log::error('cloneRowAndSetValues failed for BK: ' . $e->getMessage());

                    try {
                        $template->cloneRow('kode_bk', $bk->count());
                        Log::info('BK cloneRow successful, setting individual values');

                        foreach ($bk as $index => $item) {
                            $i = $index + 1;
                            $template->setValue("kode_bk#{$i}", $item->kode_bk ?? '-');
                            $template->setValue("nama_bk#{$i}", $item->nama_bk ?? '-');
                            $template->setValue("deskripsi_bk#{$i}", $item->deskripsi_bk ?? '-');
                        }
                    } catch (\Exception $e2) {
                        Log::error('cloneRow also failed for BK: ' . $e2->getMessage());

                        $bkData = '';
                        $namaData = '';
                        $deskripsiData = '';

                        foreach ($bk as $index => $item) {
                            $no = $index + 1;
                            $bkData .= ($index > 0 ? "\n" : '') . $no . '. ' . ($item->kode_bk ?? '-');
                            $namaData .= ($index > 0 ? "\n" : '') . $no . '. ' . ($item->nama_bk ?? '-');
                            $deskripsiData .= ($index > 0 ? "\n" : '') . $no . '. ' . ($item->deskripsi_bk ?? '-');
                        }

                        $template->setValue('kode_bk', $bkData);
                        $template->setValue('nama_bk', $namaData);
                        $template->setValue('deskripsi_bk', $deskripsiData);

                        Log::info('BK fallback method used successfully');
                    }
                }
            } else {
                Log::warning('No BK data found');
                $template->setValue('kode_bk', 'Tidak ada data bahan kajian');
                $template->setValue('nama_bk', '-');
                $template->setValue('deskripsi_bk', '-');
            }
        } catch (\Exception $e) {
            Log::error('Error processing BK data: ' . $e->getMessage());
            $template->setValue('kode_bk', 'Error: ' . $e->getMessage());
            $template->setValue('nama_bk', '-');
            $template->setValue('deskripsi_bk', '-');
        }
        try {
            $semuaMataKuliah = DB::table('mata_kuliahs as mk')
                ->join('cpl_mk', 'mk.kode_mk', '=', 'cpl_mk.kode_mk')
                ->join('capaian_profil_lulusans as cpl', 'cpl.id_cpl', '=', 'cpl_mk.id_cpl')
                ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
                ->join('profil_lulusans as pl', 'pl.id_pl', '=', 'cpl_pl.id_pl')
                ->where('pl.kode_prodi', $kodeProdi)
                ->where('pl.id_tahun', $idTahun)
                ->select('mk.nama_mk', 'mk.sks_mk', 'mk.semester_mk', 'mk.jenis_mk', 'mk.kompetensi_mk')
                ->distinct()
                ->get();

            $matriksData = [];
            for ($i = 1; $i <= 8; $i++) {
                $matriksData[$i] = [
                    'sks' => 0,
                    'jml_mk' => 0,
                    'mk_wajib' => [],
                    'mk_pilihan' => [],
                    'mkw' => []
                ];
            }
            $totals = ['sks' => 0, 'jml_mk' => 0, 'mk_wajib' => 0, 'mk_pilihan' => 0, 'mkw' => 0];

            foreach ($semuaMataKuliah as $matkul) {
                $semester = (int)$matkul->semester_mk;
                if ($semester >= 1 && $semester <= 8) {
                    $matriksData[$semester]['sks'] += $matkul->sks_mk;
                    $matriksData[$semester]['jml_mk']++;

                    if (strtolower($matkul->kompetensi_mk) === 'utama') {
                        $mkFormattedWajib = htmlspecialchars($matkul->nama_mk, ENT_COMPAT, 'UTF-8');
                        $matriksData[$semester]['mk_wajib'][] = $mkFormattedWajib;
                        $totals['mk_wajib'] += $matkul->sks_mk;
                    } elseif (strtolower($matkul->kompetensi_mk) === 'pendukung') {
                        $mkFormattedPilihan = htmlspecialchars($matkul->nama_mk, ENT_COMPAT, 'UTF-8') . ' (' . $matkul->sks_mk . ' SKS)';
                        $matriksData[$semester]['mk_pilihan'][] = $mkFormattedPilihan;
                        $totals['mk_pilihan'] += $matkul->sks_mk;
                    }

                    if (strtolower($matkul->jenis_mk) === 'mkwn') {
                        $mkFormattedMkwn = htmlspecialchars($matkul->nama_mk, ENT_COMPAT, 'UTF-8') . ' (' . $matkul->sks_mk . ' SKS)';
                        $matriksData[$semester]['mkw'][] = $mkFormattedMkwn;
                        $totals['mkw'] += $matkul->sks_mk;
                    }
                }
            }

            $maxWajibColumns = 5;
            for ($i = 1; $i <= 8; $i++) {
                $template->setValue("smt{$i}", $i);
                $template->setValue("sks{$i}", $matriksData[$i]['sks'] ?: '0');
                $template->setValue("jml_mk{$i}", $matriksData[$i]['jml_mk'] ?: '0');

                for ($j = 1; $j <= $maxWajibColumns; $j++) {
                    $template->setValue("mk_wajib{$i}#{$j}", $matriksData[$i]['mk_wajib'][$j - 1] ?? '-');
                }

                $template->setValue("mk_pilihan{$i}", !empty($matriksData[$i]['mk_pilihan']) ? implode('<w:br/>', $matriksData[$i]['mk_pilihan']) : '-');
                $template->setValue("mkw{$i}", !empty($matriksData[$i]['mkw']) ? implode('<w:br/>', $matriksData[$i]['mkw']) : '-');
            }

            $totals['sks'] = array_sum(array_column($matriksData, 'sks'));
            $totals['jml_mk'] = array_sum(array_column($matriksData, 'jml_mk'));

            $template->setValue('total_sks', $totals['sks'] ?: '0');
            $template->setValue('total_jumlah_mk', $totals['jml_mk'] ?: '0');

            $template->setValue('total_mk_wajib#1', $totals['mk_wajib'] ?: '0');
            for ($j = 2; $j <= $maxWajibColumns; $j++) {
                $template->setValue("total_mk_wajib#{$j}", '-');
            }

            $template->setValue('total_mk_pilihan', $totals['mk_pilihan'] ?: '0');
            $template->setValue('total_mkwm', $totals['mkw'] ?: '0');

            Log::info('Matriks Struktur Kurikulum berhasil diproses dengan logika baru.');
        } catch (\Exception $e) {
            Log::error('Gagal memproses Matriks Struktur Kurikulum: ' . $e->getMessage());
            for ($i = 1; $i <= 8; $i++) {
                $template->setValue("sks{$i}", 'Err');
                $template->setValue("jml_mk{$i}", 'Err');
                for ($j = 1; $j <= 5; $j++) {
                    $template->setValue("mk_wajib{$i}#{$j}", 'Error');
                }
                $template->setValue("mk_pilihan{$i}", 'Error');
                $template->setValue("mkw{$i}", 'Error');
            }
            $template->setValue('total_sks', 'Error');
            $template->setValue('total_jumlah_mk', 'Error');
            $template->setValue('total_mk_wajib#1', 'Err');
            $template->setValue('total_mk_pilihan', 'Err');
            $template->setValue('total_mkwm', 'Err');
        }
        // ========================================================================
        // ::: START: PENAMBAHAN LOGIKA DAFTAR MATA KULIAH PER SEMESTER :::
        // ========================================================================
        try {
            Log::info('Memulai proses pengisian daftar mata kuliah per semester.');
            $grandTotalSks = 0;

            for ($i = 1; $i <= 8; $i++) {
                Log::info("Memproses semester {$i}...");

                // Ambil data mata kuliah untuk semester saat ini
                // NOTE: Asumsi nama kolom SKS adalah sks_teori, sks_praktek, sks_lapangan. Sesuaikan jika berbeda.
                $matakuliahSemester = DB::table('mata_kuliahs as mk')
                    ->join('cpl_mk', 'mk.kode_mk', '=', 'cpl_mk.kode_mk')
                    ->join('capaian_profil_lulusans as cpl', 'cpl.id_cpl', '=', 'cpl_mk.id_cpl')
                    ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
                    ->join('profil_lulusans as pl', 'pl.id_pl', '=', 'cpl_pl.id_pl')
                    ->where('pl.kode_prodi', $kodeProdi)
                    ->where('pl.id_tahun', $idTahun)
                    ->where('mk.semester_mk', $i)
                    ->select(
                        'mk.kode_mk',
                        'mk.nama_mk',
                        'mk.sks_mk',
                        'mk.sks_teori',      // Asumsi untuk kolom Teori
                        'mk.sks_praktek',    // Asumsi untuk kolom Praktikum
                        'mk.sks_lapangan'    // Asumsi untuk kolom Praktek
                    )
                    ->distinct()
                    ->orderBy('mk.kode_mk')
                    ->get();

                $semesterTotalSks = 0;
                $no = 1;
                if ($matakuliahSemester->count() > 0) {
                    $replacements = [];
                    foreach ($matakuliahSemester as $matkul) {
                        $replacements[] = [
                            "s{$i}_no" => $no++,
                            "s{$i}_kode_mk" => $matkul->kode_mk ?? '-',
                            "s{$i}_nama_mk" => htmlspecialchars($matkul->nama_mk ?? '-', ENT_COMPAT, 'UTF-8'),
                            "s{$i}_teori" => $matkul->sks_teori ?? '0',
                            "s{$i}_praktikum" => $matkul->sks_praktek ?? '0',
                            "s{$i}_praktek" => $matkul->sks_lapangan ?? '0',
                            "s{$i}_jumlah" => $matkul->sks_mk ?? '0',
                        ];
                        $semesterTotalSks += (int)($matkul->sks_mk ?? 0);
                    }

                    // Clone baris dan isi nilainya
                    $template->cloneRowAndSetValues("s{$i}_no", $replacements);
                    Log::info("Berhasil mengisi " . $matakuliahSemester->count() . " mata kuliah untuk semester {$i}.");
                } else {
                    // Jika tidak ada mata kuliah, isi dengan placeholder kosong
                    $template->cloneRow("s{$i}_no", 1);
                    $template->setValue("s{$i}_no#1", '-');
                    $template->setValue("s{$i}_kode_mk#1", '-');
                    $template->setValue("s{$i}_nama_mk#1", 'Tidak ada mata kuliah');
                    $template->setValue("s{$i}_teori#1", '-');
                    $template->setValue("s{$i}_praktikum#1", '-');
                    $template->setValue("s{$i}_praktek#1", '-');
                    $template->setValue("s{$i}_jumlah#1", '-');
                    Log::warning("Tidak ada mata kuliah ditemukan untuk semester {$i}.");
                }

                // Set total SKS semester
                $template->setValue("s{$i}_total_sks", $semesterTotalSks);
                $grandTotalSks += $semesterTotalSks;
            }

            // Set grand total SKS (jika ada placeholder-nya di template, misal: ${total_sks_keseluruhan})
            $template->setValue('total_sks_keseluruhan', $grandTotalSks);
            Log::info("Proses pengisian daftar mata kuliah per semester selesai. Grand total SKS: {$grandTotalSks}");
        } catch (\Exception $e) {
            Log::error('Gagal memproses Daftar Mata Kuliah per Semester: ' . $e->getMessage());
            // Fallback jika terjadi error, agar dokumen tetap ter-generate
            for ($i = 1; $i <= 8; $i++) {
                $template->setValue("s{$i}_no", 'Error');
                $template->setValue("s{$i}_kode_mk", 'Error');
                $template->setValue("s{$i}_nama_mk", 'Gagal memuat data');
                $template->setValue("s{$i}_total_sks", 'Err');
            }
        }
        // ========================================================================
        // ::: END: PENAMBAHAN LOGIKA :::
        // ========================================================================

        // Simpan dan download
        $fileName = 'Export-KPT-' . ($prodi->nama_prodi ?? 'Unknown') . '-' . ($tahun->tahun ?? 'Unknown') . '.docx';
        $outputPath = storage_path('app/export/' . $fileName);

        // Pastikan folder export ada
        $exportDir = storage_path('app/export');
        if (!file_exists($exportDir)) {
            mkdir($exportDir, 0755, true);
        }

        try {
            $template->saveAs($outputPath);
            Log::info('Template saved successfully to: ' . $outputPath);

            return response()->download($outputPath)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            Log::error('Error saving template: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to generate document: ' . $e->getMessage()], 500);
        }
    }
}
