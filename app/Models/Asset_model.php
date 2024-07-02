<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Asset_model extends Model
{
    // listing semua
    public function listing($paginasi)
    {
        $query = DB::table('asset')
            ->join('lokasi', 'lokasi.id_lokasi', '=', 'asset.id_lokasi','LEFT')
            ->join('jenis_asset', 'jenis_asset.id_jenis_asset', '=', 'asset.id_jenis_asset','LEFT')
            ->select('asset.*', 
                    'lokasi.lokasi',
                    'lokasi.ruangan',
                    'jenis_asset.tipe',
                    'jenis_asset.jenis'
                )
            ->orderBy('asset.id_asset','DESC')
            ->paginate($paginasi);
        return $query;
    }
 }
