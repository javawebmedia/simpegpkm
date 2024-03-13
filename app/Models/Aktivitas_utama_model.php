<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Aktivitas_utama_model extends Model
{
    // use HasFactory;

    // listing semua
    public function listing()
    {
        $query = DB::table('aktivitas_utama')
            ->join('aktivitas', 'aktivitas.id_aktivitas', '=', 'aktivitas_utama.id_aktivitas','LEFT')
            ->join('satuan', 'satuan.id_satuan', '=', 'aktivitas.id_satuan','LEFT')
            ->join('pegawai', 'pegawai.nip', '=', 'aktivitas_utama.nip','LEFT')
            ->select('aktivitas_utama.*', 
                    'aktivitas.nama_aktivitas',
                    'aktivitas.kode_aktivitas',
                    'aktivitas.waktu',
                    'aktivitas.tingkat_kesulitan',
                    'aktivitas.kategori',
                    'aktivitas.bobot',
                    'aktivitas.status_aktivitas',
                    'satuan.nama_satuan',
                    'pegawai.nama_lengkap'
                )
            ->orderBy('aktivitas_utama.id_aktivitas_utama','DESC')
            ->get();
        return $query;
    }

    // jabatan
    public function jabatan($id_jabatan)
    {
        $query = DB::table('aktivitas_utama')
            ->join('aktivitas', 'aktivitas.id_aktivitas', '=', 'aktivitas_utama.id_aktivitas','LEFT')
            ->join('satuan', 'satuan.id_satuan', '=', 'aktivitas.id_satuan','LEFT')
            ->join('pegawai', 'pegawai.nip', '=', 'aktivitas_utama.nip','LEFT')
            ->select('aktivitas_utama.*', 
                    'aktivitas.nama_aktivitas',
                    'aktivitas.kode_aktivitas',
                    'aktivitas.waktu',
                    'aktivitas.tingkat_kesulitan',
                    'aktivitas.kategori',
                    'aktivitas.bobot',
                    'aktivitas.status_aktivitas',
                    'satuan.nama_satuan',
                    'pegawai.nama_lengkap'
                )
            ->where('aktivitas_utama.id_jabatan',$id_jabatan)
            ->orderBy('aktivitas_utama.id_aktivitas_utama','DESC')
            ->get();
        return $query;
    }

    // pegawai
    public function pegawai($nip)
    {
        $query = DB::table('aktivitas_utama')
            ->join('aktivitas', 'aktivitas.id_aktivitas', '=', 'aktivitas_utama.id_aktivitas','LEFT')
            ->join('satuan', 'satuan.id_satuan', '=', 'aktivitas.id_satuan','LEFT')
            ->join('pegawai', 'pegawai.nip', '=', 'aktivitas_utama.nip','LEFT')
            ->select('aktivitas_utama.*', 
                    'aktivitas.nama_aktivitas',
                    'aktivitas.kode_aktivitas',
                    'aktivitas.waktu',
                    'aktivitas.tingkat_kesulitan',
                    'aktivitas.kategori',
                    'aktivitas.bobot',
                    'aktivitas.status_aktivitas',
                    'satuan.nama_satuan',
                    'pegawai.nama_lengkap'
                )
            ->where('aktivitas_utama.nip',$nip)
            ->orderBy('aktivitas_utama.id_aktivitas_utama','DESC')
            ->get();
        return $query;
    }

    // check pegawai
    public function check_pegawai($nip,$id_aktivitas)
    {
        $query = DB::table('aktivitas_utama')
            ->join('aktivitas', 'aktivitas.id_aktivitas', '=', 'aktivitas_utama.id_aktivitas','LEFT')
            ->join('satuan', 'satuan.id_satuan', '=', 'aktivitas.id_satuan','LEFT')
            ->join('pegawai', 'pegawai.nip', '=', 'aktivitas_utama.nip','LEFT')
            ->select('aktivitas_utama.*', 
                    'aktivitas.nama_aktivitas',
                    'aktivitas.kode_aktivitas',
                    'aktivitas.waktu',
                    'aktivitas.tingkat_kesulitan',
                    'aktivitas.kategori',
                    'aktivitas.bobot',
                    'aktivitas.status_aktivitas',
                    'satuan.nama_satuan',
                    'pegawai.nama_lengkap'
                )
            ->where([   'aktivitas_utama.nip'           => $nip,
                        'aktivitas_utama.id_aktivitas'  => $id_aktivitas
                    ])
            ->orderBy('aktivitas_utama.id_aktivitas_utama','DESC')
            ->first();
        return $query;
    }

    // detail
    public function detail($id_aktivitas_utama)
    {
        $query = DB::table('aktivitas_utama')
            ->join('aktivitas', 'aktivitas.id_aktivitas', '=', 'aktivitas_utama.id_aktivitas','LEFT')
            ->join('satuan', 'satuan.id_satuan', '=', 'aktivitas.id_satuan','LEFT')
            ->join('pegawai', 'pegawai.nip', '=', 'aktivitas_utama.nip','LEFT')
            ->select('aktivitas_utama.*', 
                    'aktivitas.nama_aktivitas',
                    'aktivitas.kode_aktivitas',
                    'aktivitas.waktu',
                    'aktivitas.tingkat_kesulitan',
                    'aktivitas.kategori',
                    'aktivitas.bobot',
                    'aktivitas.status_aktivitas',
                    'satuan.nama_satuan',
                    'pegawai.nama_lengkap'
                )
            ->where('aktivitas_utama.id_aktivitas_utama',$id_aktivitas_utama)
            ->orderBy('aktivitas_utama.id_aktivitas_utama','DESC')
            ->first();
        return $query;
    }
}
