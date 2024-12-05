<?php

use Illuminate\Support\Facades\Route;

// Main page
Route::get('/', 'App\Http\Controllers\Home@index');
Route::get('tentang-aplikasi', 'App\Http\Controllers\Home@tentang');
Route::get('kontak', 'App\Http\Controllers\Home@kontak');
Route::get('panduan', 'App\Http\Controllers\Home@panduan');
Route::get('panduan/detail/{id1}', 'App\Http\Controllers\Home@detail');

// halaman login
Route::get('login', 'App\Http\Controllers\Login@index');
Route::post('login/check', 'App\Http\Controllers\Login@check');
Route::get('logout', 'App\Http\Controllers\Login@logout');

// MODUL PEGAWAI
// modul dasbor
Route::get('pegawai/dasbor', 'App\Http\Controllers\Pegawai\Dasbor@index');

// modul gaji
Route::get('pegawai/gaji', 'App\Http\Controllers\Pegawai\Gaji@index');

// modul rencana kinerja
Route::get('pegawai/aktivitas-utama', 'App\Http\Controllers\Pegawai\Aktivitas_utama@index');
Route::post('pegawai/aktivitas-utama/tambah', 'App\Http\Controllers\Pegawai\Aktivitas_utama@tambah');
Route::get('pegawai/aktivitas-utama/delete/{id}', 'App\Http\Controllers\Pegawai\Aktivitas_utama@delete');

// Dokumen
Route::get('pegawai/dokumen', 'App\Http\Controllers\Pegawai\Dokumen@index');
Route::post('pegawai/dokumen/unggah', 'App\Http\Controllers\Pegawai\Dokumen@unggah');
Route::get('pegawai/dokumen/delete/{id}', 'App\Http\Controllers\Pegawai\Dokumen@delete');

// modul kinerja
Route::get('pegawai/kinerja', 'App\Http\Controllers\Pegawai\Kinerja@index');
Route::get('pegawai/kinerja/approval', 'App\Http\Controllers\Pegawai\Kinerja@approval');
Route::get('pegawai/kinerja/bulanan', 'App\Http\Controllers\Pegawai\Kinerja@bulanan');
Route::post('pegawai/kinerja/tambah', 'App\Http\Controllers\Pegawai\Kinerja@tambah');
Route::get('pegawai/kinerja/edit/{id}', 'App\Http\Controllers\Pegawai\Kinerja@edit');
Route::get('pegawai/kinerja/delete/{id}/{id2}', 'App\Http\Controllers\Pegawai\Kinerja@delete');
Route::post('pegawai/kinerja/proses-edit', 'App\Http\Controllers\Pegawai\Kinerja@proses_edit');
Route::get('pegawai/kinerja/detail/{id}/{id2}', 'App\Http\Controllers\Pegawai\Kinerja@detail');
Route::get('pegawai/kinerja/setujui/{id}/{id2}', 'App\Http\Controllers\Pegawai\Kinerja@setujui');
Route::get('pegawai/kinerja/cetak/{id}/{id2}', 'App\Http\Controllers\Pegawai\Kinerja@cetak');
Route::post('pegawai/kinerja/proses', 'App\Http\Controllers\Pegawai\Kinerja@proses');

// modul pegawai
Route::get('pegawai/pegawai', 'App\Http\Controllers\Pegawai\Pegawai@index');
Route::get('pegawai/pegawai/edit', 'App\Http\Controllers\Pegawai\Pegawai@edit');
Route::post('pegawai/pegawai/proses-edit', 'App\Http\Controllers\Pegawai\Pegawai@proses_edit');
Route::get('pegawai/pegawai/cetak', 'App\Http\Controllers\Pegawai\Pegawai@cetak');
Route::get('pegawai/pegawai/unduh', 'App\Http\Controllers\Pegawai\Pegawai@unduh');
Route::get('pegawai/pegawai/cetak-riwayat', 'App\Http\Controllers\Pegawai\Pegawai@cetak_riwayat');
Route::get('pegawai/pegawai/unduh-riwayat', 'App\Http\Controllers\Pegawai\Pegawai@unduh_riwayat');
Route::get('pegawai/pegawai/riwayat', 'App\Http\Controllers\Pegawai\Pegawai@riwayat');
// modul str-sip
Route::get('pegawai/str-sip', 'App\Http\Controllers\Pegawai\Str_sip@index');
Route::get('pegawai/str-sip/edit/{par1}', 'App\Http\Controllers\Pegawai\Str_sip@edit');
Route::post('pegawai/str-sip/proses-edit', 'App\Http\Controllers\Pegawai\Str_sip@proses_edit');
Route::get('pegawai/str-sip/cetak', 'App\Http\Controllers\Pegawai\Str_sip@cetak');
Route::get('pegawai/str-sip/unduh/{par1}', 'App\Http\Controllers\Pegawai\Str_sip@unduh');
Route::get('pegawai/str-sip/tambah', 'App\Http\Controllers\Pegawai\Str_sip@tambah');
Route::post('pegawai/str-sip/proses-tambah', 'App\Http\Controllers\Pegawai\Str_sip@proses_tambah');
Route::get('pegawai/str-sip/hapus/{par1}', 'App\Http\Controllers\Pegawai\Str_sip@hapus');

// modul cuti
Route::get('pegawai/cuti', 'App\Http\Controllers\Pegawai\Cuti@index');
Route::get('pegawai/cuti/pengajuan/{par1}/{par2}', 'App\Http\Controllers\Pegawai\Cuti@pengajuan');
Route::get('pegawai/cuti/edit/{par1}', 'App\Http\Controllers\Pegawai\Cuti@edit');
Route::post('pegawai/cuti/proses-edit', 'App\Http\Controllers\Pegawai\Cuti@proses_edit');
Route::get('pegawai/cuti/cetak', 'App\Http\Controllers\Pegawai\Cuti@cetak');
Route::get('pegawai/cuti/unduh/{par1}', 'App\Http\Controllers\Pegawai\Cuti@unduh');
Route::get('pegawai/cuti/tambah', 'App\Http\Controllers\Pegawai\Cuti@tambah');
Route::post('pegawai/cuti/proses-pengajuan/{par1}/{par2}', 'App\Http\Controllers\Pegawai\Cuti@proses_pengajuan');
Route::get('pegawai/cuti/hapus/{par1}', 'App\Http\Controllers\Pegawai\Cuti@hapus');
Route::get('pegawai/cuti/tanggal', 'App\Http\Controllers\Pegawai\Cuti@tanggal');
Route::get('pegawai/cuti/approval1', 'App\Http\Controllers\Pegawai\Cuti@approval1');
Route::get('pegawai/cuti/approval2', 'App\Http\Controllers\Pegawai\Cuti@approval2');
Route::get('pegawai/cuti/approval3', 'App\Http\Controllers\Pegawai\Cuti@approval3');
Route::post('pegawai/cuti/proses1', 'App\Http\Controllers\Pegawai\Cuti@proses1');
Route::post('pegawai/cuti/proses2', 'App\Http\Controllers\Pegawai\Cuti@proses2');
Route::post('pegawai/cuti/proses3', 'App\Http\Controllers\Pegawai\Cuti@proses3');


