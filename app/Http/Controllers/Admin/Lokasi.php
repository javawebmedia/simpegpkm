<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Lokasi extends Controller
{
    // halaman lokasi
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data lokasi
        $lokasi = DB::table('lokasi')->get();

        $data = [   'title'     => 'Data Master Lokasi Asset',
                    'lokasi'     => $lokasi,
                    'content'   => 'admin/lokasi/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_lokasi)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data lokasi
        $lokasi = DB::table('lokasi')->where('id_lokasi',$id_lokasi)->first();

        $data = [   'title'     => 'Edit Lokasi: '.$lokasi->lokasi,
                    'lokasi'     => $lokasi,
                    'content'   => 'admin/lokasi/edit'
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
                            'lokasi' => 'required',
                            'urutan'     => 'required',
                            ]);

        DB::table('lokasi')->insert([
            'id_lokasi'      => $request->id_lokasi,
            'lokasi'         => $request->lokasi,
            'ruangan'        => $request->ruangan,
            'urutan'         => $request->urutan,
            'tanggal_post'   => date('Y-m-d H:i:s')
        ]);
        return redirect('admin/lokasi')->with(['sukses' => 'Data telah ditambah']);
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
                            'lokasi' => 'required',
                            'urutan'     => 'required',
                            ]);

        DB::table('lokasi')->where('id_lokasi',$request->id_lokasi)->update([
            'id_lokasi'      => $request->id_lokasi,
            'lokasi'         => $request->lokasi,
            'ruangan'        => $request->ruangan,
            'urutan'         => $request->urutan,
        ]);
        return redirect('admin/lokasi')->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_lokasi)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('lokasi')->where('id_lokasi',$id_lokasi)->delete();
        return redirect('admin/lokasi')->with(['sukses' => 'Data telah dihapus']);
    }
}
