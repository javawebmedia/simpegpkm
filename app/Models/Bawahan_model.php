<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bawahan_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('bawahan')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'bawahan.id_pegawai','LEFT')
            ->select('bawahan.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->orderBy('bawahan.id_bawahan','DESC')
            ->get();
        return $query;
    }

    // listing semua
    public function atasan($id_atasan)
    {
        $query = DB::table('bawahan')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'bawahan.id_pegawai','LEFT')
            ->select('bawahan.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('bawahan.id_atasan',$id_atasan)
            ->orderBy('bawahan.id_bawahan','DESC')
            ->get();
        return $query;
    }

    // listing semua
    public function pegawai($id_pegawai)
    {
        $query = DB::table('bawahan')
            ->where('bawahan.id_pegawai',$id_pegawai)
            ->first();
        return $query;
    }

    // detail
    public function detail($id_bawahan)
    {
        $query = DB::table('bawahan')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'bawahan.id_pegawai','LEFT')
            ->select('bawahan.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('bawahan.id_bawahan',$id_bawahan)
            ->orderBy('bawahan.id_bawahan','DESC')
            ->first();
        return $query;
    }
}
