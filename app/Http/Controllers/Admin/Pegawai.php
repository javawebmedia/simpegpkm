<?php

namespace App\Http\Controllers\Admin;

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
use Image;
use PDF;

class Pegawai extends Controller
{
    // halaman pegawai
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_pegawai  = new Pegawai_model();
        $pegawai    = $m_pegawai->listing();

        $data = [   'title'     => 'Data Pegawai',
                    'pegawai'   => $pegawai,
                    'content'   => 'admin/pegawai/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // halaman detail pegawai
    public function detail($id_pegawai)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_pegawai          = new Pegawai_model();
        $m_riwayat_jabatan  = new Riwayat_jabatan_model();
        $m_pendidikan       = new Pendidikan_model();
        $m_keluarga         = new Keluarga_model();
        $pegawai            = $m_pegawai->detail($id_pegawai);
        $riwayat_jabatan    = $m_riwayat_jabatan->pegawai($id_pegawai);
        $pendidikan         = $m_pendidikan->pegawai($id_pegawai);
        $keluarga           = $m_keluarga->pegawai($id_pegawai);

        $data = [   'title'             => $pegawai->nama_lengkap.' (NIP: '.$pegawai->nip.')',
                    'pegawai'           => $pegawai,
                    'riwayat_jabatan'   => $riwayat_jabatan,
                    'pendidikan'        => $pendidikan,
                    'keluarga'          => $keluarga,
                    'content'           => 'admin/pegawai/detail'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // halaman kelola riwayat pegawai
    public function riwayat($id_pegawai)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_pegawai          = new Pegawai_model();
        $m_riwayat_jabatan  = new Riwayat_jabatan_model();
        $pegawai            = $m_pegawai->detail($id_pegawai);
        $riwayat_jabatan    = $m_riwayat_jabatan->pegawai($id_pegawai);
        $m_pendidikan       = new Pendidikan_model();
        $pendidikan         = $m_pendidikan->pegawai($id_pegawai);
        $m_keluarga         = new Keluarga_model();
        $keluarga           = $m_keluarga->pegawai($id_pegawai);

        $data = [   'title'             => $pegawai->nama_lengkap.' (NIP: '.$pegawai->nip.')',
                    'pegawai'           => $pegawai,
                    'riwayat_jabatan'   => $riwayat_jabatan,
                    'pendidikan'        => $pendidikan,
                    'keluarga'          => $keluarga,
                    'content'           => 'admin/pegawai/riwayat'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit jabatan
    public function lihat_jabatan($id_pegawai,$id_riwayat_jabatan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_pegawai          = new Pegawai_model();
        $m_riwayat_jabatan  = new Riwayat_jabatan_model();
        $pegawai            = $m_pegawai->detail($id_pegawai);
        $riwayat_jabatan    = $m_riwayat_jabatan->detail($id_riwayat_jabatan);

        $data = [   'title'             => $pegawai->nama_lengkap.' (NIP: '.$pegawai->nip.')',
                    'pegawai'           => $pegawai,
                    'riwayat_jabatan'   => $riwayat_jabatan,
                    'content'           => 'admin/pegawai/lihat-jabatan'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit pendidikan
    public function lihat_pendidikan($id_pegawai,$id_pendidikan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_pegawai          = new Pegawai_model();
        $m_pendidikan       = new Pendidikan_model();
        $pegawai            = $m_pegawai->detail($id_pegawai);
        $pendidikan         = $m_pendidikan->detail($id_pendidikan);

        $data = [   'title'             => $pegawai->nama_lengkap.' (NIP: '.$pegawai->nip.')',
                    'pegawai'           => $pegawai,
                    'pendidikan'        => $pendidikan,
                    'content'           => 'admin/pegawai/lihat-pendidikan'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // halaman cetak pegawai
    public function cetak($id_pegawai)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_pegawai  = new Pegawai_model();
        $pegawai    = $m_pegawai->detail($id_pegawai);

        $data = [   'title'     => $pegawai->nama_lengkap.' (NIP: '.$pegawai->nip.')',
                    'pegawai'   => $pegawai
                ];
        return view('admin/pegawai/cetak',$data);
    }

    // halaman cetak pegawai dan riwayat
    public function cetak_riwayat($id_pegawai)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_pegawai          = new Pegawai_model();
        $m_riwayat_jabatan  = new Riwayat_jabatan_model();
        $m_pendidikan       = new Pendidikan_model();
        $m_keluarga         = new Keluarga_model();
        $pegawai            = $m_pegawai->detail($id_pegawai);
        $riwayat_jabatan    = $m_riwayat_jabatan->pegawai($id_pegawai);
        $pendidikan         = $m_pendidikan->pegawai($id_pegawai);
        $keluarga           = $m_keluarga->pegawai($id_pegawai);

        $data = [   'title'             => $pegawai->nama_lengkap.' (NIP: '.$pegawai->nip.')',
                    'pegawai'           => $pegawai,
                    'riwayat_jabatan'   => $riwayat_jabatan,
                    'pendidikan'        => $pendidikan,
                    'keluarga'          => $keluarga,
                ];
        return view('admin/pegawai/cetak_riwayat',$data);
    }

    // halaman unduh pegawai
    public function unduh($id_pegawai)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_pegawai  = new Pegawai_model();
        $pegawai    = $m_pegawai->detail($id_pegawai);

        $data = [   'title'     => $pegawai->nama_lengkap.' (NIP: '.$pegawai->nip.')',
                    'pegawai'   => $pegawai
                ];
        // mulai unduh pdf
        $config = [
            'format' => 'A4-P', 
        ];
        $pdf        = PDF::loadview('admin/pegawai/cetak', $data,[] ,$config);
        $nama_file  = 'cetak-pegawai-'.$pegawai->nama_lengkap.'-'.date('d-m-Y-H-i-s').'.pdf';
        return $pdf->download($nama_file, 'I');
        // end unduh
    }

    // halaman unduh riwayat pegawai
    public function unduh_riwayat($id_pegawai)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_pegawai          = new Pegawai_model();
        $m_riwayat_jabatan  = new Riwayat_jabatan_model();
        $m_pendidikan       = new Pendidikan_model();
        $m_keluarga         = new Keluarga_model();
        $pegawai            = $m_pegawai->detail($id_pegawai);
        $riwayat_jabatan    = $m_riwayat_jabatan->pegawai($id_pegawai);
        $pendidikan         = $m_pendidikan->pegawai($id_pegawai);
        $keluarga           = $m_keluarga->pegawai($id_pegawai);

        $data = [   'title'             => $pegawai->nama_lengkap.' (NIP: '.$pegawai->nip.')',
                    'pegawai'           => $pegawai,
                    'riwayat_jabatan'   => $riwayat_jabatan,
                    'pendidikan'        => $pendidikan,
                    'keluarga'          => $keluarga,
                ];
        // mulai unduh pdf
        $config = [
            'format' => 'A4-P', 
        ];
        $pdf        = PDF::loadview('admin/pegawai/cetak_riwayat', $data,[] ,$config);
        $nama_file  = 'cetak-riwayat-pegawai-'.$pegawai->nama_lengkap.'-'.date('d-m-Y-H-i-s').'.pdf';
        return $pdf->download($nama_file, 'I');
        // end unduh
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

        $data = [   'title'     => 'Import Data Pegawai',
                    'content'   => 'admin/pegawai/import'
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
                $nip            = $rows[$i][0];
                $nrk            = $rows[$i][1];
                $nik            = $rows[$i][2];
                $nama_lengkap   = $rows[$i][3];
                $tempat_lahir   = $rows[$i][4];
                // KHUSUS TANGGAL
                $tanggal_lahir  = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($rows[$i][5]);
                $tmt_masuk      = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($rows[$i][6]);
                $jenis_pegawai  = $rows[$i][7];
                $jenis_kelamin  = $rows[$i][8];
                // END TANGGAL
                // chack nrk
                
                // check nip
                $check = DB::table('pegawai')->where('nip',$nip)->count();
                if($check > 0) {
                    // do nothing tidak diimport
                }else{
                    DB::table('pegawai')->insert([
                        'nip'           => $nip,
                        'nrk'           => $nrk,
                        'nik'           => $nik,
                        'nama_lengkap'  => $nama_lengkap,
                        'tempat_lahir'  => $tempat_lahir,
                        'tanggal_lahir' => $tanggal_lahir,
                        'tmt_masuk'     => $tmt_masuk,
                        'password'      => sha1($nip),
                        'akses_level'   => 'Pegawai',
                        'jenis_pegawai' => $jenis_pegawai,
                        'jenis_kelamin' => $jenis_kelamin,
                        'tanggal_post'  => date('Y-m-d H:i:s')
                    ]);
                }
                // end check nip
            }
            $i++;
        }
        // hapus
        unlink('./assets/upload/file/'.$input['nama_file']);
        return redirect('admin/pegawai')->with(['sukses' => 'Data telah diimport']);
        // end import
    }

    // View tambah pegawai
    public function tambah()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $divisi = DB::table('divisi')->orderBy('urutan', 'asc')->get();
        $agama = DB::table('agama')->orderBy('urutan', 'asc')->get();
        $jenjang_pendidikan = DB::table('jenjang_pendidikan')->orderBy('urutan', 'asc')->get();
        // dd($agama);

        $data = [  
            'title'                 => 'Data Pegawai',
            'divisi'                => $divisi,
            'agama'                 => $agama,
            'jenjang_pendidikan'    => $jenjang_pendidikan,
            'content'               => 'admin/pegawai/tambah'
        ];
        return view('admin/layout/wrapper',$data);
    }

    // View edit pegawai
    public function edit($id_pegawai)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $divisi = DB::table('divisi')->orderBy('urutan', 'asc')->get();
        $agama  = DB::table('agama')->orderBy('urutan', 'asc')->get();
        $jenjang_pendidikan = DB::table('jenjang_pendidikan')->orderBy('urutan', 'asc')->get();
        // memanggil data pegawai yang akan diedit
        $m_pegawai  = new Pegawai_model();
        $pegawai    = $m_pegawai->detail($id_pegawai);

        $data = [  
            'title'                 => 'Edit Pegawai: '.$pegawai->nama_lengkap,
            'pegawai'               => $pegawai,
            'divisi'                => $divisi,
            'agama'                 => $agama,
            'jenjang_pendidikan'    => $jenjang_pendidikan,
            'content'               => 'admin/pegawai/edit'
        ];
        return view('admin/layout/wrapper',$data);
    }

