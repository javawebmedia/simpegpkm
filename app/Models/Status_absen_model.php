<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Status_absen_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('status_absen')
            ->select('*')
            ->orderBy('status_absen.id_status_absen','DESC')
            ->get();
        return $query;
    }

    // jenis_status_absen
    public function jenis_status_absen($jenis_status_absen)
    {
        $query = DB::table('status_absen')
            ->select('*')
            ->where('jenis_status_absen',$jenis_status_absen)
            ->orderBy('status_absen.id_status_absen','DESC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_status_absen)
    {
        $query = DB::table('status_absen')
            ->select('*')
            ->where('status_absen.id_status_absen',$id_status_absen)
            ->orderBy('status_absen.id_status_absen','DESC')
            ->first();
        return $query;
    }

     // pegawai
    public function pegawai($nip)
    {
        $query = DB::table('status_absen')
            ->select('*')
            ->where('status_absen.nip',$nip)
            ->orderBy('status_absen.id_status_absen','DESC')
            ->first();
        return $query;
    }
}