/* input riwayat pegawai */
Route::post('pegawai/pegawai/proses-pendidikan', 'App\Http\Controllers\Pegawai\Pegawai@proses_pendidikan');
Route::post('pegawai/pegawai/proses-keluarga', 'App\Http\Controllers\Pegawai\Pegawai@proses_keluarga');
Route::post('pegawai/pegawai/edit-pendidikan', 'App\Http\Controllers\Pegawai\Pegawai@edit_pendidikan');
Route::post('pegawai/pegawai/edit-keluarga', 'App\Http\Controllers\Pegawai\Pegawai@edit_keluarga');
/* delete riwayat */
Route::get('pegawai/pegawai/delete-pendidikan/{id}', 'App\Http\Controllers\Pegawai\Pegawai@delete_pendidikan');
Route::get('pegawai/pegawai/delete-keluarga/{id}', 'App\Http\Controllers\Pegawai\Pegawai@delete_keluarga');
/* view edit riwayat */
Route::get('pegawai/pegawai/lihat-jabatan/{id}', 'App\Http\Controllers\Pegawai\Pegawai@lihat_jabatan');
Route::get('pegawai/pegawai/lihat-pendidikan/{id}', 'App\Http\Controllers\Pegawai\Pegawai@lihat_pendidikan');
Route::get('pegawai/pegawai/lihat-keluarga/{id}', 'App\Http\Controllers\Pegawai\Pegawai@lihat_keluarga');

// modul Diklat pegawai
Route::get('pegawai/diklat', 'App\Http\Controllers\Pegawai\Diklat@index');
Route::get('pegawai/diklat/approval', 'App\Http\Controllers\Pegawai\Diklat@approval');
Route::get('pegawai/diklat/tambah', 'App\Http\Controllers\Pegawai\Diklat@tambah');
Route::post('pegawai/diklat/proses-tambah', 'App\Http\Controllers\Pegawai\Diklat@proses_tambah');
Route::get('pegawai/diklat/detail/{id}', 'App\Http\Controllers\Pegawai\Diklat@detail');
// Route::get('pegawai/diklat/sertifikat', 'App\Http\Controllers\Pegawai\Diklat@sertifikat');
Route::get('pegawai/diklat/detail-pimpinan/{id}', 'App\Http\Controllers\Pegawai\Diklat@detail_pimpinan');
Route::get('pegawai/diklat/edit/{id}', 'App\Http\Controllers\Pegawai\Diklat@edit');
Route::post('pegawai/diklat/proses-edit', 'App\Http\Controllers\Pegawai\Diklat@proses_edit');
Route::get('pegawai/diklat/delete/{id}', 'App\Http\Controllers\Pegawai\Diklat@delete');
Route::get('pegawai/diklat/import', 'App\Http\Controllers\Pegawai\Diklat@import');
Route::post('pegawai/diklat/proses-import', 'App\Http\Controllers\Pegawai\Diklat@proses_import');
Route::post('pegawai/diklat/proses', 'App\Http\Controllers\Pegawai\Diklat@proses');

// END MODUL PEGAWAI

// modul dasbor
Route::get('admin/dasbor', 'App\Http\Controllers\Admin\Dasbor@index');
Route::get('admin/dasbor/statistik', 'App\Http\Controllers\Admin\Dasbor@statistik');
Route::get('admin/dasbor/cari', 'App\Http\Controllers\Admin\Dasbor@cari');

// modul laporan
Route::get('admin/laporan', 'App\Http\Controllers\Admin\Laporan@index');
Route::get('admin/laporan/diklat', 'App\Http\Controllers\Admin\Laporan@diklat');
Route::get('admin/laporan/keterlambatan', 'App\Http\Controllers\Admin\Laporan@keterlambatan');

// detai
Route::get('admin/detail', 'App\Http\Controllers\Admin\Detail@index');
Route::get('admin/detail/pegawai/{id}/{id2}/{id3}', 'App\Http\Controllers\Admin\Detail@pegawai');
Route::get('admin/detail/jadwal/{id}/{id2}/{id3}', 'App\Http\Controllers\Admin\Detail@jadwal');
Route::get('admin/detail/kehadiran/{id}/{id2}/{id3}', 'App\Http\Controllers\Admin\Detail@kehadiran');
Route::get('admin/detail/absensi/{id}/{id2}/{id3}', 'App\Http\Controllers\Admin\Detail@absensi');
Route::get('admin/detail/gaji/{id}/{id2}/{id3}', 'App\Http\Controllers\Admin\Detail@gaji');
Route::get('admin/detail/generate/{id}/{id2}/{id3}', 'App\Http\Controllers\Admin\Detail@generate');
Route::get('admin/detail/dokumen/{id}/{id2}/{id3}', 'App\Http\Controllers\Admin\Detail@dokumen');
Route::get('admin/detail/ekinerja/{id}/{id2}/{id3}', 'App\Http\Controllers\Admin\Detail@ekinerja');
Route::get('admin/detail/cuti/{id}/{id2}/{id3}', 'App\Http\Controllers\Admin\Detail@cuti');
Route::get('admin/detail/diklat/{id}/{id2}/{id3}', 'App\Http\Controllers\Admin\Detail@diklat');
Route::get('admin/detail/str-sip/{id}/{id2}/{id3}', 'App\Http\Controllers\Admin\Detail@str_sip');
Route::get('admin/detail/keluarga/{id}/{id2}/{id3}', 'App\Http\Controllers\Admin\Detail@keluarga');

// modul data_finger
Route::get('admin/data-finger', 'App\Http\Controllers\Admin\Data_finger@index');
Route::get('admin/data-finger/tarik/{par1}', 'App\Http\Controllers\Admin\Data_finger@tarik');
Route::post('admin/data-finger/tambah', 'App\Http\Controllers\Admin\Data_finger@tambah');

