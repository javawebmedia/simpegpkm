<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dokumen_pegawai_model extends Model
{

    // listing
    public function listing()
    {
        $query = DB::table('dokumen_pegawai')
            ->select('dokumen_pegawai.*', 
                'jenis_dokumen.nama_jenis_dokumen',
                'sub_jenis_dokumen.nama_sub_jenis_dokumen',
                'pegawai.nama_lengkap',
                'pegawai.nrk',
                'pegawai.nip'
            )
            ->join('jenis_dokumen', 'jenis_dokumen.id_jenis_dokumen', '=', 'dokumen_pegawai.id_jenis_dokumen','LEFT')
            ->join('sub_jenis_dokumen', 'sub_jenis_dokumen.id_sub_jenis_dokumen', '=', 'dokumen_pegawai.id_sub_jenis_dokumen','LEFT')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'dokumen_pegawai.id_pegawai','LEFT')
            ->orderBy('dokumen_pegawai.id_dokumen_pegawai','DESC')
            ->get();
        return $query;
    }

    // check_all
    public function check_all($id_pegawai,$id_jenis_dokumen,$id_sub_jenis_dokumen)
    {
        $query = DB::table('dokumen_pegawai')
            ->select('*')
            ->where('dokumen_pegawai.id_pegawai',$id_pegawai)
            ->where('dokumen_pegawai.id_jenis_dokumen',$id_jenis_dokumen)
            ->where('dokumen_pegawai.id_sub_jenis_dokumen',$id_sub_jenis_dokumen)
            ->orderBy('dokumen_pegawai.id_dokumen_pegawai','DESC')
            ->get();
        return $query;
    }

    // total_all
    public function total_all($id_pegawai,$id_jenis_dokumen,$id_sub_jenis_dokumen)
    {
        $query = DB::table('dokumen_pegawai')
            ->select('*')
            ->where('dokumen_pegawai.id_pegawai',$id_pegawai)
            ->where('dokumen_pegawai.id_jenis_dokumen',$id_jenis_dokumen)
            ->where('dokumen_pegawai.id_sub_jenis_dokumen',$id_sub_jenis_dokumen)
            ->orderBy('dokumen_pegawai.id_dokumen_pegawai','DESC')
            ->count();
        return $query;
    }

    // id_pegawai
    public function all_id_pegawai($id_pegawai)
    {
        $query = DB::table('dokumen_pegawai')
            ->select('dokumen_pegawai.*', 
                'jenis_dokumen.nama_jenis_dokumen',
                'sub_jenis_dokumen.nama_sub_jenis_dokumen',
                'pegawai.nama_lengkap',
                'pegawai.nrk',
                'pegawai.nip'
            )
            ->join('jenis_dokumen', 'jenis_dokumen.id_jenis_dokumen', '=', 'dokumen_pegawai.id_jenis_dokumen','LEFT')
            ->join('sub_jenis_dokumen', 'sub_jenis_dokumen.id_sub_jenis_dokumen', '=', 'dokumen_pegawai.id_sub_jenis_dokumen','LEFT')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'dokumen_pegawai.id_pegawai','LEFT')
            ->where('dokumen_pegawai.id_pegawai',$id_pegawai)
            ->orderBy('dokumen_pegawai.id_dokumen_pegawai','DESC')
            ->get();
        return $query;
    }

    // id_pegawai
    public function check_id_pegawai($id_pegawai)
    {
        $query = DB::table('dokumen_pegawai')
            ->select('dokumen_pegawai.*', 
                'jenis_dokumen.nama_jenis_dokumen',
                'sub_jenis_dokumen.nama_sub_jenis_dokumen',
                'pegawai.nama_lengkap',
                'pegawai.nrk',
                'pegawai.nip'
            )
            ->join('jenis_dokumen', 'jenis_dokumen.id_jenis_dokumen', '=', 'dokumen_pegawai.id_jenis_dokumen','LEFT')
            ->join('sub_jenis_dokumen', 'sub_jenis_dokumen.id_sub_jenis_dokumen', '=', 'dokumen_pegawai.id_sub_jenis_dokumen','LEFT')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'dokumen_pegawai.id_pegawai','LEFT')
            ->where('dokumen_pegawai.id_pegawai',$id_pegawai)
            ->orderBy('dokumen_pegawai.id_dokumen_pegawai','DESC')
            ->get();
        return $query;
    }

    // paginasi
    public function paginasi($paginasi)
    {
        $query = DB::table('dokumen_pegawai')
            ->select('dokumen_pegawai.*', 
                'jenis_dokumen.nama_jenis_dokumen',
                'sub_jenis_dokumen.nama_sub_jenis_dokumen',
                'pegawai.nama_lengkap',
                'pegawai.nrk',
                'pegawai.nip'
            )
            ->join('jenis_dokumen', 'jenis_dokumen.id_jenis_dokumen', '=', 'dokumen_pegawai.id_jenis_dokumen','LEFT')
            ->join('sub_jenis_dokumen', 'sub_jenis_dokumen.id_sub_jenis_dokumen', '=', 'dokumen_pegawai.id_sub_jenis_dokumen','LEFT')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'dokumen_pegawai.id_pegawai','LEFT')
            ->orderBy('dokumen_pegawai.id_dokumen_pegawai','DESC')
            ->paginate($paginasi);
        return $query;
    }

    // paginasi_cari
    public function paginasi_cari($paginasi,$keywords)
    {
        $query = DB::table('dokumen_pegawai')
            ->select('dokumen_pegawai.*', 
                'jenis_dokumen.nama_jenis_dokumen',
                'sub_jenis_dokumen.nama_sub_jenis_dokumen',
                'pegawai.nama_lengkap',
                'pegawai.nrk',
                'pegawai.nip'
            )
            ->join('jenis_dokumen', 'jenis_dokumen.id_jenis_dokumen', '=', 'dokumen_pegawai.id_jenis_dokumen','LEFT')
            ->join('sub_jenis_dokumen', 'sub_jenis_dokumen.id_sub_jenis_dokumen', '=', 'dokumen_pegawai.id_sub_jenis_dokumen','LEFT')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'dokumen_pegawai.id_pegawai','LEFT')
            ->where('dokumen_pegawai.nama_pegawai', 'LIKE', "%{$keywords}%") 
            ->orWhere('dokumen_pegawai.id_pegawai', 'LIKE', "%{$keywords}%") 
            ->orWhere('dokumen_pegawai.alasan_jenis_dokumen', 'LIKE', "%{$keywords}%") 
            ->orWhere('dokumen_pegawai.id_pegawai', 'LIKE', "%{$keywords}%") 
            ->orWhere('dokumen_pegawai.tahun_ajaran', 'LIKE', "%{$keywords}%") 
            ->orWhere('dokumen_pegawai.semester', 'LIKE', "%{$keywords}%") 
            ->orWhere('dokumen_pegawai.keterangan', 'LIKE', "%{$keywords}%") 
            ->orderBy('dokumen_pegawai.id_dokumen_pegawai','DESC')
            ->paginate($paginasi);
        return $query;
    }

    // paginasi
    public function paginasi_jenis_dokumen($paginasi,$id_jenis_dokumen)
    {
        $query = DB::table('dokumen_pegawai')
            ->select('dokumen_pegawai.*', 
                'jenis_dokumen.nama_jenis_dokumen',
                'sub_jenis_dokumen.nama_sub_jenis_dokumen',
                'pegawai.nama_lengkap',
                'pegawai.nrk',
                'pegawai.nip'
            )
            ->join('jenis_dokumen', 'jenis_dokumen.id_jenis_dokumen', '=', 'dokumen_pegawai.id_jenis_dokumen','LEFT')
            ->join('sub_jenis_dokumen', 'sub_jenis_dokumen.id_sub_jenis_dokumen', '=', 'dokumen_pegawai.id_sub_jenis_dokumen','LEFT')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'dokumen_pegawai.id_pegawai','LEFT')
            ->where('dokumen_pegawai.id_jenis_dokumen',$id_jenis_dokumen)
            ->orderBy('dokumen_pegawai.id_dokumen_pegawai','DESC')
            ->paginate($paginasi);
        return $query;
    }

    // paginasi
    public function total_jenis_dokumen($id_jenis_dokumen)
    {
        $query = DB::table('dokumen_pegawai')
            ->select('dokumen_pegawai.*', 
                'jenis_dokumen.nama_jenis_dokumen',
                'sub_jenis_dokumen.nama_sub_jenis_dokumen',
                'pegawai.nama_lengkap',
                'pegawai.nrk',
                'pegawai.nip'
            )
            ->join('jenis_dokumen', 'jenis_dokumen.id_jenis_dokumen', '=', 'dokumen_pegawai.id_jenis_dokumen','LEFT')
            ->join('sub_jenis_dokumen', 'sub_jenis_dokumen.id_sub_jenis_dokumen', '=', 'dokumen_pegawai.id_sub_jenis_dokumen','LEFT')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'dokumen_pegawai.id_pegawai','LEFT')
            ->where('dokumen_pegawai.id_jenis_dokumen',$id_jenis_dokumen)
            ->orderBy('dokumen_pegawai.id_dokumen_pegawai','DESC')
            ->count();
        return $query;
    }

    // total
    public function total_cari($keywords)
    {
        $query = DB::table('dokumen_pegawai')
            ->select('dokumen_pegawai.*', 
                'jenis_dokumen.nama_jenis_dokumen',
                'sub_jenis_dokumen.nama_sub_jenis_dokumen',
                'pegawai.nama_lengkap',
                'pegawai.nrk',
                'pegawai.nip'
            )
            ->join('jenis_dokumen', 'jenis_dokumen.id_jenis_dokumen', '=', 'dokumen_pegawai.id_jenis_dokumen','LEFT')
            ->join('sub_jenis_dokumen', 'sub_jenis_dokumen.id_sub_jenis_dokumen', '=', 'dokumen_pegawai.id_sub_jenis_dokumen','LEFT')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'dokumen_pegawai.id_pegawai','LEFT')
            ->where('dokumen_pegawai.nama_pegawai', 'LIKE', "%{$keywords}%") 
            ->orWhere('dokumen_pegawai.id_pegawai', 'LIKE', "%{$keywords}%") 
            ->orWhere('dokumen_pegawai.alasan_jenis_dokumen', 'LIKE', "%{$keywords}%") 
            ->orWhere('dokumen_pegawai.id_pegawai', 'LIKE', "%{$keywords}%") 
            ->orWhere('dokumen_pegawai.tahun_ajaran', 'LIKE', "%{$keywords}%") 
            ->orWhere('dokumen_pegawai.semester', 'LIKE', "%{$keywords}%") 
            ->orWhere('dokumen_pegawai.keterangan', 'LIKE', "%{$keywords}%") 
            ->orderBy('dokumen_pegawai.id_dokumen_pegawai','DESC')
            ->count();
        return $query;
    }

    // id_pegawai
    public function id_pegawai($id_pegawai)
    {
        $query = DB::table('dokumen_pegawai')
            ->select('dokumen_pegawai.*', 
                'jenis_dokumen.nama_jenis_dokumen',
                'sub_jenis_dokumen.nama_sub_jenis_dokumen',
                'pegawai.nama_lengkap',
                'pegawai.nrk',
                'pegawai.nip'
            )
            ->join('jenis_dokumen', 'jenis_dokumen.id_jenis_dokumen', '=', 'dokumen_pegawai.id_jenis_dokumen','LEFT')
            ->join('sub_jenis_dokumen', 'sub_jenis_dokumen.id_sub_jenis_dokumen', '=', 'dokumen_pegawai.id_sub_jenis_dokumen','LEFT')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'dokumen_pegawai.id_pegawai','LEFT')
            ->where('dokumen_pegawai.id_pegawai',$id_pegawai)
            ->orderBy('dokumen_pegawai.id_dokumen_pegawai','DESC')
            ->first();
        return $query;
    }

   
    // status_pegawai
    public function status_pegawai($status_pegawai)
    {
        $query = DB::table('dokumen_pegawai')
            ->select('dokumen_pegawai.*', 
                'jenis_dokumen.nama_jenis_dokumen',
                'sub_jenis_dokumen.nama_sub_jenis_dokumen',
                'pegawai.nama_lengkap',
                'pegawai.nrk',
                'pegawai.nip'
            )
            ->join('jenis_dokumen', 'jenis_dokumen.id_jenis_dokumen', '=', 'dokumen_pegawai.id_jenis_dokumen','LEFT')
            ->join('sub_jenis_dokumen', 'sub_jenis_dokumen.id_sub_jenis_dokumen', '=', 'dokumen_pegawai.id_sub_jenis_dokumen','LEFT')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'dokumen_pegawai.id_pegawai','LEFT')

            ->where(array(  'dokumen_pegawai.status_pegawai'    => $status_pegawai))

            ->orderBy('dokumen_pegawai.id_dokumen_pegawai','DESC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_pegawai)
    {
        $query = DB::table('dokumen_pegawai')
            ->select('dokumen_pegawai.*', 
                'jenis_dokumen.nama_jenis_dokumen',
                'sub_jenis_dokumen.nama_sub_jenis_dokumen',
                'pegawai.nama_lengkap',
                'pegawai.nrk',
                'pegawai.nip'
            )
            ->join('jenis_dokumen', 'jenis_dokumen.id_jenis_dokumen', '=', 'dokumen_pegawai.id_jenis_dokumen','LEFT')
            ->join('sub_jenis_dokumen', 'sub_jenis_dokumen.id_sub_jenis_dokumen', '=', 'dokumen_pegawai.id_sub_jenis_dokumen','LEFT')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'dokumen_pegawai.id_pegawai','LEFT')
            ->orderBy('dokumen_pegawai.id_jenis_dokumen','DESC')
            ->where(array(  'dokumen_pegawai.id_dokumen_pegawai'    => $id_pegawai))
            ->orderBy('dokumen_pegawai.id_dokumen_pegawai','DESC')
            ->first();
        return $query;
    }
}
