<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jabatan_model;
use App\Models\Aktivitas_model;
use App\Models\Aktivitas_utama_model;
use App\Models\Pegawai_model;
use App\Models\Riwayat_jabatan_model;

class Jabatan extends Controller
{
    // halaman jabatan
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_jabatan  = new Jabatan_model();
        $jabatan    = $m_jabatan->listing();
        $divisi     = DB::table('divisi')->orderBy('urutan', 'asc')->get();

        $data = [   'title'     => 'Data Master Jabatan',
                    'jabatan'   => $jabatan,
                    'divisi'    => $divisi,
                    'content'   => 'admin/jabatan/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_jabatan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data jabatan
        $jabatan    = DB::table('jabatan')->where('id_jabatan',$id_jabatan)->first();
        $divisi     = DB::table('divisi')->orderBy('urutan', 'asc')->get();

        $data = [   'title'     => 'Edit Jabatan: '.$jabatan->nama_jabatan,
                    'jabatan'   => $jabatan,
                    'divisi'    => $divisi,
                    'content'   => 'admin/jabatan/edit'
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
                            'nama_jabatan'  => 'required',
                            'urutan'        => 'required',
                            ]);

        DB::table('jabatan')->insert([
            'id_pegawai'    => Session()->get('id_pegawai'),
            'id_divisi'     => $request->id_divisi,
            'jenis_jabatan' => $request->jenis_jabatan,
            'nama_jabatan'  => $request->nama_jabatan,
            'keterangan'    => $request->keterangan,
            'urutan'        => $request->urutan,
            'tanggal_post'  => date('Y-m-d H:i:s')
        ]);
        return redirect('admin/jabatan')->with(['sukses' => 'Data telah ditambah']);
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
                            'nama_jabatan' => 'required',
                            'urutan'     => 'required',
                            ]);

        DB::table('jabatan')->where('id_jabatan',$request->id_jabatan)->update([
            'id_pegawai'    => Session()->get('id_pegawai'),
            'id_divisi'     => $request->id_divisi,
            'jenis_jabatan' => $request->jenis_jabatan,
            'nama_jabatan'  => $request->nama_jabatan,
            'keterangan'    => $request->keterangan,
            'urutan'        => $request->urutan,
        ]);
        return redirect('admin/jabatan')->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_jabatan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('jabatan')->where('id_jabatan',$id_jabatan)->delete();
        return redirect('admin/jabatan')->with(['sukses' => 'Data telah dihapus']);
    }

    // aktivitas
    public function aktivitas($id_jabatan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data jabatan
        $jabatan            = DB::table('jabatan')->where('id_jabatan',$id_jabatan)->first();
        $m_aktivitas        = new Aktivitas_model();
        $m_aktivitas_utama  = new Aktivitas_utama_model();
        $m_pegawai          = new Pegawai_model();
        $aktivitas          = $m_aktivitas->listing();
        $aktivitas_utama    = $m_aktivitas_utama->jabatan($id_jabatan);
        $pegawai            = $m_pegawai->jabatan($id_jabatan);
        // dd($pegawai);

        $data = [   'title'             => 'Aktivitas Utama: '.$jabatan->nama_jabatan,
                    'jabatan'           => $jabatan,
                    'aktivitas'         => $aktivitas,
                    'aktivitas_utama'   => $aktivitas_utama,
                    'pegawai'           => $pegawai,
                    'content'           => 'admin/jabatan/aktivitas'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // Tambah aktivitas utama
    public function tambah_aktivitas(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $pegawai    = DB::table('pegawai')->where('nip', $request->nip)->first();

        // end proteksi halaman
        request()->validate([
                            'nip'           => 'required',
                            'id_aktivitas'  => 'required',
                            ]);

        DB::table('aktivitas_utama')->insert([
            'id_pegawai'            => Session()->get('id_pegawai'),
            'id_jabatan'            => $pegawai->id_jabatan,
            'id_aktivitas'          => $request->id_aktivitas,
            'jenis_aktivitas_utama' => $request->jenis_aktivitas_utama,
            'nip'                   => $request->nip,
        ]);
        return redirect('admin/jabatan/aktivitas/' . $request->id_jabatan)->with(['sukses' => 'Data telah ditambah']);
    }

    // Edit aktivitas utama
    public function edit_aktivitas($id_aktivitas_utama)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data jabatan

        $m_aktivitas        = new Aktivitas_model();
        $m_aktivitas_utama  = new Aktivitas_utama_model();
        $m_pegawai          = new Pegawai_model();
        $aktivitas          = $m_aktivitas->listing();
        $aktivitas_utama    = $m_aktivitas_utama->detail($id_aktivitas_utama);
        $pegawai            = $m_pegawai->jabatan($aktivitas_utama->id_jabatan);


        $data = [   'title'             => 'Edit Aktivitas Utama: '.$aktivitas_utama->nama_aktivitas,
                    'aktivitas'         => $aktivitas,
                    'pegawai'           => $pegawai,
                    'aktivitas_utama'   => $aktivitas_utama,
                    'content'           => 'admin/jabatan/edit_aktivitas'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // Update aktivitas utama
    public function update_aktivitas(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $pegawai    = DB::table('pegawai')->where('nip', $request->nip)->first();

        // end proteksi halaman
        request()->validate([
                            'nip'           => 'required',
                            'id_aktivitas'  => 'required',
                            ]);

        DB::table('aktivitas_utama')->where('id_aktivitas_utama', $request->id_aktivitas_utama)->update([
            'id_pegawai'            => Session()->get('id_pegawai'),
            'id_jabatan'            => $pegawai->id_jabatan,
            'id_aktivitas'          => $request->id_aktivitas,
            'jenis_aktivitas_utama' => $request->jenis_aktivitas_utama,
            'nip'                   => $request->nip,
        ]);
        return redirect('admin/jabatan/aktivitas/' . $pegawai->id_jabatan)->with(['sukses' => 'Data telah diubah']);
    }

    // Hapus aktivitas utama
    public function delete_aktivitas($id_aktivitas_utama,$id_jabatan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('aktivitas_utama')->where('id_aktivitas_utama',$id_aktivitas_utama)->delete();
        return redirect('admin/jabatan/aktivitas/' . $id_jabatan)->with(['sukses' => 'Data telah dihapus']);
    }
}