// modul kinerja
Route::get('admin/kinerja', 'App\Http\Controllers\Admin\Kinerja@index');
Route::get('admin/kinerja/approval', 'App\Http\Controllers\Admin\Kinerja@approval');
Route::post('admin/kinerja/tambah', 'App\Http\Controllers\Admin\Kinerja@tambah');
Route::get('admin/kinerja/edit/{id}', 'App\Http\Controllers\Admin\Kinerja@edit');
Route::get('admin/kinerja/delete/{id}/{id2}', 'App\Http\Controllers\Admin\Kinerja@delete');
Route::post('admin/kinerja/proses-edit', 'App\Http\Controllers\Admin\Kinerja@proses_edit');
Route::get('admin/kinerja/detail/{id}/{id2}', 'App\Http\Controllers\Admin\Kinerja@detail');
Route::get('admin/kinerja/setujui/{id}/{id2}', 'App\Http\Controllers\Admin\Kinerja@setujui');
Route::get('admin/kinerja/cetak/{id}/{id2}', 'App\Http\Controllers\Admin\Kinerja@cetak');
Route::post('admin/kinerja/proses', 'App\Http\Controllers\Admin\Kinerja@proses');
Route::get('admin/kinerja/setujui-harian', 'App\Http\Controllers\Admin\Kinerja@setujui_harian');
Route::post('admin/kinerja/setujui-bulanan', 'App\Http\Controllers\Admin\Kinerja@setujui_bulanan');

// modul akun
Route::get('admin/akun', 'App\Http\Controllers\Admin\Akun@index');
Route::get('admin/akun/password', 'App\Http\Controllers\Admin\Akun@password');
Route::post('admin/akun/edit', 'App\Http\Controllers\Admin\Akun@edit');
Route::get('admin/akun/cetak', 'App\Http\Controllers\Admin\Akun@cetak');
Route::get('admin/akun/unduh', 'App\Http\Controllers\Admin\Akun@unduh');
Route::post('admin/akun/ganti-password', 'App\Http\Controllers\Admin\Akun@ganti_password');

// modul divisi
// Route::get('admin/divisi', 'App\Http\Controllers\Admin\Divisi@index');

// modul jabatan
Route::get('admin/jabatan', 'App\Http\Controllers\Admin\Jabatan@index');
Route::post('admin/jabatan/tambah', 'App\Http\Controllers\Admin\Jabatan@tambah');
Route::get('admin/jabatan/edit/{id}', 'App\Http\Controllers\Admin\Jabatan@edit');
Route::post('admin/jabatan/proses-edit', 'App\Http\Controllers\Admin\Jabatan@proses_edit');
Route::get('admin/jabatan/delete/{id}', 'App\Http\Controllers\Admin\Jabatan@delete');
Route::get('admin/jabatan/aktivitas/{id}', 'App\Http\Controllers\Admin\Jabatan@aktivitas');
Route::get('admin/jabatan/delete-aktivitas/{id}/{id2}', 'App\Http\Controllers\Admin\Jabatan@delete_aktivitas');
Route::post('admin/jabatan/tambah-aktivitas', 'App\Http\Controllers\Admin\Jabatan@tambah_aktivitas');
Route::get('admin/jabatan/edit-aktivitas/{id}', 'App\Http\Controllers\Admin\Jabatan@edit_aktivitas');
Route::post('admin/jabatan/update-aktivitas', 'App\Http\Controllers\Admin\Jabatan@update_aktivitas');

// modul agama
Route::get('admin/agama', 'App\Http\Controllers\Admin\Agama@index');
Route::post('admin/agama/tambah', 'App\Http\Controllers\Admin\Agama@tambah');
Route::get('admin/agama/edit/{id}', 'App\Http\Controllers\Admin\Agama@edit');
Route::post('admin/agama/proses-edit', 'App\Http\Controllers\Admin\Agama@proses_edit');
Route::get('admin/agama/delete/{id}', 'App\Http\Controllers\Admin\Agama@delete');

// modul Diklat
Route::get('admin/diklat', 'App\Http\Controllers\Admin\Diklat@index');
Route::get('admin/diklat/tambah', 'App\Http\Controllers\Admin\Diklat@tambah');
Route::post('admin/diklat/proses-tambah', 'App\Http\Controllers\Admin\Diklat@proses_tambah');
Route::get('admin/diklat/detail/{id}', 'App\Http\Controllers\Admin\Diklat@detail');
Route::get('admin/diklat/edit/{id}', 'App\Http\Controllers\Admin\Diklat@edit');
Route::post('admin/diklat/proses-edit', 'App\Http\Controllers\Admin\Diklat@proses_edit');
Route::get('admin/diklat/delete/{id}', 'App\Http\Controllers\Admin\Diklat@delete');
Route::get('admin/diklat/import', 'App\Http\Controllers\Admin\Diklat@import');
Route::post('admin/diklat/proses-import', 'App\Http\Controllers\Admin\Diklat@proses_import');
Route::post('admin/diklat/proses', 'App\Http\Controllers\Admin\Diklat@proses');
Route::get('admin/diklat/laporan', 'App\Http\Controllers\Admin\Diklat@laporan');
Route::get('admin/diklat/rekap', 'App\Http\Controllers\Admin\Diklat@rekap');
Route::get('admin/diklat/listing/{par1}', 'App\Http\Controllers\Admin\Diklat@listing');

// modul kode-diklat
Route::get('admin/kode-diklat', 'App\Http\Controllers\Admin\Kode_diklat@index');
Route::post('admin/kode-diklat/tambah', 'App\Http\Controllers\Admin\Kode_diklat@tambah');
Route::get('admin/kode-diklat/edit/{id}', 'App\Http\Controllers\Admin\Kode_diklat@edit');
Route::post('admin/kode-diklat/proses-edit', 'App\Http\Controllers\Admin\Kode_diklat@proses_edit');
Route::get('admin/kode-diklat/delete/{id}', 'App\Http\Controllers\Admin\Kode_diklat@delete');
Route::get('admin/kode-diklat/import', 'App\Http\Controllers\Admin\Kode_diklat@import');
Route::post('admin/kode-diklat/proses-import', 'App\Http\Controllers\Admin\Kode_diklat@proses_import');
Route::post('admin/kode-diklat/proses', 'App\Http\Controllers\Admin\Kode_diklat@proses');

