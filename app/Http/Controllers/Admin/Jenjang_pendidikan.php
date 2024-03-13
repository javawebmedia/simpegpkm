<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Jenjang_pendidikan extends Controller
{
    // halaman jenjang_pendidikan
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data jenjang_pendidikan
        $jenjang_pendidikan = DB::table('jenjang_pendidikan')->get();

        $data = [   'title'                 => 'Data Master Jenjang Pendidikan',
                    'jenjang_pendidikan'    => $jenjang_pendidikan,
                    'content'               => 'admin/jenjang_pendidikan/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_jenjang_pendidikan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data jenjang_pendidikan
        $jenjang_pendidikan = DB::table('jenjang_pendidikan')->where('id_jenjang_pendidikan',$id_jenjang_pendidikan)->first();

        $data = [   'title'                 => 'Edit Jenjang Pendidikan: '.$jenjang_pendidikan->nama_jenjang_pendidikan,
                    'jenjang_pendidikan'    => $jenjang_pendidikan,
                    'content'               => 'admin/jenjang_pendidikan/edit'
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
                            'nama_jenjang_pendidikan' => 'required|unique:jenjang_pendidikan',
                            'urutan'     => 'required',
                            ]);

        DB::table('jenjang_pendidikan')->insert([
            'id_pegawai'                => Session()->get('id_pegawai'),
            'nama_jenjang_pendidikan'   => $request->nama_jenjang_pendidikan,
            'urutan'                    => $request->urutan,
            'tanggal_post'              => date('Y-m-d H:i:s')
        ]);
        return redirect('admin/jenjang-pendidikan')->with(['sukses' => 'Data telah ditambah']);
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
                            'nama_jenjang_pendidikan' => 'required',
                            'urutan'     => 'required',
                            ]);

        DB::table('jenjang_pendidikan')->where('id_jenjang_pendidikan',$request->id_jenjang_pendidikan)->update([
            'id_pegawai'                => Session()->get('id_pegawai'),
            'nama_jenjang_pendidikan'   => $request->nama_jenjang_pendidikan,
            'urutan'                    => $request->urutan
        ]);
        return redirect('admin/jenjang-pendidikan')->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_jenjang_pendidikan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('jenjang_pendidikan')->where('id_jenjang_pendidikan',$id_jenjang_pendidikan)->delete();
        return redirect('admin/jenjang-pendidikan')->with(['sukses' => 'Data telah dihapus']);
    }
}
