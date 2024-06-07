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
use Image;
use PDF;

class Absensi extends Controller
{
    // halaman absensi
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
        // ambil data absensi
        $m_absensi      = new Absensi_model();
        $m_pegawai      = new Pegawai_model();
        $m_kehadiran    = new Kehadiran_model();
        $absensi        = $m_absensi->thbl($thbl);
        $pegawai        = $m_pegawai->listing();

         // bikin rekap
        if(isset($_GET['rekap'])) {
            foreach($pegawai as $pegawai) {
                $nip    = $pegawai->nip;
                $total  = $m_kehadiran->pegawai_thbl($pegawai->pin,$thbl);
                $hadir  = $m_kehadiran->pegawai_thbl_status($pegawai->pin,$thbl,'Hadir');
                $alpa   = $m_kehadiran->pegawai_thbl_status($pegawai->pin,$thbl,'Alpa');
                $sakit  = $m_kehadiran->pegawai_thbl_status($pegawai->pin,$thbl,'Sakit');
                $izin   = $m_kehadiran->pegawai_thbl_status($pegawai->pin,$thbl,'Izin');
                $check      = $m_absensi->thbl_pegawai($thbl,$nip);
                if($check) {
                    $nilai_perilaku = $check->nilai_perilaku;
                    $nilai_serapan  = $check->nilai_serapan;
                    $keterangan     = $check->keterangan;
                }else{
                    $nilai_perilaku = 0;
                    $nilai_serapan  = 0;
                    $keterangan     = '-';
                }
                $data   = [
                        'id_pegawai'        => Session()->get('id_pegawai'),
                        'nip'               => $pegawai->nip,
                        'thbl'              => $thbl,
                        'bulan'             => $bulan,
                        'tahun'             => $tahun,
                        'menit_terlambat'   => $total->total_jumlah_menit_terlambat,
                        'nilai_perilaku'    => $nilai_perilaku,
                        'nilai_serapan'     => $nilai_serapan,
                        'sakit'             => $sakit->total_status_kehadiran,
                        'izin'              => $izin->total_status_kehadiran,
                        'alpa'              => $alpa->total_status_kehadiran,
                        'keterangan'        => $keterangan,
                        'tanggal_post'      => date('Y-m-d H:i:s')
                    ];
                
                if($check) {
                    DB::table('absensi')->where(['nip' => $check->nip, 'thbl' => $check->thbl])->update($data); 
                }else{
                   DB::table('absensi')->insert($data); 
                }
            }
            return redirect('admin/absensi?thbl='.$thbl.'&tahun='.$tahun.'&bulan='.$bulan.'&thbl='.$thbl)->with(['sukses' => 'Data rekap telah dibuat']);
        }

