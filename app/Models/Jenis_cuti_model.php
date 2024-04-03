<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Jenis_cuti_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('jenis_cuti')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'jenis_cuti.id_pegawai','LEFT')
            ->select('jenis_cuti.*', 'pegawai.id_pegawai', 'pegawai.nama_lengkap')
            ->orderBy('jenis_cuti.urutan','ASC')
            ->get();
        return $query;
    }
    
    // detail
    public function detail($id_jenis_cuti)
    {
        $query = DB::table('jenis_cuti')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'jenis_cuti.id_pegawai','LEFT')
            ->select('jenis_cuti.*', 'pegawai.id_pegawai', 'pegawai.nama_lengkap')
            ->where('jenis_cuti.id_jenis_cuti',$id_jenis_cuti)
            ->orderBy('jenis_cuti.urutan','ASC')
            ->first();
        return $query;
    }

     // pegawai
    public function pegawai($id_pegawai)
    {
        $query = DB::table('jenis_cuti')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'jenis_cuti.id_pegawai','LEFT')
            ->select('jenis_cuti.*', 'pegawai.id_pegawai', 'pegawai.nama_lengkap')
            ->where('jenis_cuti.id_pegawai',$id_pegawai)
            ->orderBy('jenis_cuti.urutan','ASC')
            ->first();
        return $query;
    }
}
