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
use App\Models\Kinerja_model;
use Image;
use PDF;

class Kinerja extends Controller
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
        if(isset($_GET['tanggal_kinerja'])) {
            $tanggal        = $_GET['tanggal_kinerja'];
        }else{
            $tanggal        = date('d-m-Y');
        }

        $tanggal_kinerja    = date('Y-m-d',strtotime($tanggal));
        $id_pegawai         = Session()->get('id_pegawai');
        $nip                = Session()->get('nip');
        $m_pegawai          = new Pegawai_model();
        $m_aktivitas        = new Aktivitas_model();
        $m_aktivitas_utama  = new Aktivitas_utama_model();
        $m_kinerja          = new Kinerja_model();
        $pegawai            = $m_pegawai->detail($id_pegawai);
        $aktivitas          = $m_aktivitas->listing();
        $aktivitas_utama    = $m_aktivitas_utama->pegawai($nip);
        $kinerja            = $m_kinerja->pegawai_tanggal($nip,$tanggal_kinerja);
        

        $data = [   'title'             => 'Kinerja: '.$pegawai->nama_lengkap.' (NIP: '.$pegawai->nip.')',
                    'pegawai'           => $pegawai,
                    'tanggal'           => $tanggal,
                    'aktivitas'         => $aktivitas,
                    'aktivitas_utama'   => $aktivitas_utama,
                    'tanggal_kinerja'   => $tanggal_kinerja,
                    'kinerja'           => $kinerja,
                    'content'           => 'pegawai/kinerja/index'
                ];
        return view('pegawai/layout/wrapper',$data);
    }

    // bulanan
    public function bulanan()
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
        $nip                = Session()->get('nip');
        $m_pegawai          = new Pegawai_model();
        $m_aktivitas        = new Aktivitas_model();
        $m_aktivitas_utama  = new Aktivitas_utama_model();
        $m_kinerja          = new Kinerja_model();
        $pegawai            = $m_pegawai->detail($id_pegawai);
        $aktivitas          = $m_aktivitas->listing();
        $aktivitas_utama    = $m_aktivitas_utama->pegawai($nip);
        $kinerja            = $m_kinerja->pegawai_thbl($nip,$thbl);
        

        $data = [   'title'             => 'Kinerja Bulanan: '.$pegawai->nama_lengkap.' (NIP: '.$pegawai->nip.')',
                    'pegawai'           => $pegawai,
                    'aktivitas'         => $aktivitas,
                    'aktivitas_utama'   => $aktivitas_utama,
                    'kinerja'           => $kinerja,
                    'thbl'              => $thbl,
                    'tahun'             => $tahun,
                    'bulan'             => $bulan,
                    'content'           => 'pegawai/kinerja/bulanan'
                ];
        return view('pegawai/layout/wrapper',$data);
    }

    // edit
    public function edit($id_kinerja)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $id_pegawai         = Session()->get('id_pegawai');
        $nip                = Session()->get('nip');
        $m_pegawai          = new Pegawai_model();
        $m_aktivitas        = new Aktivitas_model();
        $m_aktivitas_utama  = new Aktivitas_utama_model();
        $m_kinerja          = new Kinerja_model();
        $pegawai            = $m_pegawai->detail($id_pegawai);
        $aktivitas          = $m_aktivitas->listing();
        $aktivitas_utama    = $m_aktivitas_utama->pegawai($nip);
        $kinerja            = $m_kinerja->pegawai_id($nip,$id_kinerja);
        

        $data = [   'title'             => 'Edit Kinerja: '.$pegawai->nama_lengkap.' (NIP: '.$pegawai->nip.')',
                    'pegawai'           => $pegawai,
                    'aktivitas'         => $aktivitas,
                    'aktivitas_utama'   => $aktivitas_utama,
                    'kinerja'           => $kinerja,
                    'content'           => 'pegawai/kinerja/edit'
                ];
        return view('pegawai/layout/wrapper',$data);
    }

    // approval
    public function approval()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $id_pegawai         = Session()->get('id_pegawai');
        $m_pegawai          = new Pegawai_model();
        $m_atasan           = new Atasan_model();
        $m_bawahan          = new Bawahan_model();
        $pegawai            = $m_pegawai->detail($id_pegawai);
        $atasan             = $m_atasan->pegawai($id_pegawai);
        $bawahan            = $m_bawahan->atasan($atasan->id_atasan);

        if(isset($_GET['tanggal_kinerja'])) {
            $tanggal    = $_GET['tanggal_kinerja'];
        }else{
            $tanggal    = date('d-m-Y');
        }

        $data = [   'title'     => 'Approval Kinerja: '.$tanggal,
                    'pegawai'   => $pegawai,
                    'atasan'    => $atasan,
                    'bawahan'   => $bawahan,
                    'tanggal'   => $tanggal,
                    'content'   => 'pegawai/kinerja/approval'
                ];
        return view('pegawai/layout/wrapper',$data);
    }

    // detail
    public function detail($nip,$tanggal_kinerja)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $id_pegawai         = Session()->get('id_pegawai');
        $m_pegawai          = new Pegawai_model();
        $m_atasan           = new Atasan_model();
        $m_bawahan          = new Bawahan_model();

        $m_kinerja          = new Kinerja_model();
        $kinerja            = $m_kinerja->pegawai_tanggal($nip,$tanggal_kinerja);

        $pegawai            = $m_pegawai->detail($id_pegawai);
        $atasan             = $m_atasan->pegawai($id_pegawai);
        $bawahan            = $m_pegawai->nip($pegawai->nip);

        $data = [   'title'             => 'Approval Kinerja: '.date('d-m-Y',strtotime($tanggal_kinerja)).
                                    ' a.n '.$bawahan->nama_lengkap,
                    'pegawai'           => $pegawai,
                    'atasan'            => $atasan,
                    'bawahan'           => $bawahan,
                    'tanggal_kinerja'   => $tanggal_kinerja,
                    'tanggal'           => $tanggal_kinerja,
                    'kinerja'           => $kinerja,
                    'content'           => 'pegawai/kinerja/detail'
                ];
        return view('pegawai/layout/wrapper',$data);
    }

    // cetak
    public function cetak($nip,$tanggal_kinerja)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $id_pegawai         = Session()->get('id_pegawai');
        $m_pegawai          = new Pegawai_model();
        $m_atasan           = new Atasan_model();
        $m_bawahan          = new Bawahan_model();

        $m_kinerja          = new Kinerja_model();
        $kinerja            = $m_kinerja->pegawai_tanggal($nip,$tanggal_kinerja);

        $pegawai            = $m_pegawai->detail($id_pegawai);
        $atasan             = $m_atasan->pegawai($id_pegawai);
        $bawahan            = $m_pegawai->nip($nip);

        $data = [   'title'             => 'Approval Kinerja: '.date('d-m-Y',strtotime($tanggal_kinerja)).
                                    ' a.n '.$bawahan->nama_lengkap,
                    'pegawai'           => $pegawai,
                    'atasan'            => $atasan,
                    'bawahan'           => $bawahan,
                    'tanggal_kinerja'   => $tanggal_kinerja,
                    'tanggal'           => $tanggal_kinerja,
                    'kinerja'           => $kinerja
                ];
        return view('pegawai/kinerja/cetak',$data);
    }

    // setujui
    public function setujui($nip,$tanggal_kinerja)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        // proses approval
        DB::table('kinerja')->where([   'nip'               => $nip,
                                        'tanggal_kinerja'   => $tanggal_kinerja
                                    ])->update([
            'id_atasan'             => Session()->get('id_pegawai'),
            'status_approval'       => 'Disetujui',
            'tanggal_approval'      => date('Y-m-d H:i:s')
        ]);
        return redirect('pegawai/kinerja/approval?tanggal_kinerja='.$tanggal_kinerja)->with(['sukses' => 'Data kinerja telah disetujui']);
        // end proses approval
    }

    // proses
    public function proses(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $nip                    = $request->nip;
        $tanggal_kinerja        = $request->tanggal_kinerja;
        $id_kinerja             = $request->id_kinerja;
        $id_atasan              = $request->id_atasan;
        $status_approval        = $request->status_approval;
        $jumlah_menit_disetujui = $request->jumlah_menit_disetujui;

        if(empty($id_kinerja)) {
            return redirect('pegawai/kinerja/detail/'.$nip.'/'.$tanggal_kinerja)->with(['warning' => 'Mohon maaf, Anda belum memilih salah satu aktivitas']);
        }else{
            for($i=0; $i < sizeof($id_kinerja);$i++) {
                DB::table('kinerja')->where('id_kinerja',$id_kinerja[$i])->update([
                        'id_atasan'             => Session()->get('id_pegawai'),
                        'status_approval'       => $request->status_approval,
                        'catatan_atasan'        => $request->catatan_atasan,
                        'jumlah_menit_disetujui'=> $jumlah_menit_disetujui[$i],
                        'tanggal_approval'      => date('Y-m-d H:i:s')
                ]);
            }
            return redirect('pegawai/kinerja/detail/'.$nip.'/'.$tanggal_kinerja)->with(['sukses' => 'Status Approval telah diupdate']);
        }
    }

     // Tambah aktivitas harian
    public function tambah(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $pegawai    = DB::table('pegawai')->where('nip', $request->nip)->first();

        // end proteksi halaman
        request()->validate([
                            'id_aktivitas'  => 'required',
                            ]);
        // Hitung jumlah menit
        $tanggal1       = date('Y-m-d',strtotime($request->tanggal_kinerja));
        $tanggal2       = date('Y-m-d',strtotime($request->tanggal_selesai));
        $mulai          = $request->jam_mulai;
        $selesai        = $request->jam_selesai;
        $date1          = strtotime(date($tanggal1.' '.$mulai));
        $date2          = strtotime(date($tanggal2.' '.$selesai));
        $jumlah_menit   = ($date2 - $date1) / 60;
        // hitung volume
        $m_aktivitas    = new Aktivitas_model();
        $aktivitas      = $m_aktivitas->detail($request->id_aktivitas);
        $volume         = $jumlah_menit/$aktivitas->waktu;
        // End hitung jumlah menit

        DB::table('kinerja')->insert([
            'id_pegawai'            => Session()->get('id_pegawai'),
            'jenis_aktivitas'       => $request->jenis_aktivitas,
            'id_aktivitas'          => $request->id_aktivitas,
            'nip'                   => Session()->get('nip'),
            'thbl'                  => date('Ym',strtotime($request->tanggal_kinerja)),
            'tanggal_kinerja'       => date('Y-m-d',strtotime($request->tanggal_kinerja)),
            'tanggal_selesai'       => date('Y-m-d',strtotime($request->tanggal_selesai)),
            'jam_mulai'             => $request->jam_mulai,
            'jam_selesai'           => $request->jam_selesai,
            'jumlah_menit'          => $jumlah_menit,
            'keterangan'            => $request->keterangan,
            'volume'                => $volume,
            'jumlah_menit_disetujui'=> $jumlah_menit,
            'status_approval'       => 'Menunggu',
            'tanggal_post'          => date('Y-m-d H:i:s')
        ]);
        return redirect('pegawai/kinerja?tanggal_kinerja='.$request->tanggal_kinerja)->with(['sukses' => 'Data telah ditambah']);
    }

    // Edit aktivitas harian
    public function proses_edit(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $pegawai    = DB::table('pegawai')->where('nip', $request->nip)->first();

        // end proteksi halaman
        request()->validate([
                            'id_aktivitas'  => 'required',
                            ]);
        // Hitung jumlah menit
        $tanggal1       = date('Y-m-d',strtotime($request->tanggal_kinerja));
        $tanggal2       = date('Y-m-d',strtotime($request->tanggal_selesai));
        $mulai          = $request->jam_mulai;
        $selesai        = $request->jam_selesai;
        $date1          = strtotime(date($tanggal1.' '.$mulai));
        $date2          = strtotime(date($tanggal2.' '.$selesai));
        $jumlah_menit   = ($date2 - $date1) / 60;
        // hitung volume
        $m_aktivitas    = new Aktivitas_model();
        $aktivitas      = $m_aktivitas->detail($request->id_aktivitas);
        $volume         = $jumlah_menit/$aktivitas->waktu;
        // End hitung jumlah menit

        DB::table('kinerja')->where('id_kinerja',$request->id_kinerja)->update([
            'id_pegawai'            => Session()->get('id_pegawai'),
            'jenis_aktivitas'       => $request->jenis_aktivitas,
            'id_aktivitas'          => $request->id_aktivitas,
            'nip'                   => Session()->get('nip'),
            'thbl'                  => date('Ym',strtotime($request->tanggal_kinerja)),
            'tanggal_kinerja'       => date('Y-m-d',strtotime($request->tanggal_kinerja)),
            'tanggal_selesai'       => date('Y-m-d',strtotime($request->tanggal_selesai)),
            'jam_mulai'             => $request->jam_mulai,
            'jam_selesai'           => $request->jam_selesai,
            'jumlah_menit'          => $jumlah_menit,
            'keterangan'            => $request->keterangan,
            'volume'                => $volume,
            'jumlah_menit_disetujui'=> $jumlah_menit,
            'status_approval'       => 'Menunggu'
        ]);
        return redirect('pegawai/kinerja?tanggal_kinerja='.$request->tanggal_kinerja)->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_kinerja,$tanggal_kinerja)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('kinerja')->where([   'id_kinerja'   => $id_kinerja,
                                        'nip'          => Session()->get('nip')
                                    ])->delete();
        return redirect('pegawai/kinerja?tanggal_kinerja='.$tanggal_kinerja)->with(['sukses' => 'Data telah dihapus']);
    }
}
