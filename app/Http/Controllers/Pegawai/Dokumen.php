<?php

namespace App\Http\Controllers\Pegawai;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
// panggil model
use App\Models\Diklat_model;
use App\Models\Pegawai_model;
use App\Models\Jabatan_model;
use App\Models\Riwayat_jabatan_model;
use App\Models\Pendidikan_model;
use App\Models\Keluarga_model;
use App\Models\Konfigurasi_model;
use App\Models\Kehadiran_model;
use App\Models\Str_sip_model;
use App\Models\Jenis_dokumen_model;
use App\Models\Sub_jenis_dokumen_model;
use App\Models\Dokumen_pegawai_model;
use Image;
use PDF;

class Dokumen extends Controller
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
        $id_pegawai                 = Session()->get('id_pegawai');
        $m_pegawai                  = new Pegawai_model();
        $m_dokumen_pegawai          = new Dokumen_pegawai_model();
        $m_jenis_dokumen            = new Jenis_dokumen_model();
        $m_sub_jenis_dokumen        = new Sub_jenis_dokumen_model();
        
        $jenis_dokumen              = $m_jenis_dokumen->status_jenis_dokumen('Aktif');
        $sub_jenis_dokumen          = $m_sub_jenis_dokumen->status_sub_jenis_dokumen('Aktif');
        $pegawai                    = $m_pegawai->detail($id_pegawai);

        $data = [   'title'                     => 'Unggah Dokumen',
                    'pegawai'                   => $pegawai,
                    'jenis_dokumen'             => $jenis_dokumen,
                    'jenis_dokumen2'            => $jenis_dokumen,
                    'sub_jenis_dokumen'         => $sub_jenis_dokumen,
                    'm_sub_jenis_dokumen'       => $m_sub_jenis_dokumen,
                    'm_dokumen_pegawai'         => $m_dokumen_pegawai,
                    'id_pegawai'                => $id_pegawai,
                    'content'                   => 'pegawai/dokumen/index'
                ];
        return view('pegawai/layout/wrapper',$data);
    }

    // unggah
    public function unggah(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        request()->validate([
            'id_jenis_dokumen'      => 'required',
            'id_sub_jenis_dokumen'  => 'required',
            'gambar'                => 'file|mimetypes:application/pdf,image/png,image/jpg,image/jpeg,image/gif|max:8024',
        ]);

        // UPLOAD START
        $pengalihan             = $request->pengalihan;
        $image                  = $request->file('gambar');
        $filenamewithextension  = $request->file('gambar')->getClientOriginalName();
        $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
        $destinationPath        = './assets/upload/file';
        $image->move($destinationPath, $input['nama_file']);
        // END UPLOAD

        DB::table('dokumen_pegawai')->insert([
            'created_by'            => Session()->get('id_pegawai'),
            'id_pegawai'            => $request->id_pegawai,
            'id_jenis_dokumen'      => $request->id_jenis_dokumen,
            'id_sub_jenis_dokumen'  => $request->id_sub_jenis_dokumen,
            'tanggal_unggah'        => date('Y-m-d'),
            'kode_dokumen_pegawai'  => strtoupper(Str::random(32)),
            'gambar'                => $input['nama_file'],
            'keterangan'            => $request->keterangan,
            'ekstensi'              => $filenamewithextension,
            'status_dokumen_pegawai'=> $request->status_dokumen_pegawai
        ]);
        return redirect($pengalihan)->with(['sukses' => 'Data telah ditambah']);
    }

    // Hapus dokumen utama
    public function delete($kode_dokumen_pegawai)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('dokumen_pegawai')->where('kode_dokumen_pegawai',$kode_dokumen_pegawai)->delete();
        if(isset($_GET['pengalihan'])) {
            return redirect($_GET['pengalihan'])->with(['sukses' => 'Data telah dihapus']);
        }else{
            return redirect('pegawai/dokumen')->with(['sukses' => 'Data telah dihapus']);
        }
        
    }
}