// modul Jenis Pelatihan
Route::get('admin/jenis-pelatihan', 'App\Http\Controllers\Admin\Jenis_pelatihan@index');
Route::post('admin/jenis-pelatihan/tambah', 'App\Http\Controllers\Admin\Jenis_pelatihan@tambah');
Route::get('admin/jenis-pelatihan/edit/{id}', 'App\Http\Controllers\Admin\Jenis_pelatihan@edit');
Route::post('admin/jenis-pelatihan/proses-edit', 'App\Http\Controllers\Admin\Jenis_pelatihan@proses_edit');
Route::get('admin/jenis-pelatihan/delete/{id}', 'App\Http\Controllers\Admin\Jenis_pelatihan@delete');
Route::get('admin/jenis-pelatihan/import', 'App\Http\Controllers\Admin\Jenis_pelatihan@import');
Route::post('admin/jenis-pelatihan/proses-import', 'App\Http\Controllers\Admin\Jenis_pelatihan@proses_import');

// modul aktivitas
Route::get('admin/aktivitas', 'App\Http\Controllers\Admin\Aktivitas@index');
Route::post('admin/aktivitas/tambah', 'App\Http\Controllers\Admin\Aktivitas@tambah');
Route::get('admin/aktivitas/edit/{id}', 'App\Http\Controllers\Admin\Aktivitas@edit');
Route::post('admin/aktivitas/proses-edit', 'App\Http\Controllers\Admin\Aktivitas@proses_edit');
Route::get('admin/aktivitas/delete/{id}', 'App\Http\Controllers\Admin\Aktivitas@delete');

// dokumen
Route::get('admin/dokumen-pegawai', 'App\Http\Controllers\Admin\Dokumen_pegawai@index');
Route::get('admin/dokumen-pegawai/unduh/{par1}', 'App\Http\Controllers\Admin\Dokumen_pegawai@unduh');
Route::get('admin/dokumen-pegawai/delete/{par1}', 'App\Http\Controllers\Admin\Dokumen_pegawai@delete');
Route::get('admin/dokumen-pegawai/pegawai/{par1}', 'App\Http\Controllers\Admin\Dokumen_pegawai@pegawai');
Route::get('admin/dokumen-pegawai/approval/{par1}', 'App\Http\Controllers\Admin\Dokumen_pegawai@approval');
Route::post('admin/dokumen-pegawai/proses', 'App\Http\Controllers\Admin\Dokumen_pegawai@proses');

// jenis-dokumen
Route::get('admin/jenis-dokumen', 'App\Http\Controllers\Admin\Jenis_dokumen@index');
Route::post('admin/jenis-dokumen/tambah', 'App\Http\Controllers\Admin\Jenis_dokumen@tambah');
Route::get('admin/jenis-dokumen/edit/{par1}', 'App\Http\Controllers\Admin\Jenis_dokumen@edit');
Route::get('admin/jenis-dokumen/sub/{par1}', 'App\Http\Controllers\Admin\Jenis_dokumen@sub');
Route::get('admin/jenis-dokumen/edit-sub/{par1}/{par2}', 'App\Http\Controllers\Admin\Jenis_dokumen@edit_sub');
Route::get('admin/jenis-dokumen/delete-sub/{par1}/{par2}', 'App\Http\Controllers\Admin\Jenis_dokumen@delete_sub');
Route::get('admin/jenis-dokumen/activate/{par1}', 'App\Http\Controllers\Admin\Jenis_dokumen@activate');
Route::post('admin/jenis-dokumen/proses_edit', 'App\Http\Controllers\Admin\Jenis_dokumen@proses_edit');
Route::get('admin/jenis-dokumen/delete/{par1}', 'App\Http\Controllers\Admin\Jenis_dokumen@delete');
Route::post('admin/jenis-dokumen/proses', 'App\Http\Controllers\Admin\Jenis_dokumen@proses');
Route::post('admin/jenis-dokumen/tambah-sub', 'App\Http\Controllers\Admin\Jenis_dokumen@tambah_sub');
Route::post('admin/jenis-dokumen/edit-sub', 'App\Http\Controllers\Admin\Jenis_dokumen@edit_sub');
Route::get('admin/jenis-dokumen/delete-sub/{par1}/{par2}', 'App\Http\Controllers\Admin\Jenis_dokumen@delete_sub');

// modul satuan
Route::get('admin/satuan', 'App\Http\Controllers\Admin\Satuan@index');
Route::post('admin/satuan/tambah', 'App\Http\Controllers\Admin\Satuan@tambah');
Route::get('admin/satuan/edit/{id}', 'App\Http\Controllers\Admin\Satuan@edit');
Route::post('admin/satuan/proses-edit', 'App\Http\Controllers\Admin\Satuan@proses_edit');
Route::get('admin/satuan/delete/{id}', 'App\Http\Controllers\Admin\Satuan@delete');

// modul pangkat
Route::get('admin/pangkat', 'App\Http\Controllers\Admin\Pangkat@index');
Route::post('admin/pangkat/tambah', 'App\Http\Controllers\Admin\Pangkat@tambah');
Route::get('admin/pangkat/edit/{id}', 'App\Http\Controllers\Admin\Pangkat@edit');
Route::post('admin/pangkat/proses-edit', 'App\Http\Controllers\Admin\Pangkat@proses_edit');
Route::get('admin/pangkat/delete/{id}', 'App\Http\Controllers\Admin\Pangkat@delete');

// modul periode
Route::get('admin/periode', 'App\Http\Controllers\Admin\Periode@index');
Route::post('admin/periode/tambah', 'App\Http\Controllers\Admin\Periode@tambah');
Route::get('admin/periode/edit/{id}', 'App\Http\Controllers\Admin\Periode@edit');
Route::post('admin/periode/proses-edit', 'App\Http\Controllers\Admin\Periode@proses_edit');
Route::get('admin/periode/delete/{id}', 'App\Http\Controllers\Admin\Periode@delete');

// modul jadwal-pegawai
Route::get('admin/jadwal-pegawai', 'App\Http\Controllers\Admin\Jadwal_pegawai@index');
Route::get('admin/jadwal-pegawai/tambah/{id}/{id2}/{id3}', 'App\Http\Controllers\Admin\Jadwal_pegawai@tambah');
Route::get('admin/jadwal-pegawai/edit/{id}', 'App\Http\Controllers\Admin\Jadwal_pegawai@edit');
Route::post('admin/jadwal-pegawai/proses-tambah', 'App\Http\Controllers\Admin\Jadwal_pegawai@proses_tambah');
Route::post('admin/jadwal-pegawai/proses-edit', 'App\Http\Controllers\Admin\Jadwal_pegawai@proses_edit');
Route::get('admin/jadwal-pegawai/delete/{id}', 'App\Http\Controllers\Admin\Jadwal_pegawai@delete');
Route::post('admin/jadwal-pegawai/proses-generate', 'App\Http\Controllers\Admin\Jadwal_pegawai@proses_generate');
Route::get('admin/jadwal-pegawai/lihat/{id}/{id2}', 'App\Http\Controllers\Admin\Jadwal_pegawai@lihat');

