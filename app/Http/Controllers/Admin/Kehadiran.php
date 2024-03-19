<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Pegawai_model;
use App\Models\Kehadiran_model;
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
        if(isset($_GET['tanggal'])) {
            $tahun  = $_GET['tahun'];
            $bulan  = $_GET['bulan'];
            $tanggal   = $_GET['tanggal'];
        }else{
            $tahun  = date('Y');
            $bulan  = date('m');
            $tanggal   = date('Y-m-d');
        }
        // ambil data kehadiran
        $m_kehadiran  = new Kehadiran_model();
        $m_pegawai  = new Pegawai_model();
        $kehadiran    = $m_kehadiran->tanggal($tanggal);
        $pegawai    = $m_pegawai->listing();

        $data = [   'title'     => 'Data Master Kehadiran: '.$tanggal,
                    'kehadiran'      => $kehadiran,
                    'pegawai'   => $pegawai,
                    'tanggal'      => $tanggal,
                    'tahun'     => $tahun,
                    'bulan'     => $bulan,
                    'content'   => 'admin/kehadiran/index'
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
        request()->validate([
                            'tahun'     => 'required',
                            'bulan'     => 'required',
                            'nip'       => 'required',
                            ]);
        // check
        $tanggal        = $request->tanggal;
        $nip            = $request->nip;
        $m_kehadiran    = new Kehadiran_model();
        $check          = $m_kehadiran->tanggal_pegawai($tanggal,$nip);
        if($check) {
            DB::table('kehadiran')->where(['nip' => $check->nip, 'tanggal' => $check->tanggal])->update([
                'id_pegawai'        => Session()->get('id_pegawai'),
                'nip'               => $request->nip,
                'tanggal'              => $request->tahun.$request->bulan,
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
           DB::table('kehadiran')->insert([
                'id_pegawai'        => Session()->get('id_pegawai'),
                'nip'               => $request->nip,
                'tanggal'           => $request->tahun.$request->bulan,
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
        
        return redirect('admin/kehadiran?bulan='.$request->bulan.'&tahun='.$request->tahun.'&tanggal=submit')->with(['sukses' => 'Data telah ditambah']);
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
                $tanggal               = $request->tahun.$request->bulan;
                

                $kehadiran            = $m_kehadiran->tanggal($tanggal);
                

                if($nrk=='') {

                }else{
                    $pegawai    = $m_pegawai->nrk($nrk);
                    if($pegawai) {
                    $nip        = $pegawai->nip;
                    $check      = $m_kehadiran->tanggal_pegawai($tanggal,$nip);

                    if($check) {
                        DB::table('kehadiran')->where(['nip' => $nip, 'tanggal' => $tanggal])->update([
                            'id_pegawai'        => Session()->get('id_pegawai'),
                            'nip'               => $nip,
                            'nrk'               => $nrk,
                            'tanggal'              => $request->tahun.$request->bulan,
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
                            'tanggal'              => $request->tahun.$request->bulan,
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
        return redirect('admin/kehadiran?bulan='.$request->bulan.'&tahun='.$request->tahun.'&tanggal=submit')->with(['sukses' => 'Data telah ditambah']);
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
        return redirect('admin/kehadiran?bulan='.$bulan.'&tahun='.$tahun.'&tanggal=submit')->with(['sukses' => 'Data telah dihapus']);
    }
}
