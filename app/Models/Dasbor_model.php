<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dasbor_model extends Model
{
    // pegawai
    public function pegawai()
    {
    	 $query = DB::table('pegawai')
            ->select('*')
            ->orderBy('id_pegawai','DESC')
            ->count();
        return $query;
    }

    // total_jenis_pegawai
    public function total_jenis_pegawai($jenis_pegawai)
    {
         $query = DB::table('pegawai')
            ->select('*')
            ->where('jenis_pegawai',$jenis_pegawai)
            ->orderBy('id_pegawai','DESC')
            ->count();
        return $query;
    }

    // kinerja
    public function kinerja()
    {
         $query = DB::table('kinerja')
            ->select('*')
            ->orderBy('id_kinerja','DESC')
            ->count();
        return $query;
    }

    // jenis_pegawai
    public function jenis_pegawai()
    {
         $query = DB::table('pegawai')
            ->select(DB::raw('COUNT(*) AS total'),'jenis_pegawai')
            ->groupBy('jenis_pegawai')
            ->orderBy('jenis_pegawai','ASC')
            ->get();
        return $query;
    }
}
