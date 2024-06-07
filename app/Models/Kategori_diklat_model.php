<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kategori_diklat_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('kategori_diklat')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'kategori_diklat.id_pegawai','LEFT')
            ->select('kategori_diklat.*', 'pegawai.id_pegawai', 'pegawai.nama_lengkap')
            ->orderBy('kategori_diklat.urutan','ASC')
            ->get();
        return $query;
    }

    // listing tanggal_kategori_diklat
    public function tanggal_kategori_diklat($tanggal_kategori_diklat)
    {
        $query = DB::table('kategori_diklat')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'kategori_diklat.id_pegawai','LEFT')
            ->select('kategori_diklat.*', 'pegawai.id_pegawai', 'pegawai.nama_lengkap')
            ->where('kategori_diklat.tanggal_kategori_diklat',$tanggal_kategori_diklat)
            ->orderBy('kategori_diklat.urutan','ASC')
            ->get();
        return $query;
    }

     // listing tanggal_kategori_diklat pegawai
    public function tanggal_kategori_diklat_pegawai($tanggal_kategori_diklat,$id_pegawai)
    {
        $query = DB::table('kategori_diklat')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'kategori_diklat.id_pegawai','LEFT')
            ->select('kategori_diklat.*', 'pegawai.id_pegawai', 'pegawai.nama_lengkap')
            ->where('kategori_diklat.tanggal_kategori_diklat',$tanggal_kategori_diklat)
            ->where('kategori_diklat.id_pegawai',$id_pegawai)
            ->orderBy('kategori_diklat.urutan','ASC')
            ->first();
        return $query;
    }

    // pegawai_thbl
    public function pegawai_thbl($pin, $thbl)
    {
        $query = DB::table('kategori_diklat')
            ->select(DB::raw('SUM(kategori_diklat.total_jam_kerja) AS total_jam_kerja'),
                    DB::raw('SUM(kategori_diklat.jumlah_menit_terlambat) AS total_jumlah_menit_terlambat'),
                    DB::raw('SUM(kategori_diklat.jumlah_menit_pulang_cepat) AS total_jumlah_menit_pulang_cepat')
            )
            ->where('kategori_diklat.pin', $pin)
            ->where('kategori_diklat.thbl', $thbl)
            // ->groupBy('thbl')
            ->orderBy('kategori_diklat.id_kategori_diklat', 'DESC')
            ->first();

        return $query;
    }

    // pegawai_thbl_all
    public function pegawai_thbl_all($pin, $thbl)
    {
        $query = DB::table('kategori_diklat')
            ->select('kategori_diklat.*', 'shift.nama', 'shift.warna', 'shift.kode','shift.day_off')
            ->join('shift', 'shift.id_shift', '=', 'kategori_diklat.id_shift')
            ->where('kategori_diklat.pin', $pin)
            ->where('kategori_diklat.thbl', $thbl)
            ->orderBy('kategori_diklat.tanggal_masuk', 'ASC')
            ->get();
        return $query;
    }


    // detail
    public function detail($id_kategori_diklat)
    {
        $query = DB::table('kategori_diklat')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'kategori_diklat.id_pegawai','LEFT')
            ->select('kategori_diklat.*', 'pegawai.id_pegawai', 'pegawai.nama_lengkap')
            ->where('kategori_diklat.id_kategori_diklat',$id_kategori_diklat)
            ->orderBy('kategori_diklat.urutan','ASC')
            ->first();
        return $query;
    }

    // pegawai
    public function pegawai($id_pegawai)
    {
        $query = DB::table('kategori_diklat')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'kategori_diklat.id_pegawai','LEFT')
            ->select('kategori_diklat.*', 'pegawai.id_pegawai', 'pegawai.nama_lengkap')
            ->where('kategori_diklat.id_pegawai',$id_pegawai)
            ->orderBy('kategori_diklat.urutan','ASC')
            ->first();
        return $query;
    }
}
