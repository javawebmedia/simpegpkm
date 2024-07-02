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
use App\Models\Diklat_model;
use App\Models\Kehadiran_model;
use App\Models\Str_sip_model;

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
        $id_pegawai         = Session()->get('id_pegawai');
        $m_pegawai          = new Pegawai_model();
        $m_riwayat_jabatan  = new Riwayat_jabatan_model();
        $m_pendidikan       = new Pendidikan_model();
        $m_keluarga         = new Keluarga_model();
        $m_kehadiran        = new Kehadiran_model();
        $m_str_sip          = new Str_sip_model();

        $pegawai            = $m_pegawai->detail($id_pegawai);
        $riwayat_jabatan    = $m_riwayat_jabatan->pegawai($id_pegawai);
        $pendidikan         = $m_pendidikan->pegawai($id_pegawai);
        $keluarga           = $m_keluarga->pegawai($id_pegawai);
        $m_site = new Konfigurasi_model();
        $site   = $m_site->listing();

        $m_diklat   = new Diklat_model();
        $nip        = Session()->get('nip');
        $diklat     = $m_diklat->nip($nip);
        $diklat_jpl = $m_diklat->nip_total($nip);

        $pin                = $pegawai->pin;
        $hari_ini           = date('Y-m-d');
        $bulan_ini          = date('Ym');
        $tahun_ini          = date('Y');

        $telat_harian       = $m_kehadiran->telat_harian($pin,$hari_ini);
        $telat_bulanan      = $m_kehadiran->telat_bulanan($pin,$bulan_ini);
        $telat_tahunan      = $m_kehadiran->telat_tahunan($pin,$tahun_ini);
        $str_sip            = $m_str_sip->pegawai($id_pegawai);

        $data = [   'title'             => $pegawai->gelar_depan.' '.$pegawai->nama_lengkap.' '.$pegawai->gelar_belakang.' (NIP: '.$pegawai->nip.')',
                    'pegawai'           => $pegawai,
                    'riwayat_jabatan'   => $riwayat_jabatan,
                    'pendidikan'        => $pendidikan,
                    'keluarga'          => $keluarga,
                    'site'              => $site,
                    'diklat_jpl'        => $diklat_jpl,
                    'telat_harian'      => $telat_harian,
                    'telat_bulanan'     => $telat_bulanan,
                    'telat_tahunan'     => $telat_tahunan,
                    'str_sip'           => $str_sip,
                    'content'           => 'pegawai/dasbor/index'
                ];
        return view('pegawai/layout/wrapper',$data);
    }

    // halaman kelola riwayat pegawai
    public function riwayat()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $id_pegawai         = Session()->get('id_pegawai');
        $m_pegawai          = new Pegawai_model();
        $m_riwayat_jabatan  = new Riwayat_jabatan_model();
        $pegawai            = $m_pegawai->detail($id_pegawai);
        $riwayat_jabatan    = $m_riwayat_jabatan->pegawai($id_pegawai);
        $m_pendidikan       = new Pendidikan_model();
        $pendidikan         = $m_pendidikan->pegawai($id_pegawai);
        $m_keluarga         = new Keluarga_model();
        $keluarga           = $m_keluarga->pegawai($id_pegawai);

        $data = [   'title'             => $pegawai->gelar_depan.' '.$pegawai->nama_lengkap.' '.$pegawai->gelar_belakang.' (NIP: '.$pegawai->nip.')',
                    'pegawai'           => $pegawai,
                    'riwayat_jabatan'   => $riwayat_jabatan,
                    'pendidikan'        => $pendidikan,
                    'keluarga'          => $keluarga,
                    'content'           => 'pegawai/pegawai/riwayat'
                ];
        return view('pegawai/layout/wrapper',$data);
    }

    // edit jabatan
    public function lihat_jabatan($id_riwayat_jabatan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $id_pegawai         = Session()->get('id_pegawai');
        $m_pegawai          = new Pegawai_model();
        $m_riwayat_jabatan  = new Riwayat_jabatan_model();
        $pegawai            = $m_pegawai->detail($id_pegawai);
        $riwayat_jabatan    = $m_riwayat_jabatan->detail($id_riwayat_jabatan);

        $data = [   'title'             => $pegawai->nama_lengkap.' (NIP: '.$pegawai->nip.')',
                    'pegawai'           => $pegawai,
                    'riwayat_jabatan'   => $riwayat_jabatan,
                    'content'           => 'pegawai/pegawai/lihat-jabatan'
                ];
        return view('pegawai/layout/wrapper',$data);
    }

    // edit pendidikan
    public function lihat_pendidikan($id_pendidikan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $id_pegawai         = Session()->get('id_pegawai');
        $m_pegawai          = new Pegawai_model();
        $m_pendidikan       = new Pendidikan_model();
        $pegawai            = $m_pegawai->detail($id_pegawai);
        $pendidikan         = $m_pendidikan->detail($id_pendidikan);

        $data = [   'title'             => $pegawai->nama_lengkap.' (NIP: '.$pegawai->nip.')',
                    'pegawai'           => $pegawai,
                    'pendidikan'        => $pendidikan,
                    'content'           => 'pegawai/pegawai/lihat-pendidikan'
                ];
        return view('pegawai/layout/wrapper',$data);
    }

    // halaman cetak pegawai
    public function cetak()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $id_pegawai = Session()->get('id_pegawai');
        $m_pegawai  = new Pegawai_model();
        $pegawai    = $m_pegawai->detail($id_pegawai);

        $data = [   'title'     => $pegawai->nama_lengkap.' (NIP: '.$pegawai->nip.')',
                    'pegawai'   => $pegawai
                ];
        return view('pegawai/pegawai/cetak',$data);
    }

    // halaman cetak pegawai dan riwayat
    public function cetak_riwayat()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $id_pegawai         = Session()->get('id_pegawai');
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
        return view('pegawai/pegawai/cetak_riwayat',$data);
    }

    // halaman unduh pegawai
    public function unduh()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $id_pegawai = Session()->get('id_pegawai');
        $m_pegawai  = new Pegawai_model();
        $pegawai    = $m_pegawai->detail($id_pegawai);

        $data = [   'title'     => $pegawai->nama_lengkap.' (NIP: '.$pegawai->nip.')',
                    'pegawai'   => $pegawai
                ];
        // mulai unduh pdf
        $config = [
            'format' => 'A4-P', 
        ];
        $pdf        = PDF::loadview('pegawai/pegawai/cetak', $data,[] ,$config);
        $nama_file  = 'cetak-pegawai-'.$pegawai->nama_lengkap.'-'.date('d-m-Y-H-i-s').'.pdf';
        return $pdf->download($nama_file, 'I');
        // end unduh
    }

    // halaman unduh riwayat pegawai
    public function unduh_riwayat()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $id_pegawai         = Session()->get('id_pegawai');
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
        $pdf        = PDF::loadview('pegawai/pegawai/cetak_riwayat', $data,[] ,$config);
        $nama_file  = 'cetak-riwayat-pegawai-'.$pegawai->nama_lengkap.'-'.date('d-m-Y-H-i-s').'.pdf';
        return $pdf->download($nama_file, 'I');
        // end unduh
    }


    // View edit pegawai
    public function edit()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        $id_pegawai         = Session()->get('id_pegawai');
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
            'content'               => 'pegawai/pegawai/edit'
        ];
        return view('pegawai/layout/wrapper',$data);
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
                    'npwp'              => $request->npwp,
                    'rekening'          => $request->rekening,
                    'status_pegawai'    => $request->status_pegawai,
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
                    'npwp'              => $request->npwp,
                    'rekening'          => $request->rekening,
                    'status_pegawai'    => $request->status_pegawai,
                ]);
            }
            // end ganti password
        }
        return redirect('pegawai/pegawai')->with(['sukses' => 'Data telah diedit']);
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
        return redirect('pegawai/pegawai/riwayat#pendidikan')->with(['sukses' => 'Data telah ditambah']);
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
        return redirect('pegawai/pegawai/riwayat#pendidikan')->with(['sukses' => 'Data telah ditambah']);
    }

    // delete penddikan
    public function delete_pendidikan($id_pendidikan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $id_pegawai         = Session()->get('id_pegawai');
        DB::table('pendidikan')->where(array(   'id_pendidikan' => $id_pendidikan,
                                                'id_pegawai'    => $id_pegawai))->delete();
        return redirect('pegawai/pegawai/riwayat#pendidikan')->with(['sukses' => 'Data telah dihapus']);
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

        return redirect('pegawai/pegawai/riwayat#keluarga')->with(['sukses' => 'Data telah ditambah']);
    }

    // edit keluarga
    public function lihat_keluarga($id_keluarga)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $id_pegawai         = Session()->get('id_pegawai');
        $m_pegawai  = new Pegawai_model();
        $m_keluarga = new Keluarga_model();
        $pegawai    = $m_pegawai->detail($id_pegawai);
        $keluarga   = $m_keluarga->detail($id_keluarga);

        $data = [  
            'title'     => $pegawai->nama_lengkap.' (NIP: '.$pegawai->nip.')',
            'pegawai'   => $pegawai,
            'keluarga'  => $keluarga,
            'content'   => 'pegawai/pegawai/lihat-keluarga'
        ];
        return view('pegawai/layout/wrapper',$data);
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

        
        // Simpan data tanpa upload
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

        return redirect('pegawai/pegawai/riwayat#keluarga')->with(['sukses' => 'Data telah di update']);
    }



    // delete penddikan
    public function delete_keluarga($id_keluarga)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $id_pegawai         = Session()->get('id_pegawai');
        DB::table('keluarga')->where(array( 'id_keluarga'   => $id_keluarga,
                                            'id_pegawai'    => $id_pegawai))->delete();
        return redirect('pegawai/pegawai/riwayat#keluarga')->with(['sukses' => 'Data telah dihapus']);
    }
}


