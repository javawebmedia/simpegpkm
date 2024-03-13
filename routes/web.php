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

// END MODUL PEGAWAI

// modul dasbor
Route::get('admin/dasbor', 'App\Http\Controllers\Admin\Dasbor@index');

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
Route::get('admin/divisi', 'App\Http\Controllers\Admin\Divisi@index');

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

// modul aktivitas
Route::get('admin/aktivitas', 'App\Http\Controllers\Admin\Aktivitas@index');
Route::post('admin/aktivitas/tambah', 'App\Http\Controllers\Admin\Aktivitas@tambah');
Route::get('admin/aktivitas/edit/{id}', 'App\Http\Controllers\Admin\Aktivitas@edit');
Route::post('admin/aktivitas/proses-edit', 'App\Http\Controllers\Admin\Aktivitas@proses_edit');
Route::get('admin/aktivitas/delete/{id}', 'App\Http\Controllers\Admin\Aktivitas@delete');

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

// modul pegawai
Route::get('admin/pegawai', 'App\Http\Controllers\Admin\Pegawai@index');
Route::get('admin/pegawai/tambah', 'App\Http\Controllers\Admin\Pegawai@tambah');
Route::post('admin/pegawai/proses-tambah', 'App\Http\Controllers\Admin\Pegawai@proses_tambah');
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