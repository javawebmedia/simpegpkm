<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kuota_cuti_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('kuota_cuti')
            ->join('pegawai', 'pegawai.nip', '=', 'kuota_cuti.nip','LEFT')
            ->select('kuota_cuti.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->orderBy('kuota_cuti.tahun','DESC')
            ->get();
        return $query;
    }

    // tahun
    public function tahun($tahun)
    {
        $query = DB::table('kuota_cuti')
            ->join('pegawai', 'pegawai.nip', '=', 'kuota_cuti.nip','LEFT')
            ->select('kuota_cuti.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('kuota_cuti.tahun',$tahun)
            ->orderBy('kuota_cuti.tahun','DESC')
            ->get();
        return $query;
    }

    // tahun_nip
    public function tahun_nip($tahun,$nip)
    {
        $query = DB::table('kuota_cuti')
            ->join('pegawai', 'pegawai.nip', '=', 'kuota_cuti.nip','LEFT')
            ->select('kuota_cuti.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('kuota_cuti.tahun',$tahun)
            ->where('kuota_cuti.nip',$nip)
            ->orderBy('kuota_cuti.tahun','DESC')
            ->count();
        return $query;
    }

    // list_tahun
    public function list_tahun()
    {
        $query = DB::table('kuota_cuti')
            ->select('tahun')
            ->groupBy('tahun')
            ->orderBy('tahun','DESC')
            ->get();
        return $query;
    }

    // listing thbl
    public function thbl($thbl)
    {
        $query = DB::table('kuota_cuti')
            ->join('pegawai', 'pegawai.nip', '=', 'kuota_cuti.nip','LEFT')
            ->select('kuota_cuti.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('kuota_cuti.thbl',$thbl)
            ->orderBy('kuota_cuti.tahun','DESC')
            ->get();
        return $query;
    }

     // listing thbl pegawai
    public function thbl_pegawai($thbl,$nip)
    {
        $query = DB::table('kuota_cuti')
            ->join('pegawai', 'pegawai.nip', '=', 'kuota_cuti.nip','LEFT')
            ->select('kuota_cuti.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('kuota_cuti.thbl',$thbl)
            ->where('kuota_cuti.nip',$nip)
            ->orderBy('kuota_cuti.tahun','DESC')
            ->first();
        return $query;
    }

    // detail
    public function detail($id_kuota_cuti)
    {
        $query = DB::table('kuota_cuti')
            ->join('pegawai', 'pegawai.nip', '=', 'kuota_cuti.nip','LEFT')
            ->select('kuota_cuti.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('kuota_cuti.id_kuota_cuti',$id_kuota_cuti)
            ->orderBy('kuota_cuti.tahun','DESC')
            ->first();
        return $query;
    }

    // detail
    public function total()
    {
        $query = DB::table('kuota_cuti')
            ->join('pegawai', 'pegawai.nip', '=', 'kuota_cuti.nip','LEFT')
            ->select('kuota_cuti.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->orderBy('kuota_cuti.tahun','DESC')
            ->count();
        return $query;
    }

     // pegawai
    public function pegawai($nip)
    {
        $query = DB::table('kuota_cuti')
            ->join('pegawai', 'pegawai.nip', '=', 'kuota_cuti.nip','LEFT')
            ->select('kuota_cuti.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('kuota_cuti.nip',$nip)
            ->orderBy('kuota_cuti.tahun','DESC')
            ->first();
        return $query;
    }
}