        $data = [   'title'     => 'Data Master Absensi: '.$thbl,
                    'absensi'   => $absensi,
                    'pegawai'   => $pegawai,
                    'thbl'      => $thbl,
                    'tahun'     => $tahun,
                    'bulan'     => $bulan,
                    'content'   => 'admin/absensi/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // fetchData
    public function data_absensi()
    {
        $nip            = $_GET['nip'];
        $tahun            = $_GET['tahun'];
        $bulan            = $_GET['bulan'];
        $m_absensi      = new Absensi_model();
        $thbl           = $tahun.$bulan;
        $absensi        = $m_absensi->thbl_pegawai($thbl,$nip);
        // Gantikan logika berikut dengan panggilan ke sumber data remote Anda
        // Misalnya, Anda mungkin akan mengambil data dari database atau API lain
        if($absensi) {
            return [
                'menit_terlambat'   => $absensi->menit_terlambat,
                'nilai_perilaku'    => $absensi->nilai_perilaku,
                'nilai_serapan'     => $absensi->nilai_serapan,
                'sakit'             => $absensi->sakit,
                'izin'              => $absensi->izin,
                'alpa'              => $absensi->alpa,
                'keterangan'        => $absensi->keterangan
            ];
        }else{
            return [
                'menit_terlambat'   => 0,
                'nilai_perilaku'    => 0,
                'nilai_serapan'     => 0,
                'sakit'             => 0,
                'izin'              => 0,
                'alpa'              => 0,
                'keterangan'        => ''
            ];
        }

        return response()->json($absensi);
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
        request()->validate([
                            'tahun'     => 'required',
                            'bulan'     => 'required',
                            'nip'       => 'required',
                            ]);
        // check
        $thbl       = $request->tahun.$request->bulan;
        $nip        = $request->nip;
        $m_absensi  = new Absensi_model();
        $check      = $m_absensi->thbl_pegawai($thbl,$nip);
        if($check) {
            DB::table('absensi')->where(['nip' => $check->nip, 'thbl' => $check->thbl])->update([
                'id_pegawai'        => Session()->get('id_pegawai'),
                'nip'               => $request->nip,
                'thbl'              => $request->tahun.$request->bulan,
                'bulan'             => $request->bulan,
                'tahun'             => $request->tahun,
                'menit_terlambat'   => $request->menit_terlambat,
                'nilai_perilaku'    => $request->nilai_perilaku,
                'nilai_serapan'     => $request->nilai_serapan,
                'sakit'             => $request->sakit,
                'izin'              => $request->izin,
                'alpa'              => $request->alpa,
                'keterangan'        => $request->keterangan,
            ]); 
        }else{
           DB::table('absensi')->insert([
                'id_pegawai'        => Session()->get('id_pegawai'),
                'nip'               => $request->nip,
                'thbl'              => $request->tahun.$request->bulan,
                'bulan'             => $request->bulan,
                'tahun'             => $request->tahun,
                'menit_terlambat'   => $request->menit_terlambat,
                'nilai_perilaku'    => $request->nilai_perilaku,
                'nilai_serapan'     => $request->nilai_serapan,
                'sakit'             => $request->sakit,
                'izin'              => $request->izin,
                'alpa'              => $request->alpa,
                'keterangan'        => $request->keterangan,
                'tanggal_post'      => date('Y-m-d H:i:s')
            ]); 
        }
        
        return redirect('admin/absensi?bulan='.$request->bulan.'&tahun='.$request->tahun.'&thbl=submit')->with(['sukses' => 'Data telah ditambah']);
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

        $data = [   'title'     => 'Import Data Absensi Pegawai',
                    'content'   => 'admin/absensi/import'
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
        $m_absensi     = new Absensi_model();
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
                $thbl               = $request->tahun.$request->bulan;
                

                $absensi            = $m_absensi->thbl($thbl);
                

                if($nrk=='') {

                }else{
                    $pegawai    = $m_pegawai->nrk($nrk);
                    if($pegawai) {
                    $nip        = $pegawai->nip;
                    $check      = $m_absensi->thbl_pegawai($thbl,$nip);

                    if($check) {
                        DB::table('absensi')->where(['nip' => $nip, 'thbl' => $thbl])->update([
                            'id_pegawai'        => Session()->get('id_pegawai'),
                            'nip'               => $nip,
                            'nrk'               => $nrk,
                            'thbl'              => $request->tahun.$request->bulan,
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
                       DB::table('absensi')->insert([
                            'id_pegawai'        => Session()->get('id_pegawai'),
                            'nip'               => $nip,
                            'nrk'               => $nrk,
                            'thbl'              => $request->tahun.$request->bulan,
                            'bulan'             => $request->bulan,
                            'tahun'             => $request->tahun,
                            'menit_terlambat'   => $menit_terlambat,
                            'nilai_perilaku'    => $nilai_perilaku,
                            'nilai_serapan'     => $nilai_serapan,
                            'sakit'             => $sakit,
                            'izin'              => $izin,
                            'alpa'              => $alpa,
                            'keterangan'        => $keterangan,
                            'tanggal_post'      => date('Y-m-d H:i:s')
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
        return redirect('admin/absensi?bulan='.$request->bulan.'&tahun='.$request->tahun.'&thbl=submit')->with(['sukses' => 'Data telah ditambah']);
        // end import
    }

    // delete
    public function delete($id_absensi,$tahun,$bulan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('absensi')->where('id_absensi',$id_absensi)->delete();
        return redirect('admin/absensi?bulan='.$bulan.'&tahun='.$tahun.'&thbl=submit')->with(['sukses' => 'Data telah dihapus']);
    }
}
