<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cuti_model extends Model
{
    // use HasFactory;

    // listing semua
    public function listing()
    {
        $query = DB::table('cuti')
            ->join('jenis_cuti', 'jenis_cuti.id_jenis_cuti', '=', 'cuti.id_jenis_cuti','LEFT')
            ->join('pegawai', 'pegawai.nip', '=', 'cuti.nip','LEFT')
            ->select('cuti.*', 'jenis_cuti.nama_jenis_cuti','pegawai.nama_lengkap')
            ->orderBy('cuti.id_cuti','DESC')
            ->get();
        return $query;
    }

    // nip_tahun
    public function tahun_nip($tahun,$nip)
    {
        $query = DB::table('cuti')
            ->join('jenis_cuti', 'jenis_cuti.id_jenis_cuti', '=', 'cuti.id_jenis_cuti','LEFT')
            ->join('pegawai', 'pegawai.nip', '=', 'cuti.nip','LEFT')
            ->select('cuti.*', 'jenis_cuti.nama_jenis_cuti','pegawai.nama_lengkap')
            ->where('cuti.nip',$nip)
            ->where('cuti.tahun',$tahun)
            ->orderBy('cuti.id_cuti','DESC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_cuti)
    {
        $query = DB::table('cuti')
           ->join('jenis_cuti', 'jenis_cuti.id_jenis_cuti', '=', 'cuti.id_jenis_cuti','LEFT')
            ->join('pegawai', 'pegawai.nip', '=', 'cuti.nip','LEFT')
            ->select('cuti.*', 'jenis_cuti.nama_jenis_cuti','pegawai.nama_lengkap')
            ->where('cuti.id_cuti',$id_cuti)
            ->orderBy('cuti.id_cuti','DESC')
            ->first();
        return $query;
    }

    // kode_cuti
    public function kode_cuti($kode_cuti)
    {
        $query = DB::table('cuti')
           ->join('jenis_cuti', 'jenis_cuti.id_jenis_cuti', '=', 'cuti.id_jenis_cuti','LEFT')
            ->join('pegawai', 'pegawai.nip', '=', 'cuti.nip','LEFT')
            ->select('cuti.*', 'jenis_cuti.nama_jenis_cuti','pegawai.nama_lengkap')
            ->where('cuti.kode_cuti',$kode_cuti)
            ->orderBy('cuti.id_cuti','DESC')
            ->first();
        return $query;
    }

    // get last id
    public function last_id()
    {
        $query = DB::table('cuti')->orderBy('cuti.id_cuti','DESC')->first();
        return $query;
    }
}
