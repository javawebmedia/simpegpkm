<?php

namespace App\Http\Controllers\Pegawai;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
// panggil model
use App\Models\Pegawai_model;
use App\Models\Jabatan_model;
use App\Models\Riwayat_jabatan_model;
use App\Models\Pendidikan_model;
use App\Models\Keluarga_model;
use App\Models\Konfigurasi_model;
use App\Models\Kuota_cuti_model;
use App\Models\Jenis_cuti_model;
use App\Models\Libur_model;
use App\Models\Jenis_libur_model;
use App\Models\Cuti_model;
use App\Models\Tanggal_cuti_model;
use Image;
use PDF;

class Cuti extends Controller
{
    // halaman cuti
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $id_pegawai         = Session()->get('id_pegawai');

        $m_pegawai          = new Pegawai_model();
        $m_site             = new Konfigurasi_model();
        $m_kuota_cuti       = new Kuota_cuti_model();
        $m_jenis_cuti       = new Jenis_cuti_model();
        $m_cuti             = new Cuti_model();
        $m_tanggal_cuti     = new Tanggal_cuti_model();

        $pegawai            = $m_pegawai->detail($id_pegawai);
        $site               = $m_site->listing();
        $tahun              = date('Y');
        $nip                = $pegawai->nip;
        $kuota_cuti         = $m_kuota_cuti->tahun_nip_total($tahun,$nip);
        $jenis_cuti         = $m_jenis_cuti->listing();
        $cuti               = $m_cuti->tahun_nip($tahun,$nip);

        // proses cuti
        if(isset($_GET['id_jenis_cuti'])) {
            $id_jenis_cuti  = $_GET['id_jenis_cuti'];
            $total_hari     = $_GET['total_hari'];
            return redirect('pegawai/cuti/pengajuan/'.$id_jenis_cuti.'/'.$total_hari)->with(['sukses' => 'Silakan isi tanggal cuti Anda']);
        }
        // end proses cuti

        $data = [   'title'             => 'Pengajuan Cuti Pegawai',
                    'pegawai'           => $pegawai,
                    'kuota_cuti'        => $kuota_cuti,
                    'jenis_cuti'        => $jenis_cuti,
                    'cuti'              => $cuti,
                    'site'              => $site,
                    'content'           => 'pegawai/cuti/index'
                ];
        return view('pegawai/layout/wrapper',$data);
    }

    // pengajuan
    public function pengajuan($id_jenis_cuti,$total_hari)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $id_pegawai         = Session()->get('id_pegawai');

        $m_pegawai          = new Pegawai_model();
        $m_site             = new Konfigurasi_model();
        $m_kuota_cuti       = new Kuota_cuti_model();
        $m_jenis_cuti       = new Jenis_cuti_model();
        $m_cuti             = new Cuti_model();
        $m_tanggal_cuti     = new Tanggal_cuti_model();

        $pegawai            = $m_pegawai->detail($id_pegawai);
        $site               = $m_site->listing();
        $tahun              = date('Y');
        $nip                = $pegawai->nip;
        $kuota_cuti         = $m_kuota_cuti->tahun_nip_total($tahun,$nip);
        $jenis_cuti         = $m_jenis_cuti->listing();
        $cuti               = $m_cuti->tahun_nip($tahun,$nip);
        $jenis_cuti_detail  = $m_jenis_cuti->detail($id_jenis_cuti);

        $data = [   'title'             => 'Pengajuan Cuti Pegawai',
                    'pegawai'           => $pegawai,
                    'kuota_cuti'        => $kuota_cuti,
                    'jenis_cuti'        => $jenis_cuti,
                    'cuti'              => $cuti,
                    'site'              => $site,
                    'jenis_cuti_detail' => $jenis_cuti_detail,
                    'id_jenis_cuti'     => $id_jenis_cuti,
                    'total_hari'        => $total_hari,
                    'content'           => 'pegawai/cuti/pengajuan'
                ];
        return view('pegawai/layout/wrapper',$data);
    }

}
