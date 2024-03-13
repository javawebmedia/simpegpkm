<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Pekerjaan extends Controller
{
    // halaman pekerjaan
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data pekerjaan
        $pekerjaan = DB::table('pekerjaan')->get();

        $data = [   'title'     => 'Data Master Pekerjaan',
                    'pekerjaan' => $pekerjaan,
                    'content'   => 'admin/pekerjaan/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_pekerjaan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data pekerjaan
        $pekerjaan = DB::table('pekerjaan')->where('id_pekerjaan',$id_pekerjaan)->first();

        $data = [   'title'     => 'Edit Pekerjaan: '.$pekerjaan->nama_pekerjaan,
                    'pekerjaan' => $pekerjaan,
                    'content'   => 'admin/pekerjaan/edit'
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
                            'nama_pekerjaan' => 'required|unique:pekerjaan',
                            'urutan'        => 'required',
                            ]);

        DB::table('pekerjaan')->insert([
            'id_pegawai'    => Session()->get('id_pegawai'),
            'nama_pekerjaan'=> $request->nama_pekerjaan,
            'urutan'        => $request->urutan,
            'tanggal_post'  => date('Y-m-d H:i:s')
        ]);
        return redirect('admin/pekerjaan')->with(['sukses' => 'Data telah ditambah']);
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
                            'nama_pekerjaan'    => 'required',
                            'urutan'            => 'required',
                            ]);

        DB::table('pekerjaan')->where('id_pekerjaan',$request->id_pekerjaan)->update([
            'id_pegawai'        => Session()->get('id_pegawai'),
            'nama_pekerjaan'    => $request->nama_pekerjaan,
            'urutan'            => $request->urutan
        ]);
        return redirect('admin/pekerjaan')->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_pekerjaan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('pekerjaan')->where('id_pekerjaan',$id_pekerjaan)->delete();
        return redirect('admin/pekerjaan')->with(['sukses' => 'Data telah dihapus']);
    }
}
