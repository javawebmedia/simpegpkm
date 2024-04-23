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

    // proses-pengajuan
    public function proses_pengajuan(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $id_user    = Session()->get('id_pegawai');
        $nip        = Session()->get('nip');

        request()->validate([
                            'id_jenis_cuti'     => 'required',
                            'total_hari'        => 'required',
                            ]);

        $kode_cuti = Str::random(8);

        DB::table('cuti')->insert([
            'id_user'           => Session()->get('id_pegawai'),
            'id_jenis_cuti'     => $request->id_jenis_cuti,
            'nip'               => Session()->get('nip'),
            'tahun'             => date('Y'),
            'tanggal_pengajuan' => date('Y-m-d'),
            'kode_cuti'         => $kode_cuti,
            'alasan_cuti'       => $request->alasan_cuti,
            'approval_1'        => 'Menunggu',
            'approval_2'        => 'Menunggu',
            'approval_3'        => 'Menunggu',
            'approval_4'        => 'Menunggu',
            'approval_5'        => 'Menunggu',
            'status_cuti'       => 'Menunggu',
            'total_hari'        => $request->total_hari,
            'tanggal_post'      => date('Y-m-d H:i:s')
        ]);

        $m_cuti     = new Cuti_model();
        $cuti       = $m_cuti->kode_cuti($kode_cuti);

        $tanggal_cuti = $request->tanggal_cuti;
        if(isset($tanggal_cuti)) {
            for($i=0; $i < sizeof($tanggal_cuti);$i++) {
                $tanggal_cutinya = date('Y-m-d',strtotime($tanggal_cuti[$i]));

                DB::table('tanggal_cuti')->insert([
                    'id_cuti'       => $cuti->id_cuti,
                    'tanggal_cuti'  => $tanggal_cutinya,
                    'catatan'       => '-'
                ]);
            }
        }
        return redirect('pegawai/cuti')->with(['sukses' => 'Data telah ditambah']);
    }

    // tanggal
    public function tanggal()
    {
        $total_hari     = $_GET['q'];
        $data = [   'total_hari'    => $total_hari];
        return view('pegawai/cuti/tanggal',$data);
    }

    // unduh
    public function unduh($kode_cuti)
    {
        $m_cuti     = new Cuti_model();
        $m_pegawai  = new Pegawai_model();
        $nip        = Session()->get('nip');
        $pegawai    = $m_pegawai->nip($nip);
        $cuti       = $m_cuti->kode_cuti($kode_cuti);

        $data = [   'title'     => $pegawai->nama_lengkap.' (NIP: '.$pegawai->nip.')',
                    'pegawai'   => $pegawai,
                    'cuti'      => $cuti,
                ];
        $mpdf = new \Mpdf\Mpdf([
                        'default_font_size' => 11,
                        'default_font'      => 'nunito-regular',
                        'format'            => [210, 330]
                    ]);
        $html = view('pegawai/cuti/unduh',$data);
        $mpdf->WriteHTML($html);
        // buka di browser
        $mpdf->Output('cetak-cuti-'.$pegawai->nama_lengkap.'-'.date('d-m-Y-H-i-s').'.pdf','I');
    }

}
