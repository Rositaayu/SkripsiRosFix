@extends('layouts.main')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Editor</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('editor') }}">Editor</a></li>
        <li class="breadcrumb-item active">Edit Data</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i>
            Edit Editor
        </div>
        <div class="card-body">
            <form action="{{ route('editor.update', $data->id_editor) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                        value="{{ old('nama', $data->user->name) }}">
                    @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email', $data->user->email) }}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                        rows="3">{{ old('alamat', $data->alamat) }}</textarea>
                    @error('alamat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="no_hp" class="form-label">No. HP</label>
                    <input type="number" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                        name="no_hp" value="{{ old('no_hp', $data->no_hp) }}">
                    @error('no_hp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="kuota" class="form-label">Kuota</label>
                    <input type="number" class="form-control @error('kuota') is-invalid @enderror" id="kuota"
                        name="kuota" value="{{ old('kuota', $data->kuota) }}">
                    @error('kuota')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="is_active" class="form-label">Status</label>
                    <div class="form-check p-0 d-flex
                        @error('is_active') is-invalid @enderror">
                        <input class="form-check
                            @error('is_active') is-invalid @enderror" type="radio" name="is_active" id="is_active1"
                            value="1" {{ old('is_active', $data->user->is_active) == 1 ? 'checked' : '' }}>
                        <label class="form-check
                            @error('is_active') is-invalid @enderror" for="is_active1">Aktif</label>
                    </div>
                    <div class="form-check p-0 d-flex
                        @error('is_active') is-invalid @enderror">
                        <input class="form-check
                            @error('is_active') is-invalid @enderror" type="radio" name="is_active" id="is_active0"
                            value="0" {{ old('is_active', $data->user->is_active) == 0 ? 'checked' : '' }}>
                        <label class="form-check
                            @error('is_active') is-invalid @enderror" for="is_active0">Tidak Aktif</label>
                    </div>
                    @error('is_active')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <a href="{{ route('editor') }}" class="btn btn-danger">Kembali</a>
                <button type="submit" class="btn btn-success">Perbarui</button>
            </form>
        </div>
    </div>
</div>
@endsection