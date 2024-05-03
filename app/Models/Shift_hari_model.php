<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Shift_hari_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('shift_hari')
            ->select('*')
            ->orderBy('shift_hari.id_shift_hari','DESC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_shift_hari)
    {
        $query = DB::table('shift_hari')
            ->select('*')
            ->where('shift_hari.id_shift_hari',$id_shift_hari)
            ->orderBy('shift_hari.id_shift_hari','DESC')
            ->first();
        return $query;
    }

    // shift_hari
    public function shift_hari($hari,$id_shift)
    {
        $query = DB::table('shift_hari')
            ->select('*')
            ->where('shift_hari.hari',$hari)
            ->where('shift_hari.id_shift',$id_shift)
            ->orderBy('shift_hari.id_shift_hari','DESC')
            ->first();
        return $query;
    }
}
