<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Models\Masuk;
use Illuminate\Http\Request;
// use DB;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'title' => 'Dashboard'
        ]);
    }
    public function masuk()
    {

        $query = DB::table('masuks')->select(DB::raw('MAX(RIGHT(kode,4)) as kode'));
        $kd = "";
        if ($query->count() > 0) {
            foreach ($query->get() as $k) {
                $tmp = ((int)$k->kode) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = date('Ymd') . "0001";
        }
        return view('masuk', [
            'title' => 'Kendaraan Masuk',
            'kode' => $kd
        ]);
    }

    public function simpanmasuk(Request $request)
    {
        $a = Masuk::where('status', 'masuk')
            ->where('nomorkendaraan', $request->nomorkendaraan)
            ->first();

        if ($a == NULL) {
            $validate = $request->validate([
                'kode' => 'required|max:255|unique:masuks',
                'nomorkendaraan' => ['required', 'min:7', 'max:255']
            ]);

            $validate['status'] = 'masuk';
            $validate['bayar'] = NULL;
            $validate['total_jam'] = '';
            $validate['created_at'] =  date('Y-m-d H:i:s');
            $validate['updated_at'] = NULL;
            $validate['nomorkendaraan'] = strtoupper($validate['nomorkendaraan']);
            Masuk::create($validate);
            return redirect('/kendaraanmasuk')->with('success', 'Berhasil Disimpan.');
        }
        return redirect('/kendaraanmasuk')->with('error', 'Kendaraan Masi Ada Diparkiran !');
    }


    public function keluar()
    {

        $a = Masuk::where('status', 'masuk')->paginate(5);

        if (request('cari')) {
            $a = Masuk::where('kode', 'like', '%' . request('cari') . '%')->where('status', 'masuk')->paginate(5);
        }

        return view('keluar', [
            'title' => 'List Pakrkir',
            'list' => $a,
        ])->with('i', (request('page', 1) - 1) * 5);
    }

    public function detaillistparkir(Request $request, $id_list)
    {

        $detaillistparkir =  Masuk::findOrFail($id_list);

        return view('detaillistparkir', [
            'title' => 'Detail List Pakrkir',
            'detaillistparkir' =>  $detaillistparkir
        ]);
    }

    public function pembayaran(Request $request, $id_bayar)
    {
        $update['kode'] = $request->kode;
        $update['nomorkendaraan'] = $request->nomorkendaraan;
        $update['total_jam'] = $request->total_jam;
        $update['bayar'] = $request->bayar;
        $update['status'] = 'keluar';
        $update['updated_at'] = date('Y-m-d H:i:s');

        Masuk::find($id_bayar)->update($update);

        return  redirect('/kendaraankeluar')->with('success', ' Berhasil dibayar.');
    }

    public function laporan()
    {

        $a = Masuk::latest()->paginate(10);
        // $a = Masuk::where('status', 'masuk')->paginate(10);

        if (request('start_date') && request('end_date')) {
            $a = Masuk::where('created_at', 'like', '%' . request('start_date') . '%')
                ->orWhere('created_at', 'like', '%' . request('end_date') . '%')
                ->paginate(10);
        } elseif (request('start_date')) {
            $a = Masuk::where('created_at', 'like', '%' . request('start_date') . '%')
                ->paginate(10);
        } elseif (request('end_date')) {
            $a = Masuk::where('created_at', 'like', '%' . request('end_date') . '%')
                ->paginate(10);
        }

        return view('laporan', [
            'title' => 'Laporan Pakrkir',
            'list' => $a,
        ])->with('i', (request('page', 1) - 1) * 10);
    }

    public function laporanExport()
    {
        return Excel::download(new LaporanExport, 'Laporan_' . date('Y_m_d') . '.xlsx');
    }
}