// modul gajian
Route::get('admin/gajian', 'App\Http\Controllers\Admin\Gajian@index');
Route::post('admin/gajian/tambah', 'App\Http\Controllers\Admin\Gajian@tambah');
Route::get('admin/gajian/edit/{id}', 'App\Http\Controllers\Admin\Gajian@edit');
Route::post('admin/gajian/proses-edit', 'App\Http\Controllers\Admin\Gajian@proses_edit');
Route::get('admin/gajian/delete/{id}', 'App\Http\Controllers\Admin\Gajian@delete');
//tkd
Route::get('admin/gajian/generate', 'App\Http\Controllers\Admin\Gajian@generate');
Route::get('admin/gajian/gaji-dan-tkd', 'App\Http\Controllers\Admin\Gajian@gaji_dan_tkd');
Route::post('admin/gajian/proses-gaji-dan-tkd', 'App\Http\Controllers\Admin\Gajian@proses_gaji_dan_tkd');
Route::get('admin/gajian/tkd/{id}', 'App\Http\Controllers\Admin\Gajian@tkd');
//gaji
Route::get('admin/gajian/generate-gaji', 'App\Http\Controllers\Admin\Gajian@generate_gaji');
Route::get('admin/gajian/gaji', 'App\Http\Controllers\Admin\Gajian@gaji');
Route::post('admin/gajian/proses-gaji', 'App\Http\Controllers\Admin\Gajian@proses_gaji');
Route::get('admin/gajian/data-gaji/{id}', 'App\Http\Controllers\Admin\Gajian@data_gaji');

// modul gaji
Route::get('admin/gaji', 'App\Http\Controllers\Admin\Gaji@index');
Route::post('admin/gaji/tambah', 'App\Http\Controllers\Admin\Gaji@tambah');
Route::get('admin/gaji/delete/{id}/{id2}/{id3}', 'App\Http\Controllers\Admin\Gaji@delete');
Route::get('admin/gaji/import', 'App\Http\Controllers\Admin\Gaji@import');
Route::post('admin/gaji/proses-import', 'App\Http\Controllers\Admin\Gaji@proses_import');
Route::get('admin/gaji/edit/{id}/{id2}/{id3}', 'App\Http\Controllers\Admin\Gaji@edit');
Route::post('admin/gaji/proses-edit', 'App\Http\Controllers\Admin\Gaji@proses_edit');

// modul absensi
Route::get('admin/absensi', 'App\Http\Controllers\Admin\Absensi@index');
Route::post('admin/absensi/tambah', 'App\Http\Controllers\Admin\Absensi@tambah');
Route::get('admin/absensi/delete/{id}/{id2}/{id3}', 'App\Http\Controllers\Admin\Absensi@delete');
Route::get('admin/absensi/import', 'App\Http\Controllers\Admin\Absensi@import');
Route::post('admin/absensi/proses-import', 'App\Http\Controllers\Admin\Absensi@proses_import');
Route::post('admin/absensi/proses-import', 'App\Http\Controllers\Admin\Absensi@proses_import');
Route::get('admin/absensi/data-absensi', 'App\Http\Controllers\Admin\Absensi@data_absensi');

// modul kehadiran
Route::get('admin/kehadiran', 'App\Http\Controllers\Admin\Kehadiran@index');
Route::get('admin/kehadiran/tambah', 'App\Http\Controllers\Admin\Kehadiran@tambah');
Route::get('admin/kehadiran/delete/{id}/{id2}/{id3}', 'App\Http\Controllers\Admin\Kehadiran@delete');
Route::get('admin/kehadiran/pegawai/{id}/{id2}/{id3}', 'App\Http\Controllers\Admin\Kehadiran@pegawai');
Route::get('admin/kehadiran/gaji/{id}/{id2}/{id3}', 'App\Http\Controllers\Admin\Kehadiran@gaji');
Route::get('admin/kehadiran/import', 'App\Http\Controllers\Admin\Kehadiran@import');
Route::post('admin/kehadiran/proses-import', 'App\Http\Controllers\Admin\Kehadiran@proses_import');
Route::get('admin/kehadiran/detail/{id}/{id2}/{id3}', 'App\Http\Controllers\Admin\Kehadiran@detail');
Route::post('admin/kehadiran/proses-rekap', 'App\Http\Controllers\Admin\Kehadiran@proses_rekap');

// modul pegawai
Route::get('admin/pegawai', 'App\Http\Controllers\Admin\Pegawai@index');
Route::get('admin/pegawai/generate-pin', 'App\Http\Controllers\Admin\Pegawai@generate_pin');
Route::get('admin/pegawai/tambah', 'App\Http\Controllers\Admin\Pegawai@tambah');
Route::post('admin/pegawai/proses-tambah', 'App\Http\Controllers\Admin\Pegawai@proses_tambah');
Route::post('admin/pegawai/proses', 'App\Http\Controllers\Admin\Pegawai@proses');
Route::get('admin/pegawai/edit/{id}', 'App\Http\Controllers\Admin\Pegawai@edit');
Route::post('admin/pegawai/proses-edit', 'App\Http\Controllers\Admin\Pegawai@proses_edit');
Route::get('admin/pegawai/delete/{id}', 'App\Http\Controllers\Admin\Pegawai@delete');
Route::get('admin/pegawai/import', 'App\Http\Controllers\Admin\Pegawai@import');
Route::post('admin/pegawai/proses-import', 'App\Http\Controllers\Admin\Pegawai@proses_import');
Route::get('admin/pegawai/detail/{id}', 'App\Http\Controllers\Admin\Pegawai@detail');
Route::get('admin/pegawai/cetak/{id}', 'App\Http\Controllers\Admin\Pegawai@cetak');
Route::get('admin/pegawai/unduh/{id}', 'App\Http\Controllers\Admin\Pegawai@unduh');
Route::get('admin/pegawai/cetak-riwayat/{id}', 'App\Http\Controllers\Admin\Pegawai@cetak_riwayat');
Route::get('admin/pegawai/unduh-riwayat/{id}', 'App\Http\Controllers\Admin\Pegawai@unduh_riwayat');
Route::get('admin/pegawai/riwayat/{id}', 'App\Http\Controllers\Admin\Pegawai@riwayat');

