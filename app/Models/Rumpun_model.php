<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rumpun_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('rumpun')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'rumpun.id_pegawai','LEFT')
            ->select('rumpun.*', 'pegawai.id_pegawai', 'pegawai.nama_lengkap')
            ->orderBy('rumpun.urutan','ASC')
            ->get();
        return $query;
    }

    // listing tanggal_rumpun
    public function tanggal_rumpun($tanggal_rumpun)
    {
        $query = DB::table('rumpun')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'rumpun.id_pegawai','LEFT')
            ->select('rumpun.*', 'pegawai.id_pegawai', 'pegawai.nama_lengkap')
            ->where('rumpun.tanggal_rumpun',$tanggal_rumpun)
            ->orderBy('rumpun.urutan','ASC')
            ->get();
        return $query;
    }

     // listing tanggal_rumpun pegawai
    public function tanggal_rumpun_pegawai($tanggal_rumpun,$id_pegawai)
    {
        $query = DB::table('rumpun')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'rumpun.id_pegawai','LEFT')
            ->select('rumpun.*', 'pegawai.id_pegawai', 'pegawai.nama_lengkap')
            ->where('rumpun.tanggal_rumpun',$tanggal_rumpun)
            ->where('rumpun.id_pegawai',$id_pegawai)
            ->orderBy('rumpun.urutan','ASC')
            ->first();
        return $query;
    }

    // pegawai_thbl
    public function pegawai_thbl($pin, $thbl)
    {
        $query = DB::table('rumpun')
            ->select(DB::raw('SUM(rumpun.total_jam_kerja) AS total_jam_kerja'),
                    DB::raw('SUM(rumpun.jumlah_menit_terlambat) AS total_jumlah_menit_terlambat'),
                    DB::raw('SUM(rumpun.jumlah_menit_pulang_cepat) AS total_jumlah_menit_pulang_cepat')
            )
            ->where('rumpun.pin', $pin)
            ->where('rumpun.thbl', $thbl)
            // ->groupBy('thbl')
            ->orderBy('rumpun.id_rumpun', 'DESC')
            ->first();

        return $query;
    }

    // pegawai_thbl_all
    public function pegawai_thbl_all($pin, $thbl)
    {
        $query = DB::table('rumpun')
            ->select('rumpun.*', 'shift.nama', 'shift.warna', 'shift.kode','shift.day_off')
            ->join('shift', 'shift.id_shift', '=', 'rumpun.id_shift')
            ->where('rumpun.pin', $pin)
            ->where('rumpun.thbl', $thbl)
            ->orderBy('rumpun.tanggal_masuk', 'ASC')
            ->get();
        return $query;
    }


    // detail
    public function detail($id_rumpun)
    {
        $query = DB::table('rumpun')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'rumpun.id_pegawai','LEFT')
            ->select('rumpun.*', 'pegawai.id_pegawai', 'pegawai.nama_lengkap')
            ->where('rumpun.id_rumpun',$id_rumpun)
            ->orderBy('rumpun.urutan','ASC')
            ->first();
        return $query;
    }

    // pegawai
    public function pegawai($id_pegawai)
    {
        $query = DB::table('rumpun')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'rumpun.id_pegawai','LEFT')
            ->select('rumpun.*', 'pegawai.id_pegawai', 'pegawai.nama_lengkap')
            ->where('rumpun.id_pegawai',$id_pegawai)
            ->orderBy('rumpun.urutan','ASC')
            ->first();
        return $query;
    }
}
