<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Jenis_libur extends Controller
{
    // halaman jenis_libur
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data jenis_libur
        $jenis_libur = DB::table('jenis_libur')->get();

        $data = [   'title'         => 'Data Master Jenis Libur',
                    'jenis_libur'   => $jenis_libur,
                    'content'       => 'admin/jenis_libur/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_jenis_libur)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data jenis_libur
        $jenis_libur = DB::table('jenis_libur')->where('id_jenis_libur',$id_jenis_libur)->first();

        $data = [   'title'         => 'Edit Jenis Libur: '.$jenis_libur->nama_jenis_libur,
                    'jenis_libur'   => $jenis_libur,
                    'content'       => 'admin/jenis_libur/edit'
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
                            'nama_jenis_libur' => 'required|unique:jenis_libur',
                            'urutan'     => 'required',
                            ]);

        DB::table('jenis_libur')->insert([
            'id_pegawai'        => Session()->get('id_pegawai'),
            'nama_jenis_libur'  => $request->nama_jenis_libur,
            'keterangan'        => $request->keterangan,
            'urutan'            => $request->urutan
        ]);
        return redirect('admin/jenis-libur')->with(['sukses' => 'Data telah ditambah']);
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
                            'nama_jenis_libur' => 'required',
                            'urutan'     => 'required',
                            ]);

        DB::table('jenis_libur')->where('id_jenis_libur',$request->id_jenis_libur)->update([
            'id_pegawai'        => Session()->get('id_pegawai'),
            'nama_jenis_libur'  => $request->nama_jenis_libur,
            'keterangan'        => $request->keterangan,
            'urutan'            => $request->urutan
        ]);
        return redirect('admin/jenis-libur')->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_jenis_libur)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('jenis_libur')->where('id_jenis_libur',$id_jenis_libur)->delete();
        return redirect('admin/jenis-libur')->with(['sukses' => 'Data telah dihapus']);
    }
}
