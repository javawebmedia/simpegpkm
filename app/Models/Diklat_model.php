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
                    'pegawai.nik',
                    'pegawai.jenis_pegawai',
                    'kode_diklat.kode_diklat',
                    'kode_diklat.nama_kode_diklat',
                )
            ->orderBy('diklat.id_diklat','DESC')
            ->paginate($paginasi);
        return $query;
    }

    // tahun
    public function tahun($tahun)
    {
        $query = DB::table('diklat')
            ->leftJoin('rumpun', 'rumpun.id_rumpun', '=', 'diklat.id_rumpun')
            ->leftJoin('jenis_pelatihan', 'jenis_pelatihan.id_jenis_pelatihan', '=', 'diklat.id_jenis_pelatihan')
            ->leftJoin('metode_diklat', 'metode_diklat.id_metode_diklat', '=', 'diklat.id_metode_diklat')
            ->leftJoin('pegawai', 'pegawai.nip', '=', 'diklat.nip')
            ->leftJoin('kode_diklat', 'kode_diklat.id_kode_diklat', '=', 'diklat.id_kode_diklat')
            ->select('diklat.*', 
                    'metode_diklat.jenis_metode',
                    'metode_diklat.nama_metode_diklat',
                    'metode_diklat.jp',
                    'rumpun.nama_rumpun',
                    'jenis_pelatihan.nama_jenis_pelatihan',
                    'pegawai.nama_lengkap',
                    'pegawai.nik',
                    'pegawai.jenis_pegawai',
                    'kode_diklat.kode_diklat',
                    'kode_diklat.nama_kode_diklat'
                )
            ->whereRaw('SUBSTR(diklat.tanggal_awal, 1, 4) = ?', [$tahun])
            ->orderBy('diklat.id_diklat', 'DESC')
            ->get();
        return $query;
    }

    // rekap
    public function rekap($tahun)
    {
        $query = DB::table('diklat')
        ->join('pegawai', 'pegawai.nip', '=', 'diklat.nip')
        ->join('kode_diklat', 'kode_diklat.id_kode_diklat', '=', 'diklat.id_kode_diklat')
        ->select(
            'diklat.nip',
            'diklat.nama_diklat',
            'kode_diklat.kode_diklat',
            DB::raw('SUM(diklat.jpl) as total_jpl'),
            DB::raw('MAX(pegawai.nik) AS nik'),
            DB::raw('MAX(pegawai.nama_lengkap) AS nama_lengkap')
        )
        ->whereRaw('SUBSTR(diklat.tanggal_awal, 1, 4) = ?', [$tahun])
        ->groupBy('diklat.nip')
        ->orderBy('total_jpl', 'DESC')
        ->get();

    return $query;

        return $query;
    }

    // tanpa_diklat
    public function tanpa_diklat($tahun)
    {
        $query = DB::table('pegawai')
            ->select(
                'pegawai.nip',
                DB::raw('0 as total_jpl'), // Inisialisasi total_jpl karena tidak ada diklat
                DB::raw('MAX(pegawai.nik) AS nik'),
                DB::raw('MAX(pegawai.nama_lengkap) AS nama_lengkap')
            )
            ->leftJoin('diklat', function ($join) use ($tahun) {
                $join->on('pegawai.nip', '=', 'diklat.nip')
                     ->whereRaw('SUBSTR(diklat.tanggal_awal, 1, 4) = ?', [$tahun]);
            })
            ->whereNull('diklat.nip') // Memastikan pegawai tidak memiliki entri diklat pada tahun tersebut
            ->groupBy('pegawai.nip')
            ->orderBy('pegawai.nip', 'ASC') // Menggunakan nip untuk pengurutan yang lebih konsisten
            ->get();

        return $query;
    }

    // tanpa_diklat
    public function jpl_kurang($tahun)
    {
        $query = DB::table('diklat')
            ->join('pegawai', 'pegawai.nip', '=', 'diklat.nip')
            ->select(
                'diklat.nip',
                DB::raw('SUM(diklat.jpl) as total_jpl'),
                DB::raw('MAX(pegawai.nik) AS nik'),
                DB::raw('MAX(pegawai.nama_lengkap) AS nama_lengkap')
            )
            ->whereRaw('SUBSTR(diklat.tanggal_awal, 1, 4) = ?', [$tahun])
            ->groupBy('diklat.nip')
            ->havingRaw('SUM(diklat.jpl) < 40')
            ->orderBy('total_jpl', 'DESC')
            ->get();

        return $query;
    }

    // tanpa_diklat
    public function jpl_cukup($tahun)
    {
        $query = DB::table('diklat')
            ->join('pegawai', 'pegawai.nip', '=', 'diklat.nip')
            ->select(
                'diklat.nip',
                DB::raw('SUM(diklat.jpl) as total_jpl'),
                DB::raw('MAX(pegawai.nik) AS nik'),
                DB::raw('MAX(pegawai.nama_lengkap) AS nama_lengkap')
            )
            ->whereRaw('SUBSTR(diklat.tanggal_awal, 1, 4) = ?', [$tahun])
            ->groupBy('diklat.nip')
            ->havingRaw('SUM(diklat.jpl) >= 40')
            ->orderBy('total_jpl', 'DESC')
            ->get();

        return $query;
    }

    // tahun_pegawai
    public function tahun_pegawai($tahun, $nip)
    {
        if($nip=='Semua') {
            $query = DB::table('diklat')
                ->leftJoin('pegawai', 'pegawai.nip', '=', 'diklat.nip')
                ->select(
                    DB::raw('SUM(diklat.jpl) AS total_jpl'),
                    DB::raw('MAX(pegawai.nik) AS nik'),
                    DB::raw('MAX(pegawai.nip) AS nip'),
                    DB::raw('MAX(pegawai.nama_lengkap) AS nama_lengkap')
                )
                ->whereRaw('SUBSTR(diklat.tanggal_awal, 1, 4) = ?', [$tahun])
                ->groupBy('diklat.nip')
                ->orderBy(DB::raw('SUM(diklat.jpl)'), 'DESC')
                ->get();

            return $query;
        }else{
            $query = DB::table('diklat')
                ->leftJoin('pegawai', 'pegawai.nip', '=', 'diklat.nip')
                ->select(
                    DB::raw('SUM(diklat.jpl) AS total_jpl'),
                    DB::raw('MAX(pegawai.nik) AS nik'),
                     DB::raw('MAX(pegawai.nip) AS nip'),
                    DB::raw('MAX(pegawai.nama_lengkap) AS nama_lengkap')
                )
                ->whereRaw('SUBSTR(diklat.tanggal_awal, 1, 4) = ?', [$tahun])
                ->where('diklat.nip', $nip)
                ->groupBy('diklat.nip')
                ->orderBy(DB::raw('SUM(diklat.jpl)'), 'ASC')
                ->get();

            return $query;
        }
        
    }

    // rekap
    public function rekap_pertahun($tahun)
    {

        // Jumlah pegawai yang belum memiliki diklat sama sekali
        $pegawai_diklat_semua = DB::table('pegawai')
            ->leftJoin('diklat', function($join) use ($tahun) {
                $join->on('pegawai.nip', '=', 'diklat.nip')
                     ->whereRaw('SUBSTR(diklat.tanggal_awal, 1, 4) = ?', [$tahun]);
            })
            ->where('diklat.id_diklat')
            ->count();

        // Jumlah pegawai yang belum memiliki diklat sama sekali
        $pegawai_tanpa_diklat = DB::table('pegawai')
            ->leftJoin('diklat', function($join) use ($tahun) {
                $join->on('pegawai.nip', '=', 'diklat.nip')
                     ->whereRaw('SUBSTR(diklat.tanggal_awal, 1, 4) = ?', [$tahun]);
            })
            ->whereNull('diklat.id_diklat')
            ->count();

        // Jumlah pegawai yang sudah memiliki diklat tapi JPL kurang dari 40
        $pegawai_jpl_kurang_40 = DB::table('pegawai')
            ->leftJoin('diklat', function($join) use ($tahun) {
                $join->on('pegawai.nip', '=', 'diklat.nip')
                     ->whereRaw('SUBSTR(diklat.tanggal_awal, 1, 4) = ?', [$tahun]);
            })
            ->select('pegawai.nip')
            ->groupBy('pegawai.nip')
            ->havingRaw('SUM(diklat.jpl) < 40')
            ->count();

        // Jumlah pegawai yang sudah memiliki diklat dengan JPL lebih besar atau sama dengan 40
        $pegawai_jpl_lebih_sama_40 = DB::table('pegawai')
            ->leftJoin('diklat', function($join) use ($tahun) {
                $join->on('pegawai.nip', '=', 'diklat.nip')
                     ->whereRaw('SUBSTR(diklat.tanggal_awal, 1, 4) = ?', [$tahun]);
            })
            ->select('pegawai.nip')
            ->groupBy('pegawai.nip')
            ->havingRaw('SUM(diklat.jpl) >= 40')
            ->count();

        return [
            'pegawai_diklat_semua' => $pegawai_diklat_semua,
            'pegawai_tanpa_diklat' => $pegawai_tanpa_diklat,
            'pegawai_jpl_kurang_40' => $pegawai_jpl_kurang_40,
            'pegawai_jpl_lebih_sama_40' => $pegawai_jpl_lebih_sama_40,
        ];
    }


    // tahun
    public function rekap_tahunan()
    {
        $query = DB::table('diklat')
            ->select(
                DB::raw('SUBSTR(diklat.tanggal_awal, 1, 4) AS tahun'),
                DB::raw('COUNT(*) AS total_diklat')
            )
            ->groupBy(DB::raw('SUBSTR(diklat.tanggal_awal, 1, 4)'))
            ->orderBy(DB::raw('SUBSTR(diklat.tanggal_awal, 1, 4)'), 'DESC')
            ->get();

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
