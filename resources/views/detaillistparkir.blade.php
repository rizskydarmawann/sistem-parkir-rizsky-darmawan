@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        </div>

        @php
            $masuk = $detaillistparkir->created_at;
            $waktusekarang = date('Y-m-d H:i:s');
            $diff = $masuk->diff($waktusekarang);

            $jam = $diff->h . ' jam';

            $biaya = $diff->h * 3000;

        @endphp


        <div class="card shadow">
            <div class="card-body">
                <form action="/pembayaran/{{$detaillistparkir->id}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="kode">Kode</label>
                        <input type="text" class="form-control" name="kode" placeholder="kode"
                            value="{{ $detaillistparkir->kode }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nomorkendaraan">Nomor Kendaraan</label>
                        <input type="text" class="form-control" name="nomorkendaraan"
                            value="{{ $detaillistparkir->nomorkendaraan }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="total_jam">Total Jam</label>
                        <input type="text" class="form-control" name="total_jam"
                            value="{{$jam}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="bayar">Biaya</label>
                        <input type="text" class="form-control" name="bayar"
                            value="{{$biaya}}" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        Bayar
                    </button>
                    <a href="/kendaraankeluar" class="btn btn-warning btn-block"> Kembali</a>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
