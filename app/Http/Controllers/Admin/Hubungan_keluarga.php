<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hubungan_keluarga extends Controller
{
    // halaman hubungan_keluarga
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data hubungan_keluarga
        $hubungan_keluarga = DB::table('hubungan_keluarga')->get();

        $data = [   'title'                 => 'Data Master Hubungan Keluarga',
                    'hubungan_keluarga'    => $hubungan_keluarga,
                    'content'               => 'admin/hubungan_keluarga/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_hubungan_keluarga)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data hubungan_keluarga
        $hubungan_keluarga = DB::table('hubungan_keluarga')->where('id_hubungan_keluarga',$id_hubungan_keluarga)->first();

        $data = [   'title'                 => 'Edit Hubungan Keluarga: '.$hubungan_keluarga->nama_hubungan_keluarga,
                    'hubungan_keluarga'    => $hubungan_keluarga,
                    'content'               => 'admin/hubungan_keluarga/edit'
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
                            'nama_hubungan_keluarga' => 'required|unique:hubungan_keluarga',
                            'urutan'     => 'required',
                            ]);

        DB::table('hubungan_keluarga')->insert([
            'id_pegawai'                => Session()->get('id_pegawai'),
            'nama_hubungan_keluarga'   => $request->nama_hubungan_keluarga,
            'urutan'                    => $request->urutan,
            'tanggal_post'              => date('Y-m-d H:i:s')
        ]);
        return redirect('admin/hubungan-keluarga')->with(['sukses' => 'Data telah ditambah']);
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
                            'nama_hubungan_keluarga' => 'required',
                            'urutan'     => 'required',
                            ]);

        DB::table('hubungan_keluarga')->where('id_hubungan_keluarga',$request->id_hubungan_keluarga)->update([
            'id_pegawai'                => Session()->get('id_pegawai'),
            'nama_hubungan_keluarga'   => $request->nama_hubungan_keluarga,
            'urutan'                    => $request->urutan
        ]);
        return redirect('admin/hubungan-keluarga')->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_hubungan_keluarga)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('hubungan_keluarga')->where('id_hubungan_keluarga',$id_hubungan_keluarga)->delete();
        return redirect('admin/hubungan-keluarga')->with(['sukses' => 'Data telah dihapus']);
    }
}
