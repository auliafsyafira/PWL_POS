<?php

// namespace App\Http\Controllers;

// use App\DataTables\LevelDataTable;
// use App\Models\LevelModel;
// use Illuminate\Http\Request;
// use Yajra\DataTables\Facades\DataTables;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\DB;

// class LevelController extends Controller
// {
//     public function index()
//     {
//         $breadcrumb = (object) [
//             'title' => 'Daftar Level',
//             'list'  => ['Home', 'Level']
//         ];

//         $page = (object) [
//             'title' => 'Daftar level yang terdaftar dalam sistem'
//         ];

//         $activeMenu = 'level'; //set menu yang sedang aktif
//         $level = LevelModel::all(); //UNTUK FILTERING
//         return view('level.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level,
//         'activeMenu' => $activeMenu]);
//     }

//     public function list(Request $request)
//     {
//         $levels = LevelModel::select('id_level', 'level_kode', 'level_nama');

//         //Filter data user berdasarkan id_level
//         if ($request->id_level) {
//             $levels->where('id_level', $request->id_level);
//         }

//         return DataTables::of($levels)
//             ->addIndexColumn()  //menambahkan kolom index/ no urut (default nama kolom: DT_RowIndex)
//             ->addColumn('aksi', function($level) {
//                 $btn = '<a href="' . url('/level/' . $level->id_level) . '" class="btn btn-info btn-sm">Detail</a> ';
//                 $btn .= '<a href="' . url('/level/' . $level->id_level . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
//                 $btn .= '<form class="d-inline-block" method="POST" action="' . url('/level/' . $level->id_level) . '">' . csrf_field() . method_field('DELETE').
//                         '<button type="submit" class="btn btn-danger btn-sm"
//                         onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
//                 return $btn;
//             })
//             ->rawColumns(['aksi']) //memberitahu bahwa kolom aksi adalah html
//             ->make(true);
//     }  

//     public function create()
//     {
//         $breadcrumb = (object) [
//             'title' => 'Tambah Level',
//             'list'  => ['Home', 'Level', 'Tambah']
//         ];

//         $page = (object) [
//             'title' => 'Tambah level baru'
//         ];

//         $level = LevelModel::all();
//         $activeMenu = 'level';

//         return view('level.create', 
//         [
//             'breadcrumb' => $breadcrumb, 
//             'page'       => $page,
//             'level'      => $level,
//             'activeMenu' => $activeMenu,
//         ]);
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'level_kode'     => 'required|max:255',                         
//             'level_nama'     => 'required|unique:m_level|max:255',                                         
//         ]);
//         LevelModel::create([
//             'level_kode'     => $request->level_kode,
//             'level_nama'     => $request->level_nama,
//         ]);
//         return redirect('/level')->with('success', 'Data Level berhasil disimpan');
//     }

//     //Menampilkan detail Level
//     public function show(String $id)
//     {
//         $level = LevelModel::find($id);

//         $breadcrumb = (object) [
//             'title' => 'Detail Level',
//             'list'  => ['Home', 'Level', 'Detail']
//         ];

//         $page = (object) [
//             'title' => 'Detail Level'
//         ];

//         $activeMenu = 'level';       //set menu yang sedang aktif
//         return view('level.show', 
//         [
//             'breadcrumb' => $breadcrumb,
//             'page'       => $page,
//             'level'       => $level,
//             'activeMenu' => $activeMenu,
//         ]);
//     }

//     public function edit($id)
//     {
//         $level = LevelModel::find($id);

//         $breadcrumb = (object) [
//             'title' => 'Level User',
//             'list'  => ['Home', 'Level', 'Edit']
//         ];

//         $page = (object) [
//             'title' => 'Edit level'
//         ];

//         $activeMenu = 'level'; //set menu yang sedang aktif

//         return view('level.edit', [
//             'breadcrumb' => $breadcrumb,
//             'page' => $page,
//             'level' => $level,
//             'activeMenu' => $activeMenu
//         ]);
//     }

