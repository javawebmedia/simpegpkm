<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Aktivitas_model;

class Aktivitas extends Controller
{
    // halaman aktivitas
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_aktivitas    = new Aktivitas_model();
        $aktivitas      = $m_aktivitas->listing();
        $divisi         = DB::table('divisi')->orderBy('urutan', 'asc')->get();
        $satuan         = DB::table('satuan')->orderBy('urutan', 'asc')->get();
        // get last id
        $last_id        = $m_aktivitas->last_id();
        if($last_id) {
            $urutan     = $last_id->id_aktivitas+1;
        }else{
            $urutan     = 1;
        }
        // end last id

        $data = [   'title'         => 'Data Aktivitas Umum',
                    'aktivitas'     => $aktivitas,
                    'divisi'        => $divisi,
                    'satuan'        => $satuan,
                    'urutan'        => $urutan,
                    'content'       => 'admin/aktivitas/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_aktivitas)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data aktivitas
        $aktivitas      = DB::table('aktivitas')->where('id_aktivitas',$id_aktivitas)->first();
        $divisi         = DB::table('divisi')->orderBy('urutan', 'asc')->get();
        $satuan         = DB::table('satuan')->orderBy('urutan', 'asc')->get();

        $data = [   'title'         => 'Edit Aktivitas Umum: '.$aktivitas->nama_aktivitas,
                    'aktivitas'     => $aktivitas,
                    'divisi'        => $divisi,
                    'satuan'        => $satuan,
                    'content'       => 'admin/aktivitas/edit'
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
                            'nama_aktivitas'    => 'required',
                            'kode_aktivitas'    => 'required|unique:aktivitas',
                            'urutan'            => 'required',
                            ]);

        DB::table('aktivitas')->insert([
            'id_pegawai'        => Session()->get('id_pegawai'),
            'id_satuan'         => $request->id_satuan,
            'id_divisi'         => $request->id_divisi,
            'nama_aktivitas'    => $request->nama_aktivitas,
            'kode_aktivitas'    => $request->kode_aktivitas,
            'keterangan'        => $request->keterangan,
            'waktu'             => $request->waktu,
            'kategori'          => $request->kategori,
            'tingkat_kesulitan' => $request->tingkat_kesulitan,
            'bobot'             => $request->bobot,
            'status_aktivitas'  => $request->status_aktivitas,
            'urutan'            => $request->urutan,
            'tanggal_post'      => date('Y-m-d H:i:s')
        ]);
        return redirect('admin/aktivitas')->with(['sukses' => 'Data telah ditambah']);
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
                            'nama_aktivitas'    => 'required',
                            'urutan'            => 'required',
                            ]);

        DB::table('aktivitas')->where('id_aktivitas',$request->id_aktivitas)->update([
            'id_pegawai'        => Session()->get('id_pegawai'),
            'id_satuan'         => $request->id_satuan,
            'id_divisi'         => $request->id_divisi,
            'nama_aktivitas'    => $request->nama_aktivitas,
            'kode_aktivitas'    => $request->kode_aktivitas,
            'keterangan'        => $request->keterangan,
            'waktu'             => $request->waktu,
            'kategori'          => $request->kategori,
            'tingkat_kesulitan' => $request->tingkat_kesulitan,
            'bobot'             => $request->bobot,
            'status_aktivitas'  => $request->status_aktivitas,
            'urutan'            => $request->urutan,
        ]);
        return redirect('admin/aktivitas')->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_aktivitas)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('aktivitas')->where('id_aktivitas',$id_aktivitas)->delete();
        return redirect('admin/aktivitas')->with(['sukses' => 'Data telah dihapus']);
    }
}


