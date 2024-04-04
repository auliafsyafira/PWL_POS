@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($level)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>Data yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('level') }}" class="btn btn-sm btn-default mt2">Kembali</a>
            @else
                <form method="POST" action="{{ url('/level/'.$level->id_level) }}" class="form-horizontal">
                @csrf
                {!! method_field('PUT') !!} <!-- tambahkan baris ini untuk proses edit yang butuh method PUT -->
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Level Kode</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="level_kode" name="level_kode" value="{{ old('level_kode', $level->level_kode) }}" required>
                        @error('level_kode')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Level Nama</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="level_nama" name="level_nama" value="{{ old('level_nama', $level->level_nama) }}" required>
                    @error('level_nama')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label"></label>
                    <div class="col-11">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('level') }}">Kembali</a>
                    </div>
                </div>
            </form>
        @endempty
    </div>
</div>
@endsection

@push('css')
@endpush
@push('js')
@endpush


{{-- @extends('layout.app')

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
 --}}
