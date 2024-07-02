<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kinerja_model extends Model
{
    // listing semua
    public function listing()
    {
        $query = DB::table('kinerja')
            ->join('aktivitas', 'aktivitas.id_aktivitas', '=', 'kinerja.id_aktivitas','LEFT')
            ->join('satuan', 'satuan.id_satuan', '=', 'aktivitas.id_satuan','LEFT')
            ->join('aktivitas_utama', 'aktivitas_utama.id_aktivitas_utama', '=', 'kinerja.id_aktivitas_utama','LEFT')
            ->join('pegawai', 'pegawai.nip', '=', 'aktivitas_utama.nip','LEFT')
            ->select('kinerja.*', 
                    'aktivitas_utama.jenis_aktivitas_utama',
                    'aktivitas.nama_aktivitas',
                    'aktivitas.kode_aktivitas',
                    'aktivitas.waktu',
                    'aktivitas.tingkat_kesulitan',
                    'aktivitas.kategori',
                    'aktivitas.bobot',
                    'aktivitas.status_aktivitas',
                    'satuan.nama_satuan',
                    'pegawai.nama_lengkap'
                )
            ->orderBy('kinerja.id_kinerja','DESC')
            ->get();
        return $query;
    }

    // pegawai dan tanggal
    public function pegawai_tanggal($nip,$tanggal_kinerja)
    {
        $query = DB::table('kinerja')
            ->join('aktivitas', 'aktivitas.id_aktivitas', '=', 'kinerja.id_aktivitas','LEFT')
            ->join('satuan', 'satuan.id_satuan', '=', 'aktivitas.id_satuan','LEFT')
            ->join('pegawai', 'pegawai.nip', '=', 'kinerja.nip','LEFT')
            ->select('kinerja.*', 
                    'aktivitas.nama_aktivitas',
                    'aktivitas.kode_aktivitas',
                    'aktivitas.waktu',
                    'aktivitas.tingkat_kesulitan',
                    'aktivitas.kategori',
                    'aktivitas.bobot',
                    'aktivitas.status_aktivitas',
                    'pegawai.nama_lengkap'
                )
            ->where([   'kinerja.nip'               => $nip,
                        'kinerja.tanggal_kinerja'   => $tanggal_kinerja
                    ])
            ->orderBy('kinerja.tanggal_kinerja','ASC')
            ->get();
        return $query;
    }

    // pegawai dan tanggal
    public function pegawai_thbl($nip,$thbl)
    {
        $query = DB::table('kinerja')
            ->join('aktivitas', 'aktivitas.id_aktivitas', '=', 'kinerja.id_aktivitas','LEFT')
            ->join('satuan', 'satuan.id_satuan', '=', 'aktivitas.id_satuan','LEFT')
            ->join('pegawai', 'pegawai.nip', '=', 'kinerja.nip','LEFT')
            ->select('kinerja.*', 
                    'aktivitas.nama_aktivitas',
                    'aktivitas.kode_aktivitas',
                    'aktivitas.waktu',
                    'aktivitas.tingkat_kesulitan',
                    'aktivitas.kategori',
                    'aktivitas.bobot',
                    'aktivitas.status_aktivitas',
                    'pegawai.nama_lengkap'
                )
            ->where([   'kinerja.nip'               => $nip,
                        'kinerja.thbl'   => $thbl
                    ])
            ->orderBy('kinerja.tanggal_kinerja','DESC')
            ->get();
        return $query;
    }

    // pegawai dan tanggal
    public function pegawai_total($nip,$tanggal_kinerja)
    {
        $query = DB::table('kinerja')
            ->where([   'kinerja.nip'               => $nip,
                        'kinerja.tanggal_kinerja'   => $tanggal_kinerja
                    ])
            ->orderBy('kinerja.id_kinerja','DESC')
            ->count();
        return $query;
    }

    // belum disetujui
    public function belum_disetujui()
    {
        $query = DB::table('kinerja')
            ->select('thbl')
            ->whereIn('status_approval',['Menunggu','Dikembalikan'])
            ->groupBy('thbl')
            ->orderBy('tanggal_kinerja','DESC')
            ->get();
        return $query;
    }

    // total menit kerja
    public function total_menit_bulan($nip,$thbl)
    {
        $query = DB::table('kinerja')
            ->select(DB::raw('SUM(jumlah_menit_disetujui) AS total_menit'))
            ->where('status_approval','Disetujui')
            ->where('nip',$nip)
            ->where('thbl',$thbl)
            ->first();
        return $query;
    }

     // pegawai dan tanggal dan status
    public function pegawai_total_status($nip,$tanggal_kinerja,$status_approval)
    {
        $query = DB::table('kinerja')
            ->where([   'kinerja.nip'               => $nip,
                        'kinerja.tanggal_kinerja'   => $tanggal_kinerja,
                        'kinerja.status_approval'   => $status_approval
                    ])
            ->orderBy('kinerja.id_kinerja','DESC')
            ->count();
        return $query;
    }

    // pegawai dan id
    public function pegawai_id($nip,$id_kinerja)
    {
        $query = DB::table('kinerja')
            ->join('aktivitas', 'aktivitas.id_aktivitas', '=', 'kinerja.id_aktivitas','LEFT')
            ->join('satuan', 'satuan.id_satuan', '=', 'aktivitas.id_satuan','LEFT')
            ->join('pegawai', 'pegawai.nip', '=', 'kinerja.nip','LEFT')
            ->select('kinerja.*', 
                    'aktivitas.nama_aktivitas',
                    'aktivitas.kode_aktivitas',
                    'aktivitas.waktu',
                    'aktivitas.tingkat_kesulitan',
                    'aktivitas.kategori',
                    'aktivitas.bobot',
                    'aktivitas.status_aktivitas',
                    'pegawai.nama_lengkap'
                )
            ->where([   'kinerja.nip'           => $nip,
                        'kinerja.id_kinerja'    => $id_kinerja
                    ])
            ->orderBy('kinerja.id_kinerja','DESC')
            ->first();
        return $query;
    }
}
