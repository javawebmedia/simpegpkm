<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kehadiran_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('kehadiran')
            ->join('pegawai', 'pegawai.nip', '=', 'kehadiran.nip','LEFT')
            ->select('kehadiran.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->orderBy('kehadiran.id_kehadiran','DESC')
            ->get();
        return $query;
    }

    // listing tanggal_kehadiran
    public function tanggal_kehadiran($tanggal_kehadiran)
    {
        $query = DB::table('kehadiran')
            ->join('pegawai', 'pegawai.nip', '=', 'kehadiran.nip','LEFT')
            ->select('kehadiran.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('kehadiran.tanggal_kehadiran',$tanggal_kehadiran)
            ->orderBy('kehadiran.id_kehadiran','DESC')
            ->get();
        return $query;
    }

     // listing tanggal_kehadiran pegawai
    public function tanggal_kehadiran_pegawai($tanggal_kehadiran,$nip)
    {
        $query = DB::table('kehadiran')
            ->join('pegawai', 'pegawai.nip', '=', 'kehadiran.nip','LEFT')
            ->select('kehadiran.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('kehadiran.tanggal_kehadiran',$tanggal_kehadiran)
            ->where('kehadiran.nip',$nip)
            ->orderBy('kehadiran.id_kehadiran','DESC')
            ->first();
        return $query;
    }

    // pegawai_thbl
    public function pegawai_thbl($pin, $thbl)
    {
        $query = DB::table('kehadiran')
            ->select(DB::raw('SUM(kehadiran.total_jam_kerja) AS total_jam_kerja'),
                    DB::raw('SUM(kehadiran.jumlah_menit_terlambat) AS total_jumlah_menit_terlambat'),
                    DB::raw('SUM(kehadiran.jumlah_menit_pulang_cepat) AS total_jumlah_menit_pulang_cepat')
            )
            ->where('kehadiran.pin', $pin)
            ->where('kehadiran.thbl', $thbl)
            // ->groupBy('thbl')
            ->orderBy('kehadiran.id_kehadiran', 'DESC')
            ->first();

        return $query;
    }

    // pegawai_thbl_all
    public function pegawai_thbl_all($pin, $thbl)
    {
        $query = DB::table('kehadiran')
            ->select('kehadiran.*', 'shift.nama', 'shift.warna', 'shift.kode','shift.day_off')
            ->join('shift', 'shift.id_shift', '=', 'kehadiran.id_shift')
            ->where('kehadiran.pin', $pin)
            ->where('kehadiran.thbl', $thbl)
            ->orderBy('kehadiran.tanggal_masuk', 'ASC')
            ->get();
        return $query;
    }


    // detail
    public function detail($id_kehadiran)
    {
        $query = DB::table('kehadiran')
            ->join('pegawai', 'pegawai.nip', '=', 'kehadiran.nip','LEFT')
            ->select('kehadiran.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('kehadiran.id_kehadiran',$id_kehadiran)
            ->orderBy('kehadiran.id_kehadiran','DESC')
            ->first();
        return $query;
    }

    // pegawai
    public function pegawai($nip)
    {
        $query = DB::table('kehadiran')
            ->join('pegawai', 'pegawai.nip', '=', 'kehadiran.nip','LEFT')
            ->select('kehadiran.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('kehadiran.nip',$nip)
            ->orderBy('kehadiran.id_kehadiran','DESC')
            ->first();
        return $query;
    }
}
