<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Hubungan_keluarga_model extends Model
{
    // use HasFactory;

    // listing semua
    public function listing()
    {
        $query = DB::table('hubungan_keluarga')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'hubungan_keluarga.id_pegawai','LEFT')
            ->select('hubungan_keluarga.*', 'pegawai.nama_lengkap')
            ->orderBy('hubungan_keluarga.id_hubungan_keluarga','DESC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_hubungan_keluarga)
    {
        $query = DB::table('hubungan_keluarga')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'hubungan_keluarga.id_pegawai','LEFT')
            ->select('hubungan_keluarga.*', 'pegawai.nama_lengkap')
            ->where('hubungan_keluarga.id_hubungan_keluarga',$id_hubungan_keluarga)
            ->orderBy('hubungan_keluarga.id_hubungan_keluarga','DESC')
            ->first();
        return $query;
    }
}
