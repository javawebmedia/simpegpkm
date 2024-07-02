<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sub_jenis_dokumen_model extends Model
{

    // listing
    public function listing()
    {
        $query = DB::table('sub_jenis_dokumen')
            ->join('jenis_dokumen', 'jenis_dokumen.id_jenis_dokumen', '=', 'sub_jenis_dokumen.id_jenis_dokumen','LEFT')
            ->select('sub_jenis_dokumen.*', 'jenis_dokumen.nama_jenis_dokumen')
            ->orderBy('sub_jenis_dokumen.urutan','ASC')
            ->get();
        return $query;
    }

    // active
    public function status_sub_jenis_dokumen($status_sub_jenis_dokumen)
    {
        $query = DB::table('sub_jenis_dokumen')
            ->join('jenis_dokumen', 'jenis_dokumen.id_jenis_dokumen', '=', 'sub_jenis_dokumen.id_jenis_dokumen','LEFT')
            ->select('sub_jenis_dokumen.*', 'jenis_dokumen.nama_jenis_dokumen')
            ->where('status_sub_jenis_dokumen',$status_sub_jenis_dokumen)
            ->orderBy('sub_jenis_dokumen.urutan','ASC')
            ->get();
        return $query;
    }

    // jenis_dokumen
    public function jenis_dokumen($id_jenis_dokumen)
    {
        $query = DB::table('sub_jenis_dokumen')
            ->join('jenis_dokumen', 'jenis_dokumen.id_jenis_dokumen', '=', 'sub_jenis_dokumen.id_jenis_dokumen','LEFT')
            ->select('sub_jenis_dokumen.*', 'jenis_dokumen.nama_jenis_dokumen')
            ->where(array(  'sub_jenis_dokumen.id_jenis_dokumen'    => $id_jenis_dokumen))
            ->orderBy('sub_jenis_dokumen.id_jenis_dokumen','DESC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_sub_jenis_dokumen)
    {
        $query = DB::table('sub_jenis_dokumen')
            ->join('jenis_dokumen', 'jenis_dokumen.id_jenis_dokumen', '=', 'sub_jenis_dokumen.id_jenis_dokumen','LEFT')
            ->select('sub_jenis_dokumen.*', 'jenis_dokumen.akses_level', 'jenis_dokumen.nama_jenis_dokumen')
            ->orderBy('sub_jenis_dokumen.id_jenis_dokumen','DESC')
            ->where(array(  'sub_jenis_dokumen.id_jenis_dokumen'    => $id_sub_jenis_dokumen))
            ->orderBy('sub_jenis_dokumen.id_jenis_dokumen','DESC')
            ->first();
        return $query;
    }
}
