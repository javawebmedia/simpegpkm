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
            ->select('jadwal_pegawai.*','shift.nama','shift.kode','pegawai.nama_lengkap')
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
            ->select('jadwal_pegawai.*','shift.nama','shift.kode','pegawai.nama_lengkap')
            ->join('shift', 'shift.id_shift', '=', 'jadwal_pegawai.id_shift','LEFT')
            ->join('pegawai', 'pegawai.pin', '=', 'jadwal_pegawai.pin')
            ->orderBy('jadwal_pegawai.id_jadwal_pegawai','DESC')
            ->paginate($paginasi);
        return $query;
    }

    // check_bulan
    public function check_bulan($nip,$thbl)
    {
        $query = DB::table('jadwal_pegawai')
            ->select('jadwal_pegawai.*','shift.nama','shift.kode','pegawai.nama_lengkap')
            ->join('shift', 'shift.id_shift', '=', 'jadwal_pegawai.id_shift','LEFT')
            ->join('pegawai', 'pegawai.pin', '=', 'jadwal_pegawai.pin')
            ->where('jadwal_pegawai.nip',$nip)
            ->where('jadwal_pegawai.thbl',$thbl)
            ->orderBy('jadwal_pegawai.id_jadwal_pegawai','ASC')
            ->get();
        return $query;
    }

    // check_tanggal
    public function check_tanggal($nip,$tanggal)
    {
        $query = DB::table('jadwal_pegawai')
            ->select('jadwal_pegawai.*','shift.nama','shift.kode','pegawai.nama_lengkap')
            ->join('shift', 'shift.id_shift', '=', 'jadwal_pegawai.id_shift','LEFT')
            ->join('pegawai', 'pegawai.pin', '=', 'jadwal_pegawai.pin')
            ->where('jadwal_pegawai.nip',$nip)
            ->where('jadwal_pegawai.tanggal',$tanggal)
            ->orderBy('jadwal_pegawai.id_jadwal_pegawai','ASC')
            ->first();
        return $query;
    }

    // detail
    public function detail($id_jadwal_pegawai)
    {
        $query = DB::table('jadwal_pegawai')
            ->select('jadwal_pegawai.*','shift.nama','shift.kode','pegawai.nama_lengkap')
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
            ->select('jadwal_pegawai.*','shift.nama','shift.kode','pegawai.nama_lengkap')
            ->join('shift', 'shift.id_shift', '=', 'jadwal_pegawai.id_shift','LEFT')
            ->join('pegawai', 'pegawai.pin', '=', 'jadwal_pegawai.pin')
            ->where('jadwal_pegawai.nip',$nip)
            ->orderBy('jadwal_pegawai.id_jadwal_pegawai','DESC')
            ->first();
        return $query;
    }
}
