<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Jenis_dokumen_model extends Model
{

    // listing
    public function listing()
    {
        $query = DB::table('jenis_dokumen')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'jenis_dokumen.id_pegawai','LEFT')
            ->select('jenis_dokumen.*', 'pegawai.nama_lengkap')
            ->orderBy('jenis_dokumen.urutan','ASC')
            ->get();
        return $query;
    }

    // active
    public function status_jenis_dokumen($status_jenis_dokumen)
    {
        $query = DB::table('jenis_dokumen')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'jenis_dokumen.id_pegawai','LEFT')
            ->select('jenis_dokumen.*', 'pegawai.nama_lengkap')
            ->where('status_jenis_dokumen',$status_jenis_dokumen)
            ->orderBy('jenis_dokumen.urutan','ASC')
            ->get();
        return $query;
    }

    // pegawai
    public function pegawai($id_jenis_dokumen)
    {
        $query = DB::table('jenis_dokumen')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'jenis_dokumen.id_pegawai','LEFT')
            ->select('jenis_dokumen.*', 'pegawai.nama_lengkap')
            ->where(array(  'jenis_dokumen.id_jenis_dokumen'    => $id_jenis_dokumen))
            ->orderBy('jenis_dokumen.id_pegawai','DESC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_jenis_dokumen)
    {
        $query = DB::table('jenis_dokumen')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'jenis_dokumen.id_pegawai','LEFT')
            ->select('jenis_dokumen.*', 'pegawai.akses_level', 'pegawai.nama_lengkap')
            ->orderBy('jenis_dokumen.id_pegawai','DESC')
            ->where(array(  'jenis_dokumen.id_jenis_dokumen'    => $id_jenis_dokumen))
            ->orderBy('jenis_dokumen.id_pegawai','DESC')
            ->first();
        return $query;
    }
}