Route::get('admin/pegawai/mesin/{id}', 'App\Http\Controllers\Admin\Pegawai@mesin');
Route::post('admin/pegawai/proses-mesin', 'App\Http\Controllers\Admin\Pegawai@proses_mesin');
Route::get('admin/pegawai/delete-mesin/{id}/{id2}', 'App\Http\Controllers\Admin\Pegawai@delete_mesin');

// modul libur
Route::get('admin/libur', 'App\Http\Controllers\Admin\Libur@index');
Route::get('admin/libur/tambah', 'App\Http\Controllers\Admin\Libur@tambah');
Route::get('admin/libur/weekend', 'App\Http\Controllers\Admin\Libur@weekend');
Route::get('admin/libur/tahunan', 'App\Http\Controllers\Admin\Libur@tahunan');
Route::post('admin/libur/proses-tambah', 'App\Http\Controllers\Admin\Libur@proses_tambah');
Route::post('admin/libur/proses-weekend', 'App\Http\Controllers\Admin\Libur@proses_weekend');
Route::get('admin/libur/edit/{id}', 'App\Http\Controllers\Admin\Libur@edit');
Route::post('admin/libur/proses-edit', 'App\Http\Controllers\Admin\Libur@proses_edit');
Route::get('admin/libur/delete/{id}', 'App\Http\Controllers\Admin\Libur@delete');
Route::get('admin/libur/import', 'App\Http\Controllers\Admin\Libur@import');
Route::post('admin/libur/proses-import', 'App\Http\Controllers\Admin\Libur@proses_import');
Route::get('admin/libur/detail/{id}', 'App\Http\Controllers\Admin\Libur@detail');
Route::get('admin/libur/cetak/{id}', 'App\Http\Controllers\Admin\Libur@cetak');
Route::get('admin/libur/unduh/{id}', 'App\Http\Controllers\Admin\Libur@unduh');
Route::get('admin/libur/cetak-riwayat/{id}', 'App\Http\Controllers\Admin\Libur@cetak_riwayat');
Route::get('admin/libur/unduh-riwayat/{id}', 'App\Http\Controllers\Admin\Libur@unduh_riwayat');
Route::get('admin/libur/riwayat/{id}', 'App\Http\Controllers\Admin\Libur@riwayat');

/* input riwayat pegawai */
Route::post('admin/pegawai/proses-jabatan', 'App\Http\Controllers\Admin\Pegawai@proses_jabatan');
Route::post('admin/pegawai/proses-pendidikan', 'App\Http\Controllers\Admin\Pegawai@proses_pendidikan');
Route::post('admin/pegawai/proses-keluarga', 'App\Http\Controllers\Admin\Pegawai@proses_keluarga');
Route::post('admin/pegawai/edit-jabatan', 'App\Http\Controllers\Admin\Pegawai@edit_jabatan');
Route::post('admin/pegawai/edit-pendidikan', 'App\Http\Controllers\Admin\Pegawai@edit_pendidikan');
Route::post('admin/pegawai/edit-keluarga', 'App\Http\Controllers\Admin\Pegawai@edit_keluarga');
/* delete riwayat */
Route::get('admin/pegawai/delete-jabatan/{id}/{id2}', 'App\Http\Controllers\Admin\Pegawai@delete_jabatan');
Route::get('admin/pegawai/delete-pendidikan/{id}/{id2}', 'App\Http\Controllers\Admin\Pegawai@delete_pendidikan');
Route::get('admin/pegawai/delete-keluarga/{id}/{id2}', 'App\Http\Controllers\Admin\Pegawai@delete_keluarga');
/* view edit riwayat */
Route::get('admin/pegawai/lihat-jabatan/{id}/{id2}', 'App\Http\Controllers\Admin\Pegawai@lihat_jabatan');
Route::get('admin/pegawai/lihat-pendidikan/{id}/{id2}', 'App\Http\Controllers\Admin\Pegawai@lihat_pendidikan');
Route::get('admin/pegawai/lihat-keluarga/{id}/{id2}', 'App\Http\Controllers\Admin\Pegawai@lihat_keluarga');

// modul divisi
Route::get('admin/divisi', 'App\Http\Controllers\Admin\Divisi@index');
Route::post('admin/divisi/tambah', 'App\Http\Controllers\Admin\Divisi@tambah');
Route::get('admin/divisi/edit/{id}', 'App\Http\Controllers\Admin\Divisi@edit');
Route::post('admin/divisi/proses-edit', 'App\Http\Controllers\Admin\Divisi@proses_edit');
Route::get('admin/divisi/delete/{id}', 'App\Http\Controllers\Admin\Divisi@delete');

// modul Management Asset
Route::get('admin/asset', 'App\Http\Controllers\Admin\Asset@index');
Route::get('admin/asset/tambah', 'App\Http\Controllers\Admin\Asset@tambah');
Route::post('admin/asset/proses-tambah', 'App\Http\Controllers\Admin\Asset@proses_tambah');
Route::get('admin/asset/detail/{id}', 'App\Http\Controllers\Admin\Asset@detail');
Route::get('admin/asset/edit/{id}', 'App\Http\Controllers\Admin\Asset@edit');
Route::post('admin/asset/proses-edit', 'App\Http\Controllers\Admin\Asset@proses_edit');
Route::get('admin/asset/delete/{id}', 'App\Http\Controllers\Admin\Asset@delete');
Route::get('admin/asset/import', 'App\Http\Controllers\Admin\Asset@import');
Route::post('admin/asset/proses-import', 'App\Http\Controllers\Admin\Asset@proses_import');
Route::post('admin/asset/proses', 'App\Http\Controllers\Admin\Asset@proses');
Route::get('admin/asset/laporan', 'App\Http\Controllers\Admin\Asset@laporan');

// modul lokasi-asset
Route::get('admin/lokasi', 'App\Http\Controllers\Admin\Lokasi@index');
Route::post('admin/lokasi/tambah', 'App\Http\Controllers\Admin\Lokasi@tambah');
Route::get('admin/lokasi/edit/{id}', 'App\Http\Controllers\Admin\Lokasi@edit');
Route::post('admin/lokasi/proses-edit', 'App\Http\Controllers\Admin\Lokasi@proses_edit');
Route::get('admin/lokasi/delete/{id}', 'App\Http\Controllers\Admin\Lokasi@delete');

