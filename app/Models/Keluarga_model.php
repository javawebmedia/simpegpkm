<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Keluarga_model extends Model
{
    // use HasFactory;

    // listing semua
    public function listing()
    {
        $query = DB::table('keluarga')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'keluarga.id_pegawai','LEFT')
            ->join('hubungan_keluarga', 'hubungan_keluarga.id_hubungan_keluarga', '=', 'keluarga.id_hubungan_keluarga','LEFT')
            ->join('jenjang_pendidikan', 'jenjang_pendidikan.id_jenjang_pendidikan', '=', 'keluarga.id_jenjang_pendidikan','LEFT')
            ->join('agama', 'agama.id_agama', '=', 'keluarga.id_agama','LEFT')
            ->join('pekerjaan', 'pekerjaan.id_pekerjaan', '=', 'keluarga.id_pekerjaan','LEFT')
            ->select('keluarga.*', 
                    'hubungan_keluarga.nama_hubungan_keluarga',
                    'jenjang_pendidikan.nama_jenjang_pendidikan',
                    'agama.nama_agama',
                    'pekerjaan.nama_pekerjaan'
                    )
            ->orderBy('keluarga.tanggal_lahir','ASC')
            ->get();
        return $query;
    }

    // listing pegawai
    public function pegawai($id_pegawai)
    {
        $query = DB::table('keluarga')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'keluarga.id_pegawai','LEFT')
            ->join('hubungan_keluarga', 'hubungan_keluarga.id_hubungan_keluarga', '=', 'keluarga.id_hubungan_keluarga','LEFT')
            ->join('jenjang_pendidikan', 'jenjang_pendidikan.id_jenjang_pendidikan', '=', 'keluarga.id_jenjang_pendidikan','LEFT')
            ->join('agama', 'agama.id_agama', '=', 'keluarga.id_agama','LEFT')
            ->join('pekerjaan', 'pekerjaan.id_pekerjaan', '=', 'keluarga.id_pekerjaan','LEFT')
            ->select('keluarga.*', 
                    'hubungan_keluarga.nama_hubungan_keluarga',
                    'jenjang_pendidikan.nama_jenjang_pendidikan',
                    'agama.nama_agama',
                    'pekerjaan.nama_pekerjaan'
                    )
            ->where('keluarga.id_pegawai',$id_pegawai)
             ->orderBy('keluarga.tanggal_lahir','ASC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_keluarga)
    {
        $query = DB::table('keluarga')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'keluarga.id_pegawai','LEFT')
            ->join('hubungan_keluarga', 'hubungan_keluarga.id_hubungan_keluarga', '=', 'keluarga.id_hubungan_keluarga','LEFT')
            ->join('jenjang_pendidikan', 'jenjang_pendidikan.id_jenjang_pendidikan', '=', 'keluarga.id_jenjang_pendidikan','LEFT')
            ->join('agama', 'agama.id_agama', '=', 'keluarga.id_agama','LEFT')
            ->join('pekerjaan', 'pekerjaan.id_pekerjaan', '=', 'keluarga.id_pekerjaan','LEFT')
            ->select('keluarga.*', 
                    'hubungan_keluarga.nama_hubungan_keluarga',
                    'jenjang_pendidikan.nama_jenjang_pendidikan',
                    'agama.nama_agama',
                    'pekerjaan.nama_pekerjaan'
                    )
            ->where('keluarga.id_keluarga',$id_keluarga)
             ->orderBy('keluarga.tanggal_lahir','ASC')
            ->first();
        return $query;
    }
}
