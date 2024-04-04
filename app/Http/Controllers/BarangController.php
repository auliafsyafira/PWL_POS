<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    // Menampilkan halaman awal barang
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];

        $page = (object) [
            'title' => 'Daftar barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'barang'; // set menu yang sedang aktif

        $barang = BarangModel::all(); // ambil data barang

        return view('barang.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    // Ambil data barang dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $barangs = BarangModel::select('barang_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual', 'created_at', 'updated_at');

        // filter data user berdasarkan id_level
        if ($request->barang_id) {
            $barangs->where('barang_id', $request->barang_id);
        }

        return DataTables::of($barangs)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($barang) { // menambahkan kolom aksi
                $btn = '<a href="' . url('/barang/' . $barang->barang_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/barang/' . $barang->barang_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/barang/' . $barang->barang_id) . '">'
                    . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    // Menampilkan halaman form tambah barang
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Barang',
            'list' => ['Home', 'Barang', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah barang baru'
        ];

        $activeMenu = 'barang'; // set menu yang sedang aktif

        $barang = BarangModel::all(); // ambil data barang
        $kategori = KategoriModel::all();

        return view('barang.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan data barang baru
    public function store(Request $request)
    {
        $request->validate([
            'barang_kode' => 'required|string|unique:m_barang,barang_kode',
            'barang_nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:m_kategori,kategori_id',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
        ]);

        BarangModel::create([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'kategori_id' => $request->kategori_id,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil disimpan');
    }

    // Menampilkan detail barang
    public function show(string $id)
    {
        $barang = BarangModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Barang',
            'list'  => ['Home', 'Barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Barang'
        ];

        $activeMenu = 'barang'; // set menu yang sedang aktif

        return view('barang.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    // Menampilkan halaman form edit barang
    public function edit(string $id)
    {
        $barang = BarangModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Barang',
            'list'  => ['Home', 'Barang', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Barang',
        ];

        $activeMenu = 'barang'; // set menu yang sedang aktif

        return view('Barang.edit', ['breadcrumb' => $breadcrumb, 'page' => $page,  'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan perubahan data barang
    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_kode' => 'required|string|unique:m_barang,barang_kode,' . $id . ',barang_id',
            'barang_nama' => 'required|string|max:255',
        ]);

        BarangModel::find($id)->update([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil diubah');
    }

    // Menghapus data barang
    public function destroy(string $id)
    {
        $check = BarangModel::find($id);
        if (!$check) {      // untuk mengecek apakah barang dengan id yang dimaksud ada atau tidak
            return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
        }

        try {
            BarangModel::destroy($id);    // Hapus data barang

            return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
        } catch (\Exception $e) {
            return redirect('/barang')->with('error', 'Data barang gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
