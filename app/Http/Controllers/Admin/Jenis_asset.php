<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Jenis_asset extends Controller
{
    // halaman jenis_asset
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data jenis_asset
        $jenis_asset = DB::table('jenis_asset')->get();

        $data = [   'title'         => 'Data Master Jenis Asset',
                    'jenis_asset'   => $jenis_asset,
                    'content'       => 'admin/jenis_asset/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_jenis_asset)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data jenis_asset
        $jenis_asset = DB::table('jenis_asset')->where('id_jenis_asset',$id_jenis_asset)->first();

        $data = [   'title'             => 'Edit Jenis_asset: '.$jenis_asset->jenis_asset,
                    'jenis_asset'       => $jenis_asset,
                    'content'           => 'admin/jenis_asset/edit'
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
                            'jenis_asset'   => 'required',
                            'tipe'          => 'required',
                            ]);

        DB::table('jenis_asset')->insert([
            'jenis_asset'           => $request->jenis_asset,
            'tipe'                  => $request->tipe,
        ]);
        return redirect('admin/jenis-asset')->with(['sukses' => 'Data telah ditambah']);
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
                            'jenis_asset'   => 'required',
                            'tipe'        => 'required',
                            ]);

        DB::table('jenis_asset')->where('id_jenis_asset',$request->id_jenis_asset)->update([
            'jenis_asset'     => $request->jenis_asset,
            'tipe'            => $request->tipe,
        ]);
        return redirect('admin/jenis-asset')->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_jenis_asset)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('jenis_asset')->where('id_jenis_asset',$id_jenis_asset)->delete();
        return redirect('admin/jenis-asset')->with(['sukses' => 'Data telah dihapus']);
    }
}
