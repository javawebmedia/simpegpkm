<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Diklat_model extends Model
{
    // listing semua
    public function listing($paginasi)
    {
        $query = DB::table('diklat')
            ->join('rumpun', 'rumpun.id_rumpun', '=', 'diklat.id_rumpun','LEFT')
            ->join('jenis_pelatihan', 'jenis_pelatihan.id_jenis_pelatihan', '=', 'diklat.id_jenis_pelatihan','LEFT')
            ->join('metode_diklat', 'metode_diklat.id_metode_diklat', '=', 'diklat.id_metode_diklat','LEFT')
            ->join('pegawai', 'pegawai.nip', '=', 'diklat.nip','LEFT')
            ->join('kode_diklat', 'kode_diklat.id_kode_diklat', '=', 'diklat.id_kode_diklat','LEFT')
            ->select('diklat.*', 
                    'metode_diklat.jenis_metode',
                    'metode_diklat.nama_metode_diklat',
                    'metode_diklat.jp',
                    'rumpun.nama_rumpun',
                    'jenis_pelatihan.nama_jenis_pelatihan',
                    'pegawai.nama_lengkap',
                    'kode_diklat.kode_diklat',
                    'kode_diklat.nama_kode_diklat',
                )
            ->orderBy('diklat.id_diklat','DESC')
            ->paginate($paginasi);
        return $query;
    }

    // listing semua
    public function nip($nip)
    {
        $query = DB::table('diklat')
            ->join('rumpun', 'rumpun.id_rumpun', '=', 'diklat.id_rumpun','LEFT')
            ->join('jenis_pelatihan', 'jenis_pelatihan.id_jenis_pelatihan', '=', 'diklat.id_jenis_pelatihan','LEFT')
            ->join('metode_diklat', 'metode_diklat.id_metode_diklat', '=', 'diklat.id_metode_diklat','LEFT')
            ->join('pegawai', 'pegawai.nip', '=', 'diklat.nip','LEFT')
            ->join('kode_diklat', 'kode_diklat.id_kode_diklat', '=', 'diklat.id_kode_diklat','LEFT')
            ->select('diklat.*', 
                    'metode_diklat.jenis_metode',
                    'metode_diklat.nama_metode_diklat',
                    'metode_diklat.jp',
                    'rumpun.nama_rumpun',
                    'jenis_pelatihan.nama_jenis_pelatihan',
                    'pegawai.nama_lengkap',
                    'kode_diklat.kode_diklat',
                    'kode_diklat.nama_kode_diklat',
                )
            ->where([   'diklat.nip'  => $nip
                    ])
            ->orderBy('diklat.id_diklat','DESC')
            ->get();
        return $query;
    }

    // total
    public function nip_total($nip)
    {
        $query = DB::table('diklat')
            ->select(DB::raw('SUM(jpl) AS total_jpl'))
            ->where([
                'diklat.nip' => $nip,
                'diklat.status_diklat' => 'Disetujui',
            ])
            // ->where('diklat.jpl', '<', 40)
            ->orderBy('diklat.id_diklat', 'DESC')
            ->first();
        return $query;
    }

    // detail
    public function detail($id_diklat)
    {
        $query = DB::table('diklat')
            ->join('rumpun', 'rumpun.id_rumpun', '=', 'diklat.id_rumpun','LEFT')
            ->join('jenis_pelatihan', 'jenis_pelatihan.id_jenis_pelatihan', '=', 'diklat.id_jenis_pelatihan','LEFT')
            ->join('metode_diklat', 'metode_diklat.id_metode_diklat', '=', 'diklat.id_metode_diklat','LEFT')
            ->join('pegawai', 'pegawai.nip', '=', 'diklat.nip','LEFT')
            ->join('kode_diklat', 'kode_diklat.id_kode_diklat', '=', 'diklat.id_kode_diklat','LEFT')
            ->select('diklat.*', 
                    'metode_diklat.jenis_metode',
                    'metode_diklat.nama_metode_diklat',
                    'metode_diklat.jp',
                    'rumpun.nama_rumpun',
                    'jenis_pelatihan.nama_jenis_pelatihan',
                    'pegawai.nama_lengkap',
                    'kode_diklat.kode_diklat',
                    'kode_diklat.nama_kode_diklat',
                )
            ->where([   'diklat.id_diklat'  => $id_diklat
                    ])
            ->orderBy('diklat.id_diklat','DESC')
            ->first();
        return $query;
    }

    // pegawai dan tanggal
    public function pegawai_thbl($nip,$thbl)
    {
        $query = DB::table('diklat')
            ->join('rumpun', 'rumpun.id_rumpun', '=', 'diklat.id_rumpun','LEFT')
            ->join('jenis_pelatihan', 'jenis_pelatihan.id_jenis_pelatihan', '=', 'diklat.id_jenis_pelatihan','LEFT')
            ->join('pegawai', 'pegawai.nip', '=', 'diklat.nip','LEFT')
            ->select('diklat.*', 
                    'metode_diklat.jenis_metode',
                    'metode_diklat.nama_metode_diklat',
                    'metode_diklat.jp',
                    'rumpun.nama_rumpun',
                    'jenis_pelatihan.nama_jenis_pelatihan',
                    'pegawai.nama_lengkap'
                )
            ->where([   'diklat.nip'               => $nip,
                        'diklat.thbl'   => $thbl
                    ])
            ->orderBy('diklat.tanggal_diklat','DESC')
            ->get();
        return $query;
    }

    // pegawai dan tanggal
    public function pegawai_total($nip,$tanggal_diklat)
    {
        $query = DB::table('diklat')
            ->where([   'diklat.nip'               => $nip,
                        'diklat.tanggal_diklat'   => $tanggal_diklat
                    ])
            ->orderBy('diklat.id_diklat','DESC')
            ->count();
        return $query;
    }

    // belum disetujui
    public function belum_disetujui()
    {
        $query = DB::table('diklat')
            ->select('thbl')
            ->whereIn('status_approval',['Menunggu','Dikembalikan'])
            ->groupBy('thbl')
            ->orderBy('tanggal_diklat','DESC')
            ->get();
        return $query;
    }

    // total menit kerja
    public function total_menit_bulan($nip,$thbl)
    {
        $query = DB::table('diklat')
            ->select(DB::raw('SUM(jumlah_menit_disetujui) AS total_menit'))
            ->where('status_approval','Disetujui')
            ->where('nip',$nip)
            ->where('thbl',$thbl)
            ->first();
        return $query;
    }

     // pegawai dan tanggal dan status
    public function pegawai_total_status($nip,$tanggal_diklat,$status_approval)
    {
        $query = DB::table('diklat')
            ->where([   'diklat.nip'               => $nip,
                        'diklat.tanggal_diklat'   => $tanggal_diklat,
                        'diklat.status_approval'   => $status_approval
                    ])
            ->orderBy('diklat.id_diklat','DESC')
            ->count();
        return $query;
    }

    // pegawai dan id
    public function pegawai_id($nip,$id_diklat)
    {
        $query = DB::table('diklat')
            ->join('rumpun', 'rumpun.id_rumpun', '=', 'diklat.id_rumpun','LEFT')
            ->join('jenis_pelatihan', 'jenis_pelatihan.id_jenis_pelatihan', '=', 'diklat.id_jenis_pelatihan','LEFT')
            ->join('pegawai', 'pegawai.nip', '=', 'diklat.nip','LEFT')
            ->select('diklat.*', 
                    'metode_diklat.jenis_metode',
                    'metode_diklat.nama_metode_diklat',
                    'metode_diklat.jp',
                    'rumpun.nama_rumpun',
                    'jenis_pelatihan.nama_jenis_pelatihan',
                    'pegawai.nama_lengkap'
                )
            ->where([   'diklat.nip'           => $nip,
                        'diklat.id_diklat'    => $id_diklat
                    ])
            ->orderBy('diklat.id_diklat','DESC')
            ->first();
        return $query;
    }
}
