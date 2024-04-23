<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mesin_absen_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('mesin_absen')
            ->select('*')
            ->orderBy('mesin_absen.id_mesin_absen','DESC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_mesin_absen)
    {
        $query = DB::table('mesin_absen')
            ->select('*')
            ->where('mesin_absen.id_mesin_absen',$id_mesin_absen)
            ->orderBy('mesin_absen.id_mesin_absen','DESC')
            ->first();
        return $query;
    }

     // pegawai
    public function pegawai($nip)
    {
        $query = DB::table('mesin_absen')
            ->select('*')
            ->where('mesin_absen.nip',$nip)
            ->orderBy('mesin_absen.id_mesin_absen','DESC')
            ->first();
        return $query;
    }
}
