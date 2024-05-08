<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Pegawai_model;
use App\Models\Kehadiran_model;
use App\Models\Data_finger_model;
use App\Models\Jadwal_pegawai_model;
use App\Models\Absensi_model;
use Image;
use PDF;

class Kehadiran extends Controller
{
    // halaman kehadiran
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        if(isset($_GET['tahun'])) {
            $tahun      = $_GET['tahun'];
            $bulan      = $_GET['bulan'];
        }else{
            $tahun      = date('Y');
            $bulan      = date('m');
        }
        // ambil data kehadiran
        $m_kehadiran    = new Kehadiran_model();
        $m_pegawai      = new Pegawai_model();
        $pegawai        = $m_pegawai->listing();

        $data = [   'title'             => 'Data Kehadiran Pegawai',
                    'pegawai'           => $pegawai,
                    'tahun'             => $tahun,
                    'bulan'             => $bulan,
                    'thbl'              => $tahun.$bulan,
                    'm_kehadiran'       => $m_kehadiran,
                    'content'           => 'admin/kehadiran/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // detail
    public function detail($pin,$tahun,$bulan)
    {
        $m_pegawai      = new Pegawai_model();
        $m_kehadiran    = new Kehadiran_model();
        $m_absensi      = new Absensi_model();
        $pegawai        = $m_pegawai->pin($pin);
        $thbl           = $tahun.$bulan;
        $kehadiran      = $m_kehadiran->pegawai_thbl_all($pin,$thbl);

        if($bulan=='01') {
            $nama_bulan = 'Januari';
        }elseif($bulan=='02') {
            $nama_bulan = 'Februari';
        }elseif($bulan=='03') {
            $nama_bulan = 'Maret';
        }elseif($bulan=='04') {
            $nama_bulan = 'April';
        }elseif($bulan=='05') {
            $nama_bulan = 'Mei';
        }elseif($bulan=='06') {
            $nama_bulan = 'Juni';
        }elseif($bulan=='07') {
            $nama_bulan = 'Juli';
        }elseif($bulan=='08') {
            $nama_bulan = 'Agustus';
        }elseif($bulan=='09') {
            $nama_bulan = 'September';
        }elseif($bulan=='10') {
            $nama_bulan = 'Oktober';
        }elseif($bulan=='11') {
            $nama_bulan = 'November';
        }elseif($bulan=='12') {
            $nama_bulan = 'Desember';
        }

        $data = [   'title'             => 'Data Kehadiran: '.$pegawai->nama_lengkap.
                                            ' (NIP: '.$pegawai->nip.') - '.$nama_bulan.' '.$tahun,
                    'pegawai'           => $pegawai,
                    'tahun'             => $tahun,
                    'bulan'             => $bulan,
                    'thbl'              => $tahun.$bulan,
                    'm_kehadiran'       => $m_kehadiran,
                    'kehadiran'         => $kehadiran,
                    'content'           => 'admin/kehadiran/detail'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // tambah
    public function tambah(Request $request)
    {
        ini_set('memory_limit', -1);
        ini_set('max_execution_time', 0);
        date_default_timezone_set("Asia/Jakarta");
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_pegawai          = new Pegawai_model();
        $m_kehadiran        = new Kehadiran_model();
        $m_data_finger      = new Data_finger_model();
        $m_jadwal_pegawai   = new Jadwal_pegawai_model();
        $pegawai            = $m_pegawai->listing();

        request()->validate([
                            'tahun'     => 'required',
                            'bulan'     => 'required',
                            ]);
        // check
        $TAHUN  = $request->tahun;
        $BULAN  = $request->bulan;
        $THBL   = $TAHUN.$BULAN;
        $submit = $request->submit;

        if($submit=='lihat') {
            return redirect('admin/kehadiran?bulan='.$request->bulan.'&tahun='.$request->tahun.'&submit='.$request->submit);
        }

        DB::table('kehadiran')->where(['thbl' => $THBL])->delete();

        foreach($pegawai as $pegawai)
        {
            $pin            = $pegawai->pin;
            $jumlah_hari    = cal_days_in_month(CAL_GREGORIAN, $BULAN, $TAHUN);
            $semua_tanggal = [];
            for ($hari = 1; $hari <= $jumlah_hari; $hari++) {
                $tanggal = sprintf('%04d-%02d-%02d', $TAHUN, $BULAN, $hari);
                $semua_tanggal[] = $tanggal;
            }
            // Menampilkan semua tanggal
            foreach ($semua_tanggal as $tanggal) {
                // check jadwal pegawai sesuai tanggal
                $pin                    = $pegawai->pin;
                $check_jadwal           = $m_jadwal_pegawai->check_tanggal($pin,$tanggal);

                if(!empty($check_jadwal)) {
                    // data finger awal
                    $check_finger_awal      = $m_data_finger->check_finger_awal($pegawai->pin,$tanggal,'0');
                    $tanggal_kemarin        = $tanggal;
                    // jika ganti hari
                    if($check_jadwal->ganti_hari=='Ya') {
                        $tanggal_keluar         = date("Y-m-d", strtotime($tanggal_kemarin . " +1 day"));
                        $check_finger_akhir     = $m_data_finger->check_finger_akhir_shift($pegawai->pin,$tanggal_keluar,'1');
                    }else{
                        $tanggal_keluar         = $tanggal;
                        $check_finger_akhir     = $m_data_finger->check_finger_akhir($pegawai->pin,$tanggal_keluar,'1');
                    }
                    // echo $tanggal . "<br>";

                    if(!empty($check_finger_awal)) {
                        $tanggal_masuk      = $check_finger_awal->tanggal_finger;
                        $tanggal_jam_masuk  = $check_finger_awal->waktu_finger;
                    }else{
                        $tanggal_masuk      = $tanggal;
                        $tanggal_jam_masuk  = null;
                    }

                    if(!empty($check_finger_akhir)) {
                        $tanggal_keluar     = $check_finger_akhir->tanggal_finger;   
                        $tanggal_jam_keluar = $check_finger_akhir->waktu_finger;
                    }else{
                        $tanggal_keluar     = $tanggal_keluar;
                        $tanggal_jam_keluar = null;
                    }

                    // print_r($check_finger_awal);
                    if($check_jadwal->day_off=='Ya') {
                        $kehadiran                  = 'OFF';
                        $keterangan                 = '-';
                        $jumlah_menit_terlambat     = 0;
                        $jumlah_menit_pulang_cepat  = 0;
                        $lembur                     = 0;
                        $total_jam_kerja            = 0;
                    }else{
                        if($tanggal_jam_masuk == null && $tanggal_jam_keluar == null) {
                            $kehadiran                  = 'Tidak Hadir';
                            $keterangan                 = '-';
                            $jumlah_menit_terlambat     = 0;
                            $jumlah_menit_pulang_cepat  = 0;
                            $lembur                     = 0;
                            $total_jam_kerja            = 0;
                        }else{
                            $kehadiran                  = 'Hadir';
                            $keterangan                 = '-';
                            // klo jam masuk ga ada
                            if($tanggal_jam_masuk==null) {
                                $jumlah_menit_terlambat     = 0;
                                $jumlah_menit_pulang_cepat  = 0;
                                $lembur                     = 0;
                                $total_jam_kerja            = 225;
                            }elseif($tanggal_jam_keluar == null) {
                                $jumlah_menit_terlambat     = 0;
                                $jumlah_menit_pulang_cepat  = 0;
                                $lembur                     = 0;
                                $total_jam_kerja            = 225;
                            }elseif(!empty($check_finger_awal) && !empty($check_finger_akhir)) {
                                $waktu_awal                 = $check_finger_awal->waktu_finger;
                                $waktu_akhir                = $check_finger_akhir->waktu_finger;
                                $timestamp_awal             = strtotime($waktu_awal);
                                $timestamp_akhir            = strtotime($waktu_akhir);
                                // Menghitung selisih waktu dalam detik
                                $total_jam_kerja            = ($timestamp_akhir - $timestamp_awal)/60;
                                // standar
                                $jam_standar_masuk          = strtotime($tanggal_masuk.' '.$check_jadwal->jam_mulai);
                                $jam_standar_pulang         = strtotime($tanggal_keluar.' '.$check_jadwal->jam_selesai);                
                                $jumlah_menit_terlambat     = ($timestamp_awal - $jam_standar_masuk)/60;
                                $jumlah_menit_pulang_cepat  = ($jam_standar_pulang - $timestamp_akhir)/60;
                                $lembur                     = 0;
                            }
                        }
                    }
                    // hitung lainnya

                    $data = [   'id_shift'                  => $check_jadwal->id_shift,
                                'nip'                       => $pegawai->nip,
                                'pin'                       => $pegawai->pin,
                                'tanggal_masuk'             => $tanggal_masuk,
                                'tanggal_keluar'            => $tanggal_keluar,
                                'tanggal_jam_masuk'         => $tanggal_jam_masuk,
                                'tanggal_jam_keluar'        => $tanggal_jam_keluar,
                                'kehadiran'                 => $kehadiran,
                                'keterangan'                => $keterangan,
                                'jumlah_menit_terlambat'    => $jumlah_menit_terlambat,
                                'jumlah_menit_pulang_cepat' => $jumlah_menit_pulang_cepat,
                                'lembur'                    => $lembur,
                                'total_jam_kerja'           => $total_jam_kerja,
                                'thbl'                      => $THBL,
                                'tahun'                     => $TAHUN,
                                'bulan'                     => $BULAN,
                                'id_pengguna'               => Session()->get('id_pegawai')
                            ];
                    DB::table('kehadiran')->insert($data);
                }else{
                    //  jika tidak diset jadwal maka kehadiran tidak diproses
                }
            }
        }
        return redirect('admin/kehadiran?bulan='.$request->bulan.'&tahun='.$request->tahun.'&submit='.$request->submit)->with(['sukses' => 'Data kehadiran telah digenerate.']);
    }

    // import
    public function import()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman

        $data = [   'title'     => 'Import Data Kehadiran Pegawai',
                    'content'   => 'admin/kehadiran/import'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // proses import
    public function proses_import(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $m_kehadiran     = new Kehadiran_model();
        $m_pegawai  = new Pegawai_model();
        // end proteksi halaman
        // start import
        request()->validate([
                     'file_excel' => 'required|file|mimes:xls,xlsx,csv|max:8024',
                            ]);
        // UPLOAD START
        $image                  = $request->file('file_excel');
        $filenamewithextension  = $request->file('file_excel')->getClientOriginalName();
        $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
        $destinationPath        = './assets/upload/file';
        $image->move($destinationPath, $input['nama_file']);
        // END UPLOAD
        $reader                 = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(TRUE);
        $spreadsheet            = $reader->load('./assets/upload/file/'.$input['nama_file']);
        $worksheet              = $spreadsheet->getActiveSheet();

        $i=1;
        $rows[]="";
        foreach ($worksheet->getRowIterator() as $row) {
            $cellIterator   = $row->getCellIterator();
            $hasil          = $cellIterator->setIterateOnlyExistingCells(FALSE); 

            $cells = [];
            foreach ($cellIterator as $cell) {
                $cells[] = $cell->getValue();
            }
            $rows[] = $cells;
            if($i>3) {
                $nrk                = $rows[$i][0];
                $menit_terlambat    = $rows[$i][2];
                $nilai_perilaku     = $rows[$i][3];
                $nilai_serapan      = $rows[$i][4];
                $sakit              = $rows[$i][5];
                $izin               = $rows[$i][6];
                $alpa               = $rows[$i][7];
                $keterangan         = $rows[$i][8];
                // check nip
                // check
                $tanggal_kehadiran               = $request->tahun.$request->bulan;
                

                $kehadiran            = $m_kehadiran->tanggal_kehadiran($tanggal_kehadiran);
                

                if($nrk=='') {

                }else{
                    $pegawai    = $m_pegawai->nrk($nrk);
                    if($pegawai) {
                    $nip        = $pegawai->nip;
                    $check      = $m_kehadiran->tanggal_kehadiran_pegawai($tanggal_kehadiran,$nip);

                    if($check) {
                        DB::table('kehadiran')->where(['nip' => $nip, 'tanggal_kehadiran' => $tanggal_kehadiran])->update([
                            'id_pegawai'        => Session()->get('id_pegawai'),
                            'nip'               => $nip,
                            'nrk'               => $nrk,
                            'tanggal_kehadiran'              => $request->tahun.$request->bulan,
                            'bulan'             => $request->bulan,
                            'tahun'             => $request->tahun,
                            'menit_terlambat'   => $menit_terlambat,
                            'nilai_perilaku'    => $nilai_perilaku,
                            'nilai_serapan'     => $nilai_serapan,
                            'sakit'             => $sakit,
                            'izin'              => $izin,
                            'alpa'              => $alpa,
                            'keterangan'        => $keterangan,
                        ]); 
                    }else{
                       DB::table('kehadiran')->insert([
                            'id_pegawai'        => Session()->get('id_pegawai'),
                            'nip'               => $nip,
                            'nrk'               => $nrk,
                            'tanggal_kehadiran'              => $request->tahun.$request->bulan,
                            'bulan'             => $request->bulan,
                            'tahun'             => $request->tahun,
                            'menit_terlambat'   => $menit_terlambat,
                            'nilai_perilaku'    => $nilai_perilaku,
                            'nilai_serapan'     => $nilai_serapan,
                            'sakit'             => $sakit,
                            'izin'              => $izin,
                            'alpa'              => $alpa,
                            'keterangan'        => $keterangan,
                            'tanggal_kehadiran_post'      => date('Y-m-d H:i:s')
                        ]); 
                    }
                    }else{
                    //Diem bae
                    }
                    
                }
                
                // end check nip
            }
            $i++;
        }
        // hapus
        unlink('./assets/upload/file/'.$input['nama_file']);
        return redirect('admin/kehadiran?bulan='.$request->bulan.'&tahun='.$request->tahun.'&tanggal_kehadiran=submit')->with(['sukses' => 'Data telah ditambah']);
        // end import
    }

    // delete
    public function delete($id_kehadiran,$tahun,$bulan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('kehadiran')->where('id_kehadiran',$id_kehadiran)->delete();
        return redirect('admin/kehadiran?bulan='.$bulan.'&tahun='.$tahun.'&tanggal_kehadiran=submit')->with(['sukses' => 'Data telah dihapus']);
    }
}