    // Proses tambah pegawai
    public function proses_tambah(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        request()->validate([
            'nip'           => 'required|unique:pegawai',
            'nama_lengkap'  => 'required',
            'foto'          => 'file|image|mimes:jpeg,png,jpg|max:8024',
        ]);

        // UPLOAD START
        $image = $request->file('foto');
        if(!empty($image))
        {
            $filenamewithextension  = $request->file('foto')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath        = './assets/upload/images/thumbs/';
            $img = Image::make($image->getRealPath(),array(
                'width'     => 150,
                'height'    => 150,
                'grayscale' => false
            ));
            $img->save($destinationPath.'/'.$input['nama_file']);
            $destinationPath = './assets/upload/images/';
            $image->move($destinationPath, $input['nama_file']);
            // END UPLOAD

            // Simpan data
            DB::table('pegawai')->insert([
                'id_divisi'         => $request->id_divisi,
                'nip'               => $request->nip,
                'nrk'               => $request->nrk,
                'nik'               => $request->nik,
                'nama_lengkap'      => $request->nama_lengkap,
                'nama_panggilan'    => $request->nama_panggilan,
                'gelar_depan'       => $request->gelar_depan,
                'gelar_belakang'    => $request->gelar_belakang,
                'tempat_lahir'      => $request->tempat_lahir,
                'tanggal_lahir'     => date('Y-m-d', strtotime($request->tanggal_lahir)),
                'jenis_kelamin'     => $request->jenis_kelamin,
                'id_agama'          => $request->id_agama,
                'status_perkawinan' => $request->status_perkawinan,
                'telepon'           => $request->telepon,
                'email'             => $request->email,
                'alamat'            => $request->alamat,
                'jenis_pegawai'     => $request->jenis_pegawai,
                'tmt_masuk'         => date('Y-m-d', strtotime($request->tmt_masuk)),
                'keterangan'        => $request->keterangan,
                'akses_level'       => $request->akses_level,
                'password'          => sha1($request->password),
                'status_pegawai'    => $request->status_pegawai,
                'foto'              => $input['nama_file'],
                'npwp'              => $request->npwp,
                'rekening'          => $request->rekening,
                'tanggal_post'      => date('Y-m-d H:i:s')
            ]);
        }
        else
        {
            // Simpan data tanpa upload
            DB::table('pegawai')->insert([
                'id_divisi'         => $request->id_divisi,
                'nip'               => $request->nip,
                'nrk'               => $request->nrk,
                'nik'               => $request->nik,
                'nama_lengkap'      => $request->nama_lengkap,
                'nama_panggilan'    => $request->nama_panggilan,
                'gelar_depan'       => $request->gelar_depan,
                'gelar_belakang'    => $request->gelar_belakang,
                'tempat_lahir'      => $request->tempat_lahir,
                'tanggal_lahir'     => date('Y-m-d', strtotime($request->tanggal_lahir)),
                'jenis_kelamin'     => $request->jenis_kelamin,
                'id_agama'          => $request->id_agama,
                'status_perkawinan' => $request->status_perkawinan,
                'telepon'           => $request->telepon,
                'email'             => $request->email,
                'alamat'            => $request->alamat,
                'jenis_pegawai'     => $request->jenis_pegawai,
                'tmt_masuk'         => date('Y-m-d', strtotime($request->tmt_masuk)),
                'keterangan'        => $request->keterangan,
                'akses_level'       => $request->akses_level,
                'password'          => sha1($request->password),
                'status_pegawai'    => $request->status_pegawai,
                'npwp'              => $request->npwp,
                'rekening'          => $request->rekening,
                'tanggal_post'      => date('Y-m-d H:i:s')
            ]);
        }
        return redirect('admin/pegawai')->with(['sukses' => 'Data telah ditambah']);
    }

