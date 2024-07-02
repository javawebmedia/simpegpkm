<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dokumen_pajak_model extends Model
{

    // listing
    public function listing()
    {
        $query = DB::table('dokumen_pajak')
            
            ->join('pengajuan', 'pengajuan.id_pengajuan', '=', 'dokumen_pajak.id_pengajuan','LEFT')
            ->join('pajak', 'pajak.nomor_objek_pajak', '=', 'dokumen_pajak.nomor_objek_pajak','LEFT')
            ->select('dokumen_pajak.*', 'pengajuan.nomor_pengajuan','pengajuan.tanggal_pengajuan','pengajuan.nama_pemilik','pajak.nama_pemilik AS nama_pemiliknya')
            ->orderBy('dokumen_pajak.id_dokumen_pajak','DESC')
            ->get();
        return $query;
    }

    // nomor_objek_pajak
    public function all_nomor_objek_pajak($nomor_objek_pajak)
    {
        $query = DB::table('dokumen_pajak')
            
            ->join('pengajuan', 'pengajuan.id_pengajuan', '=', 'dokumen_pajak.id_pengajuan','LEFT')
            ->join('pajak', 'pajak.nomor_objek_pajak', '=', 'dokumen_pajak.nomor_objek_pajak','LEFT')
            ->select('dokumen_pajak.*', 'pengajuan.nomor_pengajuan','pengajuan.tanggal_pengajuan','pengajuan.nama_pemilik','pajak.nama_pemilik AS nama_pemiliknya')
            ->where('dokumen_pajak.nomor_objek_pajak',$nomor_objek_pajak)
            ->orderBy('dokumen_pajak.id_dokumen_pajak','DESC')
            ->get();
        return $query;
    }

    // nomor_objek_pajak
    public function check_nomor_objek_pajak($nomor_objek_pajak)
    {
        $query = DB::table('dokumen_pajak')
            
            ->join('pengajuan', 'pengajuan.id_pengajuan', '=', 'dokumen_pajak.id_pengajuan','LEFT')
            ->join('pajak', 'pajak.nomor_objek_pajak', '=', 'dokumen_pajak.nomor_objek_pajak','LEFT')
            ->select('dokumen_pajak.*', 'pengajuan.nomor_pengajuan','pengajuan.tanggal_pengajuan','pengajuan.nama_pemilik','pajak.nama_pemilik AS nama_pemiliknya')
            ->where('dokumen_pajak.nomor_objek_pajak',$nomor_objek_pajak)
            ->orderBy('dokumen_pajak.id_dokumen_pajak','DESC')
            ->get();
        return $query;
    }

    // paginasi
    public function paginasi($paginasi)
    {
        $query = DB::table('dokumen_pajak')
            
            
            ->join('pengajuan', 'pengajuan.id_pengajuan', '=', 'dokumen_pajak.id_pengajuan','LEFT')
            ->join('pajak', 'pajak.nomor_objek_pajak', '=', 'dokumen_pajak.nomor_objek_pajak','LEFT')
            ->select('dokumen_pajak.*', 'pengajuan.nomor_pengajuan','pengajuan.tanggal_pengajuan','pengajuan.nama_pemilik','pajak.nama_pemilik AS nama_pemiliknya')
            ->orderBy('dokumen_pajak.id_dokumen_pajak','DESC')
            ->paginate($paginasi);
        return $query;
    }

    // paginasi_cari
    public function paginasi_cari($paginasi,$keywords)
    {
        $query = DB::table('dokumen_pajak')
            
            
            ->join('pengajuan', 'pengajuan.id_pengajuan', '=', 'dokumen_pajak.id_pengajuan','LEFT')
            ->join('pajak', 'pajak.nomor_objek_pajak', '=', 'dokumen_pajak.nomor_objek_pajak','LEFT')
            ->select('dokumen_pajak.*', 'pengajuan.nomor_pengajuan','pengajuan.tanggal_pengajuan','pengajuan.nama_pemilik','pajak.nama_pemilik AS nama_pemiliknya')
            ->where('dokumen_pajak.nama_pajak', 'LIKE', "%{$keywords}%") 
            ->orWhere('dokumen_pajak.nomor_objek_pajak', 'LIKE', "%{$keywords}%") 
            ->orWhere('dokumen_pajak.alasan_pengajuan', 'LIKE', "%{$keywords}%") 
            ->orWhere('dokumen_pajak.nomor_objek_pajak', 'LIKE', "%{$keywords}%") 
            ->orWhere('dokumen_pajak.tahun_ajaran', 'LIKE', "%{$keywords}%") 
            ->orWhere('dokumen_pajak.semester', 'LIKE', "%{$keywords}%") 
            ->orWhere('dokumen_pajak.keterangan', 'LIKE', "%{$keywords}%") 
            ->orderBy('dokumen_pajak.id_dokumen_pajak','DESC')
            ->paginate($paginasi);
        return $query;
    }

    // paginasi
    public function paginasi_pengajuan($paginasi,$id_pengajuan)
    {
        $query = DB::table('dokumen_pajak')
            
            
            ->join('pengajuan', 'pengajuan.id_pengajuan', '=', 'dokumen_pajak.id_pengajuan','LEFT')
            ->join('pajak', 'pajak.nomor_objek_pajak', '=', 'dokumen_pajak.nomor_objek_pajak','LEFT')
            ->select('dokumen_pajak.*', 'pengajuan.nomor_pengajuan','pengajuan.tanggal_pengajuan','pengajuan.nama_pemilik','pajak.nama_pemilik AS nama_pemiliknya')
            ->where('dokumen_pajak.id_pengajuan',$id_pengajuan)
            ->orderBy('dokumen_pajak.id_dokumen_pajak','DESC')
            ->paginate($paginasi);
        return $query;
    }

    // paginasi
    public function total_pengajuan($id_pengajuan)
    {
        $query = DB::table('dokumen_pajak')
            
            
            ->join('pengajuan', 'pengajuan.id_pengajuan', '=', 'dokumen_pajak.id_pengajuan','LEFT')
            ->join('pajak', 'pajak.nomor_objek_pajak', '=', 'dokumen_pajak.nomor_objek_pajak','LEFT')
            ->select('dokumen_pajak.*', 'pengajuan.nomor_pengajuan','pengajuan.tanggal_pengajuan','pengajuan.nama_pemilik','pajak.nama_pemilik AS nama_pemiliknya')
            ->where('dokumen_pajak.id_pengajuan',$id_pengajuan)
            ->orderBy('dokumen_pajak.id_dokumen_pajak','DESC')
            ->count();
        return $query;
    }

    // total
    public function total_cari($keywords)
    {
        $query = DB::table('dokumen_pajak')
            
            
            ->join('pengajuan', 'pengajuan.id_pengajuan', '=', 'dokumen_pajak.id_pengajuan','LEFT')
            ->join('pajak', 'pajak.nomor_objek_pajak', '=', 'dokumen_pajak.nomor_objek_pajak','LEFT')
            ->select('dokumen_pajak.*', 'pengajuan.nomor_pengajuan','pajak.nama_pajak')
            ->where('dokumen_pajak.nama_pajak', 'LIKE', "%{$keywords}%") 
            ->orWhere('dokumen_pajak.nomor_objek_pajak', 'LIKE', "%{$keywords}%") 
            ->orWhere('dokumen_pajak.alasan_pengajuan', 'LIKE', "%{$keywords}%") 
            ->orWhere('dokumen_pajak.nomor_objek_pajak', 'LIKE', "%{$keywords}%") 
            ->orWhere('dokumen_pajak.tahun_ajaran', 'LIKE', "%{$keywords}%") 
            ->orWhere('dokumen_pajak.semester', 'LIKE', "%{$keywords}%") 
            ->orWhere('dokumen_pajak.keterangan', 'LIKE', "%{$keywords}%") 
            ->orderBy('dokumen_pajak.id_dokumen_pajak','DESC')
            ->count();
        return $query;
    }

    // nomor_objek_pajak
    public function nomor_objek_pajak($nomor_objek_pajak)
    {
        $query = DB::table('dokumen_pajak')
            
            
            ->join('pengajuan', 'pengajuan.id_pengajuan', '=', 'dokumen_pajak.id_pengajuan','LEFT')
            ->join('pajak', 'pajak.nomor_objek_pajak', '=', 'dokumen_pajak.nomor_objek_pajak','LEFT')
            ->select('dokumen_pajak.*', 'pengajuan.nomor_pengajuan','pajak.nama_pajak')
            ->where('dokumen_pajak.nomor_objek_pajak',$nomor_objek_pajak)
            ->orderBy('dokumen_pajak.id_dokumen_pajak','DESC')
            ->first();
        return $query;
    }

   
    // status_pajak
    public function status_pajak($status_pajak)
    {
        $query = DB::table('dokumen_pajak')
            
            
            ->join('pengajuan', 'pengajuan.id_pengajuan', '=', 'dokumen_pajak.id_pengajuan','LEFT')
            ->join('pajak', 'pajak.nomor_objek_pajak', '=', 'dokumen_pajak.nomor_objek_pajak','LEFT')
            ->select('dokumen_pajak.*', 'pengajuan.nomor_pengajuan','pajak.nama_pajak')

            ->where(array(  'dokumen_pajak.status_pajak'    => $status_pajak))

            ->orderBy('dokumen_pajak.id_dokumen_pajak','DESC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_pajak)
    {
        $query = DB::table('dokumen_pajak')
            
            
            ->join('pengajuan', 'pengajuan.id_pengajuan', '=', 'dokumen_pajak.id_pengajuan','LEFT')
            ->join('pajak', 'pajak.nomor_objek_pajak', '=', 'dokumen_pajak.nomor_objek_pajak','LEFT')
            ->select('dokumen_pajak.*', 'pengajuan.nomor_pengajuan','pajak.nama_pajak')
            ->orderBy('dokumen_pajak.id_jenis_dokumen','DESC')
            ->where(array(  'dokumen_pajak.id_dokumen_pajak'    => $id_pajak))
            ->orderBy('dokumen_pajak.id_dokumen_pajak','DESC')
            ->first();
        return $query;
    }
}
