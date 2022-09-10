@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        </div>

        <div class="card shadow">
            <div class="row justify-content-center  mt-5">
                <div class="col-md-6">
                    <form action="/kendaraankeluar">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari Kode" name="cari"
                                value="{{ request('cari') }}" autofocus>
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="row">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Kode</th>
                                        <th>Nomor Kendaraan</th>
                                        <th>Tanggal / Jam Masuk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($list as $item)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $item->kode }}</td>
                                            <td>{{ $item->nomorkendaraan }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                <a href="/listparkir/detail/{{ $item->id }}" class="btn btn-info">
                                                    <i class="fa fa-eye"></i> Bayar
                                                </a>

                                            </td>
                                        </tr>
                                    @empty
                                        <td colspan="7" class="text-center">
                                            Data Kosong
                                        </td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{ $list->links() }}
            </div>
        </div>

    </div>


    <!-- /.container-fluid -->
@endsection
