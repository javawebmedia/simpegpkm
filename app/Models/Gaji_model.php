<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gaji_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('gaji')
            ->join('pegawai', 'pegawai.nip', '=', 'gaji.nip','LEFT')
            ->select('gaji.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->orderBy('gaji.id_gaji','DESC')
            ->get();
        return $query;
    }

    // listing thbl
    public function thbl($thbl)
    {
        $query = DB::table('gaji')
            ->join('pegawai', 'pegawai.nip', '=', 'gaji.nip','LEFT')
            ->select('gaji.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('gaji.thbl',$thbl)
            ->orderBy('gaji.id_gaji','DESC')
            ->get();
        return $query;
    }

     // listing thbl_pegawai
    public function thbl_pegawai($thbl,$nip)
    {
        $query = DB::table('gaji')
            ->join('pegawai', 'pegawai.nip', '=', 'gaji.nip','LEFT')
            ->select('gaji.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('gaji.thbl',$thbl)
            ->where('gaji.nip',$nip)
            ->orderBy('gaji.id_gaji','DESC')
            ->first();
        return $query;
    }

    // detail
    public function detail($id_gaji)
    {
        $query = DB::table('gaji')
            ->join('pegawai', 'pegawai.nip', '=', 'gaji.nip','LEFT')
            ->select('gaji.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('gaji.id_gaji',$id_gaji)
            ->orderBy('gaji.id_gaji','DESC')
            ->first();
        return $query;
    }

     // pegawai
    public function pegawai($nip)
    {
        $query = DB::table('gaji')
            ->join('pegawai', 'pegawai.nip', '=', 'gaji.nip','LEFT')
            ->select('gaji.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('gaji.nip',$nip)
            ->orderBy('gaji.id_gaji','DESC')
            ->first();
        return $query;
    }
}