    // Proses edit pegawai
    public function proses_edit(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        request()->validate([
            'nip'           => 'required',
            'nama_lengkap'  => 'required',
            'foto'          => 'file|image|mimes:jpeg,png,jpg|max:8024',
        ]);

        // UPLOAD START
        $image = $request->file('foto');
        if(!empty($image))
        {
            $filenamewithextension  = $request->file('foto')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath        = './assets/upload/images/thumbs/';
            $img = Image::make($image->getRealPath(),array(
                'width'     => 150,
                'height'    => 150,
                'grayscale' => false
            ));
            $img->save($destinationPath.'/'.$input['nama_file']);
            $destinationPath = './assets/upload/images/';
            $image->move($destinationPath, $input['nama_file']);
            // END UPLOAD

            // klo password lebih dari 6 dan kurang 32 karakter, passsword diganti
            if(strlen($request->password) >= 6 && strlen($request->password) <= 32) {
                // password diganti
                // Simpan data
                DB::table('pegawai')->where('id_pegawai',$request->id_pegawai)->update([
                    'id_divisi'         => $request->id_divisi,
                    'nip'               => $request->nip,
                    'nrk'               => $request->nrk,
                    'nik'               => $request->nik,
                    'nama_lengkap'      => $request->nama_lengkap,
                    'nama_panggilan'    => $request->nama_panggilan,
                    'gelar_depan'       => $request->gelar_depan,
                    'gelar_belakang'    => $request->gelar_belakang,
                    'tempat_lahir'      => $request->tempat_lahir,
                    'tanggal_lahir'     => date('Y-m-d', strtotime($request->tanggal_lahir)),
                    'jenis_kelamin'     => $request->jenis_kelamin,
                    'id_agama'          => $request->id_agama,
                    'status_perkawinan' => $request->status_perkawinan,
                    'telepon'           => $request->telepon,
                    'email'             => $request->email,
                    'alamat'            => $request->alamat,
                    'jenis_pegawai'     => $request->jenis_pegawai,
                    'tmt_masuk'         => date('Y-m-d', strtotime($request->tmt_masuk)),
                    'keterangan'        => $request->keterangan,
                    'akses_level'       => $request->akses_level,
                    'password'          => sha1($request->password),
                    'status_pegawai'    => $request->status_pegawai,
                    'npwp'              => $request->npwp,
                    'rekening'          => $request->rekening,
                    'foto'              => $input['nama_file']
                ]);
            }else{
                // password tidak diganti
                // Simpan data
                DB::table('pegawai')->where('id_pegawai',$request->id_pegawai)->update([
                    'id_divisi'         => $request->id_divisi,
                    'nip'               => $request->nip,
                    'nrk'               => $request->nrk,
                    'nik'               => $request->nik,
                    'nama_lengkap'      => $request->nama_lengkap,
                    'nama_panggilan'    => $request->nama_panggilan,
                    'gelar_depan'       => $request->gelar_depan,
                    'gelar_belakang'    => $request->gelar_belakang,
                    'tempat_lahir'      => $request->tempat_lahir,
                    'tanggal_lahir'     => date('Y-m-d', strtotime($request->tanggal_lahir)),
                    'jenis_kelamin'     => $request->jenis_kelamin,
                    'id_agama'          => $request->id_agama,
                    'status_perkawinan' => $request->status_perkawinan,
                    'telepon'           => $request->telepon,
                    'email'             => $request->email,
                    'alamat'            => $request->alamat,
                    'jenis_pegawai'     => $request->jenis_pegawai,
                    'tmt_masuk'         => date('Y-m-d', strtotime($request->tmt_masuk)),
                    'keterangan'        => $request->keterangan,
                    'akses_level'       => $request->akses_level,
                    'status_pegawai'    => $request->status_pegawai,
                    'npwp'              => $request->npwp,
                    'rekening'          => $request->rekening,
                    'foto'              => $input['nama_file']
                ]);
            }
            // end ganti password
        }
        else
        {
             // klo password lebih dari 6 dan kurang 32 karakter, passsword diganti
            if(strlen($request->password) >= 6 && strlen($request->password) <= 32) {
                // password diganti
                // Simpan data
                DB::table('pegawai')->where('id_pegawai',$request->id_pegawai)->update([
                    'id_divisi'         => $request->id_divisi,
                    'nip'               => $request->nip,
                    'nrk'               => $request->nrk,
                    'nik'               => $request->nik,
                    'nama_lengkap'      => $request->nama_lengkap,
                    'nama_panggilan'    => $request->nama_panggilan,
                    'gelar_depan'       => $request->gelar_depan,
                    'gelar_belakang'    => $request->gelar_belakang,
                    'tempat_lahir'      => $request->tempat_lahir,
                    'tanggal_lahir'     => date('Y-m-d', strtotime($request->tanggal_lahir)),
                    'jenis_kelamin'     => $request->jenis_kelamin,
                    'id_agama'          => $request->id_agama,
                    'status_perkawinan' => $request->status_perkawinan,
                    'telepon'           => $request->telepon,
                    'email'             => $request->email,
                    'alamat'            => $request->alamat,
                    'jenis_pegawai'     => $request->jenis_pegawai,
                    'tmt_masuk'         => date('Y-m-d', strtotime($request->tmt_masuk)),
                    'keterangan'        => $request->keterangan,
                    'akses_level'       => $request->akses_level,
                    'password'          => sha1($request->password),
                    'status_pegawai'    => $request->status_pegawai,
                    'npwp'              => $request->npwp,
                    'rekening'          => $request->rekening,
                ]);
            }else{
                // password tidak diganti
                // Simpan data
                DB::table('pegawai')->where('id_pegawai',$request->id_pegawai)->update([
                    'id_divisi'         => $request->id_divisi,
                    'nip'               => $request->nip,
                    'nrk'               => $request->nrk,
                    'nik'               => $request->nik,
                    'nama_lengkap'      => $request->nama_lengkap,
                    'nama_panggilan'    => $request->nama_panggilan,
                    'gelar_depan'       => $request->gelar_depan,
                    'gelar_belakang'    => $request->gelar_belakang,
                    'tempat_lahir'      => $request->tempat_lahir,
                    'tanggal_lahir'     => date('Y-m-d', strtotime($request->tanggal_lahir)),
                    'jenis_kelamin'     => $request->jenis_kelamin,
                    'id_agama'          => $request->id_agama,
                    'status_perkawinan' => $request->status_perkawinan,
                    'telepon'           => $request->telepon,
                    'email'             => $request->email,
                    'alamat'            => $request->alamat,
                    'jenis_pegawai'     => $request->jenis_pegawai,
                    'tmt_masuk'         => date('Y-m-d', strtotime($request->tmt_masuk)),
                    'keterangan'        => $request->keterangan,
                    'akses_level'       => $request->akses_level,
                    'status_pegawai'    => $request->status_pegawai,
                    'npwp'              => $request->npwp,
                    'rekening'          => $request->rekening,
                ]);
            }
            // end ganti password
        }
        return redirect('admin/pegawai')->with(['sukses' => 'Data telah diedit']);
    }

