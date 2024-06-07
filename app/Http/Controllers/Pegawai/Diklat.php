<?php

namespace App\Http\Controllers\Pegawai;

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
use App\Models\Atasan_model;
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
        $nip        = Session()->get('nip');
        $diklat     = $m_diklat->nip($nip);
        $diklat_jpl = $m_diklat->nip_total($nip);

        $data = [   'title'         => 'Data Pelatihan Dan Pendidikan',
                    'diklat'        => $diklat,
                    'diklat_jpl'    => $diklat_jpl,
                    'content'       => 'pegawai/diklat/index'
                ];
        return view('pegawai/layout/wrapper',$data);
    }

    // halaman approval
    public function approval()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_diklat   = new Diklat_model();
        $diklat     = $m_diklat->listing(2500);

        $data = [   'title'           => 'Approval Pelatihan Dan Pendidikan',
                    'diklat'          => $diklat,
                    'content'         => 'pegawai/diklat/approval'
                ];
        return view('pegawai/layout/wrapper',$data);
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
           return redirect('pegawai/diklat/approval')->with(['warning' => 'Anda belum memilih diklat']);
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
        return redirect('pegawai/diklat/approval')->with(['sukses' => 'Data telah diupdate']);
    }

    // detail
    public function detail($id_diklat)
    {
        $nip        = Session()->get('nip');
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

        if($diklat->nip != $nip) {
            $last_page = url()->full();
            return redirect('pegawai/diklat?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $data = [   'title'                 => 'Detail Diklat Pegawai: '.$diklat->nama_lengkap,
                    'diklat'                => $diklat,
                    'rumpun'                => $rumpun,
                    'jenis_pelatihan'       => $jenis_pelatihan,
                    'metode_diklat'         => $metode_diklat,
                    'pegawai'               => $pegawai,
                    'kategori_diklat'       => $kategori_diklat,
                    'kode_diklat'           => $kode_diklat,
                    'jenis_metode'          => $jenis_metode,
                    'content'               => 'pegawai/diklat/detail'
                ];
        return view('pegawai/layout/wrapper',$data);
    }

    // detail_pimpinan
    public function detail_pimpinan($id_diklat)
    {
        $nip        = Session()->get('nip');
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
                    'content'               => 'pegawai/diklat/detail'
                ];
        return view('pegawai/layout/wrapper',$data);
    }


    // edit
    public function edit($id_diklat)
    {
        $nip        = Session()->get('nip');
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

        if($diklat->nip != $nip) {
            $last_page = url()->full();
            return redirect('pegawai/diklat?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $data = [   'title'                 => 'Edit Diklat Pegawai : '.$diklat->nama_lengkap,
                    'diklat'                => $diklat,
                    'rumpun'                => $rumpun,
                    'jenis_pelatihan'       => $jenis_pelatihan,
                    'metode_diklat'         => $metode_diklat,
                    'pegawai'               => $pegawai,
                    'kategori_diklat'       => $kategori_diklat,
                    'kode_diklat'           => $kode_diklat,
                    'jenis_metode'          => $jenis_metode,
                    'content'               => 'pegawai/diklat/edit'
                ];
        return view('pegawai/layout/wrapper',$data);
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

        $m_atas       = new Atasan_model();
        $id_pegawai   = Session()->get('id_pegawai');
        $atas         = $m_atas->pegawai($id_pegawai);

        $data = [  
            'title'                 => 'Tambah Data Diklat Pegawai',
            'rumpun'                => $rumpun,
            'jenis_pelatihan'       => $jenis_pelatihan,
            'metode_diklat'         => $metode_diklat,
            'pegawai'               => $pegawai,
            'kategori_diklat'       => $kategori_diklat,
            'kode_diklat'           => $kode_diklat,
            'jenis_metode'          => $jenis_metode,
            'atas'                  => $atas,
            'content'               => 'pegawai/diklat/tambah'
        ];
        return view('pegawai/layout/wrapper',$data);
    }

    // proses tambah data
    public function proses_tambah(Request $request)
    {
        $nip        = Session()->get('nip');
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

            DB::table('diklat')->insert([
                'id_pegawai'            => Session()->get('id_pegawai'),
                'id_kode_diklat'        => $request->id_kode_diklat,
                'id_rumpun'             => $request->id_rumpun,
                'id_jenis_pelatihan'    => $request->id_jenis_pelatihan,
                'id_metode_diklat'      => $request->id_metode_diklat,
                'id_kategori_diklat'    => $request->id_kategori_diklat,
                'nip'                   => $nip,
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
                'status_diklat'         => 'Menunggu',
                'tanggal_post'          => date('Y-m-d H:i:s')
            ]);
            
        return redirect('pegawai/diklat')->with(['sukses' => 'Data telah ditambah']);
    }

    // proses edit data
    public function proses_edit(Request $request)
    {
        $nip        = Session()->get('nip');
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

            DB::table('diklat')->where('id_diklat',$request->id_diklat)->update([
                    'id_pegawai'            => Session()->get('id_pegawai'),
                    'id_kode_diklat'        => $request->id_kode_diklat,
                    'id_rumpun'             => $request->id_rumpun,
                    'id_jenis_pelatihan'    => $request->id_jenis_pelatihan,
                    'id_metode_diklat'      => $request->id_metode_diklat,
                    'id_kategori_diklat'    => $request->id_kategori_diklat,
                    'nip'                   => $nip,
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
                    'status_diklat'         => 'Menunggu',
            ]);
        }else{
            DB::table('diklat')->where('id_diklat',$request->id_diklat)->update([
                    'id_pegawai'            => Session()->get('id_pegawai'),
                    'id_kode_diklat'        => $request->id_kode_diklat,
                    'id_rumpun'             => $request->id_rumpun,
                    'id_jenis_pelatihan'    => $request->id_jenis_pelatihan,
                    'id_metode_diklat'      => $request->id_metode_diklat,
                    'id_kategori_diklat'    => $request->id_kategori_diklat,
                    'nip'                   => $nip,
                    'nama_diklat'           => $request->nama_diklat,
                    'tempat_pelaksanaan'    => $request->tempat_pelaksanaan,
                    'kategori_diklat'       => $request->kategori_diklat,
                    'tanggal_awal'          => date('Y-m-d', strtotime($request->tanggal_awal)),
                    'tanggal_akhir'         => date('Y-m-d', strtotime($request->tanggal_akhir)),
                    'durasi'                => $request->durasi,
                    'jpl'                   => $request->jpl,
                    'nomor_sertifikat'      => $request->nomor_sertifikat,
                    'tanggal_sertifikat'    => date('Y-m-d', strtotime($request->tanggal_sertifikat)),
                    'status_diklat'         => 'Menunggu',
            ]);
        }
        return redirect('pegawai/diklat')->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_diklat)
    {
        $nip        = Session()->get('nip');
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

        if($diklat->nip != $nip) {
            $last_page = url()->full();
            return redirect('pegawai/diklat?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('diklat')->where('id_diklat',$id_diklat)->delete();
        return redirect('pegawai/diklat')->with(['sukses' => 'Data telah dihapus']);
    }
}
