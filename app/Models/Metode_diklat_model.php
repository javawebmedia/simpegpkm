<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Metode_diklat_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('metode_diklat')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'metode_diklat.id_pegawai','LEFT')
            ->select('metode_diklat.*', 'pegawai.id_pegawai', 'pegawai.nama_lengkap')
            ->orderBy('metode_diklat.urutan','ASC')
            ->get();
        return $query;
    }

    // listing tanggal_metode_diklat
    public function jenis_metode()
    {
        $query = DB::table('metode_diklat')
            ->select('jenis_metode')
            ->groupBy('jenis_metode')
            ->orderBy('metode_diklat.jenis_metode','ASC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_metode_diklat)
    {
        $query = DB::table('metode_diklat')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'metode_diklat.id_pegawai','LEFT')
            ->select('metode_diklat.*', 'pegawai.id_pegawai', 'pegawai.nama_lengkap')
            ->where('metode_diklat.id_metode_diklat',$id_metode_diklat)
            ->orderBy('metode_diklat.urutan','ASC')
            ->first();
        return $query;
    }

    // pegawai
    public function pegawai($id_pegawai)
    {
        $query = DB::table('metode_diklat')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'metode_diklat.id_pegawai','LEFT')
            ->select('metode_diklat.*', 'pegawai.id_pegawai', 'pegawai.nama_lengkap')
            ->where('metode_diklat.id_pegawai',$id_pegawai)
            ->orderBy('metode_diklat.urutan','ASC')
            ->first();
        return $query;
    }
}
