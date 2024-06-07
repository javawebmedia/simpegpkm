<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Status_absen extends Controller
{
    // halaman status_absen
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data status_absen
        $status_absen = DB::table('status_absen')->get();

        $data = [   'title'             => 'Data Master Status absen',
                    'status_absen'      => $status_absen,
                    'content'           => 'admin/status_absen/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_status_absen)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data status_absen
        $status_absen = DB::table('status_absen')->where('id_status_absen',$id_status_absen)->first();

        $data = [   'title'            => 'Edit Status absen: '.$status_absen->nama_status_absen,
                    'status_absen'     => $status_absen,
                    'content'          => 'admin/status_absen/edit'
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

            $id=uniqid();

            request()->validate([
                                'kode_status_absen' => 'required|unique:status_absen',
                                
                                ]);

            DB::table('status_absen')->insert([
                // 'id_status_absen'             => Session()->get('id_pegawai'),
                'id_status_absen'             => $request->$id,
                'kode_status_absen'           => $request->kode_status_absen,
                'nama_status_absen'           => $request->nama_status_absen,
                'jenis_status_absen'          => $request->jenis_status_absen,
                'warna_status_absen'          => $request->warna_status_absen,
                'aktif_status_absen'          => $request->aktif_status_absen,
                'status_kehadiran'            => $request->status_kehadiran,
                'tanggal_post'                => date('Y-m-d H:i:s')
            ]);
        return redirect('admin/status-absen')->with(['sukses' => 'Data telah ditambah']);
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

            $id=uniqid();

            request()->validate([
                                'kode_status_absen' => 'required',
                                ]);

            DB::table('status_absen')->where('id_status_absen',$request->id_status_absen)->update([
                'id_status_absen'             => $request->id_status_absen,
                'kode_status_absen'           => $request->kode_status_absen,
                'nama_status_absen'           => $request->nama_status_absen,
                'jenis_status_absen'          => $request->jenis_status_absen,
                'warna_status_absen'          => $request->warna_status_absen,
                'aktif_status_absen'          => $request->aktif_status_absen,
                'status_kehadiran'            => $request->status_kehadiran,
            ]);
            return redirect('admin/status-absen')->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_status_absen)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('status_absen')->where('id_status_absen',$id_status_absen)->delete();
        return redirect('admin/status-absen')->with(['sukses' => 'Data telah dihapus']);
    }
}
