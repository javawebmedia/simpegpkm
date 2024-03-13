<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
// panggil model
use App\Models\Pegawai_model;
use App\Models\Jabatan_model;
use App\Models\Riwayat_jabatan_model;
use App\Models\Pendidikan_model;
use App\Models\Keluarga_model;
use App\Models\Konfigurasi_model;
use Image;
use PDF;

class Home extends Controller
{
    // index
    public function index()
    {
        $m_site = new Konfigurasi_model();
        $site   = $m_site->listing();

        $data = [   'title'         => $site->namaweb.' | '.$site->tagline,
                    'description'   => $site->namaweb.' | '.$site->tagline,
                    'keywords'      => $site->namaweb.' | '.$site->tagline,
                    'site'          => $site,
                    'content'       => 'home/index'
                ];
        return view('layout/wrapper',$data);
    }

    // tentang aplikasi
    public function tentang()
    {
        $m_site = new Konfigurasi_model();
        $site   = $m_site->listing();

        $data = [   'title'         => 'Tentang Aplikasi '.$site->singkatan,
                    'description'   => 'Tentang Aplikasi '.$site->singkatan,
                    'keywords'      => 'Tentang Aplikasi '.$site->singkatan,
                    'site'          => $site,
                    'content'       => 'home/tentang'
                ];
        return view('layout/wrapper',$data);
    }

    // kontak
    public function kontak()
    {
        $m_site = new Konfigurasi_model();
        $site   = $m_site->listing();

        $data = [   'title'         => 'Menghubungi '.$site->namaweb,
                    'description'   => 'Menghubungi '.$site->namaweb,
                    'keywords'      => 'Menghubungi '.$site->namaweb,
                    'site'          => $site,
                    'content'       => 'home/kontak'
                ];
        return view('layout/wrapper',$data);
    }

    // panduan
    public function panduan()
    {
        $m_site     = new Konfigurasi_model();
        $site       = $m_site->listing();
        $panduan    = DB::table('panduan')->get();

        $data = [   'title'         => 'Panduan Penggunaan Aplikasi '.$site->namaweb,
                    'description'   => 'Panduan Penggunaan Aplikasi '.$site->namaweb,
                    'keywords'      => 'Panduan Penggunaan Aplikasi '.$site->namaweb,
                    'site'          => $site,
                    'panduan'       => $panduan,
                    'content'       => 'home/panduan'
                ];
        return view('layout/wrapper',$data);
    }

     // detail
    public function detail($id_panduan)
    {
        $m_site     = new Konfigurasi_model();
        $site       = $m_site->listing();
        
        $panduan    = DB::table('panduan')->where('id_panduan',$id_panduan)->first();
        $pathToFile = './assets/upload/file/'.$panduan->gambar;
        return response()->download($pathToFile, $panduan->gambar);
    }
}
