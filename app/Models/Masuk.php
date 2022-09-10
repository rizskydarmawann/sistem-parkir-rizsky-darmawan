<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Masuk extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    protected $hidden = [

    ];

    public function getmasuk(){

        return  DB::table('masuks')->get();
    }
}
