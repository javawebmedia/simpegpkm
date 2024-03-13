<div class="modal fade" id="modal-pendidikan">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Baru</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ asset('pegawai/pegawai/proses-pendidikan') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <input type="hidden" name="id_pegawai" value="{{ $pegawai->id_pegawai }}">

        <div class="form-group row">
          <label class="col-md-3">Jenjang Pendidikan <span class="text-danger">*</span></label>

          <div class="col-md-3">
            <select name="jenis_pendidikan" id="jenis_pendidikan" class="form-control" required>
              <option value="">Pilih Jenis</option>
              <option value="Formal">Formal</option>
              <option value="Informal">Informal</option>
            </select>
          </div>

          <div class="col-md-6">
            <select name="id_jenjang_pendidikan" class="form-control" id="id_jenjang_pendidikan">
              <option value="">Pilih Jenjang</option>
              <?php foreach($jenjang_pendidikan as $jenjang_pendidikan) { ?>
                <option value="{{ $jenjang_pendidikan->id_jenjang_pendidikan }}" class="Formal">{{ $jenjang_pendidikan->nama_jenjang_pendidikan }}</option>
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
            <input type="text" name="nomor_ijazah" class="form-control" placeholder="Nomor Ijazah" value="{{ old('nomor_ijazah') }}" required>
          </div>
          <div class="col-md-3">
            <input type="text" name="tanggal_lulus" class="form-control datepicker" placeholder="Tanggal Ijazah" value="{{ old('tanggal_lulus') }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Nama dan Kota Institusi</label>
          <div class="col-md-6">
            <input type="text" name="nama_sekolah" class="form-control" placeholder="Nama Sekolah/Kampus/Institusi" value="{{ old('nama_sekolah') }}" required>
          </div>
          <div class="col-md-3">
            <input type="text" name="kota_sekolah" class="form-control" placeholder="Kota Sekolah" value="{{ old('kota_sekolah') }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Tahun Masuk dan Lulus</label>
          <div class="col-md-3">
            <input type="number" name="tahun_masuk" class="form-control" placeholder="Tahun Masuk" value="{{ old('tahun_masuk') }}" required>
          </div>
          <div class="col-md-3">
            <input type="number" name="tahun_lulus" class="form-control" placeholder="Tahun Lulus/Keluar" value="{{ old('tahun_lulus') }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Keterangan/Catatan</label>
          <div class="col-md-9">
            <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Upload dokumen Ijazah</label>
          <div class="col-md-9">
            <input type="file" name="gambar" class="form-control" placeholder="Upload SK" value="{{ old('gambar') }}">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3"></label>
          <div class="col-md-9">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>

        </form>

      </div>
      <div class="modal-footer justify-content-between">
        
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->