    // proses jabatan
    public function proses_jabatan(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        request()->validate([
            'tmt'           => 'required',
            'eselon'        => 'required',
            'gambar'        => 'file|mimetypes:application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/pdf,image/png,image/jpg,image/jpeg,image/gif|max:8024',
        ]);

        // UPLOAD START
        $image = $request->file('gambar');
        if(!empty($image))
        {
            DB::transaction(function () use ($request) {
                $filenamewithextension  = $request->file('gambar')->getClientOriginalName();
                $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath        = './assets/upload/file';
                $image->move($destinationPath, $input['nama_file']);
                // END UPLOAD

                // Simpan data
                DB::table('riwayat_jabatan')->insert([
                    'id_pegawai'        => $request->id_pegawai,
                    'id_divisi'         => $request->id_divisi,
                    'id_jabatan'        => $request->id_jabatan,
                    'id_pendidikan'     => 0,
                    'id_pangkat'        => $request->id_pangkat,
                    'created_by'        => Session()->get('id_pegawai'),
                    'updated_by'        => Session()->get('id_pegawai'),
                    'tmt'               => date('Y-m-d', strtotime($request->tmt)),
                    'eselon'            => $request->eselon,
                    'nomor_sk'          => $request->nomor_sk,
                    'tanggal_sk'        => date('Y-m-d', strtotime($request->tanggal_sk)),
                    'nip_pejabat'       => $request->nip_pejabat,
                    'nama_pejabat'      => $request->nama_pejabat,
                    'jabatan_pejabat'   => $request->jabatan_pejabat,
                    'keterangan'        => $request->keterangan,
                    'gambar'            => $input['nama_file'],
                    'tanggal_post'      => date('Y-m-d H:i:s')
                ]);

                DB::table('pegawai')
                    ->where('id_pegawai', $request->id_pegawai)
                    ->update([
                        'id_jabatan'    => $request->id_jabatan
                    ]);
            });
        }else{
            // Simpan data tanpa upload
            DB::transaction(function () use ($request) {
                DB::table('riwayat_jabatan')->insert([
                    'id_pegawai'        => $request->id_pegawai,
                    'id_divisi'         => $request->id_divisi,
                    'id_jabatan'        => $request->id_jabatan,
                    'id_pendidikan'     => 0,
                    'id_pangkat'        => $request->id_pangkat,
                    'created_by'        => Session()->get('id_pegawai'),
                    'updated_by'        => Session()->get('id_pegawai'),
                    'tmt'               => date('Y-m-d', strtotime($request->tmt)),
                    'eselon'            => $request->eselon,
                    'nomor_sk'          => $request->nomor_sk,
                    'tanggal_sk'        => date('Y-m-d', strtotime($request->tanggal_sk)),
                    'nip_pejabat'       => $request->nip_pejabat,
                    'nama_pejabat'      => $request->nama_pejabat,
                    'jabatan_pejabat'   => $request->jabatan_pejabat,
                    'keterangan'        => $request->keterangan,
                    // 'gambar'            => $input['nama_file'],
                    'tanggal_post'      => date('Y-m-d H:i:s')
                ]);

                DB::table('pegawai')
                    ->where('id_pegawai', $request->id_pegawai)
                    ->update([
                        'id_jabatan'    => $request->id_jabatan
                    ]);
            });
        }
        return redirect('admin/pegawai/riwayat/'.$request->id_pegawai.'#jabatan')->with(['sukses' => 'Data telah ditambah']);
    }

