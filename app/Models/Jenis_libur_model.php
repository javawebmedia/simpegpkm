<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Jenis_libur_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('jenis_libur')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'jenis_libur.id_pegawai','LEFT')
            ->select('jenis_libur.*', 'pegawai.id_pegawai', 'pegawai.nama_lengkap')
            ->orderBy('jenis_libur.urutan','ASC')
            ->get();
        return $query;
    }

    // listing thbl
    public function thbl($thbl)
    {
        $query = DB::table('jenis_libur')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'jenis_libur.id_pegawai','LEFT')
            ->select('jenis_libur.*', 'pegawai.id_pegawai', 'pegawai.nama_lengkap')
            ->where('jenis_libur.thbl',$thbl)
            ->orderBy('jenis_libur.urutan','ASC')
            ->get();
        return $query;
    }

     // listing thbl pegawai
    public function thbl_pegawai($thbl,$id_pegawai)
    {
        $query = DB::table('jenis_libur')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'jenis_libur.id_pegawai','LEFT')
            ->select('jenis_libur.*', 'pegawai.id_pegawai', 'pegawai.nama_lengkap')
            ->where('jenis_libur.thbl',$thbl)
            ->where('jenis_libur.id_pegawai',$id_pegawai)
            ->orderBy('jenis_libur.urutan','ASC')
            ->first();
        return $query;
    }

    // detail
    public function detail($id_jenis_libur)
    {
        $query = DB::table('jenis_libur')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'jenis_libur.id_pegawai','LEFT')
            ->select('jenis_libur.*', 'pegawai.id_pegawai', 'pegawai.nama_lengkap')
            ->where('jenis_libur.id_jenis_libur',$id_jenis_libur)
            ->orderBy('jenis_libur.urutan','ASC')
            ->first();
        return $query;
    }

     // pegawai
    public function pegawai($id_pegawai)
    {
        $query = DB::table('jenis_libur')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'jenis_libur.id_pegawai','LEFT')
            ->select('jenis_libur.*', 'pegawai.id_pegawai', 'pegawai.nama_lengkap')
            ->where('jenis_libur.id_pegawai',$id_pegawai)
            ->orderBy('jenis_libur.urutan','ASC')
            ->first();
        return $query;
    }
}
