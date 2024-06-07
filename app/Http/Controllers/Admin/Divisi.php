<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Divisi extends Controller
{
    // halaman divisi
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data divisi
        $divisi = DB::table('divisi')->get();

        $data = [   'title'     => 'Data Master Divisi',
                    'divisi'     => $divisi,
                    'content'   => 'admin/divisi/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_divisi)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data divisi
        $divisi = DB::table('divisi')->where('id_divisi',$id_divisi)->first();

        $data = [   'title'     => 'Edit Divisi: '.$divisi->nama_divisi,
                    'divisi'     => $divisi,
                    'content'   => 'admin/divisi/edit'
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
                            'nama_divisi' => 'required|unique:divisi',
                            'urutan'     => 'required',
                            ]);

        DB::table('divisi')->insert([
            'id_pegawai'     => Session()->get('id_pegawai'),
            'nama_divisi'    => $request->nama_divisi,
            'kode_divisi'    => $request->kode_divisi,
            'urutan'         => $request->urutan,
            'tanggal_post'   => date('Y-m-d H:i:s')
        ]);
        return redirect('admin/divisi')->with(['sukses' => 'Data telah ditambah']);
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
                            'nama_divisi' => 'required',
                            'urutan'     => 'required',
                            ]);

        DB::table('divisi')->where('id_divisi',$request->id_divisi)->update([
            'id_pegawai'    => Session()->get('id_pegawai'),
            'nama_divisi'    => $request->nama_divisi,
            'kode_divisi'    => $request->kode_divisi,
            'urutan'        => $request->urutan
        ]);
        return redirect('admin/divisi')->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_divisi)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('divisi')->where('id_divisi',$id_divisi)->delete();
        return redirect('admin/divisi')->with(['sukses' => 'Data telah dihapus']);
    }
}
