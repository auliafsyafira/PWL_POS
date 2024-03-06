<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    
    public function run(): void
    {
        $data = [
            [
                'barang_id' => 1,
                'kategori_id' => 2,
                'barang_kode' => 'BRG1',
                'barang_nama' => 'Buku',
                'harga_beli' => '5000',
                'harga_jual' => '7000',
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 4,
                'barang_kode' => 'BRG2',
                'barang_nama' => 'Kipas',
                'harga_beli' => '100000',
                'harga_jual' => '130000',
            ],
            [
                'barang_id' => 3,
                'kategori_id' => 3,
                'barang_kode' => 'BRG3',
                'barang_nama' => 'Celana',
                'harga_beli' => '70000',
                'harga_jual' => '90000',
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 1,
                'barang_kode' => 'BRG4',
                'barang_nama' => 'Kalung',
                'harga_beli' => '300000',
                'harga_jual' => '350000',
            ],
            [
                'barang_id' => 5,
                'kategori_id' => 3,
                'barang_kode' => 'BRG5',
                'barang_nama' => 'Kemeja',
                'harga_beli' => '100000',
                'harga_jual' => '150000',
            ],
            [
                'barang_id' => 6,
                'kategori_id' => 3,
                'barang_kode' => 'BRG6',
                'barang_nama' => 'Jaket',
                'harga_beli' => '170000',
                'harga_jual' => '200000',
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 4,
                'barang_kode' => 'BRG7',
                'barang_nama' => 'Kursi',
                'harga_beli' => '50000',
                'harga_jual' => '55000',
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 2,
                'barang_kode' => 'BRG8',
                'barang_nama' => 'Pensil',
                'harga_beli' => '3000',
                'harga_jual' => '5000',
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 5,
                'barang_kode' => 'BRG9',
                'barang_nama' => 'Dasi',
                'harga_beli' => '30000',
                'harga_jual' => '40000',
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 3,
                'barang_kode' => 'BRG10',
                'barang_nama' => 'Penghapus',
                'harga_beli' => '5000',
                'harga_jual' => '7000',
            ],
        ];
        DB::table('m_barang')->insert($data);
    }
}