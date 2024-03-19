<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Jenis_cuti extends Controller
{
    // halaman jenis_cuti
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data jenis_cuti
        $jenis_cuti = DB::table('jenis_cuti')->get();

        $data = [   'title'         => 'Data Master Jenis Cuti',
                    'jenis_cuti'   => $jenis_cuti,
                    'content'       => 'admin/jenis_cuti/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_jenis_cuti)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data jenis_cuti
        $jenis_cuti = DB::table('jenis_cuti')->where('id_jenis_cuti',$id_jenis_cuti)->first();

        $data = [   'title'         => 'Edit Jenis Cuti: '.$jenis_cuti->nama_jenis_cuti,
                    'jenis_cuti'   => $jenis_cuti,
                    'content'       => 'admin/jenis_cuti/edit'
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
                            'nama_jenis_cuti' => 'required|unique:jenis_cuti',
                            'urutan'     => 'required',
                            ]);

        DB::table('jenis_cuti')->insert([
            'id_pegawai'        => Session()->get('id_pegawai'),
            'nama_jenis_cuti'  => $request->nama_jenis_cuti,
            'keterangan'        => $request->keterangan,
            'urutan'            => $request->urutan
        ]);
        return redirect('admin/jenis-cuti')->with(['sukses' => 'Data telah ditambah']);
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
                            'nama_jenis_cuti' => 'required',
                            'urutan'     => 'required',
                            ]);

        DB::table('jenis_cuti')->where('id_jenis_cuti',$request->id_jenis_cuti)->update([
            'id_pegawai'        => Session()->get('id_pegawai'),
            'nama_jenis_cuti'  => $request->nama_jenis_cuti,
            'keterangan'        => $request->keterangan,
            'urutan'            => $request->urutan
        ]);
        return redirect('admin/jenis-cuti')->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_jenis_cuti)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('jenis_cuti')->where('id_jenis_cuti',$id_jenis_cuti)->delete();
        return redirect('admin/jenis-cuti')->with(['sukses' => 'Data telah dihapus']);
    }
}
