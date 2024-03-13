<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Absensi_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('absensi')
            ->join('pegawai', 'pegawai.nip', '=', 'absensi.nip','LEFT')
            ->select('absensi.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->orderBy('absensi.id_absensi','DESC')
            ->get();
        return $query;
    }

    // listing thbl
    public function thbl($thbl)
    {
        $query = DB::table('absensi')
            ->join('pegawai', 'pegawai.nip', '=', 'absensi.nip','LEFT')
            ->select('absensi.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('absensi.thbl',$thbl)
            ->orderBy('absensi.id_absensi','DESC')
            ->get();
        return $query;
    }

     // listing thbl pegawai
    public function thbl_pegawai($thbl,$nip)
    {
        $query = DB::table('absensi')
            ->join('pegawai', 'pegawai.nip', '=', 'absensi.nip','LEFT')
            ->select('absensi.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('absensi.thbl',$thbl)
            ->where('absensi.nip',$nip)
            ->orderBy('absensi.id_absensi','DESC')
            ->first();
        return $query;
    }

    // detail
    public function detail($id_absensi)
    {
        $query = DB::table('absensi')
            ->join('pegawai', 'pegawai.nip', '=', 'absensi.nip','LEFT')
            ->select('absensi.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('absensi.id_absensi',$id_absensi)
            ->orderBy('absensi.id_absensi','DESC')
            ->first();
        return $query;
    }

     // pegawai
    public function pegawai($nip)
    {
        $query = DB::table('absensi')
            ->join('pegawai', 'pegawai.nip', '=', 'absensi.nip','LEFT')
            ->select('absensi.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('absensi.nip',$nip)
            ->orderBy('absensi.id_absensi','DESC')
            ->first();
        return $query;
    }
}
