@extends('base.main')
@section('content')
    <div class="page-title">
        <div class="row m-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Barang Masuk</h3>
                <p class="text-subtitle text-muted">Daftar Barang Masuk Bulan {{ date('F') }}</p>
            </div>
        </div>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Barang Masuk</h4>
                @if (auth()->user()->role == 'admin')
                <a href="/barang_masuk/add" class="btn btn-primary mt-3">Add Data Barang Masuk</a>
                @endif
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <h4 class="card-title mx-4">Filter Tanggal</h4>
                    <form method="POST" action="/filter">
                        @csrf
                        <div class="d-flex">
                            <div class="form-group mx-4 col-4">
                                <label for="">Dari :</label>
                                <input type="date" name="dari" id="dari" class="form-control">
                            </div>
                            <div class="form-group mx-4 col-4">
                                <label for="">Sampai :</label>
                                <input type="date" name="sampai" id="sampai" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="col-2 mx-4 btn btn-success" id="btn-filter">Filter</button>
                    </form>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <h4 class="card-title mx-4">Cari Produk</h4>
                    <form action="/search-data-bm" method="get">
                        <div class="form-group mx-4 col-4">
                            <label for="">Nama Produk :</label>
                            <input type="search" name="search" class="form-control">
                        </div>
                        <button type="submit" class="col-2 mx-4 btn btn-success" id="btn-filter">Cari</button>
                    </form>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <!-- Table with outer spacing -->
                    <div class="table-responsive">
                        <table class="table table-lg">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Kode Supplier</th>
                                    <th>Kode Pegawai</th>
                                    <th>Jumlah Barang</th>
                                    {{-- <th>Ukuran (ml)</th> --}}
                                    <th>Harga Beli</th>
                                    <th>Total Harga</th>
                                    {{-- <th>Expired</th> --}}
                                    @if (auth()->user()->role == 'admin')
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if ($products->count())
                                    @foreach ($products as $product)
                                        <tr id="product{{ $product->id }}">
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $product->tanggal_masuk }}</td>
                                            <td>{{ $product->kode_barang }}</td>
                                            <td>{{ $product->merk_barang }}</td>
                                            <td>{{ $product->kode_supplier }}</td>
                                            <td>{{ $product->kode_pegawai }}</td>
                                            <td>{{ $product->jumlah_barang }}</td>
                                            {{-- <td>{{ $product->ukuran }}</td> --}}
                                            <td>Rp. {{ number_format($product->harga_satuan, 0, '.', '.') }}</td>
                                            <td>Rp. {{ number_format($product->total_harga, 0, '.', '.') }}</td>
                                            {{-- <td>{{ $product->expired }}</td> --}}
                                            <td>
                                                @if (auth()->user()->role == 'admin')
                                                <div class="row">
                                                    <div class="col-6">
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-warning btn-user btn-edit"
                                                            data-id="{{ $product->id }}"
                                                            data-name="{{ $product->merk_barang }}"><i
                                                                class="fa-regular fa-pen-to-square"></i></a>
                                                    </div>

                                                    <div class="col-6">
                                                        <a href="javascript:void(0)"
                                                            class="btn btn-danger btn-user btn-delete"
                                                            data-id="{{ $product->id }}"
                                                            data-name="{{ $product->merk_barang }}"><i
                                                                class="fa-regular fa-trash-can"></i></a>
                                                    </div>
                                                </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <h4 class="text-center">
                                        Data kosong
                                    </h4>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.btn-delete').on('click', function() {
            var Id = $(this).data('id')
            var name = $(this).data('name')

            Swal.fire({
                title: 'Code Verification',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Submit',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    if (login == {!! json_encode($code) !!}) {
                        return true;
                    } else {
                        Swal.fire('Kode Salah')
                        return false;
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "GET",
                        url: '/barang_masuk/delete/' + Id,
                        success: function(data) {
                            Swal.fire('Deleted !', data.success, 'success')
                            $("#product" + Id).remove()
                        },
                        error: function(data) {
                            console.log('Error', data);
                        }
                    });
                } else {
                    Swal.fire('Data tidak jadi dihapus')
                }
            })
        });

        $('.btn-edit').on('click', function() {
            var Id = $(this).data('id')
            var name = $(this).data('name')

            Swal.fire({
                title: 'Code Verification',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Submit',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    if (login == {!! json_encode($code) !!}) {
                        return true;
                    } else {
                        Swal.fire('Kode Salah')
                        return false;
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = '/barang_masuk/edit/' + Id;
                } else {
                    Swal.fire('Data tidak jadi diedit')
                }
            })
        });
    </script>
@endsection
