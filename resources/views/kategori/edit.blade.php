@extends('layout.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Edit Kategori
        </div>
        <div class="card-body">
            <form action="{{ route('kategori.simpan_edit', $data->kategori_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="kategori_kode">Kode Kategori</label>
                    <input type="text" class="form-control" id="kategori_kode" name="kategori_kode" value="{{ $data->kategori_kode }}">
                </div>
                <div class="form-group">
                    <label for="kategori_nama">Nama Kategori</label>
                    <input type="text" class="form-control" id="kategori_nama" name="kategori_nama" value="{{ $data->kategori_nama }}">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection

