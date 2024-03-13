<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Jabatan_model extends Model
{
    // use HasFactory;

    // listing semua
    public function listing()
    {
        $query = DB::table('jabatan')
            ->join('divisi', 'divisi.id_divisi', '=', 'jabatan.id_divisi','LEFT')
            ->select('jabatan.*', 'divisi.nama_divisi')
            ->orderBy('jabatan.id_jabatan','DESC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_jabatan)
    {
        $query = DB::table('jabatan')
            ->join('divisi', 'divisi.id_divisi', '=', 'jabatan.id_divisi','LEFT')
            ->select('jabatan.*', 'divisi.nama_divisi')
            ->where('jabatan.id_jabatan',$id_jabatan)
            ->orderBy('jabatan.id_jabatan','DESC')
            ->first();
        return $query;
    }
}
