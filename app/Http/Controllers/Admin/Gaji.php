<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Pegawai_model;
use App\Models\Gaji_model;
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
        // ambil data gaji
        $m_gaji     = new Gaji_model();
        $m_pegawai  = new Pegawai_model();
        $gaji       = $m_gaji->thbl($thbl);
        $pegawai    = $m_pegawai->listing();

        $data = [   'title'     => 'Data Master Gaji: '.$thbl,
                    'gaji'      => $gaji,
                    'pegawai'   => $pegawai,
                    'thbl'      => $thbl,
                    'tahun'     => $tahun,
                    'bulan'     => $bulan,
                    'content'   => 'admin/gaji/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_gaji,$tahun,$bulan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $thbl       = $tahun.$bulan;
        // ambil data gaji
        $m_gaji     = new Gaji_model();
        $m_pegawai  = new Pegawai_model();
        $gaji       = $m_gaji->detail($id_gaji);
        $pegawai    = $m_pegawai->listing();

        $data = [   'title'     => 'Edit Master Gaji: '.$thbl,
                    'gaji'      => $gaji,
                    'pegawai'   => $pegawai,
                    'thbl'      => $thbl,
                    'tahun'     => $tahun,
                    'bulan'     => $bulan,
                    'content'   => 'admin/gaji/edit'
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
        $thbl       = $request->tahun.$request->bulan;
        $nip        = $request->nip;
        $m_gaji     = new Gaji_model();
        $check      = $m_gaji->thbl_pegawai($thbl,$nip);
        if($check) {
            DB::table('gaji')->where(['nip' => $check->nip, 'thbl' => $check->thbl])->update([
                'id_pegawai'        => Session()->get('id_pegawai'),
                'nip'               => $request->nip,
                'tmt'               => date('Y-m-d',strtotime($request->tmt)),
                'thbl'              => $request->tahun.$request->bulan,
                'bulan'             => $request->bulan,
                'tahun'             => $request->tahun,
                'gaji'              => $request->gaji,
                'tunjangan'         => $request->tunjangan,
                'tkd'               => $request->tkd,
                'pengali'           => $request->pengali,
                'bpjs_kes'          => $request->bpjs_kes,
                'bpjs_tk'           => $request->bpjs_tk,
                'potongan_lainnya'  => $request->potongan_lainnya,
                'pph_gaji'          => $request->pph_gaji,
                'pph_tkd'           => $request->pph_tkd,
                'keterangan'        => $request->keterangan,
                'tunjangan_jabatan'         => $request->tunjangan_jabatan,
            ]); 
        }else{
           DB::table('gaji')->insert([
                'id_pegawai'        => Session()->get('id_pegawai'),
                'nip'               => $request->nip,
                'tmt'               => date('Y-m-d',strtotime($request->tmt)),
                'thbl'              => $request->tahun.$request->bulan,
                'bulan'             => $request->bulan,
                'tahun'             => $request->tahun,
                'gaji'              => $request->gaji,
                'tunjangan'         => $request->tunjangan,
                'tkd'               => $request->tkd,
                'pengali'           => $request->pengali,
                'bpjs_kes'          => $request->bpjs_kes,
                'bpjs_tk'           => $request->bpjs_tk,
                'potongan_lainnya'  => $request->potongan_lainnya,
                'pph_gaji'          => $request->pph_gaji,
                'pph_tkd'           => $request->pph_tkd,
                'keterangan'        => $request->keterangan,
                'tunjangan_jabatan'         => $request->tunjangan_jabatan,
                'tanggal_post'      => date('Y-m-d H:i:s')
            ]); 
        }
        
        return redirect('admin/gaji?bulan='.$request->bulan.'&tahun='.$request->tahun.'&thbl=submit')->with(['sukses' => 'Data telah ditambah']);
    }

    // proses edit data
    public function proses_edit(Request $request)
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
        $m_gaji     = new Gaji_model();
        $check      = $m_gaji->thbl_pegawai($thbl,$nip);

            DB::table('gaji')->where('id_gaji',$request->id_gaji)->update([
                'id_pegawai'        => Session()->get('id_pegawai'),
                'nip'               => $request->nip,
                'tmt'               => date('Y-m-d',strtotime($request->tmt)),
                'thbl'              => $request->tahun.$request->bulan,
                'bulan'             => $request->bulan,
                'tahun'             => $request->tahun,
                'gaji'              => $request->gaji,
                'tunjangan'         => $request->tunjangan,
                'tkd'               => $request->tkd,
                'pengali'           => $request->pengali,
                'bpjs_kes'          => $request->bpjs_kes,
                'bpjs_tk'           => $request->bpjs_tk,
                'potongan_lainnya'  => $request->potongan_lainnya,
                'pph_gaji'          => $request->pph_gaji,
                'pph_tkd'           => $request->pph_tkd,
                'keterangan'        => $request->keterangan,
                'tunjangan_jabatan'         => $request->tunjangan_jabatan,
            ]); 
        return redirect('admin/gaji?bulan='.$request->bulan.'&tahun='.$request->tahun.'&thbl=submit')->with(['sukses' => 'Data telah ditambah']);
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

        $data = [   'title'     => 'Import Data Gaji Pegawai',
                    'content'   => 'admin/gaji/import'
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
        $m_gaji     = new Gaji_model();
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
                $nip                = $rows[$i][0];
                // Check if TMT is not null before converting
                $tmt                = !empty($rows[$i][2]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($rows[$i][2]) : null;
                $gaji               = $rows[$i][3];
                $pengali            = $rows[$i][4];
                $bpjs_kes           = $rows[$i][5];
                $bpjs_tk            = $rows[$i][6];
                $potongan_lainnya   = $rows[$i][7];
                $keterangan         = $rows[$i][8];
                $tunjangan          = $rows[$i][9];
                $tkd                = $rows[$i][10];
                $pph_gaji           = $rows[$i][11];
                $pph_tkd            = $rows[$i][12];
                $tunjangan_jabatan  = $rows[$i][13];
                // check nip
                // check
                $thbl       = $request->tahun.$request->bulan;
                
                if($nip=='') {

                }else{
                    $check      = $m_gaji->thbl_pegawai($thbl,$nip);
                    if($check) {
                        DB::table('gaji')->where(['nip' => $nip, 'thbl' => $thbl])->update([
                            'id_pegawai'        => Session()->get('id_pegawai'),
                            'nip'               => $nip,
                            'tmt'               => $tmt,
                            'thbl'              => $request->tahun.$request->bulan,
                            'bulan'             => $request->bulan,
                            'tahun'             => $request->tahun,
                            'gaji'              => $gaji,
                            'tunjangan'         => $tunjangan,
                            'tkd'               => $tkd,
                            'pengali'           => $pengali,
                            'bpjs_kes'          => $bpjs_kes,
                            'bpjs_tk'           => $bpjs_tk,
                            'potongan_lainnya'  => $potongan_lainnya,
                            'pph_gaji'          => $pph_gaji,
                            'pph_tkd'           => $pph_tkd,
                            'keterangan'        => $keterangan,
                            'tunjangan_jabatan' => $tunjangan_jabatan
                        ]); 
                    }else{
                       DB::table('gaji')->insert([
                            'id_pegawai'        => Session()->get('id_pegawai'),
                            'nip'               => $nip,
                            'tmt'               => $tmt,
                            'thbl'              => $request->tahun.$request->bulan,
                            'bulan'             => $request->bulan,
                            'tahun'             => $request->tahun,
                            'gaji'              => $gaji,
                            'tunjangan'         => $tunjangan,
                            'tkd'               => $tkd,
                            'pengali'           => $pengali,
                            'bpjs_kes'          => $bpjs_kes,
                            'bpjs_tk'           => $bpjs_tk,
                            'potongan_lainnya'  => $potongan_lainnya,
                            'pph_gaji'          => $pph_gaji,
                            'pph_tkd'           => $pph_tkd,
                            'keterangan'        => $keterangan,
                            'tunjangan_jabatan' => $tunjangan_jabatan,
                            'tanggal_post'      => date('Y-m-d H:i:s')
                        ]); 
                    }
                }
                
                // end check nip
            }
            $i++;
        }
        // hapus
        unlink('./assets/upload/file/'.$input['nama_file']);
        return redirect('admin/gaji?bulan='.$request->bulan.'&tahun='.$request->tahun.'&thbl=submit')->with(['sukses' => 'Data telah ditambah']);
        // end import
    }

    // delete
    public function delete($id_gaji,$tahun,$bulan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('gaji')->where('id_gaji',$id_gaji)->delete();
        return redirect('admin/gaji?bulan='.$bulan.'&tahun='.$tahun.'&thbl=submit')->with(['sukses' => 'Data telah dihapus']);
    }
}
