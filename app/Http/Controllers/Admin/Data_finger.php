<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\Parser;
use App\Models\Mesin_absen_model;
use App\Models\Data_finger_model;
use App\Models\Pegawai_model;

class Data_finger extends Controller
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
        $m_data_finger  = new Data_finger_model();
        $m_pegawai      = new Pegawai_model();
        $m_data_finger  = new Data_finger_model();

        $data_finger    = $m_data_finger->semua(1000);
        $pegawai        = $m_pegawai->listing();
        $mesin_absen    = DB::table('mesin_absen')->get();

        $data = [   'title'         => 'Data Kehadiran Pegawai',
                    'data_finger'   => $data_finger,
                    'mesin_absen'   => $mesin_absen,
                    'mesin_absen2'  => $mesin_absen,
                    'mesin_absen3'  => $mesin_absen,
                    'pegawai'       => $pegawai,
                    'content'       => 'admin/data_finger/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // tambah
    public function tambah(Request $request)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_mesin_absen = new Mesin_absen_model();
        $m_data_finger = new Data_finger_model();
        $id_mesin_absen_masuk   = $request->id_mesin_absen;
        $id_mesin_absen_pulang  = $request->id_mesin_absen_pulang;

        $mesin_absen_masuk      = $m_mesin_absen->detail($id_mesin_absen_masuk);
        $mesin_absen_pulang     = $m_mesin_absen->detail($id_mesin_absen_pulang);

        $ip_address_masuk       = $mesin_absen_masuk->ip_mesin_absen;
        $ip_address_pulang      = $mesin_absen_pulang->ip_mesin_absen;

        $tanggal_finger_masuk   = date('Y-m-d', strtotime($request->tanggal_finger));
        $tanggal_finger_pulang  = date('Y-m-d', strtotime($request->tanggal_finger_pulang));
        $waktu_finger_masuk     = $tanggal_finger_masuk.' '.$request->jam_finger;
        $waktu_finger_pulang    = $tanggal_finger_pulang.' '.$request->jam_finger_pulang;

        request()->validate([
                            'pin' => 'required'
                            ]);

        DB::table('data_finger')->insert([
            'id_mesin_absen'    => $id_mesin_absen_masuk,
            'ip_mesin_absen'    => $ip_address_masuk,
            'pin'               => $request->pin,
            'tanggal_finger'    => $tanggal_finger_masuk,
            'waktu_finger'      => $waktu_finger_masuk,
            'verified'          => 1,
            'status_data_finger'=> 0,
        ]);

        DB::table('data_finger')->insert([
            'id_mesin_absen'    => $id_mesin_absen_pulang,
            'ip_mesin_absen'    => $ip_address_pulang,
            'pin'               => $request->pin,
            'tanggal_finger'    => $tanggal_finger_pulang,
            'waktu_finger'      => $waktu_finger_pulang,
            'verified'          => 1,
            'status_data_finger'=> 1,
        ]);
        return redirect('admin/data-finger')->with(['sukses' => 'Data telah ditambah']);
    }

    // tarik
    public function tarik($id_mesin_absen)
    {
        ini_set('memory_limit', -1);
        ini_set('max_execution_time', 0);
        
        $m_mesin_absen          = new Mesin_absen_model();
        $m_data_finger          = new Data_finger_model();
        $mesin_absen            = $m_mesin_absen->detail($id_mesin_absen);
        $ip_mesin_absen         = $mesin_absen->ip_mesin_absen;
        $key_mesin_absen        = $mesin_absen->key_mesin_absen;

        $Connect        = @fsockopen($ip_mesin_absen, "80", $errno, $errstr, 1);
        if($Connect){
            $soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">".$key_mesin_absen."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
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
            echo "Koneksi Gagal";
        } 

        $buffer = Parser::parseData($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
        $buffer=explode("\r\n",$buffer);
        for($a=0;$a<count($buffer);$a++){
            $data       = Parser::parseData($buffer[$a],"<Row>","</Row>");
            $PIN        = Parser::parseData($data,"<PIN>","</PIN>");
            $DateTime   = Parser::parseData($data,"<DateTime>","</DateTime>");
            $Verified   = Parser::parseData($data,"<Verified>","</Verified>");
            $Status     = Parser::parseData($data,"<Status>","</Status>");
            $WorkCode   = Parser::parseData($data,"<WorkCode>","</WorkCode>");
            if($PIN =='') {}else{
                // echo 'PIN: '.$PIN.'<br>';
                // echo 'DateTime: '.$DateTime.'<br>';
                // echo 'Verified: '.$Verified.'<br>';
                // echo 'Status: '.$Status.'<br>';
                // echo '<hr>';
                $check = $m_data_finger->check($id_mesin_absen,$PIN,$DateTime);
                if(count($check) > 0) {
                }else{
                    $data = [   'id_mesin_absen'        => $id_mesin_absen,
                                'ip_mesin_absen'        => $ip_mesin_absen,
                                'pin'                   => $PIN,
                                'tanggal_finger'        => date('Y-m-d',strtotime($DateTime)),
                                'waktu_finger'          => $DateTime,
                                'verified'              => $Verified,
                                'status_data_finger'    => $Status,
                                'work_code'             => $WorkCode
                            ];
                    DB::table('data_finger')->insert($data);
                }
            }
        }
        return redirect('admin/data-finger')->with(['sukses' => 'Data absensi biometrik telah ditambah']);
    }

    // parser
    public function parser()
    {

    }
}
