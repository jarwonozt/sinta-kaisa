@extends('base.main')
@section('content')
    <div class="page-title">
        <div class="row m-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Data Barang Keluar</h3>
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
            <form action="/barang_keluar/update/{{ $product->id }}" method="POST">
                @csrf
                <div class="form-group col-8">
                    <label>Tanggal Keluar</label>
                    <input type="date" name="tanggal_keluar"
                        class="form-control @error('tanggal_keluar') is-invalid @enderror" id="tanggal_keluar"
                        value="{{ $product->tanggal_keluar }}">
                    @error('tanggal_keluar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-8">
                    <label>Nama Barang</label>
                    <select class="form-select" name="merk_barang" id="merk_barang">
                        @foreach ($merkBarang as $item)
                            <option value="{!! $item !!}"
                                {{ $product->merk_barang == $item ? 'selected' : '' }}>{!! $item !!}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="form-group col-8">
                    <label>Ukuran Barang (ml)</label>
                    <select class="form-select" name="ukuran" id="ukuran">
                        <option value="{{ $product->ukuran }}">{{ $product->ukuran }}</option>
                    </select>
                </div> --}}
                <div class="form-group col-8">
                    <label>Jumlah Barang</label>
                    <input type="number" min="0" name="jumlah_barang"
                        class="form-control @error('jumlah_barang') is-invalid @enderror" id="jumlah_barang"
                        placeholder="Jumlah Barang" value="{{ $product->jumlah_barang }}">
                    @error('jumlah_barang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-8">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan" id="keterangan" rows="3">{{ $product->keterangan }}</textarea>
                </div>
                <button type="submit" class="btn btn-success mt-3">Submit</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let merkBarang = $('select[name="merk_barang"]').val();
            let ukuran = {!! json_encode($product->ukuran) !!}

            if (merkBarang) {
                jQuery.ajax({
                    url: '/merk_barang/' + merkBarang + '/ukuran',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $('select[name="ukuran"]').empty();
                        $.each(data, function(key, value) {
                            if (value == ukuran) {
                                $('select[name="ukuran"]').append(
                                    '<option value="' + value + '" selected>' + value +
                                    '</option>');
                            } else {
                                $('select[name="ukuran"]').append(
                                    '<option value="' + value + '">' + value +
                                    '</option>');
                            }
                        });
                    }
                });
            }

            $('select[name="merk_barang"]').on('change', function() {
                merkBarang = $(this).val();
                if (merkBarang) {
                    jQuery.ajax({
                        url: '/merk_barang/' + merkBarang + '/ukuran',
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('select[name="ukuran"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="ukuran"]').append(
                                    '<option value="' + value + '">' + value +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="city_origin"]').empty();
                }
            });
        });
    </script>
@endsection
