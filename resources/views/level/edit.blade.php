@extends('layout.app')

@section('subtitle', 'User')
@section('content_header_title', 'User')
@section('content_header_subtitle', 'Edit')

@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Level</h3>
            </div>
            <form method="post" action="{{ route('/level/edit_simpan', $data->id_level) }}">
                @csrf
                @method('PUT')
                <div class='card'></div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="level_code">Level Kode</label>
                        <input type="text" class="form-control" id="level_kode" name="level_kode" value="{{$data->level_kode}}">
                    </div>
                    <div class="form-group">
                        <label for="level_nama">Level Nama</label>
                        <input type="text" class="form-control" id="level_nama" name="level_nama" value="{{$data->level_nama}}">
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('level.index') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