// modul jenis_asset
Route::get('admin/jenis-asset', 'App\Http\Controllers\Admin\Jenis_asset@index');
Route::post('admin/jenis-asset/tambah', 'App\Http\Controllers\Admin\Jenis_asset@tambah');
Route::get('admin/jenis-asset/edit/{id}', 'App\Http\Controllers\Admin\Jenis_asset@edit');
Route::post('admin/jenis-asset/proses-edit', 'App\Http\Controllers\Admin\Jenis_asset@proses_edit');
Route::get('admin/jenis-asset/delete/{id}', 'App\Http\Controllers\Admin\Jenis_asset@delete');

// modul status_absen
Route::get('admin/status-absen', 'App\Http\Controllers\Admin\Status_absen@index');
Route::post('admin/status-absen/tambah', 'App\Http\Controllers\Admin\Status_absen@tambah');
Route::get('admin/status-absen/edit/{id}', 'App\Http\Controllers\Admin\Status_absen@edit');
Route::post('admin/status-absen/proses-edit', 'App\Http\Controllers\Admin\Status_absen@proses_edit');
Route::get('admin/status-absen/delete/{id}', 'App\Http\Controllers\Admin\Status_absen@delete');

// modul shift
Route::get('admin/shift', 'App\Http\Controllers\Admin\Shift@index');
Route::post('admin/shift/tambah', 'App\Http\Controllers\Admin\Shift@tambah');
Route::get('admin/shift/edit/{id}', 'App\Http\Controllers\Admin\Shift@edit');
Route::post('admin/shift/proses-edit', 'App\Http\Controllers\Admin\Shift@proses_edit');
Route::get('admin/shift/delete/{id}', 'App\Http\Controllers\Admin\Shift@delete');

// modul jenis_cuti
Route::get('admin/jenis-cuti', 'App\Http\Controllers\Admin\Jenis_cuti@index');
Route::post('admin/jenis-cuti/tambah', 'App\Http\Controllers\Admin\Jenis_cuti@tambah');
Route::get('admin/jenis-cuti/edit/{id}', 'App\Http\Controllers\Admin\Jenis_cuti@edit');
Route::post('admin/jenis-cuti/proses-edit', 'App\Http\Controllers\Admin\Jenis_cuti@proses_edit');
Route::get('admin/jenis-cuti/delete/{id}', 'App\Http\Controllers\Admin\Jenis_cuti@delete');

// modul mesin-absen
Route::get('admin/mesin-absen', 'App\Http\Controllers\Admin\Mesin_absen@index');
Route::post('admin/mesin-absen/tambah', 'App\Http\Controllers\Admin\Mesin_absen@tambah');
Route::get('admin/mesin-absen/edit/{id}', 'App\Http\Controllers\Admin\Mesin_absen@edit');
Route::post('admin/mesin-absen/proses-edit', 'App\Http\Controllers\Admin\Mesin_absen@proses_edit');
Route::get('admin/mesin-absen/delete/{id}', 'App\Http\Controllers\Admin\Mesin_absen@delete');
Route::get('admin/mesin-absen/unggah/{par1}', 'App\Http\Controllers\Admin\Mesin_absen@unggah');

// modul kuota_cuti
Route::get('admin/kuota-cuti', 'App\Http\Controllers\Admin\Kuota_cuti@index');
Route::post('admin/kuota-cuti/proses-tambah', 'App\Http\Controllers\Admin\Kuota_cuti@proses_tambah');
Route::get('admin/kuota-cuti/edit/{id}', 'App\Http\Controllers\Admin\Kuota_cuti@edit');
Route::post('admin/kuota-cuti/proses-edit', 'App\Http\Controllers\Admin\Kuota_cuti@proses_edit');
Route::get('admin/kuota-cuti/delete/{id}', 'App\Http\Controllers\Admin\Kuota_cuti@delete');
Route::get('admin/kuota-cuti/import', 'App\Http\Controllers\Admin\Kuota_cuti@import');
Route::post('admin/kuota-cuti/proses-import', 'App\Http\Controllers\Admin\Kuota_cuti@proses_import');

// modul jenis_libur
Route::get('admin/jenis-libur', 'App\Http\Controllers\Admin\Jenis_libur@index');
Route::post('admin/jenis-libur/tambah', 'App\Http\Controllers\Admin\Jenis_libur@tambah');
Route::get('admin/jenis-libur/edit/{id}', 'App\Http\Controllers\Admin\Jenis_libur@edit');
Route::post('admin/jenis-libur/proses-edit', 'App\Http\Controllers\Admin\Jenis_libur@proses_edit');
Route::get('admin/jenis-libur/delete/{id}', 'App\Http\Controllers\Admin\Jenis_libur@delete');

// modul panduan
Route::get('admin/panduan', 'App\Http\Controllers\Admin\Panduan@index');
Route::post('admin/panduan/tambah', 'App\Http\Controllers\Admin\Panduan@tambah');
Route::get('admin/panduan/edit/{id}', 'App\Http\Controllers\Admin\Panduan@edit');
Route::post('admin/panduan/proses-edit', 'App\Http\Controllers\Admin\Panduan@proses_edit');
Route::get('admin/panduan/delete/{id}', 'App\Http\Controllers\Admin\Panduan@delete');

// modul pekerjaan
Route::get('admin/pekerjaan', 'App\Http\Controllers\Admin\Pekerjaan@index');
Route::post('admin/pekerjaan/tambah', 'App\Http\Controllers\Admin\Pekerjaan@tambah');
Route::get('admin/pekerjaan/edit/{id}', 'App\Http\Controllers\Admin\Pekerjaan@edit');
Route::post('admin/pekerjaan/proses-edit', 'App\Http\Controllers\Admin\Pekerjaan@proses_edit');
Route::get('admin/pekerjaan/delete/{id}', 'App\Http\Controllers\Admin\Pekerjaan@delete');

// modul rumpun
Route::get('admin/rumpun', 'App\Http\Controllers\Admin\Rumpun@index');
Route::post('admin/rumpun/tambah', 'App\Http\Controllers\Admin\Rumpun@tambah');
Route::get('admin/rumpun/edit/{id}', 'App\Http\Controllers\Admin\Rumpun@edit');
Route::post('admin/rumpun/proses-edit', 'App\Http\Controllers\Admin\Rumpun@proses_edit');
Route::get('admin/rumpun/delete/{id}', 'App\Http\Controllers\Admin\Rumpun@delete');

