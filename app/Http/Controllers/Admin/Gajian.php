<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
use App\Models\Kinerja_model;
use App\Models\Konfigurasi_model;
use App\Models\Tkd_model;
use App\Models\Gaji_model;
use App\Models\Absensi_model;
use App\Models\Gaji_pegawai_model;
use Image;
use PDF;

class Gajian extends Controller
{
    // halaman agama
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // proses
        if(isset($_GET['submit'])) {
            return redirect('admin/gajian/generate?thbl='.$_GET['thbl'])->with(['sukses' => 'Berikut hasil generate gaji dan TKD']);
        }
        if(isset($_GET['lihat'])) {
            return redirect('admin/gajian/tkd/'.$_GET['thbl'])->with(['sukses' => 'Berikut hasil generate gaji dan TKD']);
        }
        // end proses
        $m_pegawai  = new Pegawai_model();
        $pegawai    = $m_pegawai->aktif();
        $periode    = DB::table('periode')->orderBy('thbl','DESC')->get();

        $data = [   'title'     => 'Data TKD Pegawai',
                    'periode'   => $periode,
                    'pegawai'   => $pegawai,
                    'content'   => 'admin/gajian/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // halaman agama
    public function gaji()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // proses
        if(isset($_GET['submit'])) {
            return redirect('admin/gajian/generate-gaji?thbl='.$_GET['thbl'])->with(['sukses' => 'Berikut hasil generate gaji dan TKD']);
        }
        if(isset($_GET['lihat'])) {
            return redirect('admin/gajian/data-gaji/'.$_GET['thbl'])->with(['sukses' => 'Berikut hasil generate gaji dan TKD']);
        }
        // end proses
        $m_pegawai  = new Pegawai_model();
        $pegawai    = $m_pegawai->aktif();
        $periode    = DB::table('periode')->orderBy('thbl','DESC')->get();

        $data = [   'title'     => 'Data Gaji Pegawai',
                    'periode'   => $periode,
                    'pegawai'   => $pegawai,
                    'content'   => 'admin/gajian/gaji'
                ];
        return view('admin/layout/wrapper',$data);
    }


    // generate
    public function generate()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        if(isset($_GET['thbl'])) {
            $thbl = $_GET['thbl'];
        }else{
            return redirect('admin/gajian')->with(['warning' => 'Mohon maaf, Anda belum memilih THBL']);
        }

        $m_pegawai      = new Pegawai_model();
        $m_konfigurasi  = new Konfigurasi_model();
        $pegawai        = $m_pegawai->aktif();
        $periode        = DB::table('periode')->where('thbl',$thbl)->first();
        $site           = $m_konfigurasi->listing();

