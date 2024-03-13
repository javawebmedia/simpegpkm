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
use Image;
use PDF;

class Dasbor extends Controller
{
    // halaman dasbor
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
        $m_riwayat_jabatan  = new Riwayat_jabatan_model();
        $m_pendidikan       = new Pendidikan_model();
        $m_keluarga         = new Keluarga_model();
        $pegawai            = $m_pegawai->detail($id_pegawai);
        $riwayat_jabatan    = $m_riwayat_jabatan->pegawai($id_pegawai);
        $pendidikan         = $m_pendidikan->pegawai($id_pegawai);
        $keluarga           = $m_keluarga->pegawai($id_pegawai);
        $m_site = new Konfigurasi_model();
        $site   = $m_site->listing();

        $data = [   'title'             => $pegawai->nama_lengkap.' (NIP: '.$pegawai->nip.')',
                    'pegawai'           => $pegawai,
                    'riwayat_jabatan'   => $riwayat_jabatan,
                    'pendidikan'        => $pendidikan,
                    'keluarga'          => $keluarga,
                    'site'              => $site,
                    'content'           => 'pegawai/dasbor/index'
                ];
        return view('pegawai/layout/wrapper',$data);
    }
}
