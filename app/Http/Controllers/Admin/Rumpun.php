<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Rumpun_model;

class Rumpun extends Controller
{
    // halaman rumpun
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data rumpun
        $m_rumpun   = new Rumpun_model();
        $rumpun     = $m_rumpun->listing();

        $data = [   'title'     => 'Data Master Rumpun',
                    'rumpun'    => $rumpun,
                    'content'   => 'admin/rumpun/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_rumpun)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data rumpun
        $m_rumpun   = new Rumpun_model();
        $rumpun     = $m_rumpun->detail($id_rumpun);

        $data = [   'title'     => 'Edit Rumpun: '.$rumpun->nama_rumpun,
                    'rumpun'    => $rumpun,
                    'content'   => 'admin/rumpun/edit'
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
                            'nama_rumpun'   => 'required|unique:rumpun',
                            'urutan'        => 'required',
                            ]);

        DB::table('rumpun')->insert([
            'id_pegawai'    => Session()->get('id_pegawai'),
            'nama_rumpun'   => $request->nama_rumpun,
            'keterangan'    => $request->keterangan,
            'urutan'        => $request->urutan
        ]);
        return redirect('admin/rumpun')->with(['sukses' => 'Data telah ditambah']);
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
                            'nama_rumpun'   => 'required',
                            'urutan'        => 'required',
                            ]);

        DB::table('rumpun')->where('id_rumpun',$request->id_rumpun)->update([
            'id_pegawai'    => Session()->get('id_pegawai'),
            'nama_rumpun'   => $request->nama_rumpun,
            'keterangan'    => $request->keterangan,
            'urutan'        => $request->urutan
        ]);
        return redirect('admin/rumpun')->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_rumpun)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('rumpun')->where('id_rumpun',$id_rumpun)->delete();
        return redirect('admin/rumpun')->with(['sukses' => 'Data telah dihapus']);
    }
}
