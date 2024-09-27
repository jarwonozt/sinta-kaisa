@extends('base.main')
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 d-flex justify-content-end">
                <p class="text-subtitle text-muted mx-3">Date : {{ $data['today'] }}</p>
                <p class="text-subtitle text-muted">|</p>
                <p class="text-subtitle text-muted mx-3">Time : <span id="rtc"></span></p>
            </div>
            <div class="col-12 col-md-6 m-3">
                <h3>Dashboard</h3>
            </div>
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Selamat Datang di Sistem Informasi Persediaan Barang PT.SHU Baitullah</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <table class="table table-dark">
            <thead>
                <th>TOTAL DAFTAR BARANG</th>
                <th>STOK BARANG TERSEDIA</th>
                <th>STOK BARANG SEDIKIT</th>
                <th>STOK BARANG HABIS</th>
            </thead>
            <tbody>
                <td class="table-primary">{{ $data['total'] }}</td>
                <td class="table-primary">
                    @if ($data['avail']->count())
                        @foreach ($data['avail'] as $key => $item)
                            <span class="text-start fw-bold">
                                -
                                {{ Str::limit($item->merk_barang, 13) . ': ' . $item->stok }}
                            </span>
                            <br>
                        @endforeach
                    @else
                        <h5 class="text-start fw-bold"> - </h5>
                    @endif
                </td>
                <td class="table-primary">
                    @if ($data['warning']->count())
                        @foreach ($data['warning'] as $key => $item)
                            <span class="text-start fw-bold">-
                                {{ Str::limit($item->merk_barang, 13) . ': ' . $item->stok }}</span>
                            <br>
                        @endforeach
                    @else
                        <h5 class="text-start fw-bold"> - </h5>
                    @endif
                </td>
                <td class="table-primary">
                    @if ($data['outOfStock']->count())
                        @foreach ($data['outOfStock'] as $key => $item)
                            <span class="text-start fw-bold">
                                -
                                {{ Str::limit($item->merk_barang, 13) }}
                            </span>
                            <br>
                        @endforeach
                    @else
                        <h5 class="text-start fw-bold"> - </h5>
                    @endif
                </td>
            </tbody>
        </table>
        {{-- <div class="row g-3 mb-4 ">
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <div class="card px-2 shadow">
                    <div class="card-body">
                        <p class="card-title text-primary">TOTAL DAFTAR BARANG</p>
                    </div>
                    <div class="card-footer bg-white">
                        <h5 class="text-start fw-bold">{{ $data['total'] }}</h5>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <div class="card px-2 shadow">
                    <div class="card-body">
                        <p class="card-title text-success">STOK BARANG TERSEDIA</p>
                    </div>
                    <div class="card-footer bg-white">
                        @if ($data['avail']->count())
                            @foreach ($data['avail'] as $key => $item)
                                <span class="text-start fw-bold">
                                    -
                                    {{ Str::limit($item->merk_barang, 13) . ' ' . Str::limit($item->ukuran) . 'ml: ' . $item->stok }}
                                </span>
                                <br>
                            @endforeach
                        @else
                            <h5 class="text-start fw-bold"> - </h5>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <div class="card px-2 shadow">
                    <div class="card-body">
                        <p class="card-title text-warning">STOK BARANG SEDIKIT</p>
                    </div>
                    <div class="card-footer bg-white">
                        @if ($data['warning']->count())
                            @foreach ($data['warning'] as $key => $item)
                                <span class="text-start fw-bold">-
                                    {{ Str::limit($item->merk_barang, 13) . ' ' . Str::limit($item->ukuran) . 'ml: ' . $item->stok }}</span>
                                <br>
                            @endforeach
                        @else
                            <h5 class="text-start fw-bold"> - </h5>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <div class="card px-2 shadow">
                    <div class="card-body">
                        <p class="card-title text-danger">STOK BARANG HABIS</p>
                    </div>
                    <div class="card-footer bg-white">
                        @if ($data['outOfStock']->count())
                            @foreach ($data['outOfStock'] as $key => $item)
                                <span class="text-start fw-bold">
                                    -
                                    {{ Str::limit($item->merk_barang, 13) . ' ' . Str::limit($item->ukuran) . 'ml' }}
                                </span>
                                <br>
                            @endforeach
                        @else
                            <h5 class="text-start fw-bold"> - </h5>
                        @endif
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
