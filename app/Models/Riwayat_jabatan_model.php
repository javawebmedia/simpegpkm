<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Riwayat_jabatan_model extends Model
{
    // use HasFactory;

    // listing semua
    public function listing()
    {
        $query = DB::table('riwayat_jabatan')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'riwayat_jabatan.id_pegawai','LEFT')
            ->join('divisi', 'divisi.id_divisi', '=', 'riwayat_jabatan.id_divisi','LEFT')
            ->join('jabatan', 'jabatan.id_jabatan', '=', 'riwayat_jabatan.id_jabatan','LEFT')
            ->join('pendidikan', 'pendidikan.id_pendidikan', '=', 'riwayat_jabatan.id_pendidikan','LEFT')
            ->join('pangkat', 'pangkat.id_pangkat', '=', 'riwayat_jabatan.id_pangkat','LEFT')
            ->select('riwayat_jabatan.*', 
                    'pegawai.nama_lengkap',
                    'pegawai.nip',
                    'pegawai.nrk',
                    'divisi.nama_divisi',
                    'jabatan.nama_jabatan',
                    'jabatan.jenis_jabatan',
                    'pendidikan.nama_sekolah',
                    'pangkat.nama_pangkat',
                    'pangkat.golongan',
                    'pangkat.ruang',
                    )
            ->orderBy('riwayat_jabatan.id_riwayat_jabatan','DESC')
            ->get();
        return $query;
    }

    // listing pegawai
    public function pegawai($id_pegawai)
    {
        $query = DB::table('riwayat_jabatan')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'riwayat_jabatan.id_pegawai','LEFT')
            ->join('divisi', 'divisi.id_divisi', '=', 'riwayat_jabatan.id_divisi','LEFT')
            ->join('jabatan', 'jabatan.id_jabatan', '=', 'riwayat_jabatan.id_jabatan','LEFT')
            ->join('pendidikan', 'pendidikan.id_pendidikan', '=', 'riwayat_jabatan.id_pendidikan','LEFT')
            ->join('pangkat', 'pangkat.id_pangkat', '=', 'riwayat_jabatan.id_pangkat','LEFT')
            ->select('riwayat_jabatan.*', 
                    'pegawai.nama_lengkap',
                    'pegawai.nip',
                    'pegawai.nrk',
                    'divisi.nama_divisi',
                    'jabatan.nama_jabatan',
                    'jabatan.jenis_jabatan',
                    'pendidikan.nama_sekolah',
                    'pangkat.nama_pangkat',
                    'pangkat.golongan',
                    'pangkat.ruang',
                    )
            ->where('riwayat_jabatan.id_pegawai',$id_pegawai)
            ->orderBy('riwayat_jabatan.tmt','DESC')
            ->get();
        return $query;
    }

    // detail
    public function detail($id_riwayat_jabatan)
    {
        $query = DB::table('riwayat_jabatan')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'riwayat_jabatan.id_pegawai','LEFT')
            ->join('divisi', 'divisi.id_divisi', '=', 'riwayat_jabatan.id_divisi','LEFT')
            ->join('jabatan', 'jabatan.id_jabatan', '=', 'riwayat_jabatan.id_jabatan','LEFT')
            ->join('pendidikan', 'pendidikan.id_pendidikan', '=', 'riwayat_jabatan.id_pendidikan','LEFT')
            ->join('pangkat', 'pangkat.id_pangkat', '=', 'riwayat_jabatan.id_pangkat','LEFT')
            ->select('riwayat_jabatan.*', 
                    'pegawai.nama_lengkap',
                    'pegawai.nip',
                    'pegawai.nrk',
                    'divisi.nama_divisi',
                    'jabatan.nama_jabatan',
                    'jabatan.jenis_jabatan',
                    'pendidikan.nama_sekolah',
                    'pangkat.nama_pangkat',
                    'pangkat.golongan',
                    'pangkat.ruang',
                    )
            ->where('riwayat_jabatan.id_riwayat_jabatan',$id_riwayat_jabatan)
            ->orderBy('riwayat_jabatan.id_riwayat_jabatan','DESC')
            ->first();
        return $query;
    }

    public function terakhir($id_pegawai)
    {
        $query = DB::table('riwayat_jabatan')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'riwayat_jabatan.id_pegawai','LEFT')
            ->join('divisi', 'divisi.id_divisi', '=', 'riwayat_jabatan.id_divisi','LEFT')
            ->join('jabatan', 'jabatan.id_jabatan', '=', 'riwayat_jabatan.id_jabatan','LEFT')
            ->join('pendidikan', 'pendidikan.id_pendidikan', '=', 'riwayat_jabatan.id_pendidikan','LEFT')
            ->join('pangkat', 'pangkat.id_pangkat', '=', 'riwayat_jabatan.id_pangkat','LEFT')
            ->select('riwayat_jabatan.*', 
                    'pegawai.nama_lengkap',
                    'pegawai.nip',
                    'pegawai.nrk',
                    'divisi.nama_divisi',
                    'jabatan.nama_jabatan',
                    'jabatan.jenis_jabatan',
                    'pendidikan.nama_sekolah',
                    'pangkat.nama_pangkat',
                    'pangkat.golongan',
                    'pangkat.ruang',
                    )
            ->where('riwayat_jabatan.id_pegawai',$id_pegawai)
            ->orderBy('riwayat_jabatan.tmt','DESC')
            ->first();
        return $query;
    }
}
