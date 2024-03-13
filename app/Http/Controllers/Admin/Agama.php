<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class Agama extends Controller
{
    // halaman agama
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data agama
        $agama = DB::table('agama')->get();

        $data = [   'title'     => 'Data Master Agama',
                    'agama'     => $agama,
                    'content'   => 'admin/agama/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_agama)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data agama
        $agama = DB::table('agama')->where('id_agama',$id_agama)->first();

        $data = [   'title'     => 'Edit Agama: '.$agama->nama_agama,
                    'agama'     => $agama,
                    'content'   => 'admin/agama/edit'
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
                            'nama_agama' => 'required|unique:agama',
                            'urutan'     => 'required',
                            ]);

        DB::table('agama')->insert([
            'id_pegawai'    => Session()->get('id_pegawai'),
            'nama_agama'    => $request->nama_agama,
            'urutan'        => $request->urutan,
            'tanggal_post'  => date('Y-m-d H:i:s')
        ]);
        return redirect('admin/agama')->with(['sukses' => 'Data telah ditambah']);
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
                            'nama_agama' => [
                                'required',
                                Rule::unique('agama', 'nama_agama')->ignore($request->id_agama, 'id_agama')
                            ],
                            'urutan'     => 'required',
                            ]);

        DB::table('agama')->where('id_agama',$request->id_agama)->update([
            'id_pegawai'    => Session()->get('id_pegawai'),
            'nama_agama'    => $request->nama_agama,
            'urutan'        => $request->urutan
        ]);
        return redirect('admin/agama')->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_agama)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('agama')->where('id_agama',$id_agama)->delete();
        return redirect('admin/agama')->with(['sukses' => 'Data telah dihapus']);
    }
}
