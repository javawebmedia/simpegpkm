<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Shift_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('shift')
            ->select('*')
            ->orderBy('shift.id_shift','DESC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_shift)
    {
        $query = DB::table('shift')
            ->select('*')
            ->where('shift.id_shift',$id_shift)
            ->orderBy('shift.id_shift','DESC')
            ->first();
        return $query;
    }

    // default_shift
    public function shift_default($shift_default)
    {
        $query = DB::table('shift')
            ->select('*')
            ->where('shift.shift_default',$shift_default)
            ->orderBy('shift.id_shift','DESC')
            ->first();
        return $query;
    }

    // day_off
    public function day_off($day_off)
    {
        $query = DB::table('shift')
            ->select('*')
            ->where('shift.day_off',$day_off)
            ->orderBy('shift.id_shift','DESC')
            ->first();
        return $query;
    }

    // jumat
    public function jumat($jumat)
    {
        $query = DB::table('shift')
            ->select('*')
            ->where('shift.jumat',$jumat)
            ->orderBy('shift.id_shift','DESC')
            ->first();
        return $query;
    }
}
