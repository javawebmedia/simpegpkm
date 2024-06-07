<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Metode_diklat_model;

class Metode_diklat extends Controller
{
    // halaman metode_diklat
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data metode_diklat
        $m_metode_diklat   = new Metode_diklat_model();
        $metode_diklat     = $m_metode_diklat->listing();

        $data = [   'title'         => 'Data Master Metode Diklat',
                    'metode_diklat' => $metode_diklat,
                    'content'       => 'admin/metode_diklat/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_metode_diklat)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data metode_diklat
        $m_metode_diklat   = new Metode_diklat_model();
        $metode_diklat     = $m_metode_diklat->detail($id_metode_diklat);

        $data = [   'title'         => 'Edit Metode Diklat: '.$metode_diklat->nama_metode_diklat,
                    'metode_diklat' => $metode_diklat,
                    'content'       => 'admin/metode_diklat/edit'
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
                            'nama_metode_diklat'   => 'required|unique:metode_diklat',
                            'urutan'        => 'required',
                            ]);

        DB::table('metode_diklat')->insert([
            'id_pegawai'            => Session()->get('id_pegawai'),
            'jenis_metode'          => $request->jenis_metode,
            'nama_metode_diklat'    => $request->nama_metode_diklat,
            'jp'                    => $request->jp,
            'keterangan'            => $request->keterangan,
            'urutan'                => $request->urutan
        ]);
        return redirect('admin/metode-diklat')->with(['sukses' => 'Data telah ditambah']);
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
                            'nama_metode_diklat'   => 'required',
                            'urutan'        => 'required',
                            ]);

        DB::table('metode_diklat')->where('id_metode_diklat',$request->id_metode_diklat)->update([
            'id_pegawai'            => Session()->get('id_pegawai'),
            'jenis_metode'          => $request->jenis_metode,
            'nama_metode_diklat'    => $request->nama_metode_diklat,
            'jp'                    => $request->jp,
            'keterangan'            => $request->keterangan,
            'urutan'                => $request->urutan
        ]);
        return redirect('admin/metode-diklat')->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_metode_diklat)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('metode_diklat')->where('id_metode_diklat',$id_metode_diklat)->delete();
        return redirect('admin/metode-diklat')->with(['sukses' => 'Data telah dihapus']);
    }
}
