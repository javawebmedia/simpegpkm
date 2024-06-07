<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori_diklat_model;

class Kategori_diklat extends Controller
{
    // halaman kategori_diklat
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data kategori_diklat
        $m_kategori_diklat   = new Kategori_diklat_model();
        $kategori_diklat     = $m_kategori_diklat->listing();

        $data = [   'title'             => 'Data Master Kategori Diklat',
                    'kategori_diklat'   => $kategori_diklat,
                    'content'           => 'admin/kategori_diklat/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_kategori_diklat)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data kategori_diklat
        $m_kategori_diklat   = new Kategori_diklat_model();
        $kategori_diklat     = $m_kategori_diklat->detail($id_kategori_diklat);

        $data = [   'title'             => 'Edit Kategori Diklat: '.$kategori_diklat->nama_kategori_diklat,
                    'kategori_diklat'   => $kategori_diklat,
                    'content'           => 'admin/kategori_diklat/edit'
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
                            'nama_kategori_diklat'   => 'required|unique:kategori_diklat',
                            'urutan'        => 'required',
                            ]);

        DB::table('kategori_diklat')->insert([
            'id_pegawai'            => Session()->get('id_pegawai'),
            'nama_kategori_diklat'  => $request->nama_kategori_diklat,
            'keterangan'            => $request->keterangan,
            'urutan'                => $request->urutan
        ]);
        return redirect('admin/kategori-diklat')->with(['sukses' => 'Data telah ditambah']);
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
                            'nama_kategori_diklat'   => 'required',
                            'urutan'        => 'required',
                            ]);

        DB::table('kategori_diklat')->where('id_kategori_diklat',$request->id_kategori_diklat)->update([
            'id_pegawai'            => Session()->get('id_pegawai'),
            'nama_kategori_diklat'  => $request->nama_kategori_diklat,
            'keterangan'            => $request->keterangan,
            'urutan'                => $request->urutan
        ]);
        return redirect('admin/kategori-diklat')->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_kategori_diklat)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('kategori_diklat')->where('id_kategori_diklat',$id_kategori_diklat)->delete();
        return redirect('admin/kategori-diklat')->with(['sukses' => 'Data telah dihapus']);
    }
}
