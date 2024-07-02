<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
// panggil model
use App\Models\Diklat_model;
use App\Models\Pegawai_model;
use App\Models\Jenis_pelatihan_model;
use App\Models\Rumpun_model;
use App\Models\Metode_diklat_model;
use App\Models\Kategori_diklat_model;
use App\Models\Kode_diklat_model;
//exell
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Image;
use PDF;

class Diklat extends Controller
{
    // halaman diklat
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_diklat   = new Diklat_model();
        if(isset($_GET['tahun'])) {
            $tahun = $_GET['tahun'];
        }else{
            $tahun = date('Y');
        }
        $diklat         = $m_diklat->tahun($tahun);
        $rekap_tahunan  = $m_diklat->rekap_tahunan();

        // print_r($rekap_tahunan);

        $data = [   'title'           => 'Data Master Pelatihan Dan Pendidikan - Tahun '.$tahun,
                    'diklat'          => $diklat,
                    'rekap_tahunan'   => $rekap_tahunan,
                    'tahun'           => $tahun,
                    'content'         => 'admin/diklat/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // laporan
    public function laporan()
    {
        $m_diklat   = new Diklat_model();
        $diklat     = $m_diklat->listing(100000);

        $data = [   'title'           => 'Laporan Diklat',
                    'diklat'          => $diklat
                ];
        return view('admin/diklat/laporan',$data);
    }

    // detail
    public function detail($id_diklat)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data diklat
        $m_pegawai          = new Pegawai_model();
        $m_diklat           = new Diklat_model();
        $m_rumpun           = new Rumpun_model();
        $m_jenis_pelatihan  = new Jenis_pelatihan_model();
        $m_metode_diklat    = new Metode_diklat_model();
        $m_kategori_diklat  = new Kategori_diklat_model();
        $m_kode_diklat      = new Kode_diklat_model();

        
        $rumpun             = $m_rumpun->listing();
        $jenis_pelatihan    = $m_jenis_pelatihan->listing();
        $jenis_metode       = $m_metode_diklat->jenis_metode();
        $metode_diklat      = $m_metode_diklat->listing();
        $kategori_diklat    = $m_kategori_diklat->listing();
        $kode_diklat        = $m_kode_diklat->listing();
        $pegawai            = $m_pegawai->listing();
        $diklat             = $m_diklat->detail($id_diklat);
        $pegawai            = $m_pegawai->nip($diklat->nip);

        $data = [   'title'                 => 'Detail Diklat Pegawai: '.$diklat->nama_lengkap,
                    'diklat'                => $diklat,
                    'rumpun'                => $rumpun,
                    'jenis_pelatihan'       => $jenis_pelatihan,
                    'metode_diklat'         => $metode_diklat,
                    'pegawai'               => $pegawai,
                    'kategori_diklat'       => $kategori_diklat,
                    'kode_diklat'           => $kode_diklat,
                    'jenis_metode'          => $jenis_metode,
                    'content'               => 'admin/diklat/detail'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // proses
    public function proses(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        // proses
        $id_diklat      = $request->id_diklat;
        $status_diklat  = $request->status_diklat;
        $submit         = $request->submit;

        // check berita
        if(empty($id_diklat))
        {
           return redirect('admin/diklat')->with(['warning' => 'Anda belum memilih diklat']);
        }
        // end check berita
        // proses
        if(isset($submit) && $submit=='submit') {
            for($i=0; $i < sizeof($id_diklat);$i++) {
                DB::table('diklat')->where('id_diklat',$id_diklat[$i])->update([
                    'id_pegawai'        => Session()->get('id_pegawai'),
                    'status_diklat'     => $status_diklat
                ]);
            }
        }elseif(isset($submit) && $submit=='delete') {
            for($i=0; $i < sizeof($id_diklat);$i++) {
                DB::table('diklat')->where('id_diklat',$id_diklat[$i])->delete();
            }
        }
        return redirect('admin/diklat')->with(['sukses' => 'Data telah diupdate']);
    }

    // edit
    public function edit($id_diklat)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data diklat
        $m_pegawai          = new Pegawai_model();
        $m_diklat           = new Diklat_model();
        $m_rumpun           = new Rumpun_model();
        $m_jenis_pelatihan  = new Jenis_pelatihan_model();
        $m_metode_diklat    = new Metode_diklat_model();
        $m_kategori_diklat  = new Kategori_diklat_model();
        $m_kode_diklat      = new Kode_diklat_model();

        $pegawai            = $m_pegawai->listing();
        $rumpun             = $m_rumpun->listing();
        $jenis_pelatihan    = $m_jenis_pelatihan->listing();
        $jenis_metode       = $m_metode_diklat->jenis_metode();
        $metode_diklat      = $m_metode_diklat->listing();
        $kategori_diklat    = $m_kategori_diklat->listing();
        $kode_diklat        = $m_kode_diklat->listing();
        $pegawai            = $m_pegawai->listing();
        $diklat             = $m_diklat->detail($id_diklat);

        $data = [   'title'                 => 'Edit Diklat Pegawai : '.$diklat->nama_lengkap,
                    'diklat'                => $diklat,
                    'rumpun'                => $rumpun,
                    'jenis_pelatihan'       => $jenis_pelatihan,
                    'metode_diklat'         => $metode_diklat,
                    'pegawai'               => $pegawai,
                    'kategori_diklat'       => $kategori_diklat,
                    'kode_diklat'           => $kode_diklat,
                    'jenis_metode'          => $jenis_metode,
                    'content'               => 'admin/diklat/edit'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // View tambah diklat pegawai
    public function tambah()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $m_pegawai          = new Pegawai_model();
        $m_diklat           = new Diklat_model();
        $m_rumpun           = new Rumpun_model();
        $m_jenis_pelatihan  = new Jenis_pelatihan_model();
        $m_metode_diklat    = new Metode_diklat_model();
        $m_kategori_diklat  = new Kategori_diklat_model();
        $m_kode_diklat      = new Kode_diklat_model();

        $pegawai            = $m_pegawai->listing();
        $rumpun             = $m_rumpun->listing();
        $jenis_pelatihan    = $m_jenis_pelatihan->listing();
        $jenis_metode       = $m_metode_diklat->jenis_metode();
        $metode_diklat      = $m_metode_diklat->listing();
        $kategori_diklat    = $m_kategori_diklat->listing();
        $kode_diklat        = $m_kode_diklat->listing();
        $pegawai            = $m_pegawai->listing();

        $data = [  
            'title'                 => 'Tambah Data Diklat Pegawai',
            'rumpun'                => $rumpun,
            'jenis_pelatihan'       => $jenis_pelatihan,
            'metode_diklat'         => $metode_diklat,
            'pegawai'               => $pegawai,
            'kategori_diklat'       => $kategori_diklat,
            'kode_diklat'           => $kode_diklat,
            'jenis_metode'          => $jenis_metode,
            'content'               => 'admin/diklat/tambah'
        ];
        return view('admin/layout/wrapper',$data);
    }

    // proses tambah data
    public function proses_tambah(Request $request)
    {
        $m_kode_diklat  = new Kode_diklat_model();
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman

        $id=uniqid();
        
        request()->validate([
                            // 'diklat'        => 'required|unique:id_diklat',
                            'sertifikat'    => 'file|mimetypes:application/pdf,image/png,image/jpg,image/jpeg,image/gif|max:8024',
                            ]);

     
        // UPLOAD START
        $image                  = $request->file('sertifikat');
        $filenamewithextension  = $request->file('sertifikat')->getClientOriginalName();
        $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
        $destinationPath        = './assets/upload/file';
        $image->move($destinationPath, $input['nama_file']);
        // END UPLOAD

            $id_kode_diklat         = $request->id_kode_diklat;
            $kode_diklat            = $m_kode_diklat->detail($id_kode_diklat);
            $id_jenis_pelatihan     = $kode_diklat->id_jenis_pelatihan;
            $id_rumpun              = $kode_diklat->id_rumpun;

            DB::table('diklat')->insert([
                'id_pegawai'            => Session()->get('id_pegawai'),
                'id_kode_diklat'        => $request->id_kode_diklat,
                'id_rumpun'             => $id_rumpun,
                'id_jenis_pelatihan'    => $id_jenis_pelatihan,
                'id_metode_diklat'      => $request->id_metode_diklat,
                'id_kategori_diklat'    => $request->id_kategori_diklat,
                'nip'                   => $request->nip,
                'nama_diklat'           => $request->nama_diklat,
                'tempat_pelaksanaan'    => $request->tempat_pelaksanaan,
                'kategori_diklat'       => $request->kategori_diklat,
                'tanggal_awal'          => date('Y-m-d', strtotime($request->tanggal_awal)),
                'tanggal_akhir'         => date('Y-m-d', strtotime($request->tanggal_akhir)),
                'durasi'                => $request->durasi,
                'jpl'                   => $request->jpl,
                'nomor_sertifikat'      => $request->nomor_sertifikat,
                'tanggal_sertifikat'    => date('Y-m-d', strtotime($request->tanggal_sertifikat)),
                'sertifikat'            => $input['nama_file'],
                'status_diklat'         => $request->status_diklat,
                'tanggal_post'          => date('Y-m-d H:i:s')
            ]);
            
        return redirect('admin/diklat')->with(['sukses' => 'Data telah ditambah']);
    }

    // proses edit data
    public function proses_edit(Request $request)
    {
        $m_kode_diklat  = new Kode_diklat_model();
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        request()->validate([
                            'id_diklat'     => 'required',
                            'sertifikat'    => 'file|mimetypes:application/pdf,image/png,image/jpg,image/jpeg,image/gif|max:8024',
                            ]);

        // UPLOAD START
        $sertifikat = $request->file('foto');
        if(!empty($sertifikat)) {
            $image                  = $request->file('sertifikat');
            $filenamewithextension  = $request->file('sertifikat')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath        = './assets/upload/file';
            $image->move($destinationPath, $input['nama_file']);
            // END UPLOAD

            $id_kode_diklat         = $request->id_kode_diklat;
            $kode_diklat            = $m_kode_diklat->detail($id_kode_diklat);
            $id_jenis_pelatihan     = $kode_diklat->id_jenis_pelatihan;
            $id_rumpun              = $kode_diklat->id_rumpun;

            DB::table('diklat')->where('id_diklat',$request->id_diklat)->update([
                    'id_pegawai'            => Session()->get('id_pegawai'),
                    'id_kode_diklat'        => $request->id_kode_diklat,
                    'id_rumpun'             => $id_rumpun,
                    'id_jenis_pelatihan'    => $id_jenis_pelatihan,
                    'id_metode_diklat'      => $request->id_metode_diklat,
                    'id_kategori_diklat'    => $request->id_kategori_diklat,
                    'nip'                   => $request->nip,
                    'nama_diklat'           => $request->nama_diklat,
                    'tempat_pelaksanaan'    => $request->tempat_pelaksanaan,
                    'kategori_diklat'       => $request->kategori_diklat,
                    'tanggal_awal'          => date('Y-m-d', strtotime($request->tanggal_awal)),
                    'tanggal_akhir'         => date('Y-m-d', strtotime($request->tanggal_akhir)),
                    'durasi'                => $request->durasi,
                    'jpl'                   => $request->jpl,
                    'nomor_sertifikat'      => $request->nomor_sertifikat,
                    'tanggal_sertifikat'    => date('Y-m-d', strtotime($request->tanggal_sertifikat)),
                    'sertifikat'            => $input['nama_file'],
                    'status_diklat'         => $request->status_diklat,
            ]);
        }else{

            $id_kode_diklat         = $request->id_kode_diklat;
            $kode_diklat            = $m_kode_diklat->detail($id_kode_diklat);
            $id_jenis_pelatihan     = $kode_diklat->id_jenis_pelatihan;
            $id_rumpun              = $kode_diklat->id_rumpun;
            
            DB::table('diklat')->where('id_diklat',$request->id_diklat)->update([
                    'id_pegawai'            => Session()->get('id_pegawai'),
                    'id_kode_diklat'        => $request->id_kode_diklat,
                    'id_rumpun'             => $id_rumpun,
                    'id_jenis_pelatihan'    => $id_jenis_pelatihan,
                    'id_metode_diklat'      => $request->id_metode_diklat,
                    'id_kategori_diklat'    => $request->id_kategori_diklat,
                    'nip'                   => $request->nip,
                    'nama_diklat'           => $request->nama_diklat,
                    'tempat_pelaksanaan'    => $request->tempat_pelaksanaan,
                    'kategori_diklat'       => $request->kategori_diklat,
                    'tanggal_awal'          => date('Y-m-d', strtotime($request->tanggal_awal)),
                    'tanggal_akhir'         => date('Y-m-d', strtotime($request->tanggal_akhir)),
                    'durasi'                => $request->durasi,
                    'jpl'                   => $request->jpl,
                    'nomor_sertifikat'      => $request->nomor_sertifikat,
                    'tanggal_sertifikat'    => date('Y-m-d', strtotime($request->tanggal_sertifikat)),
                    'status_diklat'         => $request->status_diklat,
            ]);
        }
        return redirect('admin/diklat')->with(['sukses' => 'Data telah diedit']);
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

        $data = [   'title'     => 'Import Data Kodefikasi Jenis Pelatihan',
                    'content'   => 'admin/diklat/import'
                ];
        return view('admin/layout/wrapper',$data);
    }

    public function proses_import(Request $request)
    {
        // proteksi halaman
        if(session()->get('username') == "") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        
        // start import
        $request->validate([
            'file_excel' => 'required|file|mimes:xls,xlsx,csv|max:8024',
        ]);
        
        // UPLOAD START
        $image = $request->file('file_excel');
        $filenamewithextension = $request->file('file_excel')->getClientOriginalName();
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $input['nama_file'] = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
        $destinationPath = './assets/upload/file';
        $image->move($destinationPath, $input['nama_file']);
        // END UPLOAD
        
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load('./assets/upload/file/'.$input['nama_file']);
        $worksheet = $spreadsheet->getActiveSheet();
        
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
            if($i>2) {
                $diklat                = $rows[$i][1];
                $detail_jenis_pelatihan     = $rows[$i][2];
                $jenis_pelatihan            = $rows[$i][3];
                $rumpun_pelatihan           = $rows[$i][4];
                
                if ($diklat != '') {
                    $existing = DB::table('diklat')->where('diklat', $diklat)->first();
                    
                    if ($existing) {
                        DB::table('diklat')->where('diklat', $diklat)->update([
                            'diklat' => $diklat,
                            'detail_jenis_pelatihan' => $detail_jenis_pelatihan,
                            'jenis_pelatihan' => $jenis_pelatihan,
                            'rumpun_pelatihan' => $rumpun_pelatihan
                        ]);
                    } else {
                        DB::table('diklat')->insert([
                            'diklat' => $diklat,
                            'detail_jenis_pelatihan' => $detail_jenis_pelatihan,
                            'jenis_pelatihan' => $jenis_pelatihan,
                            'rumpun_pelatihan' => $rumpun_pelatihan
                        ]);
                    }
                }
            }
            $i++;
        }
        
        // hapus
        unlink('./assets/upload/file/'.$input['nama_file']);
        return redirect('admin/diklat')->with(['sukses' => 'Data telah ditambah']);
    }

    // delete
    public function delete($id_diklat)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('diklat')->where('id_diklat',$id_diklat)->delete();
        return redirect('admin/diklat')->with(['sukses' => 'Data telah dihapus']);
    }
}
