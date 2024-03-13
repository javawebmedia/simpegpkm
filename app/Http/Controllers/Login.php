<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Login extends Controller
{
    // halaman login
    public function index()
    {
        // check last page yg coba diakses
        if(isset($_GET['redirect'])) {
            Session()->put('redirect',$_GET['redirect']);
        }else{
            Session()->forget('redirect');
        }
        // end check

        $data = [   'title'     => 'Halaman Login'];
        return view('login/index',$data);
    }

    // check login
    public function check(Request $request)
    {
        $pegawai = DB::table('pegawai')
                    ->where(array(   'nip'          => $request->nip,
                                     'password'     => sha1($request->password)))
                    ->first();
        // kalau pegawainya ada
        if($pegawai) {
            // session adalah data login/authentication
            $request->session()->put('id_pegawai', $pegawai->id_pegawai);
            $request->session()->put('nip', $pegawai->nip);
            $request->session()->put('username', $pegawai->nip);
            $request->session()->put('nama_lengkap', $pegawai->nama_lengkap);
            $request->session()->put('akses_level', $pegawai->akses_level);
            // Jika berhasil masuk halaman dasbor
            if(Session()->get('redirect')=='') {
                // Kalo dia pegawai, masuk ke halaman pegawai
                if($pegawai->akses_level=='Pegawai') {
                    return redirect('pegawai/dasbor')->with(['sukses' => 'Anda berhasil login']);
                }else if($pegawai->akses_level=='Pimpinan'){
                    return redirect('pegawai/dasbor')->with(['sukses' => 'Anda berhasil login']);
                }else if($pegawai->akses_level=='Admin'){
                    return redirect('admin/dasbor')->with(['sukses' => 'Anda berhasil login']);
                }else{
                    return redirect(Session()->get('redirect'))->with(['sukses' => 'Anda berhasil login']);
                }
                // End
                
            }else{
                if($pegawai->akses_level=='Pegawai') {
                    return redirect('pegawai/dasbor')->with(['sukses' => 'Anda berhasil login']);
                }else{
                    return redirect(Session()->get('redirect'))->with(['sukses' => 'Anda berhasil login']);
                }
            }
        }else{
            // jika nip/username dan password tidak cocok, suruh login lagi
            return redirect('login')->with(['warning' => 'Mohon maaf, Username (NIP) atau password salah']);
        }
        // End proses login
    }

    // logout
    public function logout()
    {
        Session()->forget('id_pegawai');
        Session()->forget('nip');
        Session()->forget('username');
        Session()->forget('nama_lengkap');
        Session()->forget('akses_level');
        return redirect('login')->with(['sukses' => 'Anda berhasil logout']);
    }
}
