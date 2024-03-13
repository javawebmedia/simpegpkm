<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pendidikan_model extends Model
{
    // use HasFactory;

    // listing semua
    public function listing()
    {
        $query = DB::table('pendidikan')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'pendidikan.id_pegawai','LEFT')
            ->join('jenjang_pendidikan', 'jenjang_pendidikan.id_jenjang_pendidikan', '=', 'pendidikan.id_jenjang_pendidikan','LEFT')
            ->select('pendidikan.*', 
                    'pegawai.nama_lengkap',
                    'pegawai.nip',
                    'pegawai.nrk',
                    'jenjang_pendidikan.nama_jenjang_pendidikan'
                    )
            ->orderBy('jenjang_pendidikan.urutan','DESC')
            ->get();
        return $query;
    }

    // listing pegawai
    public function pegawai($id_pegawai)
    {
        $query = DB::table('pendidikan')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'pendidikan.id_pegawai','LEFT')
            ->join('jenjang_pendidikan', 'jenjang_pendidikan.id_jenjang_pendidikan', '=', 'pendidikan.id_jenjang_pendidikan','LEFT')
            ->select('pendidikan.*', 
                    'pegawai.nama_lengkap',
                    'pegawai.nip',
                    'pegawai.nrk',
                    'jenjang_pendidikan.nama_jenjang_pendidikan'
                    )
            ->where('pendidikan.id_pegawai',$id_pegawai)
             ->orderBy('jenjang_pendidikan.urutan','DESC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_pendidikan)
    {
        $query = DB::table('pendidikan')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'pendidikan.id_pegawai','LEFT')
            ->join('jenjang_pendidikan', 'jenjang_pendidikan.id_jenjang_pendidikan', '=', 'pendidikan.id_jenjang_pendidikan','LEFT')
            ->select('pendidikan.*', 
                    'pegawai.nama_lengkap',
                    'pegawai.nip',
                    'pegawai.nrk',
                    'jenjang_pendidikan.nama_jenjang_pendidikan'
                    )
            ->where('pendidikan.id_pendidikan',$id_pendidikan)
             ->orderBy('jenjang_pendidikan.urutan','DESC')
            ->first();
        return $query;
    }
}
