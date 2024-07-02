<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Dokumen_pegawai_model;
use App\Models\Pegawai_model;
use Image;

class Dokumen_pegawai extends Controller
{
    // Index
    public function index()
    {
    	if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $m_dokumen_pegawai  = new Dokumen_pegawai_model();
        $dokumen_pegawai    = $m_dokumen_pegawai->listing();

		$data = array(  'title'               => 'Arsip Dokumen Pegawai ('.count($dokumen_pegawai).')',
						'dokumen_pegawai'     => $dokumen_pegawai,
                        'content'             => 'admin/dokumen_pegawai/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // pegawai
    public function pegawai($id_pegawai)
    {
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        
        $m_dokumen_pegawai  = new Dokumen_pegawai_model();
        $m_pegawai          = new Pegawai_model();
        $pegawai            = $m_pegawai->detail($id_pegawai);
        $dokumen_pegawai    = $m_dokumen_pegawai->all_id_pegawai($id_pegawai);

        $data = array(  'title'             => 'Arsip Dokumen Pegawai ('.count($dokumen_pegawai).')',
                        'dokumen_pegawai'   => $dokumen_pegawai,
                        'pegawai'           => $pegawai,
                        'content'           => 'admin/dokumen_pegawai/index'
                    );
        return view('admin/layout/wrapper',$data);
    }

    // approval
    public function approval($kode_dokumen_pegawai)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        DB::table('dokumen_pegawai')->where('kode_dokumen_pegawai',$kode_dokumen_pegawai)->update([
                        'status_dokumen_pegawai'      => 'Disetujui'
                ]);
        return redirect('admin/dokumen-pegawai')->with(['sukses' => 'Dokumen Telah Disetujui']);
    }

    // oke
    public function proses(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        // proses
        $id_dokumen_pegawai     = $request->id_dokumen_pegawai;
        $submit                 = $request->submit;
        $status_dokumen_pegawai = $request->status_dokumen_pegawai;
        $pengalihan             = $request->pengalihan;

        // check berita
        if(empty($id_dokumen_pegawai))
        {
           return redirect('admin/dokumen-pegawai')->with(['warning' => 'Anda belum memilih dokumen']);
        }
        // end check berita
        // proses
        if(isset($submit)) {
            for($i=0; $i < sizeof($id_dokumen_pegawai);$i++) {
                DB::table('dokumen_pegawai')->where('id_dokumen_pegawai',$id_dokumen_pegawai[$i])->update([
                        'status_dokumen_pegawai'      => $status_dokumen_pegawai
                ]);
            }
        }
        return redirect($pengalihan)->with(['sukses' => 'Data telah diupdate']);
    }


    // Delete
    public function delete($kode_dokumen_pegawai)
    {
    	if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        //website('user_log');
    	DB::table('dokumen_pegawai')->where('kode_dokumen_pegawai',$kode_dokumen_pegawai)->delete();
    	return redirect('admin/dokumen-pegawai')->with(['sukses' => 'Data telah dihapus']);
    }
}
