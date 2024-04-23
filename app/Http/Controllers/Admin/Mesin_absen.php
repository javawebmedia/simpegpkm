<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\Parser;
use Illuminate\Support\Facades\DB;
use App\Models\Pegawai_model;
use App\Models\Pin_pegawai_model;

class Mesin_absen extends Controller
{
    // halaman mesin_absen
    public function index()
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data mesin_absen
        $mesin_absen = DB::table('mesin_absen')->get();

        $data = [   'title'         => 'Data Master Mesin Absen',
                    'mesin_absen'   => $mesin_absen,
                    'content'       => 'admin/mesin_absen/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // edit
    public function edit($id_mesin_absen)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        // ambil data mesin_absen
        $mesin_absen = DB::table('mesin_absen')->where('id_mesin_absen',$id_mesin_absen)->first();

        $data = [   'title'         => 'Edit Mesin Absen: '.$mesin_absen->ip_mesin_absen,
                    'mesin_absen'   => $mesin_absen,
                    'content'       => 'admin/mesin_absen/edit'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // unggah
    public function unggah($id_mesin_absen)
    {
        $mesin_absen    = DB::table('mesin_absen')->where('id_mesin_absen',$id_mesin_absen)->first();
        $m_pegawai      = new Pegawai_model();
        $m_pin_pegawai  = new Pin_pegawai_model();
        $pegawai        = $m_pegawai->listing();
        $IP             = $mesin_absen->ip_mesin_absen;
        $Key            = $mesin_absen->key_mesin_absen;
        // proses
        foreach($pegawai as $pegawai) 
        {
            $check          = $m_pin_pegawai->check_pegawai_mesin($pegawai->nip,$mesin_absen->id_mesin_absen);
            if(!empty($check)) {}else{
                $nama           = $pegawai->nama_lengkap;
                $id             = substr($pegawai->nip, -9);
                $data = [   'nip'               => $pegawai->nip,
                            'pin'               => $id,
                            'id_mesin_absen'    => $mesin_absen->id_mesin_absen,
                            'ip_mesin_absen'    => $mesin_absen->ip_mesin_absen
                        ];
                DB::table('pin_pegawai')->insert($data);
                // proses masukin ke mesin absen
                $Connect = @fsockopen($IP, "80", $errno, $errstr, 1);
                if($Connect){
                    $soap_request="<SetUserInfo><ArgComKey Xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN>".$id."</PIN><Name>".$nama."</Name></Arg></SetUserInfo>";
                    $newLine="\r\n";
                    fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
                    fputs($Connect, "Content-Type: text/xml".$newLine);
                    fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
                    fputs($Connect, $soap_request.$newLine);
                    $buffer="";
                    while($Response=fgets($Connect, 1024)){
                        $buffer=$buffer.$Response;
                    }
                }else{ 
                    $buffer = 0;
                    echo "Koneksi Gagal";
                }
                $buffer = Parser::parseData($buffer,"<Information>","</Information>");
                echo "<B>Result:</B><BR>";
                echo $buffer.'<hr>';
            }
        }
        return redirect('admin/mesin-absen')->with(['sukses' => 'Data pegawai telah dimasukkan ke mesin absensi']);
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
                            'lokasi'        => 'required',
                            'serial_number' => 'required',
                            ]);

        DB::table('mesin_absen')->insert([
            'ip_mesin_absen'        => $request->ip_mesin_absen,
            'key_mesin_absen'       => $request->key_mesin_absen,
            'serial_number'         => $request->serial_number,
            'lokasi'                => $request->lokasi,
            'status_mesin_absen'    => $request->status_mesin_absen
        ]);
        return redirect('admin/mesin-absen')->with(['sukses' => 'Data telah ditambah']);
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
                            'lokasi'        => 'required',
                            'serial_number' => 'required',
                            ]);

        DB::table('mesin_absen')->where('id_mesin_absen',$request->id_mesin_absen)->update([
            'ip_mesin_absen'        => $request->ip_mesin_absen,
            'key_mesin_absen'       => $request->key_mesin_absen,
            'serial_number'         => $request->serial_number,
            'lokasi'                => $request->lokasi,
            'status_mesin_absen'    => $request->status_mesin_absen
        ]);
        return redirect('admin/mesin-absen')->with(['sukses' => 'Data telah diedit']);
    }

    // delete
    public function delete($id_mesin_absen)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        DB::table('mesin_absen')->where('id_mesin_absen',$id_mesin_absen)->delete();
        return redirect('admin/mesin-absen')->with(['sukses' => 'Data telah dihapus']);
    }
}
