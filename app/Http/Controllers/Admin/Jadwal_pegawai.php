<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\Parser;
use App\Models\Pegawai_model;
use App\Models\Jadwal_pegawai_model;
use App\Models\Shift_model;
use App\Models\Libur_model;
use App\Models\Jenis_libur_model;
use App\Models\Shift_hari_model;
// load libary
use App\Libraries\Website;

class Jadwal_pegawai extends Controller
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
        $m_jadwal_pegawai   = new Jadwal_pegawai_model();
        $m_pegawai          = new Pegawai_model();

        // sortir jenis shift
        if(isset($_GET['shift'])) {
            $status_shift       = $_GET['shift'];
            if($status_shift=='Ya') {
                $title              = 'Jadwal Kerja Pegawai Shift';
            }else{
                $title              = 'Jadwal Kerja Pegawai Non Shift';
            }
            $pegawai            = $m_pegawai->shift($status_shift);
        }else{
            $title              = 'Jadwal Kerja Semua Pegawai';
            $pegawai            = $m_pegawai->listing();
        }
        // end jenis shift
        
        $total_shift        = $m_pegawai->status_shift('Ya');
        $total_non_shift    = $m_pegawai->status_shift('Tidak');

        if(isset($_GET['thbl'])) {
            $thbl   = $_GET['thbl'];
            $tahun  = $_GET['tahun'];
            $bulan  = $_GET['bulan'];
        }else{
            $thbl   = date('Ym');
            $tahun  = date('Y');
            $bulan  = date('m');
        }

        $data = [   'title'             => $title,
                    'm_jadwal_pegawai'  => $m_jadwal_pegawai,
                    'pegawai'           => $pegawai,
                    'thbl'              => $thbl,
                    'tahun'             => $tahun,
                    'bulan'             => $bulan,
                    'total_shift'       => $total_shift,
                    'total_non_shift'   => $total_non_shift,
                    'content'           => 'admin/jadwal_pegawai/index'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // lihat
    public function lihat($tahun,$bulan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_jadwal_pegawai   = new Jadwal_pegawai_model();
        $m_pegawai          = new Pegawai_model();
        $pegawai            = $m_pegawai->listing();
        $thbl   = $tahun.$bulan;

        if(isset($_GET['thbl'])) {
            $thbl   = $_GET['thbl'];
            $tahun  = $_GET['tahun'];
            $bulan  = $_GET['bulan'];
        }

        if($bulan=='01') {
            $nama_bulan = 'Januari';
        }elseif($bulan=='02') {
            $nama_bulan = 'Februari';
        }elseif($bulan=='03') {
            $nama_bulan = 'Maret';
        }elseif($bulan=='04') {
            $nama_bulan = 'April';
        }elseif($bulan=='05') {
            $nama_bulan = 'Mei';
        }elseif($bulan=='06') {
            $nama_bulan = 'Juni';
        }elseif($bulan=='07') {
            $nama_bulan = 'Juli';
        }elseif($bulan=='08') {
            $nama_bulan = 'Agustus';
        }elseif($bulan=='09') {
            $nama_bulan = 'September';
        }elseif($bulan=='10') {
            $nama_bulan = 'Oktober';
        }elseif($bulan=='11') {
            $nama_bulan = 'November';
        }elseif($bulan=='12') {
            $nama_bulan = 'Desember';
        }

        $data = [   'title'             => 'Jadwal Kerja Pegawai - '.$nama_bulan.' '.$tahun,
                    'm_jadwal_pegawai'  => $m_jadwal_pegawai,
                    'pegawai'           => $pegawai,
                    'thbl'              => $thbl,
                    'tahun'             => $tahun,
                    'bulan'             => $bulan,
                    'content'           => 'admin/jadwal_pegawai/lihat'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // tambah
    public function tambah($id_pegawai,$tahun,$bulan)
    {
        $m_pegawai          = new Pegawai_model();
        $m_jadwal_pegawai   = new Jadwal_pegawai_model();
        $m_shift            = new Shift_model();
        $m_shift_hari       = new Shift_hari_model();
        $m_libur            = new Libur_model();

        $pegawai            = $m_pegawai->detail($id_pegawai);
        $thbl               = $tahun.$bulan;

        if($pegawai->status_shift=='Ya') {
            $content     = 'admin/jadwal_pegawai/tambah-shift';
        }else{
            $content     = 'admin/jadwal_pegawai/tambah';
        }

        $data = [   'title'             => 'Update Jam Kerja Pegawai: '.$pegawai->nama_lengkap.' (NIP: '.$pegawai->nip.')',
                    'm_jadwal_pegawai'  => $m_jadwal_pegawai,
                    'pegawai'           => $pegawai,
                    'thbl'              => $thbl,
                    'tahun'             => $tahun,
                    'bulan'             => $bulan,
                    'm_shift'           => $m_shift,
                    'm_libur'           => $m_libur,
                    'm_jadwal_pegawai'  => $m_jadwal_pegawai,
                    'm_shift_hari'      => $m_shift_hari,
                    'content'           => $content
                ];
        return view('admin/layout/wrapper',$data);
    }

    // proses_generate
    public function proses_generate(Request $request)
    {
        ini_set('memory_limit', -1);
        ini_set('max_execution_time', 0);
        
        $m_jadwal_pegawai   = new Jadwal_pegawai_model();
        $m_pegawai          = new Pegawai_model();
        $m_libur            = new Libur_model();
        $m_shift            = new Shift_model();

        
        $website            = new Website(); 

        $thbl               = $request->thbl;
        $tahun              = $request->tahun;
        $bulan              = $request->bulan;
        $status_shift       = $request->status_shift;

        $pegawai            = $m_pegawai->shift($status_shift);

        foreach($pegawai as $pegawai)
        {
            $pin    = $pegawai->pin;
            $nip    = $pegawai->nip;
            // ambil jumlah hari dalam sebulan
            $jumlah_hari    = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
            $semua_tanggal = [];
            for ($hari = 1; $hari <= $jumlah_hari; $hari++) {
                $tanggal = sprintf('%04d-%02d-%02d', $tahun, $bulan, $hari);
                $semua_tanggal[] = $tanggal;
            }
            // end ambil hari
            // proses entri ke database
            foreach ($semua_tanggal as $tanggal) 
            {
                $shift          = $m_shift->listing();
                $shift_default  = $m_shift->shift_default('Ya');
                $day_off        = $m_shift->day_off('Ya');
                $hari           = $website->get_hari($tanggal);
                $libur          = $m_libur->tanggal_libur($tanggal);
                $jumat          = $m_shift->jumat('Ya');
                $check_jadwal   = $m_jadwal_pegawai->check_tanggal($nip,$tanggal);
                // logic
                foreach($shift as $shift) {
                    if(!empty($check_jadwal)) {
                            if($check_jadwal->id_shift==$shift->id_shift) {
                                $id_shift = $check_jadwal->id_shift;
                            }
                        }else{
                        // End 
                        if($hari=='Senin' || $hari=='Selasa' || $hari=='Rabu' || $hari=='Kamis') { 
                            if(!empty($libur)) { 
                                if(!empty($day_off)) { 
                                    if($day_off->id_shift == $shift->id_shift) {
                                       $id_shift = $day_off->id_shift;
                                    }
                                }
                            }elseif(!empty($shift_default)) {
                                if($shift_default->id_shift == $shift->id_shift) {
                                    $id_shift = $shift_default->id_shift;
                                }
                            }
                        }elseif($hari=='Jumat') {
                            if(!empty($jumat)) { 
                                if($jumat->id_shift == $shift->id_shift) {
                                    $id_shift = $jumat->id_shift;
                                }
                            }
                        }elseif($hari=='Sabtu' || $hari=='Minggu') {
                            if(!empty($day_off)) { 
                                if($day_off->id_shift == $shift->id_shift) {
                                    $id_shift = $day_off->id_shift;
                                }
                            }
                        } 
                        // end 
                    }
                }
                // end logic
                // masuk db
                $data = [   'id_user'       => Session()->get('id_pegawai'),
                            'id_shift'      => $id_shift,
                            'pin'           => $pegawai->pin,
                            'nip'           => $pegawai->nip,
                            'tahun'         => $tahun,
                            'bulan'         => $bulan,
                            'tanggal'       => $tanggal
                        ];
                $check  = $m_jadwal_pegawai->check_tanggal($pin,$tanggal);
                if($check) {
                    DB::table('jadwal_pegawai')->where( [   'pin'       => $pin,
                                                            'tanggal'   => $tanggal
                                                    ])->update($data);
                }else{
                    DB::table('jadwal_pegawai')->insert($data);
                }
                // end masuk db
            }
            // end entri ke database
        }
        return redirect('admin/jadwal-pegawai?thbl='.$thbl.'&bulan='.$bulan.'&tahun='.$tahun)->with(['sukses' => 'Data jadwal kerja telah disetting']);
    }

    //proses_tambah
    public function proses_tambah(Request $request)
    {
        $m_jadwal_pegawai = new Jadwal_pegawai_model();
        $thbl       = $request->thbl;
        $tahun      = $request->tahun;
        $bulan      = $request->bulan;
        $pin        = $request->pin;
        $nip        = $request->nip;
        $id_pegawai        = $request->id_pegawai;

        // ambil tanggal dalam satu bulan
        $jumlah_hari    = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        $semua_tanggal = [];
        for ($hari = 1; $hari <= $jumlah_hari; $hari++) {
            $tanggal = sprintf('%04d-%02d-%02d', $tahun, $bulan, $hari);
            $semua_tanggal[] = $tanggal;
        }
        // end ambil tanggal
        // proses ke database
        foreach($semua_tanggal as $tanggal) 
        {
            $input_id_shift     = 'id_shift_'.str_replace('-','',$tanggal);
            $id_shift           = $request->$input_id_shift;
            $check              = $m_jadwal_pegawai->check_tanggal($pin,$tanggal);
            $data = [   'id_user'       => Session()->get('id_pegawai'),
                        'id_shift'      => $id_shift,
                        'pin'           => $pin,
                        'nip'           => $nip,
                        'tahun'         => $tahun,
                        'bulan'         => $bulan,
                        'tanggal'       => $tanggal
                    ];
            if($check) {
                DB::table('jadwal_pegawai')->where( [   'pin'       => $pin,
                                                        'tanggal'   => $tanggal
                                                ])->update($data);
            }else{
                DB::table('jadwal_pegawai')->insert($data);
            }

        }
        // end proses
        return redirect($request->pengalihan)->with(['sukses' => 'Data jadwal kerja telah disetting']);
    }

    // tarik
    public function tarik($id_pegawai)
    {
        $m_pegawai          = new Pegawai_model();
        $m_jadwal_pegawai          = new Jadwal_pegawai_model();
        $pegawai            = $m_pegawai->detail($id_pegawai);
        $ip_pegawai         = $pegawai->ip_pegawai;
        $key_pegawai        = $pegawai->key_pegawai;

        $Connect        = @fsockopen($ip_pegawai, "80", $errno, $errstr, 1);
        if($Connect){
            $soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">".$key_pegawai."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
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
                $check = $m_jadwal_pegawai->check($id_pegawai,$PIN,$DateTime);
                if(count($check) > 0) {
                }else{
                    $data = [   'id_pegawai'        => $id_pegawai,
                                'ip_pegawai'        => $ip_pegawai,
                                'pin'                   => $PIN,
                                'tanggal_finger'        => date('Y-m-d',strtotime($DateTime)),
                                'waktu_finger'          => $DateTime,
                                'verified'              => $Verified,
                                'status_jadwal_pegawai'    => $Status,
                                'work_code'             => $WorkCode
                            ];
                    DB::table('jadwal_pegawai')->insert($data);
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
