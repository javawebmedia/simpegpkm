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
use App\Models\Atasan_model;
use App\Models\Bawahan_model;
use App\Models\Aktivitas_model;
use App\Models\Aktivitas_utama_model;
use App\Models\Kinerja_Model;
// end panggil model

use Image;
use PDF;

class Ekinerja extends Controller
{
    // index
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
        $pegawai            = $m_pegawai->detail($id_pegawai);

        $data = [   'title'             => 'eKinerja '.$pegawai->nama_lengkap.' (NIP: '.$pegawai->nip.')',
                    'pegawai'           => $pegawai,
                    'content'           => 'pegawai/ekinerja/index'
                ];
        return view('pegawai/layout/wrapper',$data);
    }

    // Approval
    public function approval()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $id_pegawai  = Session()->get('id_pegawai');
        $m_pegawai   = new Pegawai_model();
        $pegawai     = $m_pegawai->detail($id_pegawai);
        $m_atasan    = new Atasan_model();
        $atasan      = $m_atasan->pegawai($id_pegawai);
        $m_bawahan   = new Bawahan_model();
        $bawahan     = $m_bawahan->atasan($atasan->id_atasan);

        if (isset($_GET['tanggal'])) {
            $tanggal = $_GET['tanggal'];
        }else{
            $tanggal = date('d-m-Y');
        }

        $data = [   'title'             => 'Approval eKinerja: '.$tanggal,
                    'pegawai'           => $pegawai,
                    'atasan'            => $atasan,
                    'bawahan'           => $bawahan,
                    'tanggal'           => $tanggal,
                    'content'           => 'pegawai/ekinerja/approval'
                ];
        return view('pegawai/layout/wrapper',$data);
    }

    // Tambah Ekinerja
    public function tambah()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $id_pegawai         = Session()->get('id_pegawai');
        $m_pegawai          = new Pegawai_model();
        $pegawai            = $m_pegawai->detail($id_pegawai);
        $m_aktivitas        = new Aktivitas_model();
        $aktivitas          = $m_aktivitas->listing();    

        $data = [   'title'             => 'Input eKinerja ',
                    'pegawai'           => $pegawai,
                    'aktivitas'         => $aktivitas,
                    'content'           => 'pegawai/ekinerja/tambah'
                ];
        return view('pegawai/layout/wrapper',$data);
    }


}
