<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'username' => 'customer-1',
            'nama' => 'Pelanggan',
            'password' => Hash::make('12345'),
            'id_level' => 4
        ];
        UserModel::insert($data);

    // coba akses model UserModel
    $user = UserModel::all(); 
    return view('user', ['data' => $user]);
    }
}

