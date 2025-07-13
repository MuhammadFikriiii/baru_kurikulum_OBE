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

        $prodi = DB::table('prodis')
            ->join('jurusans', 'prodis.id_jurusan', '=', 'jurusans.id_jurusan')
            ->where('prodis.kode_prodi', $kodeProdi)
            ->select('prodis.*', 'jurusans.nama_jurusan')
            ->first();

        $tahun = DB::table('tahun')->where('id_tahun', $idTahun)->first();

        $visiMisi = DB::table('visi_misi')->latest()->first();

        $pls = DB::table('profil_lulusans')
            ->where('kode_prodi', $kodeProdi)
            ->where('id_tahun', $idTahun)
            ->select('kode_pl', 'deskripsi_pl')
            ->orderBy('kode_pl')
            ->get();

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

        $cplPlRel = DB::table('cpl_pl')
            ->join('profil_lulusans as pl', 'pl.id_pl', '=', 'cpl_pl.id_pl')
            ->join('capaian_profil_lulusans as cpl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->where('pl.kode_prodi', $kodeProdi)
            ->where('pl.id_tahun', $idTahun)
            ->select('cpl.kode_cpl', 'pl.kode_pl')
            ->get();

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

        Log::info('CPL Data: ' . json_encode($cpl->toArray()));
        Log::info('PL Data: ' . json_encode($pls->toArray()));
        Log::info('BK Data Count: ' . $bk->count());
        Log::info('MK Data: ' . json_encode($mk->toArray()));
        Log::info('CPL-PL Relations Raw: ' . json_encode($cplPlRel->toArray()));
        Log::info('CPL-MK Relations Raw: ' . json_encode($cplMkRel->toArray()));

        $template = new TemplateProcessor(storage_path('app/template/templateword.docx'));

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

        // Handle matriks CPL-PL
        if ($pls->count() > 0 && $cpl->count() > 0) {

            foreach ($kodePlList as $i => $kodePl) {
                $template->setValue("kode_pl#" . ($i + 1), $kodePl);
            }

            $relationMap = [];
            foreach ($cplPlRel as $rel) {
                $relationMap[$rel->kode_cpl][$rel->kode_pl] = true;
            }

            Log::info('Relation Map: ' . json_encode($relationMap));

            $cplPlReplacements = [];
            foreach ($cpl as $index => $item) {
                $row = [
                    'no_cplpl' => $index + 1,
                    'kode_cpl' => $item->kode_cpl,
                ];

                foreach ($kodePlList as $i => $kodePl) {
                    $key = 'pl_rel' . ($i + 1);

                    $hasRelation = isset($relationMap[$item->kode_cpl][$kodePl]);
                    $row[$key] = $hasRelation ? 'v' : '';

                    Log::info("Checking relation: CPL={$item->kode_cpl}, PL={$kodePl}, Result=" . ($hasRelation ? 'TRUE' : 'FALSE'));
                }

                $cplPlReplacements[] = $row;
            }

            Log::info('CPL-PL Replacements: ' . json_encode($cplPlReplacements));

            try {
                $template->cloneRowAndSetValues('no_cplpl', $cplPlReplacements);
            } catch (\Exception $e) {
                Log::error('Error cloning CPL-PL matrix: ' . $e->getMessage());

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

                    if (count($cplPlReplacements) > 0) {
                        $firstRow = $cplPlReplacements[0];
                        foreach ($firstRow as $key => $value) {
                            $template->setValue($key, $value);
                        }
                    }
                }
            }
        } else {
            $template->setValue('no_cplpl', '-');
            $template->setValue('kode_cpl', '-');

            for ($i = 1; $i <= 10; $i++) {
                $template->setValue("pl_rel{$i}", '-');
            }
        }

        if ($mk->count() > 0 && $cpl->count() > 0) {

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

                        $hasRelation = isset($cplMkRelationMap[$item->kode_mk][$kodeCpl]);
                        $row[$key] = $hasRelation ? 'v' : '';

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
            Log::info('Memulai proses pengisian bahan kajian berdasarkan CPL Prodi.');

            $cplBahanKajian = DB::table('capaian_profil_lulusans as cpl')
                ->join('cpl_bk', 'cpl.id_cpl', '=', 'cpl_bk.id_cpl')
                ->join('bahan_kajians as bk', 'cpl_bk.id_bk', '=', 'bk.id_bk')
                ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
                ->join('profil_lulusans as pl', 'pl.id_pl', '=', 'cpl_pl.id_pl')
                ->where('pl.kode_prodi', $kodeProdi)
                ->where('pl.id_tahun', $idTahun)
                ->select('cpl.kode_cpl', 'cpl.deskripsi_cpl', 'bk.nama_bk')
                ->distinct()
                ->orderBy('cpl.kode_cpl')
                ->orderBy('bk.nama_bk')
                ->get();

            if ($cplBahanKajian->count() > 0) {
        
                $groupedData = [];
                foreach ($cplBahanKajian as $item) {
                    $key = $item->kode_cpl;
                    if (!isset($groupedData[$key])) {
                        $groupedData[$key] = [
                            'kode_cpl' => $item->kode_cpl,
                            'deskripsi_cpl' => htmlspecialchars($item->deskripsi_cpl, ENT_COMPAT, 'UTF-8'),
                            'bahan_kajian' => [],
                        ];
                    }
                    $groupedData[$key]['bahan_kajian'][] = htmlspecialchars($item->nama_bk, ENT_COMPAT, 'UTF-8');
                }

            
                $replacements = [];
                // Based on the user image, the placeholders are ${kode_cpl}, ${deskripsi_cpl}, ${nama_bk}
                foreach ($groupedData as $data) {
                    $replacements[] = [
                        'kode_cpl' => $data['kode_cpl'],
                        'deskripsi_cpl' => $data['deskripsi_cpl'],
                        'nama_bk' => implode('<w:br/>', $data['bahan_kajian']),
                    ];
                }

                Log::info('Data Bahan Kajian per CPL: ' . json_encode($replacements));

                $template->cloneRowAndSetValues('kode_cpl', $replacements);
                Log::info('Berhasil mengisi tabel bahan kajian berdasarkan CPL Prodi.');
            } else {
                Log::warning('Tidak ada data bahan kajian berdasarkan CPL Prodi ditemukan.');
                $template->cloneRow('kode_cpl', 1);
                $template->setValue('kode_cpl#1', 'Tidak ada data');
                $template->setValue('deskripsi_cpl#1', '-');
                $template->setValue('nama_bk#1', '-');
            }
        } catch (\Exception $e) {
            Log::error('Gagal memproses tabel bahan kajian berdasarkan CPL Prodi: ' . $e->getMessage());
            $template->cloneRow('kode_cpl', 1);
            $template->setValue('kode_cpl#1', 'Error');
            $template->setValue('deskripsi_cpl#1', 'Gagal memuat data');
            $template->setValue('nama_bk#1', 'Error');
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

        try {
            Log::info('Memulai proses pengisian daftar mata kuliah per semester.');
            $grandTotalSks = 0;

            for ($i = 1; $i <= 2; $i++) {
                Log::info("Memproses semester {$i}...");

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
                        'mk.sks_mk'
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

                        ];
                        $semesterTotalSks += (int)($matkul->sks_mk ?? 0);
                    }

                    $template->cloneRowAndSetValues("s{$i}_no", $replacements);
                    Log::info("Berhasil mengisi " . $matakuliahSemester->count() . " mata kuliah untuk semester {$i}.");
                } else {
           
                    $template->cloneRow("s{$i}_no", 1);
                    $template->setValue("s{$i}_no#1", '-');
                    $template->setValue("s{$i}_kode_mk#1", '-');
                    $template->setValue("s{$i}_nama_mk#1", 'Tidak ada mata kuliah');
                    Log::warning("Tidak ada mata kuliah ditemukan untuk semester {$i}.");
                }

                $template->setValue("s{$i}_total_sks", $semesterTotalSks);
                $grandTotalSks += $semesterTotalSks;
            }

            $template->setValue('total_sks_keseluruhan', $grandTotalSks);
            Log::info("Proses pengisian daftar mata kuliah per semester selesai. Grand total SKS: {$grandTotalSks}");
        } catch (\Exception $e) {
            Log::error('Gagal memproses Daftar Mata Kuliah per Semester: ' . $e->getMessage());
         
            for ($i = 1; $i <= 8; $i++) {
                $template->setValue("s{$i}_no", 'Error');
                $template->setValue("s{$i}_kode_mk", 'Error');
                $template->setValue("s{$i}_nama_mk", 'Gagal memuat data');
                $template->setValue("s{$i}_total_sks", 'Err');
            }
        }

        try {
            Log::info('Memulai proses pengisian tabel mata kuliah wajib prodi.');

            $wajibMk = DB::table('mata_kuliahs as mk')
                ->join('cpl_mk', 'mk.kode_mk', '=', 'cpl_mk.kode_mk')
                ->join('capaian_profil_lulusans as cpl', 'cpl.id_cpl', '=', 'cpl_mk.id_cpl')
                ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
                ->join('profil_lulusans as pl', 'pl.id_pl', '=', 'cpl_pl.id_pl')
                ->where('pl.kode_prodi', $kodeProdi)
                ->where('pl.id_tahun', $idTahun)
              
                ->select('mk.kode_mk', 'mk.nama_mk', 'mk.sks_mk', 'mk.kompetensi_mk')
                ->distinct()
                ->orderBy('mk.kompetensi_mk', 'desc') // Urutkan utama dulu, lalu pendukung
                ->orderBy('mk.kode_mk')
                ->get();

            Log::info('Data mata kuliah wajib ditemukan: ' . $wajibMk->count() . ' record(s)');

            if ($wajibMk->count() > 0) {
                $totalSksWajib = 0;
                $totalSksUtama = 0;
                $totalSksPendukung = 0;

                $template->cloneRow('no_mk', $wajibMk->count());

                foreach ($wajibMk as $index => $matkul) {
                    $rowNum = $index + 1;

                    // Debug: Log data untuk setiap mata kuliah
                    Log::info("Processing MK #{$rowNum}: " . json_encode([
                        'kode_mk' => $matkul->kode_mk,
                        'nama_mk' => $matkul->nama_mk,
                        'sks_mk' => $matkul->sks_mk,
                        'kompetensi_mk' => $matkul->kompetensi_mk
                    ]));

                    $template->setValue("no_mk#{$rowNum}", $rowNum);
                    $template->setValue("kode_mk#{$rowNum}", $matkul->kode_mk ?? '-');
                    $template->setValue("nama_mk#{$rowNum}", htmlspecialchars($matkul->nama_mk ?? '-', ENT_COMPAT, 'UTF-8'));

                    $sksValue = $matkul->sks_mk ?? 0;
                    $kompetensiValue = $matkul->kompetensi_mk ?? 'utama';

                    $template->setValue("sks_mk#{$rowNum}", (string)$sksValue);
                    $template->setValue("kompetensi_mk#{$rowNum}", ucfirst($kompetensiValue));

                    $totalSksWajib += (int)$sksValue;

                    if ($kompetensiValue === 'utama') {
                        $totalSksUtama += (int)$sksValue;
                    } else {
                        $totalSksPendukung += (int)$sksValue;
                    }
                }

                $template->setValue('total_bobot_sks', $totalSksWajib);

                if (method_exists($template, 'setValue')) {
                    $template->setValue('total_sks_utama', $totalSksUtama);
                    $template->setValue('total_sks_pendukung', $totalSksPendukung);
                }

                Log::info('Berhasil mengisi tabel mata kuliah wajib prodi. Total SKS: ' . $totalSksWajib . ' (Utama: ' . $totalSksUtama . ', Pendukung: ' . $totalSksPendukung . ')');
            } else {
                Log::warning('Tidak ada data mata kuliah wajib ditemukan.');

                // Buat satu baris kosong
                $template->cloneRow('no_mk', 1);
                $template->setValue('no_mk#1', '-');
                $template->setValue('kode_mk#1', '-');
                $template->setValue('nama_mk#1', 'Tidak ada data mata kuliah wajib');
                $template->setValue('sks_mk#1', '-');
                $template->setValue('kompetensi_mk#1', '-');
                $template->setValue('total_bobot_sks', '0');
            }
        } catch (\Exception $e) {
            Log::error('Gagal memproses tabel mata kuliah wajib: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            $template->cloneRow('no_mk', 1);
            $template->setValue('no_mk#1', 'Error');
            $template->setValue('kode_mk#1', 'Error');
            $template->setValue('nama_mk#1', 'Gagal memuat data');
            $template->setValue('sks_mk#1', 'Err');
            $template->setValue('kompetensi_mk#1', 'Err');
            $template->setValue('total_bobot_sks', 'Err');
        }

        $fileName = 'Export-KPT-' . ($prodi->nama_prodi ?? 'Unknown') . '-' . ($tahun->tahun ?? 'Unknown') . '.docx';
        $outputPath = storage_path('app/export/' . $fileName);

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
