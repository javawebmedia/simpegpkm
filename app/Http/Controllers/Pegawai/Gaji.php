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
use App\Models\Tkd_model;
use App\Models\Gaji_pegawai_model;
use Image;
use PDF;

class Gaji extends Controller
{
    // halaman gaji
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        if(isset($_GET['thbl'])) {
            $tahun  = $_GET['tahun'];
            $bulan  = $_GET['bulan'];
            $thbl   = $_GET['tahun'].$_GET['bulan'];
        }else{
            $tahun  = date('Y');
            $bulan  = date('m');
            $thbl   = date('Ym');
        }

        $id_pegawai         = Session()->get('id_pegawai');
        $m_pegawai          = new Pegawai_model();
        $m_riwayat_jabatan  = new Riwayat_jabatan_model();
        $m_pendidikan       = new Pendidikan_model();
        $m_keluarga         = new Keluarga_model();
        $m_tkd              = new Tkd_model();
        $m_gaji_pegawai     = new Gaji_pegawai_model();
        
        $username           = Session()->get('username');
        $pegawai            = $m_pegawai->detail($id_pegawai);
        $tkd                = $m_tkd->thbl_pegawai($thbl,$username);
        $gaji_pegawai       = $m_gaji_pegawai->thbl_pegawai($thbl,$username);

        $data = [   'title'         => 'Riwayat Gaji dan TKD',
                    'pegawai'       => $pegawai,
                    'thbl'          => $thbl,
                    'tahun'         => $tahun,
                    'bulan'         => $bulan,
                    'tkd'           => $tkd,
                    'gaji_pegawai'  => $gaji_pegawai,
                    'content'       => 'pegawai/gaji/index'
                ];
        return view('pegawai/layout/wrapper-2',$data);
    }
}