    // edit jabatan
    public function edit_jabatan(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        request()->validate([
            'tmt'           => 'required',
            'eselon'        => 'required',
            'gambar'        => 'file|mimetypes:application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/pdf,image/png,image/jpg,image/jpeg,image/gif|max:8024',
        ]);

        // UPLOAD START
        $image = $request->file('gambar');
        if(!empty($image))
        {
            DB::transaction(function () {

                $filenamewithextension  = $request->file('gambar')->getClientOriginalName();
                $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath        = './assets/upload/file';
                $image->move($destinationPath, $input['nama_file']);
                // END UPLOAD

                // Simpan data
                $jabatan = DB::table('riwayat_jabatan')->where('id_riwayat_jabatan',$request->id_riwayat_jabatan)->update([
                    'id_pegawai'        => $request->id_pegawai,
                    'id_divisi'         => $request->id_divisi,
                    'id_jabatan'        => $request->id_jabatan,
                    'id_pendidikan'     => 0,
                    'id_pangkat'        => $request->id_pangkat,
                    'updated_by'        => Session()->get('id_pegawai'),
                    'tmt'               => date('Y-m-d', strtotime($request->tmt)),
                    'eselon'            => $request->eselon,
                    'nomor_sk'          => $request->nomor_sk,
                    'tanggal_sk'        => date('Y-m-d', strtotime($request->tanggal_sk)),
                    'nip_pejabat'       => $request->nip_pejabat,
                    'nama_pejabat'      => $request->nama_pejabat,
                    'jabatan_pejabat'   => $request->jabatan_pejabat,
                    'keterangan'        => $request->keterangan,
                    'gambar'            => $input['nama_file']
                ]);

                $m_riwayat_jabatan  = new Riwayat_jabatan_model();
                $jabatan_terakhir   = $m_riwayat_jabatan->terakhir($request->id_pegawai);
                // dd($jabatan_terakhir->tmt);

                if(date('Y-m-d', strtotime($request->tmt)) >= $jabatan_terakhir->tmt)
                {
                    DB::table('pegawai')
                    ->where('id_pegawai', $request->id_pegawai)
                    ->update([
                        'id_jabatan'    => $request->id_jabatan
                    ]);
                }
            });
        }else{

            // Simpan data tanpa upload
            DB::transaction(function () use ($request) {
                $jabatan = DB::table('riwayat_jabatan')->where('id_riwayat_jabatan',$request->id_riwayat_jabatan)->update([
                    'id_pegawai'        => $request->id_pegawai,
                    'id_divisi'         => $request->id_divisi,
                    'id_jabatan'        => $request->id_jabatan,
                    'id_pendidikan'     => 0,
                    'id_pangkat'        => $request->id_pangkat,
                    'updated_by'        => Session()->get('id_pegawai'),
                    'tmt'               => date('Y-m-d', strtotime($request->tmt)),
                    'eselon'            => $request->eselon,
                    'nomor_sk'          => $request->nomor_sk,
                    'tanggal_sk'        => date('Y-m-d', strtotime($request->tanggal_sk)),
                    'nip_pejabat'       => $request->nip_pejabat,
                    'nama_pejabat'      => $request->nama_pejabat,
                    'jabatan_pejabat'   => $request->jabatan_pejabat,
                    'keterangan'        => $request->keterangan,
                // 'gambar'            => $input['nama_file'],
                ]);

                $m_riwayat_jabatan  = new Riwayat_jabatan_model();
                $jabatan_terakhir   = $m_riwayat_jabatan->terakhir($request->id_pegawai);
                // dd($jabatan_terakhir->tmt);

                if(date('Y-m-d', strtotime($request->tmt)) >= $jabatan_terakhir->tmt)
                {
                    DB::table('pegawai')
                    ->where('id_pegawai', $request->id_pegawai)
                    ->update([
                        'id_jabatan'    => $request->id_jabatan
                    ]);
                }
            });
        }
        return redirect('admin/pegawai/riwayat/'.$request->id_pegawai.'#jabatan')->with(['sukses' => 'Data telah ditambah']);
    }

