<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Periode extends Controller
{
    // halaman periode
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data periode
        $periode = DB::table('periode')->orderBy('thbl','DESC')->get();

        $data = [   'title'     => 'Data Master Periode Gaji',
                    'periode'   => $periode,
                    'content'   => 'admin/periode/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_periode)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data periode
        $periode = DB::table('periode')->where('id_periode',$id_periode)->first();

        $data = [   'title'     => 'Edit Periode Gaji: '.$periode->thbl,
                    'periode'   => $periode,
                    'content'   => 'admin/periode/edit'
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
                            'tahun'         => 'required',
                            'jumlah_hari'   => 'required',
                            ]);

        DB::table('periode')->insert([
            'thbl'          => $request->tahun.$request->bulan,
            'tahun'         => $request->tahun,
            'bulan'         => $request->bulan,
            'jumlah_hari'   => $request->jumlah_hari,
            'keterangan'    => $request->keterangan,
            'id_pegawai'    => Session()->get('id_pegawai')
        ]);
        return redirect('admin/periode')->with(['sukses' => 'Data telah ditambah']);
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
                            'tahun'         => 'required',
                            'jumlah_hari'   => 'required',
                            ]);

        DB::table('periode')->where('id_periode',$request->id_periode)->update([
            'thbl'          => $request->tahun.$request->bulan,
            'tahun'         => $request->tahun,
            'bulan'         => $request->bulan,
            'jumlah_hari'   => $request->jumlah_hari,
            'keterangan'    => $request->keterangan,
            'id_pegawai'    => Session()->get('id_pegawai')
        ]);
        return redirect('admin/periode')->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_periode)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('periode')->where('id_periode',$id_periode)->delete();
        return redirect('admin/periode')->with(['sukses' => 'Data telah dihapus']);
    }
}
