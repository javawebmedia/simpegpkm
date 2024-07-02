<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
// panggil model
use App\Models\Asset_model;
use App\Models\Pegawai_model;

class Asset extends Controller
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
        $m_asset   = new Asset_model();
        $asset     = $m_asset->listing(100000);

        $data = [   'title'         => 'Management Asset Puskesmas Kramat Jati',
                    'asset'         => $asset,
                    'content'       => 'admin/asset/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

     // View tambah diklat pegawai
     public function tambah()
     {
         // proteksi halaman
         if(Session()->get('username')=="") { 
             $last_page = url()->full();
             return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
         }
 
         $m_pegawai          = new Pegawai_model();
         $m_diklat           = new Diklat_model();
         $m_rumpun           = new Rumpun_model();
         $m_jenis_pelatihan  = new Jenis_pelatihan_model();
         $m_metode_diklat    = new Metode_diklat_model();
         $m_kategori_diklat  = new Kategori_diklat_model();
         $m_kode_diklat      = new Kode_diklat_model();
 
         $pegawai            = $m_pegawai->listing();
         $rumpun             = $m_rumpun->listing();
         $jenis_pelatihan    = $m_jenis_pelatihan->listing();
         $jenis_metode       = $m_metode_diklat->jenis_metode();
         $metode_diklat      = $m_metode_diklat->listing();
         $kategori_diklat    = $m_kategori_diklat->listing();
         $kode_diklat        = $m_kode_diklat->listing();
         $pegawai            = $m_pegawai->listing();
 
         $data = [  
             'title'                 => 'Tambah Data Diklat Pegawai',
             'rumpun'                => $rumpun,
             'jenis_pelatihan'       => $jenis_pelatihan,
             'metode_diklat'         => $metode_diklat,
             'pegawai'               => $pegawai,
             'kategori_diklat'       => $kategori_diklat,
             'kode_diklat'           => $kode_diklat,
             'jenis_metode'          => $jenis_metode,
             'content'               => 'admin/diklat/tambah'
         ];
         return view('admin/layout/wrapper',$data);
     }
 
     // proses tambah data
     public function proses_tambah(Request $request)
     {
         // proteksi halaman
         if(Session()->get('username')=="") { 
             $last_page = url()->full();
             return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
         }
         // end proteksi halaman
 
         $id = Str::random(9);
         
         request()->validate([
                                'id_asset'        => 'required|unique:id_asset',
                             ]);
 
      
         // UPLOAD START
         $image                  = $request->file('gambar');
         $filenamewithextension  = $request->file('gambar')->getClientOriginalName();
         $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
         $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
         $destinationPath        = './assets/upload/file/foto-asset';
         $image->move($destinationPath, $input['nama_file']);
         // END UPLOAD
 
             DB::table('diklat')->insert([
                 'id_asset'         => $request->id_asset,
                 'id_jenis_asset'   => $request->id_jenis_asset,
                 'id_lokasi'        => $request->id_lokasi,
                 'merek'            => $request->merek,
                 'tahun'            => $request->tahun,
                 'rekening'         => $request->rekening,
                 'harga_barang'     => $request->harga_barang,
                 'lokasi'           => $request->lokasi,
                 'keterangan'       => $request->keterangan,
                 'kondisi'          => $request->kondisi,
                 'status'           => $request->status,
                 'sertifikat'       => $input['nama_file'],
                 'tanggal_post'     => date('Y-m-d H:i:s')
             ]);
             
         return redirect('admin/asset')->with(['sukses' => 'Data telah ditambah']);
     }









} 
