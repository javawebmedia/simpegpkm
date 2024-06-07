<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\Kode_diklat_model;
use App\Models\Rumpun_model;
use App\Models\Jenis_pelatihan_model;
use Image;
use PDF;

class Kode_diklat extends Controller
{
    // halaman kode_diklat
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_kode_diklat      = new Kode_diklat_model();
        $m_rumpun           = new Rumpun_model();
        $m_jenis_pelatihan  = new Jenis_pelatihan_model();

        $kode_diklat        = $m_kode_diklat->listing();
        $rumpun             = $m_rumpun->listing();
        $jenis_pelatihan    = $m_jenis_pelatihan->listing();

        $data = [   'title'             => 'Data Master Kodifikasi Diklat',
                    'kode_diklat'       => $kode_diklat,
                    'rumpun'            => $rumpun,
                    'jenis_pelatihan'   => $jenis_pelatihan,
                    'rumpun2'           => $rumpun,
                    'jenis_pelatihan2'  => $jenis_pelatihan,
                    'content'           => 'admin/kode_diklat/index'
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
        $id_kode_diklat     = $request->id_kode_diklat;
        $id_rumpun          = $request->id_rumpun;
        $id_jenis_pelatihan = $request->id_jenis_pelatihan;

        // check berita
        if(empty($id_kode_diklat))
        {
           return redirect('admin/kode-diklat')->with(['warning' => 'Anda belum memilih diklat']);
        }
        // end check berita
        // proses
        if(isset($_POST['submit'])) {
            for($i=0; $i < sizeof($id_kode_diklat);$i++) {
                DB::table('kode_diklat')->where('id_kode_diklat',$id_kode_diklat[$i])->update([
                    'id_pegawai'            => Session()->get('id_pegawai'),
                    'id_rumpun'             => $id_rumpun,
                    'id_jenis_pelatihan'    => $id_jenis_pelatihan
                ]);
            }
        }
        return redirect('admin/kode-diklat')->with(['sukses' => 'Data telah diupdate']);
    }

    // edit
    public function edit($id_kode_diklat)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data kode_diklat
        $m_kode_diklat      = new Kode_diklat_model();
        $m_rumpun           = new Rumpun_model();
        $m_jenis_pelatihan  = new Jenis_pelatihan_model();

        $kode_diklat        = $m_kode_diklat->detail($id_kode_diklat);
        $rumpun             = $m_rumpun->listing();
        $jenis_pelatihan    = $m_jenis_pelatihan->listing();

        $data = [   'title'             => 'Edit Kode Diklat: '.$kode_diklat->kode_diklat,
                    'kode_diklat'       => $kode_diklat,
                    'rumpun'            => $rumpun,
                    'jenis_pelatihan'   => $jenis_pelatihan,
                    
                    'content'           => 'admin/kode_diklat/edit'
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

        $id=uniqid();
        
        request()->validate([
                            'kode_diklat' => 'required|unique:kode_diklat',
                            ]);

        DB::table('kode_diklat')->insert([
            'id_pegawai'            => Session()->get('id_pegawai'),
            'id_rumpun'             => $request->id_rumpun,
            'id_jenis_pelatihan'    => $request->id_jenis_pelatihan,
            'kode_diklat'           => $request->kode_diklat,
            'nama_kode_diklat'      => $request->nama_kode_diklat,
            'keterangan'            => $request->keterangan,
            'status_aktif'          => $request->status_aktif,
            'urutan'                => $request->urutan
        ]);
        return redirect('admin/kode-diklat')->with(['sukses' => 'Data telah ditambah']);
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
                            'kode_diklat' => [
                                'required',
                                Rule::unique('kode_diklat', 'kode_diklat')->ignore($request->id_kode_diklat, 'id_kode_diklat')
                            ],
                            ]);

        DB::table('kode_diklat')->where('id_kode_diklat',$request->id_kode_diklat)->update([
            'id_pegawai'            => Session()->get('id_pegawai'),
            'id_rumpun'             => $request->id_rumpun,
            'id_jenis_pelatihan'    => $request->id_jenis_pelatihan,
            'kode_diklat'           => $request->kode_diklat,
            'nama_kode_diklat'      => $request->nama_kode_diklat,
            'keterangan'            => $request->keterangan,
            'status_aktif'          => $request->status_aktif,
            'urutan'                => $request->urutan
        ]);
        return redirect('admin/kode-diklat')->with(['sukses' => 'Data telah diedit']);
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
                    'content'   => 'admin/kode_diklat/import'
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
                $kode_diklat                = $rows[$i][1];
                $nama_kode_diklat     = $rows[$i][2];
                $keterangan            = $rows[$i][3];
                $status_aktif           = $rows[$i][4];
                
                if ($kode_diklat != '') {
                    $existing = DB::table('kode_diklat')->where('kode_diklat', $kode_diklat)->first();
                    
                    if ($existing) {
                        DB::table('kode_diklat')->where('kode_diklat', $kode_diklat)->update([
                            'kode_diklat' => $kode_diklat,
                            'nama_kode_diklat' => $nama_kode_diklat,
                            'keterangan' => $keterangan,
                            'status_aktif' => $status_aktif
                        ]);
                    } else {
                        DB::table('kode_diklat')->insert([
                            'kode_diklat' => $kode_diklat,
                            'nama_kode_diklat' => $nama_kode_diklat,
                            'keterangan' => $keterangan,
                            'status_aktif' => $status_aktif
                        ]);
                    }
                }
            }
            $i++;
        }
        
        // hapus
        unlink('./assets/upload/file/'.$input['nama_file']);
        return redirect('admin/kode-diklat')->with(['sukses' => 'Data telah ditambah']);
    }

    // delete
    public function delete($id_kode_diklat)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('kode_diklat')->where('id_kode_diklat',$id_kode_diklat)->delete();
        return redirect('admin/kode-diklat')->with(['sukses' => 'Data telah dihapus']);
    }
}
