<?php 
use Illuminate\Support\Facades\DB;
// ambil data master
$jenjang_pendidikan = DB::table('jenjang_pendidikan')->get();
?>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <form action="{{ asset('admin/pegawai/edit-pendidikan') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <input type="hidden" name="id_pegawai" value="{{ $pegawai->id_pegawai }}">
        <input type="hidden" name="id_pendidikan" value="{{ $pendidikan->id_pendidikan }}">

        <div class="form-group row">
          <label class="col-md-3">Jenjang Pendidikan <span class="text-danger">*</span></label>

          <div class="col-md-3">
            <select name="jenis_pendidikan" id="jenis_pendidikan" class="form-control" required>
              <option value="">Pilih Jenis</option>
              <option value="Formal" <?php if($pendidikan->jenis_pendidikan=="Formal") { echo 'selected'; } ?>>Formal</option>
              <option value="Informal" <?php if($pendidikan->jenis_pendidikan=="Informal") { echo 'selected'; } ?>>Informal</option>
            </select>
          </div>

          <div class="col-md-6">
            <select name="id_jenjang_pendidikan" class="form-control" id="id_jenjang_pendidikan">
              <option value="">Pilih Jenjang</option>
              <?php foreach($jenjang_pendidikan as $jenjang_pendidikan) { ?>
                <option value="{{ $jenjang_pendidikan->id_jenjang_pendidikan }}" class="Formal"  <?php if($pendidikan->id_jenjang_pendidikan==$jenjang_pendidikan->id_jenjang_pendidikan) { echo 'selected'; } ?>>{{ $jenjang_pendidikan->nama_jenjang_pendidikan }}</option>
              <?php } ?>
            </select>
          </div>
      
        </div>

        <script>
            $("#id_jenjang_pendidikan").chained("#jenis_pendidikan");
          </script>

        
        <div class="form-group row">
          <label class="col-md-3">Tanggal Ijazah dan Nomor Ijazah</label>
          <div class="col-md-6">
            <input type="text" name="nomor_ijazah" class="form-control" placeholder="Nomor Ijazah" value="{{ $pendidikan->nomor_ijazah }}" required>
          </div>
          <div class="col-md-3">
            <input type="text" name="tanggal_lulus" class="form-control datepicker" placeholder="Tanggal Ijazah" value="{{ date('d-m-Y',strtotime($pendidikan->tanggal_lulus)) }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Nama dan Kota Institusi</label>
          <div class="col-md-6">
            <input type="text" name="nama_sekolah" class="form-control" placeholder="Nama Sekolah/Kampus/Institusi" value="{{ $pendidikan->nama_sekolah }}" required>
          </div>
          <div class="col-md-3">
            <input type="text" name="kota_sekolah" class="form-control" placeholder="Kota Sekolah" value="{{ $pendidikan->kota_sekolah }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Tahun Masuk dan Lulus</label>
          <div class="col-md-3">
            <input type="number" name="tahun_masuk" class="form-control" placeholder="Tahun Masuk" value="{{ $pendidikan->tahun_masuk }}" required>
          </div>
          <div class="col-md-3">
            <input type="number" name="tahun_lulus" class="form-control" placeholder="Tahun Lulus/Keluar" value="{{ $pendidikan->tahun_lulus }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Keterangan/Catatan</label>
          <div class="col-md-9">
            <textarea name="keterangan" class="form-control">{{ $pendidikan->keterangan }}</textarea>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Upload dokumen SK</label>
          <div class="col-md-9">
            <input type="file" name="gambar" class="form-control" placeholder="Upload SK" value="{{ old('gambar') }}">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3"></label>
          <div class="col-md-9">
            <a href="{{ asset('admin/pegawai/riwayat/'.$pegawai->id_pegawai) }}#pendidikan" class="btn btn-default" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>

        </form>
