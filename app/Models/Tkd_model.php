<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tkd_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('tkd')
            ->join('pegawai', 'pegawai.nip', '=', 'tkd.nip','LEFT')
            ->select('tkd.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->orderBy('tkd.id_tkd','DESC')
            ->get();
        return $query;
    }

    // listing thbl
    public function thbl($thbl)
    {
        $query = DB::table('tkd')
            ->join('pegawai', 'pegawai.nip', '=', 'tkd.nip','LEFT')
            ->select('tkd.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('tkd.thbl',$thbl)
            ->orderBy('tkd.id_tkd','DESC')
            ->get();
        return $query;
    }

     // listing thbl_pegawai
    public function thbl_pegawai($thbl,$nip)
    {
        $query = DB::table('tkd')
            ->join('pegawai', 'pegawai.nip', '=', 'tkd.nip','LEFT')
            ->select('tkd.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('tkd.thbl',$thbl)
            ->where('tkd.nip',$nip)
            ->orderBy('tkd.id_tkd','DESC')
            ->first();
        return $query;
    }

    // detail
    public function detail($id_tkd)
    {
        $query = DB::table('tkd')
            ->join('pegawai', 'pegawai.nip', '=', 'tkd.nip','LEFT')
            ->select('tkd.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('tkd.id_tkd',$id_tkd)
            ->orderBy('tkd.id_tkd','DESC')
            ->first();
        return $query;
    }

     // pegawai
    public function pegawai($nip)
    {
        $query = DB::table('tkd')
            ->join('pegawai', 'pegawai.nip', '=', 'tkd.nip','LEFT')
            ->select('tkd.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('tkd.nip',$nip)
            ->orderBy('tkd.id_tkd','DESC')
            ->first();
        return $query;
    }
}
