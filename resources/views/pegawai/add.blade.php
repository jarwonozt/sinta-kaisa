@extends('base.main')
@section('content')
    <div class="page-title">
        <div class="row m-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Add Barang</h3>
            </div>
        </div>
    </div>
    @if (session()->has('error'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="/pegawai/store" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group col-8">
                    <label>Kode Pegawai</label>
                    <input type="text" name="kode_pegawai"
                        class="form-control @error('kode_pegawai') is-invalid @enderror" id="kode_pegawai"
                        placeholder="Kode Pegawai" value="{{ $id }}" readonly>
                    @error('kode_pegawai')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-8">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                        id="username" placeholder="Username" value="{{ old('username') }}">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-8">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        id="password" placeholder="Password" value="{{ old('password') }}">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-8">
                    <label>Image</label>
                    <input type="file" name="imagex" class="form-control @error('imagex') is-invalid @enderror"
                        id="image" placeholder="Image">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-8">
                    <label>Hak Akses</label>
                    <select class="form-select" name="role" id="role">
                        <option value="admin">Full Akses</option>
                        <option value="guest">Terbatas</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success mt-3">Submit</button>
            </form>
        </div>
    </div>
@endsection
