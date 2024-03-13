<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Pangkat extends Controller
{
    // halaman pangkat
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data pangkat
        $pangkat = DB::table('pangkat')->get();

        $data = [   'title'     => 'Data Master Pangkat',
                    'pangkat'     => $pangkat,
                    'content'   => 'admin/pangkat/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_pangkat)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data pangkat
        $pangkat = DB::table('pangkat')->where('id_pangkat',$id_pangkat)->first();

        $data = [   'title'     => 'Edit Pangkat: '.$pangkat->nama_pangkat,
                    'pangkat'     => $pangkat,
                    'content'   => 'admin/pangkat/edit'
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
                            'nama_pangkat' => 'required|unique:pangkat',
                            'urutan'     => 'required',
                            ]);

        DB::table('pangkat')->insert([
            'id_pegawai'    => Session()->get('id_pegawai'),
            'nama_pangkat'  => $request->nama_pangkat,
            'golongan'      => $request->golongan,
            'ruang'         => $request->ruang,
            'urutan'        => $request->urutan,
            'tanggal_post'  => date('Y-m-d H:i:s')
        ]);
        return redirect('admin/pangkat')->with(['sukses' => 'Data telah ditambah']);
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
                            'nama_pangkat' => 'required',
                            'urutan'     => 'required',
                            ]);

        DB::table('pangkat')->where('id_pangkat',$request->id_pangkat)->update([
            'id_pegawai'    => Session()->get('id_pegawai'),
            'nama_pangkat'  => $request->nama_pangkat,
            'golongan'      => $request->golongan,
            'ruang'         => $request->ruang,
            'urutan'        => $request->urutan
        ]);
        return redirect('admin/pangkat')->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_pangkat)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('pangkat')->where('id_pangkat',$id_pangkat)->delete();
        return redirect('admin/pangkat')->with(['sukses' => 'Data telah dihapus']);
    }
}
