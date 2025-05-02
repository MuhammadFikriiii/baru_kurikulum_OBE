<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Models\ProfilLulusan;

class ExportController extends Controller
{
    public function exportProfilLulusanToWord()
    {
        $profillulusans = ProfilLulusan::with('prodi')->get();
        $templatePath = storage_path('app/template/template_profil_lulusan.docx');

        $phpWord = new TemplateProcessor($templatePath);
        $phpWord->cloneRow('kode_pl', count($profillulusans));

        foreach ($profillulusans as $index => $pl) {
            $row = $index + 1;
            $phpWord->setValue("no#$row", $row);
            $phpWord->setValue("kode_pl#$row", $pl->kode_pl);
            $phpWord->setValue("prodi#$row", $pl->prodi->nama_prodi ?? '-');
            $phpWord->setValue("deskripsi_pl#$row", $pl->deskripsi_pl);
            $phpWord->setValue("profesi_pl#$row", $pl->profesi_pl);
            $phpWord->setValue("unsur_pl#$row", $pl->unsur_pl);
            $phpWord->setValue("keterangan_pl#$row", $pl->keterangan_pl);
            $phpWord->setValue("sumber_pl#$row", $pl->sumber_pl);
        }

        $fileName = 'profil_lulusan.docx';
        $filePath = public_path($fileName);
        $phpWord->saveAs($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