    // delete jabatan
    public function delete_jabatan($id_pegawai,$id_riwayat_jabatan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('riwayat_jabatan')->where('id_riwayat_jabatan',$id_riwayat_jabatan)->delete();
        return redirect('admin/pegawai/riwayat/'.$id_pegawai.'#jabatan')->with(['sukses' => 'Data telah dihapus']);
    }

    // proses pendidikan
    public function proses_pendidikan(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        request()->validate([
            'tanggal_lulus' => 'required',
            'nomor_ijazah'   => 'required',
            'gambar'        => 'file|mimetypes:application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/pdf,image/png,image/jpg,image/jpeg,image/gif|max:8024',
        ]);

        // UPLOAD START
        $image = $request->file('gambar');
        if(!empty($image))
        {
            $filenamewithextension  = $request->file('gambar')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath        = './assets/upload/file';
            $image->move($destinationPath, $input['nama_file']);
            // END UPLOAD

            // Simpan data
            DB::table('pendidikan')->insert([
                'id_pegawai'            => $request->id_pegawai,
                'id_jenjang_pendidikan' => $request->id_jenjang_pendidikan,
                'created_by'            => Session()->get('id_pegawai'),
                'updated_by'            => Session()->get('id_pegawai'),
                'tahun_masuk'           => $request->tahun_masuk,
                'tahun_lulus'           => $request->tahun_lulus,
                'tanggal_lulus'         => date('Y-m-d', strtotime($request->tanggal_lulus)),
                'nomor_ijazah'          => $request->nomor_ijazah,
                'nama_sekolah'          => $request->nama_sekolah,
                'kota_sekolah'          => $request->kota_sekolah,
                'keterangan'            => $request->keterangan,
                'gambar'                => $input['nama_file'],
                'tanggal_post'          => date('Y-m-d H:i:s')
            ]);
        }else{
            // Simpan data tanpa upload
            DB::table('pendidikan')->insert([
                'id_pegawai'            => $request->id_pegawai,
                'id_jenjang_pendidikan' => $request->id_jenjang_pendidikan,
                'created_by'            => Session()->get('id_pegawai'),
                'updated_by'            => Session()->get('id_pegawai'),
                'tahun_masuk'           => $request->tahun_masuk,
                'tahun_lulus'           => $request->tahun_lulus,
                'tanggal_lulus'         => date('Y-m-d', strtotime($request->tanggal_lulus)),
                'nomor_ijazah'          => $request->nomor_ijazah,
                'nama_sekolah'          => $request->nama_sekolah,
                'kota_sekolah'          => $request->kota_sekolah,
                'keterangan'            => $request->keterangan,
                // 'gambar'                => $input['nama_file'],
                'tanggal_post'          => date('Y-m-d H:i:s')
            ]);
        }
        return redirect('admin/pegawai/riwayat/'.$request->id_pegawai.'#pendidikan')->with(['sukses' => 'Data telah ditambah']);
    }

