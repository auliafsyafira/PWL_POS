<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        return TransaksiModel::all();
    }

    public function store(Request $request)
    {
        $penjualan = TransaksiModel::create($request->all());
        return response()->json($penjualan, 201);
    }

    public function show(TransaksiModel $penjualan)
    {
        return TransaksiModel::find($penjualan);
    }

    public function update(Request $request, TransaksiModel $penjualan)
    {
        $penjualan->update($request->all());
        return TransaksiModel::find($penjualan);
    }

    public function destroy(TransaksiModel $penjualan)
    {
        $penjualan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data terhapus'
        ]);
    }
}