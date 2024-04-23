<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pin_pegawai_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('pin_pegawai')
            ->join('pegawai', 'pegawai.nip', '=', 'pin_pegawai.nip','LEFT')
            ->select('pin_pegawai.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->orderBy('pin_pegawai.id_pin_pegawai','DESC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_pin_pegawai)
    {
        $query = DB::table('pin_pegawai')
            ->join('pegawai', 'pegawai.nip', '=', 'pin_pegawai.nip','LEFT')
            ->select('pin_pegawai.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('pin_pegawai.id_pin_pegawai',$id_pin_pegawai)
            ->orderBy('pin_pegawai.id_pin_pegawai','DESC')
            ->first();
        return $query;
    }

    // pegawai
    public function pegawai($nip)
    {
        $query = DB::table('pin_pegawai')
            ->join('pegawai', 'pegawai.nip', '=', 'pin_pegawai.nip','LEFT')
            ->select('pin_pegawai.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('pin_pegawai.nip',$nip)
            ->orderBy('pin_pegawai.id_pin_pegawai','DESC')
            ->first();
        return $query;
    }

    // check_pegawai_mesin
    public function check_pegawai_mesin($nip,$id_mesin_absen)
    {
        $query = DB::table('pin_pegawai')
            ->join('pegawai', 'pegawai.nip', '=', 'pin_pegawai.nip','LEFT')
            ->select('pin_pegawai.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('pin_pegawai.nip',$nip)
            ->where('pin_pegawai.id_mesin_absen',$id_mesin_absen)
            ->orderBy('pin_pegawai.id_pin_pegawai','DESC')
            ->first();
        return $query;
    }
}
