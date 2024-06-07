<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Pegawai_model;
use App\Models\Absensi_model;
use App\Models\Kehadiran_model;
use App\Models\Data_finger_model;
use App\Models\Jadwal_pegawai_model;
use App\Models\Status_absen_model;
use App\Models\Riwayat_jabatan_model;
use App\Models\Pendidikan_model;
use App\Models\Keluarga_model;
use App\Models\Mesin_absen_model;
use App\Models\Pin_pegawai_model;
use App\Models\Diklat_model;
use App\Models\Tkd_model;
use App\Models\Gaji_model;
use App\Models\Jenis_pelatihan_model;
use App\Models\Rumpun_model;
use App\Models\Metode_diklat_model;
use App\Models\Kategori_diklat_model;
use App\Models\Kode_diklat_model;
use App\Models\Str_sip_model;
use App\Models\Shift_model;
use App\Models\Shift_hari_model;
use App\Models\Libur_model;
use Image;
use PDF;

class Detail extends Controller
{
    // halaman absensi
    public function index()
    {

    }

    // detail
    public function pegawai($nip,$tahun,$bulan)
    {
        // proteksi halaman
        if(Session()->get('username')=="") { 
            $last_page = url()->full();
            return redirect('login?redirect='.$last_page)->with(['warning' => 'Mohon maaf, Anda belum login']);
        }
        // end proteksi halaman
        $m_pegawai          = new Pegawai_model();
        $m_riwayat_jabatan  = new Riwayat_jabatan_model();
        $m_pendidikan       = new Pendidikan_model();
        $m_keluarga         = new Keluarga_model();
        $m_diklat           = new Diklat_model();
        $m_str_sip          = new Str_sip_model();

        $pegawai            = $m_pegawai->nip($nip);
        $id_pegawai         = $pegawai->id_pegawai;

        $riwayat_jabatan    = $m_riwayat_jabatan->pegawai($id_pegawai);
        $pendidikan         = $m_pendidikan->pegawai($id_pegawai);
        $keluarga           = $m_keluarga->pegawai($id_pegawai);
        $diklat             = $m_diklat->nip($nip);
        $str_sip            = $m_str_sip->pegawai($id_pegawai);

        $data = [   'title'             => $pegawai->nama_lengkap.' (NIP: '.$pegawai->nip.')',
                    'pegawai'           => $pegawai,
                    'riwayat_jabatan'   => $riwayat_jabatan,
                    'pendidikan'        => $pendidikan,
                    'keluarga'          => $keluarga,
                    'diklat'            => $diklat,
                    'str_sip'           => $str_sip,
                    'tahun'             => $tahun,
                    'bulan'             => $bulan,
                    'flow'              => 'pegawai',
                    'content'           => 'admin/detail/pegawai'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // generate
    public function generate($pin,$tahun,$bulan)
    {
        $m_pegawai          = new Pegawai_model();
        $m_jadwal_pegawai   = new Jadwal_pegawai_model();
        $m_shift            = new Shift_model();
        $m_shift_hari       = new Shift_hari_model();
        $m_libur            = new Libur_model();
        $m_absensi          = new Absensi_model();
        $m_kehadiran        = new Kehadiran_model();
        $m_data_finger      = new Data_finger_model();
        $m_jadwal_pegawai   = new Jadwal_pegawai_model();

        $pegawai            = $m_pegawai->pin($pin);
        $thbl               = $tahun.$bulan;
        $TAHUN              = $tahun;
        $BULAN              = $bulan;
        $THBL               = $TAHUN.$BULAN;
        // PROSES KEHADIRAN
        $jumlah_hari        = cal_days_in_month(CAL_GREGORIAN, $BULAN, $TAHUN);
        $semua_tanggal      = [];
        for ($hari = 1; $hari <= $jumlah_hari; $hari++) {
            $tanggal = sprintf('%04d-%02d-%02d', $TAHUN, $BULAN, $hari);
            $semua_tanggal[] = $tanggal;
        }
        // Menampilkan semua tanggal
        foreach ($semua_tanggal as $tanggal) {
            // check jadwal pegawai sesuai tanggal
            $pin                    = $pegawai->pin;
            $check_jadwal           = $m_jadwal_pegawai->check_tanggal($pin,$tanggal);

            if(!empty($check_jadwal)) {
                // data finger awal
                $check_finger_awal      = $m_data_finger->check_finger_awal($pegawai->pin,$tanggal,'0');
                $tanggal_kemarin        = $tanggal;
                // jika ganti hari
                if($check_jadwal->ganti_hari=='Ya') {
                    $tanggal_keluar         = date("Y-m-d", strtotime($tanggal_kemarin . " +1 day"));
                    $check_finger_akhir     = $m_data_finger->check_finger_akhir_shift($pegawai->pin,$tanggal_keluar,'1');
                }else{
                    $tanggal_keluar         = $tanggal;
                    $check_finger_akhir     = $m_data_finger->check_finger_akhir($pegawai->pin,$tanggal_keluar,'1');
                }
                // echo $tanggal . "<br>";

                if(!empty($check_finger_awal)) {
                    $tanggal_masuk      = $check_finger_awal->tanggal_finger;
                    $tanggal_jam_masuk  = $check_finger_awal->waktu_finger;
                }else{
                    $tanggal_masuk      = $tanggal;
                    $tanggal_jam_masuk  = null;
                }

                if(!empty($check_finger_akhir)) {
                    $tanggal_keluar     = $check_finger_akhir->tanggal_finger;   
                    $tanggal_jam_keluar = $check_finger_akhir->waktu_finger;
                }else{
                    $tanggal_keluar     = $tanggal_keluar;
                    $tanggal_jam_keluar = null;
                }

                // print_r($check_finger_awal);
                if($check_jadwal->day_off=='Ya') {
                    $kehadiran                  = 'OFF';
                    $keterangan                 = '-';
                    $jumlah_menit_terlambat     = 0;
                    $jumlah_menit_pulang_cepat  = 0;
                    $lembur                     = 0;
                    $total_jam_kerja            = 0;
                }else{
                    if($tanggal_jam_masuk == null && $tanggal_jam_keluar == null) {
                        $kehadiran                  = 'Alpa';
                        $keterangan                 = '-';
                        $jumlah_menit_terlambat     = 0;
                        $jumlah_menit_pulang_cepat  = 0;
                        $lembur                     = 0;
                        $total_jam_kerja            = 0;
                    }elseif($tanggal_jam_masuk == $tanggal_jam_keluar) {
                        $kehadiran                  = 'Hadir';
                        $keterangan                 = '-';
                        $jumlah_menit_terlambat     = 0;
                        $jumlah_menit_pulang_cepat  = 0;
                        $lembur                     = 0;
                        $total_jam_kerja            = 225;
                    }else{
                        $kehadiran                  = 'Hadir';
                        $keterangan                 = '-';
                        // klo jam masuk ga ada
                        if($tanggal_jam_masuk==null) {
                            $jumlah_menit_terlambat     = 0;
                            $jumlah_menit_pulang_cepat  = 0;
                            $lembur                     = 0;
                            $total_jam_kerja            = 225;
                        }elseif($tanggal_jam_keluar == null) {
                            $jumlah_menit_terlambat     = 0;
                            $jumlah_menit_pulang_cepat  = 0;
                            $lembur                     = 0;
                            $total_jam_kerja            = 225;
                        }elseif(!empty($check_finger_awal) && !empty($check_finger_akhir)) {
                            $waktu_awal                 = $check_finger_awal->waktu_finger;
                            $waktu_akhir                = $check_finger_akhir->waktu_finger;
                            $timestamp_awal             = strtotime($waktu_awal);
                            $timestamp_akhir            = strtotime($waktu_akhir);

                            // Menghitung selisih waktu dalam detik
                            $total_jam_kerja            = ($timestamp_akhir - $timestamp_awal)/60;
                            // standar
                            $jam_standar_masuk          = strtotime($tanggal_masuk.' '.$check_jadwal->jam_mulai);
                            $jam_standar_pulang         = strtotime($tanggal_keluar.' '.$check_jadwal->jam_selesai);

                            $jam_awal_standar_masuk     = strtotime($tanggal_masuk.' '.$check_jadwal->start_jam_mulai);
                            $jam_awal_standar_pulang    = strtotime($tanggal_keluar.' '.$check_jadwal->start_jam_selesai);

                            $jam_akhir_standar_masuk    = strtotime($tanggal_masuk.' '.$check_jadwal->end_jam_mulai);
                            $jam_akhir_standar_pulang   = strtotime($tanggal_keluar.' '.$check_jadwal->end_jam_selesai); 

                            if($timestamp_awal >= $jam_awal_standar_masuk && $timestamp_awal <= $jam_akhir_standar_masuk) {
                                $jumlah_menit_terlambat     = 0;
                                $jumlah_menit_pulang_cepat  = 0;
                                $lembur                     = 0;
                                $total_jam_kerja            = $total_jam_kerja;
                                $jumlah_menit_terlambat     = ($timestamp_awal - $jam_standar_masuk)/60;
                            }else{
                                $jumlah_menit_terlambat     = 0;
                                $jumlah_menit_pulang_cepat  = 0;
                                $lembur                     = 0;
                                $total_jam_kerja            = 225;
                                $jumlah_menit_terlambat     = 0;
                            }              
                            
                            if($timestamp_akhir >= $jam_awal_standar_pulang && $timestamp_akhir <= $jam_akhir_standar_pulang) {
                                $jumlah_menit_terlambat     = 0;
                                $jumlah_menit_pulang_cepat  = 0;
                                $lembur                     = 0;
                                $total_jam_kerja            = $total_jam_kerja;
                                $jumlah_menit_pulang_cepat  = ($jam_standar_pulang - $timestamp_akhir)/60;
                                $lembur                     = 0;
                            }else{
                                $jumlah_menit_terlambat     = 0;
                                $jumlah_menit_pulang_cepat  = 0;
                                $lembur                     = 0;
                                $total_jam_kerja            = 225;
                                $jumlah_menit_pulang_cepat  = 0;
                                $lembur                     = 0;
                            }                                 
                        }
                    }
                }
                // hitung lainnya

                $data = [   'id_shift'                  => $check_jadwal->id_shift,
                            'nip'                       => $pegawai->nip,
                            'pin'                       => $pegawai->pin,
                            'tanggal_masuk'             => $tanggal_masuk,
                            'tanggal_keluar'            => $tanggal_keluar,
                            'tanggal_jam_masuk'         => $tanggal_jam_masuk,
                            'tanggal_jam_keluar'        => $tanggal_jam_keluar,
                            'kehadiran'                 => $kehadiran,
                            'keterangan'                => $keterangan,
                            'jumlah_menit_terlambat'    => $jumlah_menit_terlambat,
                            'jumlah_menit_pulang_cepat' => $jumlah_menit_pulang_cepat,
                            'lembur'                    => $lembur,
                            'total_jam_kerja'           => $total_jam_kerja,
                            'thbl'                      => $THBL,
                            'tahun'                     => $TAHUN,
                            'bulan'                     => $BULAN,
                            'id_pengguna'               => Session()->get('id_pegawai')
                        ];
                $check = $m_kehadiran->check_pegawai_thbl($pegawai->nip, $tanggal_masuk);
                if($check > 0) {
                     DB::table('kehadiran')->where(['pin'           => $pegawai->pin,
                                                    'tanggal_masuk' => $tanggal_masuk])->update($data);
                }else{
                     DB::table('kehadiran')->insert($data);
                }
            }else{
                //  jika tidak diset jadwal maka kehadiran tidak diproses
            }
        }
        // END PROSES KEHADIRAN
        // PROSES REKAP ABSENSI
        $nip    = $pegawai->nip;
        $total  = $m_kehadiran->pegawai_thbl($pegawai->pin,$thbl);
        $hadir  = $m_kehadiran->pegawai_thbl_status($pegawai->pin,$thbl,'Hadir');
        $alpa   = $m_kehadiran->pegawai_thbl_status($pegawai->pin,$thbl,'Alpa');
        $sakit  = $m_kehadiran->pegawai_thbl_status($pegawai->pin,$thbl,'Sakit');
        $izin   = $m_kehadiran->pegawai_thbl_status($pegawai->pin,$thbl,'Izin');
        $check      = $m_absensi->thbl_pegawai($thbl,$nip);
        if($check) {
            $nilai_perilaku = $check->nilai_perilaku;
            $nilai_serapan  = $check->nilai_serapan;
            $keterangan     = $check->keterangan;
        }else{
            $nilai_perilaku = 0;
            $nilai_serapan  = 0;
            $keterangan     = '-';
        }
        $data   = [
                'id_pegawai'        => Session()->get('id_pegawai'),
                'nip'               => $pegawai->nip,
                'thbl'              => $thbl,
                'bulan'             => $bulan,
                'tahun'             => $tahun,
                'menit_terlambat'   => $total->total_jumlah_menit_terlambat,
                'sakit'             => $sakit->total_status_kehadiran,
                'izin'              => $izin->total_status_kehadiran,
                'alpa'              => $alpa->total_status_kehadiran,
                'keterangan'        => $keterangan,
                'tanggal_post'      => date('Y-m-d H:i:s')
            ];
        
        if($check) {
            DB::table('absensi')->where(['nip' => $check->nip, 'thbl' => $check->thbl])->update($data); 
        }else{
           DB::table('absensi')->insert($data); 
        }
        // END PROSES REKAP ABSENSI
        return redirect('admin/detail/kehadiran/'.$pegawai->pin.'/'.$tahun.'/'.$bulan)->with(['sukses' => 'Data kehadiran telah digenerate.']);
            
    }

    // jadwal
    public function jadwal($id_pegawai,$tahun,$bulan)
    {
        $m_pegawai          = new Pegawai_model();
        $m_jadwal_pegawai   = new Jadwal_pegawai_model();
        $m_shift            = new Shift_model();
        $m_shift_hari       = new Shift_hari_model();
        $m_libur            = new Libur_model();

        $pegawai            = $m_pegawai->detail($id_pegawai);
        $thbl               = $tahun.$bulan;

        if($pegawai->status_shift=='Ya') {
            $konten     = 'admin/jadwal_pegawai/tambah-shift';
        }elseif($pegawai->status_shift=='' || $pegawai->status_shift==null) {
            $konten     = 'admin/jadwal_pegawai/tambah';
        }else{
            $konten     = 'admin/jadwal_pegawai/tambah';
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
                    'konten'            => $konten,
                    'flow'              => 'jadwal',
                    'content'           => 'admin/detail/jadwal'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // kehadiran
    public function kehadiran($pin,$tahun,$bulan)
    {
        $m_pegawai      = new Pegawai_model();
        $m_kehadiran    = new Kehadiran_model();
        $m_absensi      = new Absensi_model();
        $m_status_absen = new Status_absen_model();

        $pegawai        = $m_pegawai->pin($pin);
        $thbl           = $tahun.$bulan;
        $kehadiran      = $m_kehadiran->pegawai_thbl_all($pin,$thbl);

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

        $data = [   'title'             => 'Data Kehadiran: '.$pegawai->nama_lengkap.
                                            ' (NIP: '.$pegawai->nip.') - '.$nama_bulan.' '.$tahun,
                    'pegawai'           => $pegawai,
                    'tahun'             => $tahun,
                    'bulan'             => $bulan,
                    'thbl'              => $tahun.$bulan,
                    'm_kehadiran'       => $m_kehadiran,
                    'm_status_absen'    => $m_status_absen,
                    'kehadiran'         => $kehadiran,
                    'flow'              => 'kehadiran',
                    'content'           => 'admin/detail/kehadiran'
                ];
        return view('admin/layout/wrapper',$data);
    }

    // absensi
    public function absensi($pin,$tahun,$bulan)
    {
        $m_pegawai      = new Pegawai_model();
        $m_kehadiran    = new Kehadiran_model();
        $m_absensi      = new Absensi_model();
        $m_status_absen = new Status_absen_model();

        $pegawai        = $m_pegawai->pin($pin);
        $thbl           = $tahun.$bulan;
        $kehadiran      = $m_kehadiran->pegawai_thbl_all($pin,$thbl);

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

        $data = [   'title'             => 'Rekap Kehadiran: '.$pegawai->nama_lengkap.
                                            ' (NIP: '.$pegawai->nip.') - '.$nama_bulan.' '.$tahun,
                    'pegawai'           => $pegawai,
                    'tahun'             => $tahun,
                    'bulan'             => $bulan,
                    'thbl'              => $tahun.$bulan,
                    'm_kehadiran'       => $m_kehadiran,
                    'm_status_absen'    => $m_status_absen,
                    'kehadiran'         => $kehadiran,
                    'flow'              => 'absensi',
                    'content'           => 'admin/detail/absensi'
                ];
        return view('admin/layout/wrapper',$data);
    }
}