        $data = [   'title'     => 'Generate TKD Pegawai',
                    'periode'   => $periode,
                    'pegawai'   => $pegawai,
                    'site'      => $site,
                    'content'   => 'admin/gajian/generate'
                ];
        return view('admin/layout/wrapper-2',$data);
    }

    // generate
    public function generate_gaji()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        if(isset($_GET['thbl'])) {
            $thbl = $_GET['thbl'];
        }else{
            return redirect('admin/gajian')->with(['warning' => 'Mohon maaf, Anda belum memilih THBL']);
        }

        $m_pegawai      = new Pegawai_model();
        $m_konfigurasi  = new Konfigurasi_model();
        $pegawai        = $m_pegawai->aktif();
        $periode        = DB::table('periode')->where('thbl',$thbl)->first();
        $site           = $m_konfigurasi->listing();

        $data = [   'title'     => 'Generate Gaji Pegawai',
                    'periode'   => $periode,
                    'pegawai'   => $pegawai,
                    'site'      => $site,
                    'content'   => 'admin/gajian/generate-gaji'
                ];
        return view('admin/layout/wrapper-2',$data);
    }

    // proses tkd
    public function proses_gaji_dan_tkd(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $thblnya   = $request->thbl;
        if($thblnya !='') {
            $thblnya = $thblnya;
        }else{
            return redirect('admin/gajian')->with(['warning' => 'Mohon maaf, Anda belum memilih THBL']);
        }

        $m_pegawai      = new Pegawai_model();
        $m_konfigurasi  = new Konfigurasi_model();
        $m_tkd          = new Tkd_model();
        $m_gaji         = new Gaji_model();
        $m_absensi      = new Absensi_model();
        $m_kinerja      = new Kinerja_model();
        $pegawai        = $m_pegawai->aktif();
        $periode        = DB::table('periode')->where('thbl',$thblnya)->first();
        $site           = $m_konfigurasi->listing();
        $thbl           = $periode->thbl;

        foreach($pegawai as $pegawai) { 
            $nip        = $pegawai->nip;
            $gaji       = $m_gaji->thbl_pegawai($thbl,$nip);
            $absensi    = $m_absensi->thbl_pegawai($thbl,$nip);
            $kinerja    = $m_kinerja->total_menit_bulan($nip,$thbl);
            // hitung kinerja
            if($kinerja->total_menit >0) {
                if($absensi) {
                    $menit  = $site->max_menit_bulanan-$absensi->menit_terlambat;
                }else{
                    $menit  = $site->max_menit_bulanan;
                }
                $nkinerja   = $kinerja->total_menit/$menit;
                if($nkinerja > 100) {
                    $nilai_kinerja = 100;
                }else{
                    $nilai_kinerja = $nkinerja;
                }
            }else{
                $nilai_kinerja = 0;
            }
            // end kinerja
            // hitung tkd
            if($gaji) {
                $gapok          = $gaji->gaji;
                $pengali        = $gaji->pengali;
                $pph21          = $gaji->pph_tkd;
                $potongan_bpjs      = $gaji->bpjs_kes;
                $potongan_bpjs_tk   = $gaji->bpjs_tk;
                $potongan_lain   = $gaji->potongan_lainnya;
                $tkd            = $gaji->pengali*$gaji->gaji*$nilai_kinerja; 
                $total_potongan = $gaji->pph_tkd+$gaji->bpjs_kes+$gaji->bpjs_tk;
            }else{
                $gapok          = 0;
                $pengali        = 0;
                $tkd            = 0; 
                $pph21          = 0;
                $potongan_bpjs      = 0;
                $potongan_bpjs_tk   = 0;
                $potongan_lain   = 0;
                $total_potongan = 0;
            }
            // end tkd
            // hitung absensi dan potongan
            if($absensi) {
                $sakit  = $absensi->sakit;
                $izin   = $absensi->izin;
                $alpa   = $absensi->alpa;
                $terlambat  = $absensi->menit_terlambat;
                if($absensi->sakit > 0) {
                    $pot_sakit = $tkd*$absensi->sakit*1/100;
                }else{
                    $pot_sakit = 0;
                } 
                if($absensi->izin > 0) {
                    $pot_izin = $tkd*$absensi->izin*2/100;
                }else{
                    $pot_izin = 0;
                } 
                if($absensi->alpa > 0) {
                    $pot_alpa = $tkd*$absensi->alpa*1/100;
                }else{
                    $pot_alpa = 0;
                } 
                $potongan = $pot_sakit+$pot_izin+$pot_alpa;
            }else{
                $sakit      = 0;
                $izin       = 0;
                $alpa       = 0;
                $terlambat  = 0;
                $potongan   = 0;
            }
            // end potongan
            $tkd_bruto  = $tkd-$potongan;
            $tkd_net    = $tkd_bruto-$total_potongan;
            // proses masuk database
            $check      = $m_tkd->thbl_pegawai($thbl,$nip);
            $data = [
                        'id_pegawai'        => Session()->get('id_pegawai'),
                        'nip'               => $nip,
                        'thbl'              => $thbl,
                        'tahun'             => $periode->tahun,
                        'bulan'             => $periode->bulan,
                        'gapok'             => $gapok,
                        'pengali'           => $pengali,
                        'pph21'             => $pph21,
                        'potongan_bpjs'     => $potongan_bpjs,
                        'potongan_bpjs_tk'  => $potongan_bpjs_tk,
                        'potongan_lain'     => $potongan_lain,
                        'total_potongan'    => $total_potongan,
                        'tkd_kotor'         => $tkd_bruto,
                        'kinerja'           => $nilai_kinerja,
                        'terlambat'         => $terlambat,
                        'sakit'             => $sakit,
                        'izin'              => $izin,
                        'alpa'              => $alpa,
                        'potongan_absen'    => $potongan,
                        'tkd_bersih'        => $tkd_net,
                        'keterangan'        => '-',
                        'status_gajian'     => 'Disetujui',
                        'tanggal_post'      => date('Y-m-d H:i:s')
                    ];
            if($check) {
                DB::table('tkd')->where(['nip' => $nip, 'thbl' => $thbl])->update($data);
            }else{
                DB::table('tkd')->insert($data);
            }
        }
        // end proses masuk database
        return redirect('admin/gajian/tkd/'.$thbl)->with(['sukses' => 'Berikut hasil generate gaji dan TKD']);
    }

    // proses tkd
    public function proses_gaji(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $thblnya   = $request->thbl;
        if($thblnya !='') {
            $thblnya = $thblnya;
        }else{
            return redirect('admin/gajian')->with(['warning' => 'Mohon maaf, Anda belum memilih THBL']);
        }

        $m_pegawai      = new Pegawai_model();
        $m_gaji         = new Gaji_model();
        $m_gaji_pegawai = new Gaji_pegawai_model();
        $pegawai        = $m_pegawai->aktif();
        $periode        = DB::table('periode')->where('thbl',$thblnya)->first();
        $thbl           = $periode->thbl;

        foreach($pegawai as $pegawai) { 
            $nip        = $pegawai->nip;
            $gaji       = $m_gaji->thbl_pegawai($thbl,$nip);
            if($gaji) { 
                $gapok                  = $gaji->gaji;
                $tunjangan_keluarga     = $gaji->tunjangan;
                $tunjangan_jabatan      = $gaji->tunjangan_jabatan;
                $gaji_bruto             = $gapok+$tunjangan_keluarga+$tunjangan_jabatan;
                $pph21                  = $gaji->pph_gaji;
                $total_potongan         = $gaji->pph_gaji;
                $jumlah_diterima        = $gaji_bruto-$total_potongan;
            }else{
                $gapok                  = 0;
                $tunjangan_keluarga     = 0;
                $tunjangan_jabatan      = 0;
                $gaji_bruto             = 0;
                $pph21                  = 0;
                $total_potongan         = 0;
                $jumlah_diterima        = 0;
            }
            
            // proses masuk database
            $check      = $m_gaji_pegawai->thbl_pegawai($thbl,$nip);
            $data = [
                        'id_pegawai'        => Session()->get('id_pegawai'),
                        'nip'               => $nip,
                        'thbl'              => $thbl,
                        'tahun'             => $periode->tahun,
                        'bulan'             => $periode->bulan,
                        'npwp'              => $pegawai->npwp,
                        'rekening'          => $pegawai->rekening,
                        'gaji'              => $gapok,
                        'tunjangan_keluarga'=> $tunjangan_keluarga,
                        'gaji_bruto'        => $gaji_bruto,
                        'tunjangan_jabatan' => $tunjangan_jabatan,
                        'pph21'             => $pph21,
                        'total_potongan'    => $total_potongan,
                        'jumlah_diterima'   => $jumlah_diterima,
                        'tanggal_post'      => date('Y-m-d H:i:s')
                    ];
            if($check) {
                DB::table('gaji_pegawai')->where(['nip' => $nip, 'thbl' => $thbl])->update($data);
            }else{
                DB::table('gaji_pegawai')->insert($data);
            }
        }
        // end proses masuk database
        return redirect('admin/gajian/data-gaji/'.$thbl)->with(['sukses' => 'Berikut hasil generate gaji dan TKD']);
    }

    // tkd
    public function tkd($thbl)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $m_pegawai      = new Pegawai_model();
        $m_konfigurasi  = new Konfigurasi_model();
        $m_tkd          = new Tkd_model();
        $pegawai        = $m_pegawai->aktif();
        $periode        = DB::table('periode')->where('thbl',$thbl)->first();
        $site           = $m_konfigurasi->listing();
        $tkd            = $m_tkd->thbl($thbl);

        $data = [   'title'     => 'Hasil Generate TKD Pegawai',
                    'periode'   => $periode,
                    'pegawai'   => $pegawai,
                    'site'      => $site,
                    'tkd'       => $tkd,
                    'content'   => 'admin/gajian/tkd'
                ];
        return view('admin/layout/wrapper-2',$data);
    }

    // tkd
    public function data_gaji($thbl)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $m_pegawai      = new Pegawai_model();
        $m_konfigurasi  = new Konfigurasi_model();
        $m_gaji_pegawai = new Gaji_pegawai_model();
        $pegawai        = $m_pegawai->aktif();
        $periode        = DB::table('periode')->where('thbl',$thbl)->first();
        $site           = $m_konfigurasi->listing();
        $gaji_pegawai   = $m_gaji_pegawai->thbl($thbl);

        $data = [   'title'         => 'Hasil Generate Gaji Pegawai',
                    'periode'       => $periode,
                    'pegawai'       => $pegawai,
                    'site'          => $site,
                    'gaji_pegawai'  => $gaji_pegawai,
                    'content'       => 'admin/gajian/gaji-pegawai'
                ];
        return view('admin/layout/wrapper-2',$data);
    }
}
