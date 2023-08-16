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
                    <form action="/laporan">
                        <div class="">
                            <label class="form-control-label" for="start_date">Awal</label>
                            <label class="form-control-label" style="padding-left: 200px" for="end_date">Akhir</label>
                        </div>
                        <div class="input-group date">
                            <input type="text" class="form-control" placeholder="Masukkan Tanggal" readonly
                                name="start_date" id="start_date" autocomplete="off">
                            <input type="text" class="form-control" placeholder="Masukkan Tanggal" readonly
                                id="end_date" name="end_date" autocomplete="off">

                            <button class="btn btn-primary" type="submit">Cari</button>
                        </div>

                    </form>
                </div>
            </div>
            <div class="card-header">
                <a href="/laporanExport" class="btn btn-success">Export</a>
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
                                        <th>Total Jam</th>
                                        <th>Biaya</th>
                                        <th>Tanggal / Jam Masuk</th>
                                        <th>Tanggal / Jam Keluar</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($list as $item)
                                        <tr class="text-center">
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $item->kode }}</td>
                                            <td>{{ $item->nomorkendaraan }}</td>
                                            <td>{{ isset($item->total_jam) ? $item->total_jam : '-' }}</td>
                                            <td>{{ isset($item->bayar) ? $item->bayar : '-' }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ isset($item->updated_at) ? $item->updated_at : '-' }}</td>
                                            <td>{{ $item->status }}</td>
                                        </tr>
                                    @empty
                                        <td colspan="8" class="text-center">
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

    <script type="text/javascript">
        $('#start_date').datepicker({
            format: 'yyyy-mm-dd',
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
        });

        $('#end_date').datepicker({
            format: 'yyyy-mm-dd',
            changeMonth: true,
            // changeYear: true,
            // showButtonPanel: true,
        });
    </script>




    <!-- /.container-fluid -->
@endsection