// modul metode-diklat
Route::get('admin/metode-diklat', 'App\Http\Controllers\Admin\Metode_diklat@index');
Route::post('admin/metode-diklat/tambah', 'App\Http\Controllers\Admin\Metode_diklat@tambah');
Route::get('admin/metode-diklat/edit/{id}', 'App\Http\Controllers\Admin\Metode_diklat@edit');
Route::post('admin/metode-diklat/proses-edit', 'App\Http\Controllers\Admin\Metode_diklat@proses_edit');
Route::get('admin/metode-diklat/delete/{id}', 'App\Http\Controllers\Admin\Metode_diklat@delete');

// modul kategori-diklat
Route::get('admin/kategori-diklat', 'App\Http\Controllers\Admin\Kategori_diklat@index');
Route::post('admin/kategori-diklat/tambah', 'App\Http\Controllers\Admin\Kategori_diklat@tambah');
Route::get('admin/kategori-diklat/edit/{id}', 'App\Http\Controllers\Admin\Kategori_diklat@edit');
Route::post('admin/kategori-diklat/proses-edit', 'App\Http\Controllers\Admin\Kategori_diklat@proses_edit');
Route::get('admin/kategori-diklat/delete/{id}', 'App\Http\Controllers\Admin\Kategori_diklat@delete');

// modul jenjang pendidikan
Route::get('admin/jenjang-pendidikan', 'App\Http\Controllers\Admin\Jenjang_pendidikan@index');
Route::post('admin/jenjang-pendidikan/tambah', 'App\Http\Controllers\Admin\Jenjang_pendidikan@tambah');
Route::get('admin/jenjang-pendidikan/edit/{id}', 'App\Http\Controllers\Admin\Jenjang_pendidikan@edit');
Route::post('admin/jenjang-pendidikan/proses-edit', 'App\Http\Controllers\Admin\Jenjang_pendidikan@proses_edit');
Route::get('admin/jenjang-pendidikan/delete/{id}', 'App\Http\Controllers\Admin\Jenjang_pendidikan@delete');

// modul hubungan keluarga
Route::get('admin/hubungan-keluarga', 'App\Http\Controllers\Admin\Hubungan_keluarga@index');
Route::post('admin/hubungan-keluarga/tambah', 'App\Http\Controllers\Admin\Hubungan_keluarga@tambah');
Route::get('admin/hubungan-keluarga/edit/{id}', 'App\Http\Controllers\Admin\Hubungan_keluarga@edit');
Route::post('admin/hubungan-keluarga/proses-edit', 'App\Http\Controllers\Admin\Hubungan_keluarga@proses_edit');
Route::get('admin/hubungan-keluarga/delete/{id}', 'App\Http\Controllers\Admin\Hubungan_keluarga@delete');

// Modul setting struktur
Route::get('admin/struktur', 'App\Http\Controllers\Admin\Struktur@index');
Route::post('admin/struktur/tambah', 'App\Http\Controllers\Admin\Struktur@tambah');
Route::get('admin/struktur/edit/{id}', 'App\Http\Controllers\Admin\Struktur@edit');
Route::post('admin/struktur/proses-edit', 'App\Http\Controllers\Admin\Struktur@proses_edit');
Route::get('admin/struktur/delete/{id}', 'App\Http\Controllers\Admin\Struktur@delete');

Route::get('admin/struktur/bawahan/{id}', 'App\Http\Controllers\Admin\Struktur@bawahan');
Route::post('admin/struktur/tambah-bawahan', 'App\Http\Controllers\Admin\Struktur@tambah_bawahan');
Route::get('admin/struktur/edit-bawahan/{id}', 'App\Http\Controllers\Admin\Struktur@edit_bawahan');
Route::post('admin/struktur/proses-edit-bawahan', 'App\Http\Controllers\Admin\Struktur@proses_edit_bawahan');
Route::get('admin/struktur/delete-bawahan/{id}/{id_atasan}', 'App\Http\Controllers\Admin\Struktur@delete_bawahan');

// Modul setting menu
Route::get('admin/menu-pegawai', 'App\Http\Controllers\Admin\Menu_pegawai@index');
Route::post('admin/menu-pegawai/tambah', 'App\Http\Controllers\Admin\Menu_pegawai@tambah');
Route::get('admin/menu-pegawai/edit/{id}', 'App\Http\Controllers\Admin\Menu_pegawai@edit');
Route::post('admin/menu-pegawai/proses-edit', 'App\Http\Controllers\Admin\Menu_pegawai@proses_edit');
Route::get('admin/menu-pegawai/delete/{id}', 'App\Http\Controllers\Admin\Menu_pegawai@delete');

// konfigurasi
Route::get('admin/konfigurasi', 'App\Http\Controllers\Admin\Konfigurasi@index');
Route::get('admin/konfigurasi/logo', 'App\Http\Controllers\Admin\Konfigurasi@logo');
Route::get('admin/konfigurasi/profil', 'App\Http\Controllers\Admin\Konfigurasi@profil');
Route::get('admin/konfigurasi/icon', 'App\Http\Controllers\Admin\Konfigurasi@icon');
Route::get('admin/konfigurasi/email', 'App\Http\Controllers\Admin\Konfigurasi@email');
Route::get('admin/konfigurasi/gambar', 'App\Http\Controllers\Admin\Konfigurasi@gambar');
Route::get('admin/konfigurasi/pembayaran', 'App\Http\Controllers\Admin\Konfigurasi@pembayaran');
Route::post('admin/konfigurasi/proses', 'App\Http\Controllers\Admin\Konfigurasi@proses');
Route::post('admin/konfigurasi/proses_logo', 'App\Http\Controllers\Admin\Konfigurasi@proses_logo');
Route::post('admin/konfigurasi/proses_icon', 'App\Http\Controllers\Admin\Konfigurasi@proses_icon');
Route::post('admin/konfigurasi/proses_email', 'App\Http\Controllers\Admin\Konfigurasi@proses_email');
Route::post('admin/konfigurasi/proses_gambar', 'App\Http\Controllers\Admin\Konfigurasi@proses_gambar');
Route::post('admin/konfigurasi/proses_pembayaran', 'App\Http\Controllers\Admin\Konfigurasi@proses_pembayaran');
Route::post('admin/konfigurasi/proses_profil', 'App\Http\Controllers\Admin\Konfigurasi@proses_profil');