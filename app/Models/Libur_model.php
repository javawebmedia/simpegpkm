<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Libur_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('libur')
            ->join('jenis_libur', 'jenis_libur.id_jenis_libur', '=', 'libur.id_jenis_libur','LEFT')
            ->select('libur.*', 'jenis_libur.id_jenis_libur', 'jenis_libur.nama_jenis_libur')
            ->orderBy('libur.tanggal_libur','ASC')
            ->get();
        return $query;
    }

    // tahun
    public function tahun($tahun)
    {
        $query = DB::table('libur')
            ->join('jenis_libur', 'jenis_libur.id_jenis_libur', '=', 'libur.id_jenis_libur','LEFT')
            ->select('libur.*', 'jenis_libur.id_jenis_libur', 'jenis_libur.nama_jenis_libur')
            ->where('libur.tahun',$tahun)
            ->orderBy('libur.tanggal_libur','ASC')
            ->get();
        return $query;
    }

    // list_tahun
    public function list_tahun()
    {
        $query = DB::table('libur')
            ->select('tahun')
            ->groupBy('tahun')
            ->orderBy('tahun','DESC')
            ->get();
        return $query;
    }

    // listing thbl
    public function thbl($thbl)
    {
        $query = DB::table('libur')
            ->join('jenis_libur', 'jenis_libur.id_jenis_libur', '=', 'libur.id_jenis_libur','LEFT')
            ->select('libur.*', 'jenis_libur.id_jenis_libur', 'jenis_libur.nama_jenis_libur')
            ->where('libur.thbl',$thbl)
            ->orderBy('libur.tanggal_libur','ASC')
            ->get();
        return $query;
    }

    // tanggal_libur
    public function tanggal_libur($tanggal_libur)
    {
        $query = DB::table('libur')
            ->join('jenis_libur', 'jenis_libur.id_jenis_libur', '=', 'libur.id_jenis_libur','LEFT')
            ->select('libur.*', 'jenis_libur.id_jenis_libur', 'jenis_libur.nama_jenis_libur')
            ->where('libur.tanggal_libur',$tanggal_libur)
            ->orderBy('libur.tanggal_libur','ASC')
            ->first();
        return $query;
    }

     // listing thbl jenis_libur
    public function thbl_jenis_libur($thbl,$id_jenis_libur)
    {
        $query = DB::table('libur')
            ->join('jenis_libur', 'jenis_libur.id_jenis_libur', '=', 'libur.id_jenis_libur','LEFT')
            ->select('libur.*', 'jenis_libur.id_jenis_libur', 'jenis_libur.nama_jenis_libur')
            ->where('libur.thbl',$thbl)
            ->where('libur.id_jenis_libur',$id_jenis_libur)
            ->orderBy('libur.tanggal_libur','ASC')
            ->first();
        return $query;
    }

    // detail
    public function detail($id_libur)
    {
        $query = DB::table('libur')
            ->join('jenis_libur', 'jenis_libur.id_jenis_libur', '=', 'libur.id_jenis_libur','LEFT')
            ->select('libur.*', 'jenis_libur.id_jenis_libur', 'jenis_libur.nama_jenis_libur')
            ->where('libur.id_libur',$id_libur)
            ->orderBy('libur.tanggal_libur','ASC')
            ->first();
        return $query;
    }

    // detail
    public function total()
    {
        $query = DB::table('libur')
            ->join('jenis_libur', 'jenis_libur.id_jenis_libur', '=', 'libur.id_jenis_libur','LEFT')
            ->select('libur.*', 'jenis_libur.id_jenis_libur', 'jenis_libur.nama_jenis_libur')
            ->orderBy('libur.tanggal_libur','ASC')
            ->count();
        return $query;
    }

     // jenis_libur
    public function jenis_libur($id_jenis_libur)
    {
        $query = DB::table('libur')
            ->join('jenis_libur', 'jenis_libur.id_jenis_libur', '=', 'libur.id_jenis_libur','LEFT')
            ->select('libur.*', 'jenis_libur.id_jenis_libur', 'jenis_libur.nama_jenis_libur')
            ->where('libur.id_jenis_libur',$id_jenis_libur)
            ->orderBy('libur.tanggal_libur','ASC')
            ->first();
        return $query;
    }
}
