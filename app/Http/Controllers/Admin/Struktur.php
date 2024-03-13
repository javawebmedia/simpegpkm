<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\Atasan_model;
use App\Models\Bawahan_model;
use App\Models\Pegawai_model;

class Struktur extends Controller
{
    // Halaman atasan
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman

        $m_atasan   = new Atasan_model();
        $m_bawahan  = new Bawahan_model();
        $m_pegawai  = new Pegawai_model();
        $atasan     = $m_atasan->listing();
        $pegawai    = $m_pegawai->aktif();

        $data = [
            'title'     => 'Data Setting Struktur',
            'atasan'    => $atasan,
            'pegawai'   => $pegawai,
            'm_bawahan' => $m_bawahan,
            'content'   => 'admin/struktur/index'
        ];
        return view('admin/layout/wrapper', $data);
    }

    // Tambah atasan
    public function tambah(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman

        // end proteksi halaman
        request()->validate([
            'id_pegawai' => 'required|unique:atasan',
        ]);

        DB::table('atasan')->insert([
            'id_pegawai'    => $request->id_pegawai,
            'status_atasan' => 'Aktif'
        ]);
        return redirect('admin/struktur')->with(['sukses' => 'Data telah ditambah']);
    }

    // Edit atasan
    public function edit($id_atasan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman

        $m_atasan   = new Atasan_model();
        $atasan     = $m_atasan->detail($id_atasan);
        $m_pegawai  = new Pegawai_model();
        $pegawai    = $m_pegawai->aktif();

        $data = [
            'title'     => 'Edit Data Atasan',
            'atasan'    => $atasan,
            'pegawai'   => $pegawai,
            'content'   => 'admin/struktur/edit'
        ];
        return view('admin/layout/wrapper', $data);
    }

    // Update atasan
    public function proses_edit(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman

        // end proteksi halaman
        request()->validate([
            'id_pegawai' => [
                'required',
                Rule::unique('atasan', 'id_pegawai')->ignore($request->id_atasan, 'id_atasan')
            ]
        ]);

        DB::table('atasan')->where('id_atasan', $request->id_atasan)->update([
            'id_pegawai'    => $request->id_pegawai,
            'keterangan'    => $request->keterangan,
            'status_atasan' => $request->status_atasan,
        ]);
        return redirect('admin/struktur')->with(['sukses' => 'Data telah di update']);
    }

    // Delete atasan
    public function delete($id_atasan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('atasan')->where('id_atasan',$id_atasan)->delete();
        DB::table('bawahan')->where('id_atasan',$id_atasan)->delete();
        return redirect('admin/struktur')->with(['sukses' => 'Data telah dihapus']);
    }

    // Halaman bawahan
    public function bawahan($id_atasan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman

        $m_atasan   = new Atasan_model();
        $atasan     = $m_atasan->detail($id_atasan);
        $m_bawahan  = new Bawahan_model();
        $bawahan    = $m_bawahan->atasan($id_atasan);
        $m_pegawai  = new Pegawai_model();
        $pegawai    = $m_pegawai->aktif();

        $data = [
            'title'     => 'Data Bawahan : ' . $atasan->nama_lengkap,
            'atasan'    => $atasan,
            'bawahan'   => $bawahan,
            'pegawai'   => $pegawai,
            'content'   => 'admin/struktur/bawahan'
        ];
        return view('admin/layout/wrapper', $data);
    }

    // Tambah bawahan
    public function tambah_bawahan(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman

        // end proteksi halaman
        request()->validate([
            'id_pegawai' => 'required|unique:bawahan',
        ]);

        DB::table('bawahan')->insert([
            'id_atasan'         => $request->id_atasan,
            'id_pegawai'        => $request->id_pegawai,
            'status_bawahan'    => 'Aktif'
        ]);
        return redirect('admin/struktur/bawahan/' . $request->id_atasan)->with(['sukses' => 'Data telah ditambah']);
    }

    // Edit bawahan
    public function edit_bawahan($id_bawahan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman

        $m_bawahan  = new Bawahan_model();
        $bawahan    = $m_bawahan->detail($id_bawahan);
        $m_pegawai  = new Pegawai_model();
        $pegawai    = $m_pegawai->aktif();

        $data = [
            'title'     => 'Edit Data Bawahan',
            'bawahan'   => $bawahan,
            'pegawai'   => $pegawai,
            'content'   => 'admin/struktur/edit_bawahan'
        ];
        return view('admin/layout/wrapper', $data);
    }

    // Update bawahan
    public function proses_edit_bawahan(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman

        $m_bawahan  = new Bawahan_model();
        $bawahan    = $m_bawahan->detail($request->id_bawahan);

        // end proteksi halaman
        request()->validate([
            'id_pegawai' => [
                'required',
                Rule::unique('bawahan', 'id_pegawai')->ignore($request->id_bawahan, 'id_bawahan')
            ]
        ]);

        DB::table('bawahan')->where('id_bawahan', $request->id_bawahan)->update([
            'id_pegawai'    => $request->id_pegawai,
            'keterangan'    => $request->keterangan,
            'status_bawahan' => $request->status_bawahan,
        ]);
        return redirect('admin/struktur/bawahan/' . $bawahan->id_atasan)->with(['sukses' => 'Data telah di update']);
    }

    // Delete bawahan
    public function delete_bawahan($id_bawahan,$id_atasan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_bawahan  = new Bawahan_model();
        $bawahan    = $m_bawahan->detail($id_bawahan);

        DB::table('bawahan')->where('id_bawahan',$id_bawahan)->delete();
        return redirect('admin/struktur/bawahan/' . $id_atasan)->with(['sukses' => 'Data telah dihapus']);
    }
}
