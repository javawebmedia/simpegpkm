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
use App\Models\Str_sip_model;

class Str_sip extends Controller
{

	// index
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        
        $id_pegawai         = Session()->get('id_pegawai');
        $nip                = Session()->get('nip');
        $m_pegawai          = new Pegawai_model();
        $m_str_sip        	= new Str_sip_model();
        
        $pegawai            = $m_pegawai->detail($id_pegawai);
        $str_sip          	= $m_str_sip->pegawai($id_pegawai);

        $data = [   'title'             => 'Riwayat STR dan SIP',
                    'pegawai'           => $pegawai,
                    'str_sip'           => $str_sip,
                    'content'           => 'pegawai/str_sip/index'
                ];
        return view('pegawai/layout/wrapper',$data);
    }

    // tambah
    public function tambah()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        
        $id_pegawai         = Session()->get('id_pegawai');
        $nip                = Session()->get('nip');
        $m_pegawai          = new Pegawai_model();
        $m_str_sip        	= new Str_sip_model();

        $data = [   'title' 	=> 'Tambah Riwayat STR dan SIP',
                    'content'	=> 'pegawai/str_sip/tambah'
                ];
        return view('pegawai/layout/wrapper',$data);
    }

    // edit
    public function edit($id_str_sip)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        
        $id_pegawai         = Session()->get('id_pegawai');
        $nip                = Session()->get('nip');
        $m_pegawai          = new Pegawai_model();
        $m_str_sip        	= new Str_sip_model();
        $str_sip 			= $m_str_sip->detail($id_str_sip);

        if($str_sip->id_pegawai != $id_pegawai)
        {
        	return redirect('pegawai/str-sip')->with(['warning' => 'Anda mengakses data yang salah.']);
        }

        $data = [   'title'   	=> 'Edit Riwayat STR dan SIP',
        			'str_sip'	=> $str_sip,
                    'content' 	=> 'pegawai/str_sip/edit'
                ];
        return view('pegawai/layout/wrapper',$data);
    }

    // proses_tambah
    public function proses_tambah(Request $request)
    {
    	// proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        request()->validate([
            'nomor_sertifikat'  => 'required',
            'gambar'        	=> 'file|mimetypes:application/pdf,image/png,image/jpg,image/jpeg,image/gif|max:8024',
        ]);

        // UPLOAD START
        $image                  = $request->file('gambar');
        $filenamewithextension  = $request->file('gambar')->getClientOriginalName();
        $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
        $destinationPath        = './assets/upload/file';
        $image->move($destinationPath, $input['nama_file']);
        // END UPLOAD

        DB::table('str_sip')->insert([
            'id_pegawai'    		=> Session()->get('id_pegawai'),
            'id_user'           	=> Session()->get('id_pegawai'),
            'jenis_str_sip'   		=> $request->jenis_str_sip,
            'nomor_registrasi'		=> $request->nomor_registrasi,
            'nomor_ijazah'			=> $request->nomor_ijazah,
            'nomor_sertifikat'		=> $request->nomor_sertifikat,
            'tanggal_lulus'			=> date('Y-m-d',strtotime($request->tanggal_lulus)),
            'tanggal_akhir'			=> date('Y-m-d',strtotime($request->tanggal_akhir)),
            'seumur_hidup'			=> $request->seumur_hidup,
            'tanggal_tanda_tangan'	=> date('Y-m-d',strtotime($request->tanggal_tanda_tangan)),
            'status_str_sip'		=> 'Menunggu',
            'gambar'            	=> $input['nama_file'],
            'tanggal_post'   		=> date('Y-m-d H:i:s'),
        ]);
        return redirect('pegawai/str-sip')->with(['sukses' => 'Data telah ditambah']);
    }

    // proses_edit
    public function proses_edit(Request $request)
    {
    	// proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        request()->validate([
            'nomor_sertifikat'  => 'required',
            'gambar'        	=> 'file|mimetypes:application/pdf,image/png,image/jpg,image/jpeg,image/gif|max:8024',
        ]);

        // UPLOAD START
        $image                  = $request->file('gambar');
        if(!empty($image)) {
	        $filenamewithextension  = $request->file('gambar')->getClientOriginalName();
	        $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
	        $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
	        $destinationPath        = './assets/upload/file';
	        $image->move($destinationPath, $input['nama_file']);
	        // END UPLOAD

	        DB::table('str_sip')->where('id_str_sip',$request->id_str_sip)->update([
	            'id_pegawai'    		=> Session()->get('id_pegawai'),
	            'id_user'           	=> Session()->get('id_pegawai'),
	            'jenis_str_sip'   		=> $request->jenis_str_sip,
	            'nomor_registrasi'		=> $request->nomor_registrasi,
	            'nomor_ijazah'			=> $request->nomor_ijazah,
	            'nomor_sertifikat'		=> $request->nomor_sertifikat,
	            'tanggal_lulus'			=> date('Y-m-d',strtotime($request->tanggal_lulus)),
	            'tanggal_akhir'			=> date('Y-m-d',strtotime($request->tanggal_akhir)),
	            'seumur_hidup'			=> $request->seumur_hidup,
	            'tanggal_tanda_tangan'	=> date('Y-m-d',strtotime($request->tanggal_tanda_tangan)),
	            'gambar'            	=> $input['nama_file'],
	        ]);
	    }else{
	    	DB::table('str_sip')->where('id_str_sip',$request->id_str_sip)->update([
	            'id_pegawai'    		=> Session()->get('id_pegawai'),
	            'id_user'           	=> Session()->get('id_pegawai'),
	            'jenis_str_sip'   		=> $request->jenis_str_sip,
	            'nomor_registrasi'		=> $request->nomor_registrasi,
	            'nomor_ijazah'			=> $request->nomor_ijazah,
	            'nomor_sertifikat'		=> $request->nomor_sertifikat,
	            'tanggal_lulus'			=> date('Y-m-d',strtotime($request->tanggal_lulus)),
	            'tanggal_akhir'			=> date('Y-m-d',strtotime($request->tanggal_akhir)),
	            'seumur_hidup'			=> $request->seumur_hidup,
	            'tanggal_tanda_tangan'	=> date('Y-m-d',strtotime($request->tanggal_tanda_tangan)),
	        ]);
	    }
        return redirect('pegawai/str-sip')->with(['sukses' => 'Data telah ditambah']);
    }

    // delete
    public function hapus($id_str_sip)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $id_pegawai         = Session()->get('id_pegawai');
        $nip                = Session()->get('nip');
        $m_pegawai          = new Pegawai_model();
        $m_str_sip        	= new Str_sip_model();
        $str_sip 			= $m_str_sip->detail($id_str_sip);

        // if($str_sip->id_pegawai == $id_pegawai)
        // {
        	// end proteksi halaman
	        DB::table('str_sip')->where('id_str_sip',$id_str_sip)->delete();
	        return redirect('pegawai/str-sip')->with(['sukses' => 'Data telah dihapus']);
        	
        // }else{
        // 	return redirect('pegawai/str-sip')->with(['warning' => 'Anda mengakses data yang salah.']);
        // }
    }
}

