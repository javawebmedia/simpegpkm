<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jenis_pelatihan_model;
use App\Models\Rumpun_model;

class Jenis_pelatihan extends Controller
{
    // halaman jenis_pelatihan
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data jenis_pelatihan
        $m_jenis_pelatihan      = new Jenis_pelatihan_model();
        $m_rumpun               = new Rumpun_model();
        $jenis_pelatihan        = $m_jenis_pelatihan->listing();
        $rumpun                 = $m_rumpun->listing();

        $data = [   'title'             => 'Data Master Jenis Pelatihan',
                    'jenis_pelatihan'   => $jenis_pelatihan,
                    'rumpun'            => $rumpun,
                    'content'           => 'admin/jenis_pelatihan/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_jenis_pelatihan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data jenis_pelatihan
        $m_jenis_pelatihan      = new Jenis_pelatihan_model();
        $m_rumpun               = new Rumpun_model();
        $jenis_pelatihan        = $m_jenis_pelatihan->detail($id_jenis_pelatihan);
        $rumpun                 = $m_rumpun->listing();

        $data = [   'title'             => 'Edit Jenis Pelatihan: '.$jenis_pelatihan->nama_jenis_pelatihan,
                    'jenis_pelatihan'   => $jenis_pelatihan,
                    'rumpun'            => $rumpun,
                    'content'           => 'admin/jenis_pelatihan/edit'
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
                            'nama_jenis_pelatihan'   => 'required|unique:jenis_pelatihan',
                            'urutan'        => 'required',
                            ]);

        DB::table('jenis_pelatihan')->insert([
            'id_pegawai'                => Session()->get('id_pegawai'),
            'id_rumpun'                 => $request->id_rumpun,
            'nama_jenis_pelatihan'      => $request->nama_jenis_pelatihan,
            'keterangan'                => $request->keterangan,
            'urutan'                    => $request->urutan
        ]);
        return redirect('admin/jenis-pelatihan')->with(['sukses' => 'Data telah ditambah']);
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
                            'nama_jenis_pelatihan'  => 'required',
                            'urutan'                => 'required',
                            ]);

        DB::table('jenis_pelatihan')->where('id_jenis_pelatihan',$request->id_jenis_pelatihan)->update([
            'id_pegawai'            => Session()->get('id_pegawai'),
            'id_rumpun'             => $request->id_rumpun,
            'nama_jenis_pelatihan'  => $request->nama_jenis_pelatihan,
            'keterangan'            => $request->keterangan,
            'urutan'                => $request->urutan
        ]);
        return redirect('admin/jenis-pelatihan')->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_jenis_pelatihan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('jenis_pelatihan')->where('id_jenis_pelatihan',$id_jenis_pelatihan)->delete();
        return redirect('admin/jenis-pelatihan')->with(['sukses' => 'Data telah dihapus']);
    }
}
