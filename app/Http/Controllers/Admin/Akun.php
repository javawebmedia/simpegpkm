<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
// panggil model
use App\Models\Pegawai_model;
use Image;
use PDF;

class Akun extends Controller
{
    // halaman akun
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_pegawai  = new Pegawai_model();
        $pegawai    = $m_pegawai->detail(Session()->get('id_pegawai'));

        $divisi = DB::table('divisi')->orderBy('urutan', 'asc')->get();
        $agama = DB::table('agama')->orderBy('urutan', 'asc')->get();
        $jenjang_pendidikan = DB::table('jenjang_pendidikan')->orderBy('urutan', 'asc')->get();

        $data = [   'title'                 => 'Update Profil: '.$pegawai->nama_lengkap,
                    'pegawai'               => $pegawai,
                    'divisi'                => $divisi,
                    'agama'                 => $agama,
                    'jenjang_pendidikan'    => $jenjang_pendidikan,
                    'content'               => 'admin/akun/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // halaman ganti password
    public function password()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $data = [   'title'     => 'Ganti Password',
                    'content'   => 'admin/akun/password'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // ganti password
    public function ganti_password(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $pesan  = [ 'required_with' => 'Password harus diisi',
                    'same'          => 'Password tidak sama',
                    'min'           => 'Password minimal :min karakter',
                    'max'           => 'Password minimal :max karakter',
                    ];
        request()->validate([
                            'password'              => 'required_with:password_confirmation|same:password_konfirmasi|min:6|max:32',
                            'password_konfirmasi'   => 'required|min:6|max:32'
                            ],
                            $pesan);

        DB::table('pegawai')->where('id_pegawai',$request->session()->get('id_pegawai'))->update([
            'password'      => sha1($request->password)
        ]);
        return redirect('admin/akun/password')->with(['sukses' => 'Password telah diganti.']);
    }

    // Proses edit akun pegawai
    public function edit(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        request()->validate([
            'nip'           => 'required',
            'nama_lengkap'  => 'required',
            'foto'          => 'file|image|mimes:jpeg,png,jpg|max:8024',
        ]);

        // UPLOAD START
        $image = $request->file('foto');
        if(!empty($image))
        {
            $filenamewithextension  = $request->file('foto')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath        = './assets/upload/images/thumbs/';
            $img = Image::make($image->getRealPath(),array(
                'width'     => 150,
                'height'    => 150,
                'grayscale' => false
            ));
            $img->save($destinationPath.'/'.$input['nama_file']);
            $destinationPath = './assets/upload/images/';
            $image->move($destinationPath, $input['nama_file']);
            // END UPLOAD

            // Simpan data
            DB::table('pegawai')->where('id_pegawai',$request->id_pegawai)->update([
                'nik'               => $request->nik,
                'nama_lengkap'      => $request->nama_lengkap,
                'nama_panggilan'    => $request->nama_panggilan,
                'gelar_depan'       => $request->gelar_depan,
                'gelar_belakang'    => $request->gelar_belakang,
                'tempat_lahir'      => $request->tempat_lahir,
                'tanggal_lahir'     => date('Y-m-d', strtotime($request->tanggal_lahir)),
                'jenis_kelamin'     => $request->jenis_kelamin,
                'id_agama'          => $request->id_agama,
                'status_perkawinan' => $request->status_perkawinan,
                'telepon'           => $request->telepon,
                'email'             => $request->email,
                'alamat'            => $request->alamat,
                'keterangan'        => $request->keterangan,
                'foto'              => $input['nama_file']
            ]);
        }
        else
        {
            // Simpan data tanpa upload
             DB::table('pegawai')->where('id_pegawai',$request->id_pegawai)->update([
                'nik'               => $request->nik,
                'nama_lengkap'      => $request->nama_lengkap,
                'nama_panggilan'    => $request->nama_panggilan,
                'gelar_depan'       => $request->gelar_depan,
                'gelar_belakang'    => $request->gelar_belakang,
                'tempat_lahir'      => $request->tempat_lahir,
                'tanggal_lahir'     => date('Y-m-d', strtotime($request->tanggal_lahir)),
                'jenis_kelamin'     => $request->jenis_kelamin,
                'id_agama'          => $request->id_agama,
                'status_perkawinan' => $request->status_perkawinan,
                'telepon'           => $request->telepon,
                'email'             => $request->email,
                'alamat'            => $request->alamat,
                'keterangan'        => $request->keterangan
            ]);
        }
        return redirect('admin/akun')->with(['sukses' => 'Data telah diedit']);
    }

    // halaman cetak pegawai
    public function cetak()
    {
        $id_pegawai = Session()->get('id_pegawai');

        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_pegawai  = new Pegawai_model();
        $pegawai    = $m_pegawai->detail($id_pegawai);

        $data = [   'title'     => $pegawai->nama_lengkap.' (NIP: '.$pegawai->nip.')',
                    'pegawai'   => $pegawai
                ];
        return view('admin/pegawai/cetak',$data);
    }

    // halaman unduh pegawai
    public function unduh()
    {
        $id_pegawai = Session()->get('id_pegawai');
        
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_pegawai  = new Pegawai_model();
        $pegawai    = $m_pegawai->detail($id_pegawai);

        $data = [   'title'     => $pegawai->nama_lengkap.' (NIP: '.$pegawai->nip.')',
                    'pegawai'   => $pegawai
                ];
        // mulai unduh pdf
        $config = [
            'format' => 'A4-P', 
        ];
        $pdf        = PDF::loadview('admin/pegawai/cetak', $data,[] ,$config);
        $nama_file  = 'cetak-pegawai-'.$pegawai->nama_lengkap.'-'.date('d-m-Y-H-i-s').'.pdf';
        return $pdf->download($nama_file, 'I');
        // end unduh
    }
}
