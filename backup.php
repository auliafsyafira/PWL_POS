<?php
namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller {
    // menampilkan halaman awal user
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list'  => ['Home', 'User']
        ];

        $page = (object) [
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user'; //set menu yang sedang aktif

        //$level = LevelModel::all(); // ambil data level untuk filter level 'level' => $level
        
        return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    // Ambil data user dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $users = UserModel::select('user_id', 'username', 'nama', 'id_level') ->with('level');

        // // filter data user berdasarkan id_level
        // if ($request->id_level) {
        //     $users->where('id_level', $request->id_level);
        // }
        
        return DataTables::of($users)
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('aksi', function ($user) { // menambahkan kolom aksi
            $btn = '<a href="'.url('/user/' . $user->user_id).'" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="'.url('/user/' . $user->user_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="'. url('/user/'.$user->user_id).'">'
                . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" 
                onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
            return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah User',
            'list'  => ['Home', 'User', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah user baru'
        ];

        $level = LevelModel::all(); // ambil data level untuk ditampilkan di form
        $activeMenu = 'user'; // set menu yang sedang aktif
        
        return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // menyimpan data user baru
    public function store(Request $request)
    {
        $request->validate([
            // username harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel m_user kolom username
            'username'  => 'required|string|min:3|unique:m_user,username',
            'nama'      => 'required|string|max:100|',
            'password'  => 'required|min:5|',
            'id_level'  => 'required|integer|'
        ]);

        UserModel::create([
            'username'  => $request->username,
            'nama'      => $request->nama,
            'password'  => bcrypt($request->password), // password dienkripsi sebelum disimpan
            'id_level'  => $request->id_level
        ]);

        return redirect('/user')->with('success', 'Data user berhasil disimpan');
    }

    // menampilkan detail user
    public function show(string $id)
    {
        $user = UserModel::with('level')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail User',
            'list'  => ['Home', 'User', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail user'
        ];

        $activeMenu = 'user'; // set menu yang sedang aktif
        
        return view('user.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    // menampilkan halaman form edit user
    public function edit(string $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit User',
            'list'  => ['Home', 'User', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit user'
        ];

        $activeMenu = 'user'; // set menu yang sedang aktif
        
        return view('user.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // menyimpan perubahan data user
    public function update(Request $request, string $id)
    {
        $request->validate([
            // username harus diisi, berupa string, minimal 3 karakter,
            // dan bernilai unik di tabel m_user kolom username kecuali untuk user dengan id yang sedang diedit
            'username'  => 'required|string|min:3|unique:m_user,username,'.$id.',user_id',
            'nama'      => 'required|string|max:100|',  // nama harus diidi, berupa string, danmaksimal 100 karakter
            'password'  => 'nullable|min:5|',           // password bisa diisi (minimal 5 karakter) dan bisa tidak diisi 
            'id_level'  => 'required|integer'           // id_level harus diisi dan berupa angka
        ]);

        UserModel::find($id)->update([
            'username'  => $request->username,
            'nama'      => $request->nama,
            'password'  => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
            'id_level'  => $request->id_level
        ]);

        return redirect('/user')->with('success', 'Data user berhasil diubah');
    }    

    // menghapus data user
    public function destroy(string $id)
    {
        $check = UserModel::find($id); 
        if (!$check) {
            return redirect('/user')->with('error', 'Data user tidak ditemukan');
        }

        try {
            UserModel::destroy($id); // hapus data level
            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/user')->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
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




// INDEX class="BLADE PHP"
@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('user/create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            {{-- <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="id_level" name="id_level" required>
                                <option value="">- Semua -</option>
                                @foreach ($level as $item)
                                <option value="{{ $item->id_level }}">{{ $item->level_nama }}</option>      
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Level Pengguna</small>
                        </div>
                    </div>
                </div>
            </div> --}}
            <table class="table table-bordered table-striped table-hover table-sm" id="table_user">
            <thead>
                <tr><th>ID</th><th>Username</th><th>Nama</th><th>Level Pengguna</th><th>Aksi</th></tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var dataUser = $('#table_user').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ url('user/list') }}",
                    "dataType": "json",
                    "type": "POST"
                    // "data" : function(d) {
                    //     d.id_level = $('#id_level').val();
                    }
                },
                columns: [
                    {
                        data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },{
                        data: "username",
                        className: "",
                        orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                        searchable: true // searchable: true, jika ingin kolom ini bisa dicari
                    },{
                        data: "nama",
                        className: "",
                        orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                        searchable: true // searchable: true, jika ingin kolom ini bisa dicari
                    },{
                        data: "level.level_nama",
                        className: "",
                        orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan
                        searchable: false // searchable: true, jika ingin kolom ini bisa dicari
                    },{
                        data: "aksi",
                        className: "",
                        orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan
                        searchable: false // searchable: true, jika ingin kolom ini bisa dicari
                    }
                ]
            });

            // $('#id_level').on('change', function() {
            //     dataUser.ajax.reload();
            // });

        }); 
    </script>
@endpush

