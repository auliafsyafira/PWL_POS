<?php

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

// public function index(UserDataTable $dataTable) {
//     return $dataTable->render('user.index');
// }

// public function create() {
//     return view('user.create');
// }

// public function store(Request $request) {
//     $request->validate([
//         'username' => 'bail|required|string|max:255',
//         'nama' => 'bail|required|string|max:255',
//         'password' => 'bail|required|string|max:255',
//         'id_level' => 'bail|required|string|max:255',
//     ]);

//     UserModel::create([
//         'username' => $request->username,
//         'nama' => $request->namaUser,
//         'password' => Hash::make($request->password),
//         'id_level' => $request->id_level,
//     ]);
//     return redirect('/user');
// }

// public function edit($id) {
//     $user = UserModel::find($id);
//     return view('user.edit', ['data' => $user]);
// }

// public function edit_simpan($id, Request $request) {
//     $user = UserModel::find($id);
//     $user->username = $request->username;
//     $user->nama = $request->nama;
//     $user->password = Hash::make($request->password);
//     $user->id_level = $request->id_level;
//     $user->save();
//     return redirect('/user');
// }

// public function delete($id) {
//     $user = UserModel::find($id);
//     $user->delete();
//     return redirect('/user');
// }
// namespace App\Http\Controllers;

// use App\DataTables\LevelDataTable;
// use App\Models\LevelModel;
// use Illuminate\Http\Request;

// class LevelController extends Controller
// {
//     public function index(LevelDataTable $dataTable) {
//         return $dataTable->render('level.index');
//     }

//     public function create() {
//         return view('level.create');
//     }

//     public function store(Request $request) {
//         LevelModel::create([
//         'level_kode' => $request->level_kode,
//         'level_nama' => $request->level_nama,
//     ]);
//     return redirect('/level');
//     }

//     public function edit($id) {
//         $level = LevelModel::find($id);
//         return view('level.edit', ['data' => $level]);
//     }

//     public function edit_simpan($id, Request $request) {
//         $level = LevelModel::find($id);
//         $level->level_kode = $request->level_kode;
//         $level->level_nama = $request->level_nama;
//         $level->save();
//         return redirect('/level');
//     }

//     public function delete($id) {
//         $level = LevelModel::find($id);
//         $level->delete();
//         return redirect('/level');
//     }
//}