    // proses edit pendidikan
    public function edit_pendidikan(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        request()->validate([
            'tanggal_lulus' => 'required',
            'nomor_ijazah'   => 'required',
            'gambar'        => 'file|mimetypes:application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/pdf,image/png,image/jpg,image/jpeg,image/gif|max:8024',
        ]);

        // UPLOAD START
        $image = $request->file('gambar');
        if(!empty($image))
        {
            $filenamewithextension  = $request->file('gambar')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath        = './assets/upload/file';
            $image->move($destinationPath, $input['nama_file']);
            // END UPLOAD

            // Simpan data
            DB::table('pendidikan')->where('id_pendidikan',$request->id_pendidikan)->update([
                'id_pegawai'            => $request->id_pegawai,
                'id_jenjang_pendidikan' => $request->id_jenjang_pendidikan,
                'updated_by'            => Session()->get('id_pegawai'),
                'tahun_masuk'           => $request->tahun_masuk,
                'tahun_lulus'           => $request->tahun_lulus,
                'tanggal_lulus'         => date('Y-m-d', strtotime($request->tanggal_lulus)),
                'nomor_ijazah'          => $request->nomor_ijazah,
                'nama_sekolah'          => $request->nama_sekolah,
                'kota_sekolah'          => $request->kota_sekolah,
                'keterangan'            => $request->keterangan,
                'gambar'                => $input['nama_file'],
            ]);
        }else{
            // Simpan data tanpa upload
            DB::table('pendidikan')->where('id_pendidikan',$request->id_pendidikan)->update([
                'id_pegawai'            => $request->id_pegawai,
                'id_jenjang_pendidikan' => $request->id_jenjang_pendidikan,
                'updated_by'            => Session()->get('id_pegawai'),
                'tahun_masuk'           => $request->tahun_masuk,
                'tahun_lulus'           => $request->tahun_lulus,
                'tanggal_lulus'         => date('Y-m-d', strtotime($request->tanggal_lulus)),
                'nomor_ijazah'          => $request->nomor_ijazah,
                'nama_sekolah'          => $request->nama_sekolah,
                'kota_sekolah'          => $request->kota_sekolah,
                'keterangan'            => $request->keterangan,
                // 'gambar'                => $input['nama_file'],
            ]);
        }
        return redirect('admin/pegawai/riwayat/'.$request->id_pegawai.'#pendidikan')->with(['sukses' => 'Data telah ditambah']);
    }

