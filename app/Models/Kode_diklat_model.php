<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kode_diklat_model extends Model
{
    // use HasFactory;

    // listing semua
    public function listing()
    {
        $query = DB::table('kode_diklat')
            ->join('rumpun', 'rumpun.id_rumpun', '=', 'kode_diklat.id_rumpun','LEFT')
            ->join('jenis_pelatihan', 'jenis_pelatihan.id_jenis_pelatihan', '=', 'kode_diklat.id_jenis_pelatihan','LEFT')
            ->select('kode_diklat.*', 
                    'rumpun.nama_rumpun',
                    'jenis_pelatihan.nama_jenis_pelatihan'
                    )
            ->orderBy('jenis_pelatihan.urutan','DESC')
            ->get();
        return $query;
    }

    // listing rumpun
    public function rumpun($id_rumpun)
    {
        $query = DB::table('kode_diklat')
            ->join('rumpun', 'rumpun.id_rumpun', '=', 'kode_diklat.id_rumpun','LEFT')
            ->join('jenis_pelatihan', 'jenis_pelatihan.id_jenis_pelatihan', '=', 'kode_diklat.id_jenis_pelatihan','LEFT')
            ->select('kode_diklat.*', 
                    'rumpun.nama_rumpun',
                    'jenis_pelatihan.nama_jenis_pelatihan'
                    )
            ->where('kode_diklat.id_rumpun',$id_rumpun)
             ->orderBy('jenis_pelatihan.urutan','DESC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_kode_diklat)
    {
        $query = DB::table('kode_diklat')
            ->join('rumpun', 'rumpun.id_rumpun', '=', 'kode_diklat.id_rumpun','LEFT')
            ->join('jenis_pelatihan', 'jenis_pelatihan.id_jenis_pelatihan', '=', 'kode_diklat.id_jenis_pelatihan','LEFT')
            ->select('kode_diklat.*', 
                    'rumpun.nama_rumpun',
                    'jenis_pelatihan.nama_jenis_pelatihan'
                    )
            ->where('kode_diklat.id_kode_diklat',$id_kode_diklat)
             ->orderBy('jenis_pelatihan.urutan','DESC')
            ->first();
        return $query;
    }
}
