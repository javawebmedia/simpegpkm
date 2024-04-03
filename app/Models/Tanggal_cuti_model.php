<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tanggal_cuti_model extends Model
{
    // use HasFactory;

    // listing semua
    public function listing()
    {
        $query = DB::table('tanggal_cuti')
            ->join('cuti', 'cuti.id_cuti', '=', 'tanggal_cuti.id_cuti','LEFT')
            ->join('pegawai', 'pegawai.nip', '=', 'cuti.nip','LEFT')
            ->select('tanggal_cuti.*', 'cuti.nama_cuti','pegawai.nama_lengkap')
            ->orderBy('tanggal_cuti.id_tanggal_cuti','DESC')
            ->get();
        return $query;
    }

    // nip_tahun
    public function tahun_nip($tahun,$nip)
    {
        $query = DB::table('tanggal_cuti')
            ->join('cuti', 'cuti.id_cuti', '=', 'tanggal_cuti.id_cuti','LEFT')
            ->join('pegawai', 'pegawai.nip', '=', 'cuti.nip','LEFT')
            ->select('tanggal_cuti.*', 'cuti.nama_cuti','pegawai.nama_lengkap')
            ->where('pegawai.nip',$nip)
            ->where('pegawai.tahun',$tahun)
            ->orderBy('tanggal_cuti.id_tanggal_cuti','DESC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_tanggal_cuti)
    {
        $query = DB::table('tanggal_cuti')
           ->join('cuti', 'cuti.id_cuti', '=', 'tanggal_cuti.id_cuti','LEFT')
            ->join('pegawai', 'pegawai.nip', '=', 'cuti.nip','LEFT')
            ->select('tanggal_cuti.*', 'cuti.nama_cuti','pegawai.nama_lengkap')
            ->where('tanggal_cuti.id_tanggal_cuti',$id_tanggal_cuti)
            ->orderBy('tanggal_cuti.id_tanggal_cuti','DESC')
            ->first();
        return $query;
    }

    // get last id
    public function last_id()
    {
        $query = DB::table('tanggal_cuti')->orderBy('tanggal_cuti.id_tanggal_cuti','DESC')->first();
        return $query;
    }
}
