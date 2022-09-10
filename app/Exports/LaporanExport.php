<?php

namespace App\Exports;

use App\Models\Masuk;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Masuk::all();
    }
}
