<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gaji_pegawai_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('gaji_pegawai')
            ->join('pegawai', 'pegawai.nip', '=', 'gaji_pegawai.nip','LEFT')
            ->select('gaji_pegawai.*', 'pegawai.nip', 'pegawai.nama_lengkap', 'pegawai.npwp', 'pegawai.rekening')
            ->orderBy('gaji_pegawai.id_gaji_pegawai','DESC')
            ->get();
        return $query;
    }

    // listing thbl
    public function thbl($thbl)
    {
        $query = DB::table('gaji_pegawai')
            ->join('pegawai', 'pegawai.nip', '=', 'gaji_pegawai.nip','LEFT')
            ->select('gaji_pegawai.*', 'pegawai.nip', 'pegawai.nama_lengkap', 'pegawai.npwp', 'pegawai.rekening')
            ->where('gaji_pegawai.thbl',$thbl)
            ->orderBy('gaji_pegawai.id_gaji_pegawai','DESC')
            ->get();
        return $query;
    }

     // listing thbl_pegawai
    public function thbl_pegawai($thbl,$nip)
    {
        $query = DB::table('gaji_pegawai')
            ->join('pegawai', 'pegawai.nip', '=', 'gaji_pegawai.nip','LEFT')
            ->select('gaji_pegawai.*', 'pegawai.nip', 'pegawai.nama_lengkap', 'pegawai.npwp', 'pegawai.rekening')
            ->where('gaji_pegawai.thbl',$thbl)
            ->where('gaji_pegawai.nip',$nip)
            ->orderBy('gaji_pegawai.id_gaji_pegawai','DESC')
            ->first();
        return $query;
    }

    // detail
    public function detail($id_gaji_pegawai)
    {
        $query = DB::table('gaji_pegawai')
            ->join('pegawai', 'pegawai.nip', '=', 'gaji_pegawai.nip','LEFT')
            ->select('gaji_pegawai.*', 'pegawai.nip', 'pegawai.nama_lengkap', 'pegawai.npwp', 'pegawai.rekening')
            ->where('gaji_pegawai.id_gaji_pegawai',$id_gaji_pegawai)
            ->orderBy('gaji_pegawai.id_gaji_pegawai','DESC')
            ->first();
        return $query;
    }

     // pegawai
    public function pegawai($nip)
    {
        $query = DB::table('gaji_pegawai')
            ->join('pegawai', 'pegawai.nip', '=', 'gaji_pegawai.nip','LEFT')
            ->select('gaji_pegawai.*', 'pegawai.nip', 'pegawai.nama_lengkap', 'pegawai.npwp', 'pegawai.rekening')
            ->where('gaji_pegawai.nip',$nip)
            ->orderBy('gaji_pegawai.id_gaji_pegawai','DESC')
            ->first();
        return $query;
    }
}
