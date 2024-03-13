<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class Satuan extends Controller
{
    // halaman satuan
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data satuan
        $satuan = DB::table('satuan')->get();

        $data = [   'title'     => 'Data Master Satuan',
                    'satuan'     => $satuan,
                    'content'   => 'admin/satuan/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_satuan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data satuan
        $satuan = DB::table('satuan')->where('id_satuan',$id_satuan)->first();

        $data = [   'title'     => 'Edit Satuan: '.$satuan->nama_satuan,
                    'satuan'     => $satuan,
                    'content'   => 'admin/satuan/edit'
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
                            'nama_satuan' => 'required|unique:satuan',
                            'urutan'     => 'required',
                            ]);

        DB::table('satuan')->insert([
            'id_pegawai'    => Session()->get('id_pegawai'),
            'nama_satuan'    => $request->nama_satuan,
            'urutan'        => $request->urutan,
            'tanggal_post'  => date('Y-m-d H:i:s')
        ]);
        return redirect('admin/satuan')->with(['sukses' => 'Data telah ditambah']);
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
                            'nama_satuan' => [
                                'required',
                                Rule::unique('satuan', 'nama_satuan')->ignore($request->id_satuan, 'id_satuan')
                            ],
                            'urutan'     => 'required',
                            ]);

        DB::table('satuan')->where('id_satuan',$request->id_satuan)->update([
            'id_pegawai'    => Session()->get('id_pegawai'),
            'nama_satuan'    => $request->nama_satuan,
            'urutan'        => $request->urutan
        ]);
        return redirect('admin/satuan')->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_satuan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('satuan')->where('id_satuan',$id_satuan)->delete();
        return redirect('admin/satuan')->with(['sukses' => 'Data telah dihapus']);
    }
}
