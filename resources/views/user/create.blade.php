@extends('layout.app')

@section('subtitle', 'User')
@section('content_header_title', 'User')
@section('content_header_subtitle', 'Create')

@section('content')
<div class="container">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah User Baru</h3>
        </div>
        <form method="post" action="../user">
            @csrf
            <div class="card-body">
    
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                @error('username')
                <div class="alert alert-danger">{{ $message }}</div>    
                @enderror
            </div>
 
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                @error('nama')
                <div class="alert alert-danger">{{ $message }}</div>    
                @enderror
            </div>
 
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>    
                @enderror
            </div>
 
            <div class="form-group">
                <label for="id_level">ID Level</label>
                <input type="number" class="form-control" id="id_level" name="id_level" placeholder="Id Level">
                @error('id_level')
                <div class="alert alert-danger">{{ $message }}</div>    
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary fileinputbutton">Submit</button>
        </div>
    </form>
    </div>
</div>
@endsection