//     //Menyimpan perubahan data level
//     public function update(Request $request, string $id)
//     {
//         $request->validate([
//             //levelname harus didisi, berupa string, minimal 3 karakter,
//             //dan bernilai unik ditabel m_level kolom level kecuali untuk level dengan id yang sedang diedit
//             'level_kode'     => 'required|max:255', 
//             'level_nama'     => 'required|unique:m_level|max:255',

//         ]);

//         LevelModel::find($id)->update([
//             'level_kode'     => $request->level_kode, 
//             'level_nama'     => $request->level_nama,
//         ]);

//         return redirect('/level')->with('success', 'Data level berhasil diubah');
//     }

//     //Menghapus data level
//     public function destroy(string $id)
//     {
//         $check = levelModel::find($id);
//         if (!$check) {      //untuk mengecek apakah data level dengan id yang dimaksud ada atau tidak
//             return redirect('/level')->with('error', 'Data level tidak ditemukan');
//         }

//         try{
//             levelModel::destroy($id);    //Hapus data level

//             return redirect('/level')->with('seccess', 'Data level berhasil dihapus');
//         }catch (\Illuminate\Database\QueryException $e){

//             //Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
//             return redirect('/level')->with('error', 'Data level gagal dihapus karena masih terdapat tabel lain yang terkai dengan data ini');
//         }
//     }
// }


namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    // Menampilkan halaman awal level
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];

        $page = (object) [
            'title' => 'Daftar level yang terdaftar dalam sistem'
        ];

        $activeMenu = 'level'; // set menu yang sedang aktif

        $level = LevelModel::all(); // ambil data level

        return view('level.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // Ambil data level dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $levels = LevelModel::select('id_level', 'level_kode', 'level_nama', 'created_at', 'updated_at');

        // filter data user berdasarkan id_level
        if ($request->id_level) {
            $levels->where('id_level', $request->id_level);
        }

        return DataTables::of($levels)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($level) { // menambahkan kolom aksi
                $btn = '<a href="' . url('/level/' . $level->id_level) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/level/' . $level->id_level . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/level/' . $level->id_level) . '">'
                    . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" 
                onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    // Menampilkan halaman form tambah level
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah level baru'
        ];

        $activeMenu = 'level'; // set menu yang sedang aktif

        $level = LevelModel::all(); // ambil data level

        return view('level.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan data level baru
    public function store(Request $request)
    {
        $request->validate([
            'level_kode' => 'required|string|unique:m_level,level_kode',
            'level_nama' => 'required|string|max:255',
        ]);

        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect('/level')->with('success', 'Data level berhasil disimpan');
    }

    // Menampilkan detail level
    public function show(string $id)
    {
        $level = LevelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Level',
            'list'  => ['Home', 'Level', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Level'
        ];

        $activeMenu = 'level'; // set menu yang sedang aktif

        return view('level.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // Menampilkan halaman form edit level
    public function edit(string $id)
    {
        $level = LevelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Level',
            'list'  => ['Home', 'Level', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Level',
        ];

        $activeMenu = 'level'; // set menu yang sedang aktif

        return view('level.edit', ['breadcrumb' => $breadcrumb, 'page' => $page,  'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan perubahan data level
    public function update(Request $request, string $id)
    {
        $request->validate([
            'level_kode' => 'required|string|unique:m_level,level_kode,' . $id . ',id_level',
            'level_nama' => 'required|string|max:255',
        ]);

        LevelModel::find($id)->update([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect('/level')->with('success', 'Data level berhasil diubah');
    }

    // Menghapus data level
    public function destroy(string $id)
    {
        $check = LevelModel::find($id);
        if (!$check) {      // untuk mengecek apakah level dengan id yang dimaksud ada atau tidak
            return redirect('/level')->with('error', 'Data level tidak ditemukan');
        }

        try {
            LevelModel::destroy($id);    // Hapus data level

            return redirect('/level')->with('success', 'Data level berhasil dihapus');
        } catch (\Exception $e) {
            return redirect('/level')->with('error', 'Data level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}

