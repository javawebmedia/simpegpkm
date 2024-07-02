<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pegawai_model;
use App\Models\Menu_pegawai_model;

class Menu_pegawai extends Controller
{
    // halaman menu_pegawai
    public function index()
    {
        $m_pegawai          = new Pegawai_model();
        $m_menu_pegawai     = new Menu_pegawai_model();
        $pegawai            = $m_pegawai->listing();
        $menu_pegawai       = $m_menu_pegawai->listing();

        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data menu_pegawai

        $data = [   'title'         => 'Data Menu Pegawai',
                    'menu_pegawai'  => $menu_pegawai,
                    'pegawai'       => $pegawai,
                    'content'       => 'admin/menu_pegawai/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_menu_pegawai)
    {
        $m_pegawai  = new Pegawai_model();
        $pegawai    = $m_pegawai->listing();
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data menu_pegawai
        $menu_pegawai = DB::table('menu_pegawai')->where('id_menu_pegawai',$id_menu_pegawai)->first();

        $data = [   'title'         => 'Edit Menu Pegawai: '.$menu_pegawai->nama_menu,
                    'menu_pegawai'  => $menu_pegawai,
                    'pegawai'       => $pegawai,
                    'content'       => 'admin/menu_pegawai/edit'
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
                            'nama_menu' => 'required|unique:menu_pegawai',
                            'urutan'            => 'required',
                            ]);

        DB::table('menu_pegawai')->insert([
            'id_pegawai'        => $request->id_pegawai,
            'nama_menu'         => $request->nama_menu,
            'icon'              => $request->icon,
            'link'              => $request->link,
            'keterangan'        => $request->keterangan,
            'urutan'            => $request->urutan
        ]);
        return redirect('admin/menu-pegawai')->with(['sukses' => 'Data telah ditambah']);
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
                            'nama_menu' => 'required',
                            'urutan'     => 'required',
                            ]);

        DB::table('menu_pegawai')->where('id_menu_pegawai',$request->id_menu_pegawai)->update([
            'id_pegawai'        => $request->id_pegawai,
            'nama_menu'         => $request->nama_menu,
            'icon'              => $request->icon,
            'link'              => $request->link,
            'keterangan'        => $request->keterangan,
            'urutan'            => $request->urutan
        ]);
        return redirect('admin/menu-pegawai')->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_menu_pegawai)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('menu_pegawai')->where('id_menu_pegawai',$id_menu_pegawai)->delete();
        return redirect('admin/menu-pegawai')->with(['sukses' => 'Data telah dihapus']);
    }
}
