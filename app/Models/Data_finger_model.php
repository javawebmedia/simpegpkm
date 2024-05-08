<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Data_finger_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('data_finger')
            ->select('*')
            ->orderBy('data_finger.id_data_finger','DESC')
            ->get();
        return $query;
    }

    // semua
    public function semua($paginasi)
    {
        $query = DB::table('data_finger')
            ->select('data_finger.*','mesin_absen.lokasi','mesin_absen.serial_number',
                    'pegawai.nip','pegawai.nama_lengkap')
            ->join('mesin_absen', 'mesin_absen.id_mesin_absen', '=', 'data_finger.id_mesin_absen','LEFT')
            ->join('pegawai', 'pegawai.pin', '=', 'data_finger.pin')
            ->orderBy('data_finger.id_data_finger','DESC')
            ->paginate($paginasi);
        return $query;
    }

    // check_finger_awal
    public function check_finger_awal($pin,$tanggal_finger,$status_data_finger)
    {
        $query = DB::table('data_finger')
            ->select('*')
            ->where('data_finger.status_data_finger',$status_data_finger)
            ->where('data_finger.tanggal_finger',$tanggal_finger)
            ->where('data_finger.pin',$pin)
            ->orderBy('data_finger.id_data_finger','ASC')
            ->first();
        return $query;
    }

    // check_finger_akhir
    public function check_finger_akhir($pin,$tanggal_finger,$status_data_finger)
    {
        $query = DB::table('data_finger')
            ->select('*')
            ->where('data_finger.status_data_finger',$status_data_finger)
            ->where('data_finger.tanggal_finger',$tanggal_finger)
            ->where('data_finger.pin',$pin)
            ->orderBy('data_finger.id_data_finger','DESC')
            ->first();
        return $query;
    }

    // check_finger_akhir_shift
    public function check_finger_akhir_shift($pin,$tanggal_finger,$status_data_finger)
    {
        $query = DB::table('data_finger')
            ->select('*')
            ->where('data_finger.status_data_finger',$status_data_finger)
            ->where('data_finger.tanggal_finger', $tanggal_finger)
            ->where('data_finger.pin',$pin)
            ->orderBy('data_finger.id_data_finger','ASC')
            ->first();
        return $query;
    }

    // check
    public function check($id_mesin_absen,$pin,$waktu_finger)
    {
        $query = DB::table('data_finger')
            ->select('*')
            ->where('data_finger.id_mesin_absen',$id_mesin_absen)
            ->where('data_finger.waktu_finger',$waktu_finger)
            ->where('data_finger.pin',$pin)
            ->orderBy('data_finger.id_data_finger','DESC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_data_finger)
    {
        $query = DB::table('data_finger')
            ->select('*')
            ->where('data_finger.id_data_finger',$id_data_finger)
            ->orderBy('data_finger.id_data_finger','DESC')
            ->first();
        return $query;
    }

     // pegawai
    public function pegawai($nip)
    {
        $query = DB::table('data_finger')
            ->select('*')
            ->where('data_finger.nip',$nip)
            ->orderBy('data_finger.id_data_finger','DESC')
            ->first();
        return $query;
    }
}
