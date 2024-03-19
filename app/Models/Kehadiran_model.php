<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kehadiran_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('kehadiran')
            ->join('pegawai', 'pegawai.nip', '=', 'kehadiran.nip','LEFT')
            ->select('kehadiran.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->orderBy('kehadiran.id_kehadiran','DESC')
            ->get();
        return $query;
    }

    // listing tanggal
    public function tanggal($tanggal)
    {
        $query = DB::table('kehadiran')
            ->join('pegawai', 'pegawai.nip', '=', 'kehadiran.nip','LEFT')
            ->select('kehadiran.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('kehadiran.tanggal',$tanggal)
            ->orderBy('kehadiran.id_kehadiran','DESC')
            ->get();
        return $query;
    }

     // listing tanggal pegawai
    public function tanggal_pegawai($tanggal,$nip)
    {
        $query = DB::table('kehadiran')
            ->join('pegawai', 'pegawai.nip', '=', 'kehadiran.nip','LEFT')
            ->select('kehadiran.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('kehadiran.tanggal',$tanggal)
            ->where('kehadiran.nip',$nip)
            ->orderBy('kehadiran.id_kehadiran','DESC')
            ->first();
        return $query;
    }

    // detail
    public function detail($id_kehadiran)
    {
        $query = DB::table('kehadiran')
            ->join('pegawai', 'pegawai.nip', '=', 'kehadiran.nip','LEFT')
            ->select('kehadiran.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('kehadiran.id_kehadiran',$id_kehadiran)
            ->orderBy('kehadiran.id_kehadiran','DESC')
            ->first();
        return $query;
    }

     // pegawai
    public function pegawai($nip)
    {
        $query = DB::table('kehadiran')
            ->join('pegawai', 'pegawai.nip', '=', 'kehadiran.nip','LEFT')
            ->select('kehadiran.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('kehadiran.nip',$nip)
            ->orderBy('kehadiran.id_kehadiran','DESC')
            ->first();
        return $query;
    }
}
