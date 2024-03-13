<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use PDF;
use Illuminate\Support\Str;

class Panduan extends Controller
{
    // halaman panduan
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data panduan
        $panduan = DB::table('panduan')->get();

        $data = [   'title'     => 'Data Master Panduan',
                    'panduan'     => $panduan,
                    'content'   => 'admin/panduan/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_panduan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data panduan
        $panduan = DB::table('panduan')->where('id_panduan',$id_panduan)->first();

        $data = [   'title'     => 'Edit Panduan: '.$panduan->nama_panduan,
                    'panduan'     => $panduan,
                    'content'   => 'admin/panduan/edit'
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
            'nama_panduan'  => 'required',
            'gambar'        => 'file|mimetypes:application/pdf,image/png,image/jpg,image/jpeg,image/gif|max:8024',
        ]);

        // UPLOAD START
        $image                  = $request->file('gambar');
        $filenamewithextension  = $request->file('gambar')->getClientOriginalName();
        $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
        $destinationPath        = './assets/upload/file';
        $image->move($destinationPath, $input['nama_file']);
        // END UPLOAD

        DB::table('panduan')->insert([
            'id_user'           => Session()->get('id_pegawai'),
            'nama_panduan'      => $request->nama_panduan,
            'keterangan'        => $request->keterangan,
            'gambar'            => $input['nama_file'],
            'video'             => $request->video,
            'pengguna'          => $request->pengguna,
        ]);
        return redirect('admin/panduan')->with(['sukses' => 'Data telah ditambah']);
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
            'nama_panduan'  => 'required',
            'gambar'        => 'file|mimetypes:application/pdf,image/png,image/jpg,image/jpeg,image/gif|max:8024',
        ]);

        // UPLOAD START
        $image                  = $request->file('gambar');
        if(!empty($image)) {
            $filenamewithextension  = $request->file('gambar')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath        = './assets/upload/file';
            $image->move($destinationPath, $input['nama_file']);
            // END UPLOAD

            DB::table('panduan')->where('id_panduan',$request->id_panduan)->update([
                'id_user'           => Session()->get('id_pegawai'),
                'nama_panduan'      => $request->nama_panduan,
                'keterangan'        => $request->keterangan,
                'gambar'            => $input['nama_file'],
                'video'             => $request->video,
                'pengguna'          => $request->pengguna,
            ]);
        }else{
             DB::table('panduan')->where('id_panduan',$request->id_panduan)->update([
                'id_user'           => Session()->get('id_pegawai'),
                'nama_panduan'      => $request->nama_panduan,
                'keterangan'        => $request->keterangan,
                'video'             => $request->video,
                'pengguna'          => $request->pengguna,
            ]);
        }
        return redirect('admin/panduan')->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_panduan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('panduan')->where('id_panduan',$id_panduan)->delete();
        return redirect('admin/panduan')->with(['sukses' => 'Data telah dihapus']);
    }
}
