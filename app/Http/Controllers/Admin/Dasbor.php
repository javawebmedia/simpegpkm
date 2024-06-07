<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegawai_model;

class Dasbor extends Controller
{
    // halaman dasbor
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman

        if(isset($_GET['submit'])) {
            $nip    = $_GET['nip'];
            $tahun  = $_GET['tahun'];
            $bulan  = $_GET['bulan'];
            $pin    = $_GET['pin'];
            $submit = $_GET['submit'];

            if($submit=='generate') {
                return redirect('admin/detail/generate/'.$pin.'/'.$tahun.'/'.$bulan);
            }else{
                return redirect('admin/detail/pegawai/'.$nip.'/'.$tahun.'/'.$bulan);
            }   
        }

        $data = [   'title'     => 'Selamat Datang',
                    'content'   => 'admin/dasbor/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // statistik
    public function statistik()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $data = [   'title'     => 'Statistik Pegawai',
                    'content'   => 'admin/dasbor/statistik'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // cari
    public function cari()
    {
        $m_pegawai  = new Pegawai_model();
        // POST data
        $keywords   = $_GET['search'];
        // $keywords   = 'silvan';
        $response   = array();
        $data       = $m_pegawai->cari($keywords);
        foreach($data as $row) 
        {
            $foto   = $row->foto;
            if($foto=='') {
                $gambar     = '';
            }else{
                $gambar     = asset('assets/upload/images/'.$row->foto);
            }
            $response[] = array(    "nrk"           => $row->nrk,
                                    "label"         => $row->nrk.' '. $row->nama_lengkap.' (NIP: '.$row->nip.')',
                                    "nama_lengkap"  => $row->nama_lengkap, 
                                    "nip"           => $row->nip, 
                                    "pin"           => $row->pin, 
                                    "tempat_lahir"  => $row->tempat_lahir,
                                    "tanggal_lahir" => date('d-m-Y',strtotime($row->tanggal_lahir)),
                                    "gambar"        => $gambar,
                                );
    
        }
        echo json_encode($response);
    }
}
