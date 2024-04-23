<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Pegawai_model;
use App\Models\Kehadiran_model;
use App\Models\Data_finger_model;
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

    // proses tambah data
    public function tambah(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_pegawai      = new Pegawai_model();
        $m_kehadiran    = new Kehadiran_model();
        $m_data_finger  = new Data_finger_model();
        $pegawai        = $m_pegawai->listing();

        request()->validate([
                            'tahun'     => 'required',
                            'bulan'     => 'required',
                            ]);
        // check
        $TAHUN  = $request->tahun;
        $BULAN  = $request->bulan;
        $THBL   = $TAHUN.$BULAN;

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
                // echo $tanggal . "<br>";
                $check_finger_awal      = $m_data_finger->check_finger_awal($pegawai->pin,$tanggal,'0');
                $check_finger_akhir     = $m_data_finger->check_finger_akhir($pegawai->pin,$tanggal,'1');

                if(!empty($check_finger_awal)) {
                    $tanggal_masuk  = date('Y-m-d H:i:s',strtotime($check_finger_awal->waktu_finger));
                }else{
                    $tanggal_masuk  = null;
                }

                if(!empty($check_finger_akhir)) {
                    $tanggal_keluar  = date('Y-m-d H:i:s',strtotime($check_finger_akhir->waktu_finger));
                }else{
                    $tanggal_keluar  = null;
                }

                if(!empty($check_finger_awal) && !empty($check_finger_akhir)) {
                    $kehadiran          = 'Hadir';
                    $keterangan         = '-';
                    $waktu_awal         = $check_finger_awal->waktu_finger;
                    $waktu_akhir        = $check_finger_akhir->waktu_finger;
                    $timestamp_awal     = strtotime($waktu_awal);
                    $timestamp_akhir    = strtotime($waktu_akhir);
                    // Menghitung selisih waktu dalam detik
                    $total_jam_kerja = $timestamp_akhir - $timestamp_awal;
                }else{
                    $kehadiran          = '';
                    $keterangan         = '-';
                    $total_jam_kerja    = 13500;
                }

                $jumlah_menit_terlambat     = 0;
                $pulang_cepat               = 0;
                $lembur               = 0;

                $data = [   'id_shift'                  => 1,
                            'nip'                       => $pegawai->nip,
                            'pin'                       => $pegawai->pin,
                            'tanggal_kehadiran'         => $tanggal,
                            'tanggal_masuk'             => $tanggal_masuk,
                            'tanggal_keluar'            => $tanggal_keluar,
                            'kehadiran'                 => $kehadiran,
                            'keterangan'                => $keterangan,
                            'jumlah_menit_terlambat'    => $jumlah_menit_terlambat,
                            'pulang_cepat'              => $pulang_cepat,
                            'lembur'                    => $lembur,
                            'total_jam_kerja'           => $total_jam_kerja,
                            'thbl'                      => $THBL,
                            'tahun'                     => $TAHUN,
                            'bulan'                     => $BULAN,
                            'id_pengguna'               => Session()->get('id_pegawai')
                        ];
                DB::table('kehadiran')->insert($data);
            }
        }
        return redirect('admin/kehadiran?bulan='.$request->bulan.'&tahun='.$request->tahun.'&tanggal_kehadiran=submit')->with(['sukses' => 'Data telah ditambah']);
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
