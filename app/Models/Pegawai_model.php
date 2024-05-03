<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pegawai_model extends Model
{
    // use HasFactory;

    // listing semua
    public function listing()
    {
        $query = DB::table('pegawai')
            ->join('agama', 'agama.id_agama', '=', 'pegawai.id_agama','LEFT')
            ->join('divisi', 'divisi.id_divisi', '=', 'pegawai.id_divisi','LEFT')
            ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan','LEFT')
            ->select('pegawai.*', 'agama.nama_agama','divisi.nama_divisi', 'jabatan.nama_jabatan')
            ->orderBy('pegawai.nama_lengkap','ASC')
            ->get();
        return $query;
    }

    // shift
    public function shift($status_shift)
    {
        $query = DB::table('pegawai')
            ->join('agama', 'agama.id_agama', '=', 'pegawai.id_agama','LEFT')
            ->join('divisi', 'divisi.id_divisi', '=', 'pegawai.id_divisi','LEFT')
            ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan','LEFT')
            ->select('pegawai.*', 'agama.nama_agama','divisi.nama_divisi', 'jabatan.nama_jabatan')
            ->where('pegawai.status_shift',$status_shift)
            ->orderBy('pegawai.nama_lengkap','ASC')
            ->get();
        return $query;
    }

    // listing semua
    public function cari($keywords)
    {
        $query = DB::table('pegawai')
            ->leftJoin('agama', 'agama.id_agama', '=', 'pegawai.id_agama')
            ->leftJoin('divisi', 'divisi.id_divisi', '=', 'pegawai.id_divisi')
            ->leftJoin('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
            ->select('pegawai.*', 'agama.nama_agama', 'divisi.nama_divisi', 'jabatan.nama_jabatan')
            ->where(function ($query) use ($keywords) {
                $query->where('pegawai.nama_lengkap', 'like', '%' . $keywords . '%')
                    ->orWhere('pegawai.nip', 'like', '%' . $keywords . '%')
                    ->orWhere('pegawai.nrk', 'like', '%' . $keywords . '%');
            })
            ->orderBy('pegawai.nama_lengkap', 'ASC')
            ->get();

        return $query;
    }


    // Pegawai aktif
    public function aktif()
    {
        $query = DB::table('pegawai')
            ->join('agama', 'agama.id_agama', '=', 'pegawai.id_agama','LEFT')
            ->join('divisi', 'divisi.id_divisi', '=', 'pegawai.id_divisi','LEFT')
            ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan','LEFT')
            ->select('pegawai.*', 'agama.nama_agama','divisi.nama_divisi', 'jabatan.nama_jabatan')
            ->where('status_pegawai', '=', 'Aktif')
            ->orderBy('pegawai.nama_lengkap','ASC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_pegawai)
    {
        $query = DB::table('pegawai')
            ->join('agama', 'agama.id_agama', '=', 'pegawai.id_agama','LEFT')
            ->join('divisi', 'divisi.id_divisi', '=', 'pegawai.id_divisi','LEFT')
            ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan','LEFT')
            ->select('pegawai.*', 'agama.nama_agama','divisi.nama_divisi', 'jabatan.nama_jabatan')
            ->where('pegawai.id_pegawai',$id_pegawai)
            ->orderBy('pegawai.nama_lengkap','ASC')
            ->first();
        return $query;
    }

    // status_shift
    public function status_shift($status_shift)
    {
        $query = DB::table('pegawai')
            ->select('*')
            ->where('pegawai.status_shift',$status_shift)
            ->orderBy('pegawai.nama_lengkap','ASC')
            ->count();
        return $query;
    }

    // nip
    public function nip($nip)
    {
        $query = DB::table('pegawai')
            ->join('agama', 'agama.id_agama', '=', 'pegawai.id_agama','LEFT')
            ->join('divisi', 'divisi.id_divisi', '=', 'pegawai.id_divisi','LEFT')
            ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan','LEFT')
            ->select('pegawai.*', 'agama.nama_agama','divisi.nama_divisi', 'jabatan.nama_jabatan')
            ->where('pegawai.nip',$nip)
            ->orderBy('pegawai.nama_lengkap','ASC')
            ->first();
        return $query;
    }

    // nrk
    public function nrk($nrk)
    {
        $query = DB::table('pegawai')
            ->join('agama', 'agama.id_agama', '=', 'pegawai.id_agama','LEFT')
            ->join('divisi', 'divisi.id_divisi', '=', 'pegawai.id_divisi','LEFT')
            ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan','LEFT')
            ->select('pegawai.*', 'agama.nama_agama','divisi.nama_divisi', 'jabatan.nama_jabatan')
            ->where('pegawai.nrk',$nrk)
            ->orderBy('pegawai.nama_lengkap','ASC')
            ->first();
        return $query;
    }

    // jabatan
    public function jabatan($id_jabatan)
    {
        $query = DB::table('pegawai')
            ->join('agama', 'agama.id_agama', '=', 'pegawai.id_agama','LEFT')
            ->join('divisi', 'divisi.id_divisi', '=', 'pegawai.id_divisi','LEFT')
            ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan','LEFT')
            ->select('pegawai.*', 'agama.nama_agama','divisi.nama_divisi', 'jabatan.nama_jabatan')
            ->where('pegawai.id_jabatan',$id_jabatan)
            ->orderBy('pegawai.nama_lengkap','ASC')
            ->get();
        return $query;
    }
}
