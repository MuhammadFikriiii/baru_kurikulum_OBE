<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BahanKajian;

class BahanKajianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BahanKajian::insert([
            [
                'kode_bk'=>'BK01',
                'nama_bk'=> 'Artificial Intelligence(AI)',
                'deskripsi_bk'=> '-',
                'referensi_bk'=> 'CSC2023',
                'status_bk'=> 'core',
                'knowledge_area'=> '-',
            ],
            [
                'kode_bk'=>'BK02',
                'nama_bk'=> 'Algorithmic Foundations (AL)',
                'deskripsi_bk'=> '-',
                'referensi_bk'=> 'CSC2023',
                'status_bk'=> 'elective',
                'knowledge_area'=> '-',
            ],
            [
                'kode_bk'=>'BK03',
                'nama_bk'=> 'Architecture and Organization (AR)',
                'deskripsi_bk'=> '-',
                'referensi_bk'=> 'CSC2023',
                'status_bk'=> 'core',
                'knowledge_area'=> '-',
            ],
            [
                'kode_bk'=>'BK04',
                'nama_bk'=> 'Data Management (DM)',
                'deskripsi_bk'=> '-',
                'referensi_bk'=> 'CSC2023',
                'status_bk'=> 'elective',
                'knowledge_area'=> '-',
            ],
            [
                'kode_bk'=>'BK05',
                'nama_bk'=> 'Foundations of Programming Languages (FPL)',
                'deskripsi_bk'=> '-',
                'referensi_bk'=> 'CSC2023',
                'status_bk'=> 'core',
                'knowledge_area'=> '-',
            ],
            [
                'kode_bk'=>'BK06',
                'nama_bk'=> 'Human-Computer Interaction (HCI)',
                'deskripsi_bk'=> '-',
                'referensi_bk'=> 'CSC2023',
                'status_bk'=> 'elective',
                'knowledge_area'=> '-',
            ],
            [
                'kode_bk'=>'BK07',
                'nama_bk'=> 'Mathematical and Statistical Foundations (MSF)',
                'deskripsi_bk'=> '-',
                'referensi_bk'=> 'CSC2023',
                'status_bk'=> 'core',
                'knowledge_area'=> '-',
            ],
            [
                'kode_bk'=>'BK08',
                'nama_bk'=> 'Networking and Communication (NC)',
                'deskripsi_bk'=> '-',
                'referensi_bk'=> 'CSC2023',
                'status_bk'=> 'elective',
                'knowledge_area'=> '-',
            ],
            [
                'kode_bk'=>'BK09',
                'nama_bk'=> 'Operating Systems (OS)',
                'deskripsi_bk'=> '-',
                'referensi_bk'=> 'CSC2023',
                'status_bk'=> 'core',
                'knowledge_area'=> '-',
            ],
            [
                'kode_bk'=>'BK10',
                'nama_bk'=> 'Software Development Fundamentals (SDF)',
                'deskripsi_bk'=> '-',
                'referensi_bk'=> 'CSC2023',
                'status_bk'=> 'elective',
                'knowledge_area'=> '-',
            ],
            [
                'kode_bk'=>'BK11',
                'nama_bk'=> 'Software Engineering (SE)',
                'deskripsi_bk'=> '-',
                'referensi_bk'=> 'CSC2023',
                'status_bk'=> 'elective',
                'knowledge_area'=> '-',
            ],
            [
                'kode_bk'=>'BK12',
                'nama_bk'=> 'Security (SEC)',
                'deskripsi_bk'=> '-',
                'referensi_bk'=> 'CSC2023',
                'status_bk'=> 'elective',
                'knowledge_area'=> '-',
            ],
            [
                'kode_bk'=>'BK13',
                'nama_bk'=> 'Society, Ethics, and the Profession (SEP)',
                'deskripsi_bk'=> '-',
                'referensi_bk'=> 'CSC2023',
                'status_bk'=> 'elective',
                'knowledge_area'=> '-',
            ],
            [
                'kode_bk'=>'BK14',
                'nama_bk'=> 'Systems Fundamentals (SF)',
                'deskripsi_bk'=> '-',
                'referensi_bk'=> 'CSC2023',
                'status_bk'=> 'elective',
                'knowledge_area'=> '-',
            ],
            [
                'kode_bk'=>'BK15',
                'nama_bk'=> 'Specialized Platform Development (SPD)',
                'deskripsi_bk'=> '-',
                'referensi_bk'=> 'CSC2023',
                'status_bk'=> 'elective',
                'knowledge_area'=> '-',
            ],
            [
                'kode_bk'=>'BK16',
                'nama_bk'=> 'Parallel and Distributed Computing (PDC)',
                'deskripsi_bk'=> '-',
                'referensi_bk'=> 'CSC2023',
                'status_bk'=> 'elective',
                'knowledge_area'=> '-',
            ],
            [
                'kode_bk'=>'BK17',
                'nama_bk'=> 'General Knowledge',
                'deskripsi_bk'=> '-',
                'referensi_bk'=> 'CSC2023',
                'status_bk'=> 'elective',
                'knowledge_area'=> '-',
            ],
        ]);
    }
}
