<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
   
    public function run(): void
    {
        $data = [
            [
                'kategori_id' => 1,
                'kategori_kode' => 'KTGR1',
                'kategori_nama' => 'Perhiasan',
            ],
            [
                'kategori_id' => 2,
                'kategori_kode' => 'KTGR2',
                'kategori_nama' => 'Alat Tulis',
            ],
            [
                'kategori_id' => 3,
                'kategori_kode' => 'KTGR3',
                'kategori_nama' => 'Pakaian',
            ],
            [
                'kategori_id' => 4,
                'kategori_kode' => 'KTGR4',
                'kategori_nama' => 'Alat Rumah Tangga',
            ],
            [
                'kategori_id' => 5,
                'kategori_kode' => 'KTGR5',
                'kategori_nama' => 'Aksesoris',
            ],
        ];
        DB::table('m_kategori')->insert($data);
    }
}