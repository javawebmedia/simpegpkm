<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Str_sip_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('str_sip')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'str_sip.id_pegawai','LEFT')
            ->select('str_sip.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->orderBy('str_sip.id_str_sip','DESC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_str_sip)
    {
        $query = DB::table('str_sip')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'str_sip.id_pegawai','LEFT')
            ->select('str_sip.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('str_sip.id_str_sip',$id_str_sip)
            ->orderBy('str_sip.id_str_sip','DESC')
            ->first();
        return $query;
    }

     // pegawai
    public function pegawai($id_pegawai)
    {
        $query = DB::table('str_sip')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'str_sip.id_pegawai','LEFT')
            ->select('str_sip.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('str_sip.id_pegawai',$id_pegawai)
            ->orderBy('str_sip.id_str_sip','DESC')
            ->get();
        return $query;
    }
}
