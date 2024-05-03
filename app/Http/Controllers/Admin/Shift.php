<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Shift extends Controller
{
    // halaman shift
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data shift
        $shift = DB::table('shift')->orderBy('id_shift','DESC')->get();

        $data = [   'title'     => 'Data Master Shift',
                    'shift'     => $shift,
                    'content'   => 'admin/shift/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_shift)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data shift
        $shift = DB::table('shift')->where('id_shift',$id_shift)->first();

        $data = [   'title'     => 'Edit Shift: '.$shift->nama,
                    'shift'     => $shift,
                    'content'   => 'admin/shift/edit'
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
                            'nama' => 'required|unique:shift',
                            'kode' => 'required|unique:shift',
                            ]);

        DB::table('shift')->insert([
            // 'id_pegawai'    => Session()->get('id_pegawai'),
            'kode'          => $request->kode,
            'nama'          => $request->nama,
            'jam_mulai'     => $request->jam_mulai,
            'jam_selesai'   => $request->jam_selesai,
            'hari'          => '-',
            'status'        => $request->status,
            'keterangan'    => $request->keterangan,
            'ganti_hari'    => $request->ganti_hari,
            'shift_default' => $request->shift_default,
            'day_off'       => $request->day_off,
            'jumat'         => $request->jumat,
        ]);
        // ambil
        $check  = DB::table('shift')->where('kode',$request->kode)->first();
        $hari   = $request->hari;

        if(isset($hari)) {
            for($i=0; $i < sizeof($hari);$i++) {
                $data = [   'id_shift'  => $check->id_shift,
                            'hari'      => $hari[$i],
                            'id_user'   => Session()->get('id_pegawai')
                        ];
                DB::table('shift_hari')->insert($data);
            }
        }
        // end ambil
        return redirect('admin/shift')->with(['sukses' => 'Data telah ditambah']);
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
                            'nama' => 'required',
                            ]);

        $status = isset($_POST['my-checkbox']) ? 'aktif' : 'nonaktif';
        
                            
        DB::table('shift')->where('id_shift',$request->id_shift)->update([
            // 'id_pegawai'    => Session()->get('id_pegawai'),
            'kode'          => $request->kode,
            'nama'          => $request->nama,
            'jam_mulai'     => $request->jam_mulai,
            'jam_selesai'   => $request->jam_selesai,
            'hari'          => '-',
            'status'        => $request->status,
            'keterangan'    => $request->keterangan,
            'ganti_hari'    => $request->ganti_hari,
            'shift_default' => $request->shift_default,
            'day_off'       => $request->day_off,
            'jumat'         => $request->jumat,
        ]);
        // ambil
        DB::table('shift_hari')->where('id_shift',$request->id_shift)->delete();
        $hari   = $request->hari;

        if(isset($hari)) {
            for($i=0; $i < sizeof($hari);$i++) {
                $data = [   'id_shift'  => $request->id_shift,
                            'hari'      => $hari[$i],
                            'id_user'   => Session()->get('id_pegawai')
                        ];
                DB::table('shift_hari')->insert($data);
            }
        }
        // end ambil
        return redirect('admin/shift')->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_shift)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('shift')->where('id_shift',$id_shift)->delete();
        return redirect('admin/shift')->with(['sukses' => 'Data telah dihapus']);
    }
}