    // delete penddikan
    public function delete_pendidikan($id_pegawai,$id_pendidikan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('pendidikan')->where('id_pendidikan',$id_pendidikan)->delete();
        return redirect('admin/pegawai/riwayat/'.$id_pegawai.'#pendidikan')->with(['sukses' => 'Data telah dihapus']);
    }

    // proses keluarga
    public function proses_keluarga(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        request()->validate([
            'id_hubungan_keluarga'  => 'required',
            'nama_lengkap'          => 'required',
            'nik'                   => 'required'
        ]);

        
        // Simpan data tanpa upload
        DB::table('keluarga')->insert([
            'id_pegawai'            => $request->id_pegawai,
            'id_hubungan_keluarga'  => $request->id_hubungan_keluarga,
            'id_jenjang_pendidikan' => $request->id_jenjang_pendidikan,
            'id_agama'              => $request->id_agama,
            'id_pekerjaan'          => $request->id_pekerjaan,
            'created_by'            => Session()->get('id_pegawai'),
            'updated_by'            => Session()->get('id_pegawai'),
            'nik'                   => $request->nik,
            'nama_lengkap'          => $request->nama_lengkap,
            'tempat_lahir'          => $request->tempat_lahir,
            'jenis_kelamin'         => $request->jenis_kelamin,
            'tanggal_lahir'         => date('Y-m-d', strtotime($request->tanggal_lahir)),
            'status_perkawinan'     => $request->status_perkawinan,
            'tanggal_post'          => date('Y-m-d H:i:s')
        ]);

        return redirect('admin/pegawai/riwayat/'.$request->id_pegawai.'#keluarga')->with(['sukses' => 'Data telah ditambah']);
    }

    // edit keluarga
    public function lihat_keluarga($id_pegawai,$id_keluarga)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_pegawai  = new Pegawai_model();
        $m_keluarga = new Keluarga_model();
        $pegawai    = $m_pegawai->detail($id_pegawai);
        $keluarga   = $m_keluarga->detail($id_keluarga);

        $data = [  
            'title'     => $pegawai->nama_lengkap.' (NIP: '.$pegawai->nip.')',
            'pegawai'   => $pegawai,
            'keluarga'  => $keluarga,
            'content'   => 'admin/pegawai/lihat-keluarga'
        ];
        return view('admin/layout/wrapper',$data);
    }

    // update keluarga
    public function edit_keluarga(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        request()->validate([
            'id_hubungan_keluarga'  => 'required',
            'nama_lengkap'          => 'required',
            'nik'                   => 'required'
        ]);

        
        //proses simpan data
        DB::table('keluarga')->where('id_keluarga', $request->id_keluarga)->update([
            'id_pegawai'            => $request->id_pegawai,
            'id_hubungan_keluarga'  => $request->id_hubungan_keluarga,
            'id_jenjang_pendidikan' => $request->id_jenjang_pendidikan,
            'id_agama'              => $request->id_agama,
            'id_pekerjaan'          => $request->id_pekerjaan,
            'created_by'            => Session()->get('id_pegawai'),
            'updated_by'            => Session()->get('id_pegawai'),
            'nik'                   => $request->nik,
            'nama_lengkap'          => $request->nama_lengkap,
            'tempat_lahir'          => $request->tempat_lahir,
            'jenis_kelamin'         => $request->jenis_kelamin,
            'tanggal_lahir'         => date('Y-m-d', strtotime($request->tanggal_lahir)),
            'status_perkawinan'     => $request->status_perkawinan,
            'tanggal_updated'          => date('Y-m-d H:i:s')
        ]);

        return redirect('admin/pegawai/riwayat/'.$request->id_pegawai.'#keluarga')->with(['sukses' => 'Data telah di update']);
    }



    // delete penddikan
    public function delete_keluarga($id_pegawai,$id_keluarga)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('keluarga')->where('id_keluarga',$id_keluarga)->delete();
        return redirect('admin/pegawai/riwayat/'.$id_pegawai.'#keluarga')->with(['sukses' => 'Data telah dihapus']);
    }

    // delete
    public function delete($id_pegawai)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('pegawai')->where('id_pegawai',$id_pegawai)->delete();
        return redirect('admin/pegawai')->with(['sukses' => 'Data telah dihapus']);
    }
}


