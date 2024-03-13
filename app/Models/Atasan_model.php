<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Atasan_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('atasan')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'atasan.id_pegawai','LEFT')
            ->select('atasan.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->orderBy('atasan.id_atasan','DESC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_atasan)
    {
        $query = DB::table('atasan')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'atasan.id_pegawai','LEFT')
            ->select('atasan.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('atasan.id_atasan',$id_atasan)
            ->orderBy('atasan.id_atasan','DESC')
            ->first();
        return $query;
    }

     // pegawai
    public function pegawai($id_pegawai)
    {
        $query = DB::table('atasan')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'atasan.id_pegawai','LEFT')
            ->select('atasan.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('atasan.id_pegawai',$id_pegawai)
            ->orderBy('atasan.id_atasan','DESC')
            ->first();
        return $query;
    }
}
