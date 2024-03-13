<?php 
use Illuminate\Support\Facades\DB;
use App\Models\Jabatan_model;
// ambil data master
$m_jabatan      = new Jabatan_model();
$jabatan        = $m_jabatan->listing();
$divisi       = DB::table('divisi')->get();
$jenjang_pendidikan = DB::table('jenjang_pendidikan')->get();
$pangkat      = DB::table('pangkat')->get();
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

        <form action="{{ asset('pegawai/pegawai/edit-jabatan') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <input type="hidden" name="id_pegawai" value="{{ $pegawai->id_pegawai }}">
        <input type="hidden" name="id_riwayat_jabatan" value="{{ $riwayat_jabatan->id_riwayat_jabatan }}">

        <div class="form-group row">
          <label class="col-md-3">Divisi <span class="text-danger">*</span></label>
          <div class="col-md-9">
            
            <select name="id_divisi" class="form-control" id="id_divisi" required>
              <option value="">Pilih Divisi</option>
              <?php foreach($divisi as $divisi) { ?>
                <option value="{{ $divisi->id_divisi }}" <?php if($riwayat_jabatan->id_divisi==$divisi->id_divisi) { echo 'selected'; } ?>>
                  {{ $divisi->nama_divisi }}
                </option>
              <?php } ?>
            </select>

          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Jabatan <span class="text-danger">*</span></label>
          <div class="col-md-9">
            
            <select name="id_jabatan" class="form-control" id="id_jabatan" required>
              <option value="">Pilih Jabatan</option>
              <?php foreach($jabatan as $jabatan) { ?>
                <option value="{{ $jabatan->id_jabatan }}" class="{{ $jabatan->id_divisi }}" <?php if($riwayat_jabatan->id_jabatan==$jabatan->id_jabatan) { echo 'selected'; } ?>>
                  {{ $jabatan->jenis_jabatan }} - {{ $jabatan->nama_jabatan }}
                </option>
              <?php } ?>
            </select>
            
          </div>
        </div>

        <script>
            $("#id_jabatan").chained("#id_divisi");
          </script>

        <div class="form-group row">
          <label class="col-md-3">Pangkat <span class="text-danger">*</span></label>
          <div class="col-md-9">
            
            <select name="id_pangkat" class="form-control" id="id_pangkat">
              <option value="">Pilih Pangkat</option>
              <?php foreach($pangkat as $pangkat) { ?>
                <option value="{{ $pangkat->id_pangkat }}" <?php if($riwayat_jabatan->id_pangkat==$pangkat->id_pangkat) { echo 'selected'; } ?>>
                  {{ $pangkat->golongan }}/{{ $pangkat->ruang }} - {{ $pangkat->nama_pangkat }}
                </option>
              <?php } ?>
            </select>
            
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">TMT dan Eselon</label>
          <div class="col-md-3">
            <input type="text" name="tmt" class="form-control datepicker" placeholder="TMT" value="{{ date('d-m-Y',strtotime($riwayat_jabatan->tmt)) }}" required>
          </div>
          <div class="col-md-6">
            <select name="eselon" id="eselon" class="form-control" required>
              <option value="">Pilih Eselon</option>
              <option value="0" <?php if($riwayat_jabatan->eselon=='0') { echo 'selected'; } ?>>Non Eselon</option>
              <option value="I" <?php if($riwayat_jabatan->eselon=='I') { echo 'selected'; } ?>>Eselon I</option>
              <option value="II" <?php if($riwayat_jabatan->eselon=='II') { echo 'selected'; } ?>>Eselon II</option>
              <option value="III" <?php if($riwayat_jabatan->eselon=='III') { echo 'selected'; } ?>>Eselon III</option>
              <option value="IV" <?php if($riwayat_jabatan->eselon=='IV') { echo 'selected'; } ?>>Eselon IV</option>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Tanggal dan Nomor SK</label>
          <div class="col-md-3">
            <input type="text" name="tanggal_sk" class="form-control datepicker" placeholder="Tanggal SK" value="{{ date('d-m-Y',strtotime($riwayat_jabatan->tanggal_sk)) }}">
          </div>
          <div class="col-md-6">
            <input type="text" name="nomor_sk" class="form-control" placeholder="Nomor SK" value="{{ $riwayat_jabatan->nomor_sk }}">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Pejabat yang bertanda tangan</label>
          <div class="col-md-3">
            <input type="text" name="nip_pejabat" class="form-control" placeholder="NIP Pejabat" value="{{ $riwayat_jabatan->nip_pejabat }}">
          </div>
          <div class="col-md-6">
            <input type="text" name="nama_pejabat" class="form-control" placeholder="Nama Pejabat" value="{{ $riwayat_jabatan->nama_pejabat }}">
          </div>
        </div>
       
        <div class="form-group row">
          <label class="col-md-3">Jabatan Pejabat yang bertanda tangan</label>
          <div class="col-md-9">
            <input type="text" name="jabatan_pejabat" class="form-control" placeholder="Jabatan Pejabat" value="{{ $riwayat_jabatan->jabatan_pejabat }}">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Keterangan/Catatan</label>
          <div class="col-md-9">
            <textarea name="keterangan" class="form-control">{{ $riwayat_jabatan->keterangan }}</textarea>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Upload dokumen SK</label>
          <div class="col-md-9">
            <input type="file" name="gambar" class="form-control" placeholder="Upload SK" value="{{ $riwayat_jabatan->gambar }}">
          </div>
        </div>


        <div class="form-group row">
          <label class="col-md-3"></label>
          <div class="col-md-9">
            <a href="{{ asset('pegawai/pegawai/riwayat/'.$pegawai->id_pegawai) }}#jabatan" class="btn btn-default" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>

        </form>
