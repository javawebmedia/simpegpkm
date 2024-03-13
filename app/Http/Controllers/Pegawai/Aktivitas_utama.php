<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
// panggil model
use App\Models\Pegawai_model;
use App\Models\Jabatan_model;
use App\Models\Riwayat_jabatan_model;
use App\Models\Pendidikan_model;
use App\Models\Keluarga_model;
use App\Models\Atasan_model;
use App\Models\Bawahan_model;
use App\Models\Aktivitas_model;
use App\Models\Aktivitas_utama_model;
use App\Models\Kinerja_model;
use Image;
use PDF;

class Aktivitas_utama extends Controller
{
    // index
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $id_pegawai         = Session()->get('id_pegawai');
        $nip                = Session()->get('nip');
        $m_pegawai          = new Pegawai_model();
        $m_aktivitas        = new Aktivitas_model();
        $m_aktivitas_utama  = new Aktivitas_utama_model();
        $pegawai            = $m_pegawai->detail($id_pegawai);
        $aktivitas          = $m_aktivitas->listing();
        $aktivitas_utama    = $m_aktivitas_utama->pegawai($nip);

        $data = [   'title'             => 'Rencana Kinerja',
                    'pegawai'           => $pegawai,
                    'aktivitas'         => $aktivitas,
                    'aktivitas_utama'   => $aktivitas_utama,
                    'content'           => 'pegawai/aktivitas_utama/index'
                ];
        return view('pegawai/layout/wrapper',$data);
    }

    // Tambah aktivitas utama
    public function tambah(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }

        $pegawai    = DB::table('pegawai')->where('nip', $request->nip)->first();

        // end proteksi halaman
        request()->validate([
                            'id_aktivitas'  => 'required',
                            ]);

        DB::table('aktivitas_utama')->insert([
            'id_pegawai'            => Session()->get('id_pegawai'),
            'id_aktivitas'          => $request->id_aktivitas,
            'jenis_aktivitas_utama' => 'Utama',
            'nip'                   => Session()->get('nip')
        ]);
        return redirect('pegawai/aktivitas-utama')->with(['sukses' => 'Data telah ditambah']);
    }

    // delete
    public function delete($id_aktivitas_utama)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('aktivitas_utama')->where([   'id_aktivitas_utama'    => $id_aktivitas_utama,
                                                'nip'                   => Session()->get('nip')
                                            ])->delete();
        return redirect('pegawai/aktivitas-utama')->with(['sukses' => 'Data telah dihapus']);
    }
}
