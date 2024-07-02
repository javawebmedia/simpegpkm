<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu_pegawai_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('menu_pegawai')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'menu_pegawai.id_pegawai','LEFT')
            ->select('menu_pegawai.*', 'pegawai.nip', 'pegawai.nama_lengkap', 'pegawai.nrk')
            ->orderBy('menu_pegawai.id_menu_pegawai','DESC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_menu_pegawai)
    {
        $query = DB::table('menu_pegawai')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'menu_pegawai.id_pegawai','LEFT')
            ->select('menu_pegawai.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('menu_pegawai.id_menu_pegawai',$id_menu_pegawai)
            ->orderBy('menu_pegawai.id_menu_pegawai','DESC')
            ->first();
        return $query;
    }

     // pegawai
    public function pegawai($id_pegawai)
    {
        $query = DB::table('menu_pegawai')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'menu_pegawai.id_pegawai','LEFT')
            ->select('menu_pegawai.*', 'pegawai.nip', 'pegawai.nama_lengkap')
            ->where('menu_pegawai.id_pegawai',$id_pegawai)
            ->orderBy('menu_pegawai.id_menu_pegawai','DESC')
            ->first();
        return $query;
    }
}
