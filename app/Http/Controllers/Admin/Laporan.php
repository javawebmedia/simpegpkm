<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Pegawai_model;
use App\Models\Absensi_model;
use App\Models\Kehadiran_model;
use App\Models\Data_finger_model;
use App\Models\Jadwal_pegawai_model;
use App\Models\Status_absen_model;
use App\Models\Riwayat_jabatan_model;
use App\Models\Pendidikan_model;
use App\Models\Keluarga_model;
use App\Models\Mesin_absen_model;
use App\Models\Pin_pegawai_model;
use App\Models\Diklat_model;
use App\Models\Tkd_model;
use App\Models\Gaji_model;
use App\Models\Jenis_pelatihan_model;
use App\Models\Rumpun_model;
use App\Models\Metode_diklat_model;
use App\Models\Kategori_diklat_model;
use App\Models\Kode_diklat_model;
use App\Models\Str_sip_model;
use App\Models\Shift_model;
use App\Models\Shift_hari_model;
use App\Models\Libur_model;
use App\Models\Jenis_dokumen_model;
use App\Models\Sub_jenis_dokumen_model;
use App\Models\Dokumen_pegawai_model;
// model
use App\Models\Atasan_model;
use App\Models\Bawahan_model;
use App\Models\Aktivitas_model;
use App\Models\Aktivitas_utama_model;
use App\Models\Kinerja_model;

use Image;
use PDF;

class Laporan extends Controller
{
    // halaman absensi
    public function index()
    {

    }

    // diklat
    public function diklat()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_diklat       = new Diklat_model();
        $m_pegawai      = new Pegawai_model();

        if(isset($_GET['tahun'])) {
            $tahun  = $_GET['tahun'];
            $nip    = $_GET['nip'];
        }else{
            $nip    = 'Semua';
            $tahun  = date('Y');
        }

        $diklat         = $m_diklat->tahun_pegawai($tahun,$nip);
        
        $rekap_tahunan  = $m_diklat->rekap_tahunan();
        $pegawai        = $m_pegawai->listing();

        $data = [   'title'         => 'Buat Laporan Rekap JPL Data Diklat',
                    'diklat'        => $diklat,
                    'rekap_tahunan' => $rekap_tahunan,
                    'tahun'         => $tahun,
                    'pegawai'       => $pegawai,
                    'content'       => 'admin/laporan/diklat'
                ];
        return view('admin/layout/wrapper',$data);
    }
}