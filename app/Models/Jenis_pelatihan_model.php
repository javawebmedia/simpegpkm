<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Jenis_pelatihan_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('jenis_pelatihan')
            ->join('rumpun', 'rumpun.id_rumpun', '=', 'jenis_pelatihan.id_rumpun','LEFT')
            ->select('jenis_pelatihan.*', 'rumpun.id_rumpun', 'rumpun.nama_rumpun')
            ->orderBy('jenis_pelatihan.urutan','ASC')
            ->get();
        return $query;
    }

    // listing tanggal_jenis_pelatihan
    public function tanggal_jenis_pelatihan($tanggal_jenis_pelatihan)
    {
        $query = DB::table('jenis_pelatihan')
            ->join('rumpun', 'rumpun.id_rumpun', '=', 'jenis_pelatihan.id_rumpun','LEFT')
            ->select('jenis_pelatihan.*', 'rumpun.id_rumpun', 'rumpun.nama_rumpun')
            ->where('jenis_pelatihan.tanggal_jenis_pelatihan',$tanggal_jenis_pelatihan)
            ->orderBy('jenis_pelatihan.urutan','ASC')
            ->get();
        return $query;
    }

     // listing tanggal_jenis_pelatihan rumpun
    public function tanggal_jenis_pelatihan_rumpun($tanggal_jenis_pelatihan,$id_rumpun)
    {
        $query = DB::table('jenis_pelatihan')
            ->join('rumpun', 'rumpun.id_rumpun', '=', 'jenis_pelatihan.id_rumpun','LEFT')
            ->select('jenis_pelatihan.*', 'rumpun.id_rumpun', 'rumpun.nama_rumpun')
            ->where('jenis_pelatihan.tanggal_jenis_pelatihan',$tanggal_jenis_pelatihan)
            ->where('jenis_pelatihan.id_rumpun',$id_rumpun)
            ->orderBy('jenis_pelatihan.urutan','ASC')
            ->first();
        return $query;
    }

    // rumpun_thbl
    public function rumpun_thbl($pin, $thbl)
    {
        $query = DB::table('jenis_pelatihan')
            ->select(DB::raw('SUM(jenis_pelatihan.total_jam_kerja) AS total_jam_kerja'),
                    DB::raw('SUM(jenis_pelatihan.jumlah_menit_terlambat) AS total_jumlah_menit_terlambat'),
                    DB::raw('SUM(jenis_pelatihan.jumlah_menit_pulang_cepat) AS total_jumlah_menit_pulang_cepat')
            )
            ->where('jenis_pelatihan.pin', $pin)
            ->where('jenis_pelatihan.thbl', $thbl)
            // ->groupBy('thbl')
            ->orderBy('jenis_pelatihan.id_jenis_pelatihan', 'DESC')
            ->first();

        return $query;
    }

    // rumpun_thbl_all
    public function rumpun_thbl_all($pin, $thbl)
    {
        $query = DB::table('jenis_pelatihan')
            ->select('jenis_pelatihan.*', 'shift.nama', 'shift.warna', 'shift.kode','shift.day_off')
            ->join('shift', 'shift.id_shift', '=', 'jenis_pelatihan.id_shift')
            ->where('jenis_pelatihan.pin', $pin)
            ->where('jenis_pelatihan.thbl', $thbl)
            ->orderBy('jenis_pelatihan.tanggal_masuk', 'ASC')
            ->get();
        return $query;
    }


    // detail
    public function detail($id_jenis_pelatihan)
    {
        $query = DB::table('jenis_pelatihan')
            ->join('rumpun', 'rumpun.id_rumpun', '=', 'jenis_pelatihan.id_rumpun','LEFT')
            ->select('jenis_pelatihan.*', 'rumpun.id_rumpun', 'rumpun.nama_rumpun')
            ->where('jenis_pelatihan.id_jenis_pelatihan',$id_jenis_pelatihan)
            ->orderBy('jenis_pelatihan.urutan','ASC')
            ->first();
        return $query;
    }

    // rumpun
    public function rumpun($id_rumpun)
    {
        $query = DB::table('jenis_pelatihan')
            ->join('rumpun', 'rumpun.id_rumpun', '=', 'jenis_pelatihan.id_rumpun','LEFT')
            ->select('jenis_pelatihan.*', 'rumpun.id_rumpun', 'rumpun.nama_rumpun')
            ->where('jenis_pelatihan.id_rumpun',$id_rumpun)
            ->orderBy('jenis_pelatihan.urutan','ASC')
            ->first();
        return $query;
    }
}
