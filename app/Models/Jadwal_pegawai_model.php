<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Jadwal_pegawai_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('jadwal_pegawai')
            ->select('jadwal_pegawai.*','shift.nama','shift.kode','shift.warna','pegawai.nama_lengkap')
            ->join('shift', 'shift.id_shift', '=', 'jadwal_pegawai.id_shift','LEFT')
            ->join('pegawai', 'pegawai.pin', '=', 'jadwal_pegawai.pin')
            ->orderBy('jadwal_pegawai.id_jadwal_pegawai','DESC')
            ->get();
        return $query;
    }

    // semua
    public function semua($paginasi)
    {
        $query = DB::table('jadwal_pegawai')
            ->select('jadwal_pegawai.*','shift.nama','shift.kode','shift.warna','pegawai.nama_lengkap')
            ->join('shift', 'shift.id_shift', '=', 'jadwal_pegawai.id_shift','LEFT')
            ->join('pegawai', 'pegawai.pin', '=', 'jadwal_pegawai.pin')
            ->orderBy('jadwal_pegawai.id_jadwal_pegawai','DESC')
            ->paginate($paginasi);
        return $query;
    }

    // check_bulan
    public function check_bulan($pin,$tahun,$bulan)
    {
        $query = DB::table('jadwal_pegawai')
            ->select('jadwal_pegawai.*','shift.nama','shift.kode','shift.warna','pegawai.nama_lengkap')
            ->join('shift', 'shift.id_shift', '=', 'jadwal_pegawai.id_shift','LEFT')
            ->join('pegawai', 'pegawai.pin', '=', 'jadwal_pegawai.pin')
            ->where('jadwal_pegawai.pin',$pin)
            ->where('jadwal_pegawai.tahun',$tahun)
            ->where('jadwal_pegawai.bulan',$bulan)
            ->orderBy('jadwal_pegawai.id_jadwal_pegawai','ASC')
            ->get();
        return $query;
    }

    // check_tanggal
    public function check_tanggal($pin,$tanggal)
    {
        $query = DB::table('jadwal_pegawai')
            ->select('jadwal_pegawai.*',
                        'shift.nama',
                        'shift.kode',
                        'shift.warna',
                        'pegawai.nama_lengkap',
                        'shift.jumat',
                        'shift.ganti_hari',
                        'shift.day_off',
                        'shift.shift_default',
                        'shift.jam_mulai',
                        'shift.jam_selesai')
            ->join('shift', 'shift.id_shift', '=', 'jadwal_pegawai.id_shift')
            ->join('pegawai', 'pegawai.pin', '=', 'jadwal_pegawai.pin')
            ->where('jadwal_pegawai.pin',$pin)
            ->where('jadwal_pegawai.tanggal',$tanggal)
            ->orderBy('jadwal_pegawai.id_jadwal_pegawai','ASC')
            ->first();
        return $query;
    }

    // detail
    public function detail($id_jadwal_pegawai)
    {
        $query = DB::table('jadwal_pegawai')
            ->select('jadwal_pegawai.*','shift.nama','shift.kode','shift.warna','pegawai.nama_lengkap')
            ->join('shift', 'shift.id_shift', '=', 'jadwal_pegawai.id_shift','LEFT')
            ->join('pegawai', 'pegawai.pin', '=', 'jadwal_pegawai.pin')
            ->where('jadwal_pegawai.id_jadwal_pegawai',$id_jadwal_pegawai)
            ->orderBy('jadwal_pegawai.id_jadwal_pegawai','DESC')
            ->first();
        return $query;
    }

     // pegawai
    public function pegawai($nip)
    {
        $query = DB::table('jadwal_pegawai')
            ->select('jadwal_pegawai.*','shift.nama','shift.kode','shift.warna','pegawai.nama_lengkap')
            ->join('shift', 'shift.id_shift', '=', 'jadwal_pegawai.id_shift','LEFT')
            ->join('pegawai', 'pegawai.pin', '=', 'jadwal_pegawai.pin')
            ->where('jadwal_pegawai.nip',$nip)
            ->orderBy('jadwal_pegawai.id_jadwal_pegawai','DESC')
            ->first();
        return $query;
    }
}
