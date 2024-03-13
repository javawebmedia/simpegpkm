<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Aktivitas_model extends Model
{
    // use HasFactory;

    // listing semua
    public function listing()
    {
        $query = DB::table('aktivitas')
            ->join('satuan', 'satuan.id_satuan', '=', 'aktivitas.id_satuan','LEFT')
            ->join('divisi', 'divisi.id_divisi', '=', 'aktivitas.id_divisi','LEFT')
            ->select('aktivitas.*', 'satuan.nama_satuan','divisi.nama_divisi')
            ->orderBy('aktivitas.id_aktivitas','DESC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_aktivitas)
    {
        $query = DB::table('aktivitas')
           ->join('satuan', 'satuan.id_satuan', '=', 'aktivitas.id_satuan','LEFT')
            ->join('divisi', 'divisi.id_divisi', '=', 'aktivitas.id_divisi','LEFT')
            ->select('aktivitas.*', 'satuan.nama_satuan','divisi.nama_divisi')
            ->where('aktivitas.id_aktivitas',$id_aktivitas)
            ->orderBy('aktivitas.id_aktivitas','DESC')
            ->first();
        return $query;
    }

    // get last id
    public function last_id()
    {
        $query = DB::table('aktivitas')->orderBy('aktivitas.id_aktivitas','DESC')->first();
        return $query;
    }
}
