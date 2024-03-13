<div class="modal fade" id="modal-jabatan">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Baru</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ asset('pegawai/pegawai/proses-jabatan') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <input type="hidden" name="id_pegawai" value="{{ $pegawai->id_pegawai }}">

        <div class="form-group row">
          <label class="col-md-3">Divisi <span class="text-danger">*</span></label>
          <div class="col-md-9">
            
            <select name="id_divisi" class="form-control" id="id_divisi" required>
              <option value="">Pilih Divisi</option>
              <?php foreach($divisi as $divisi) { ?>
                <option value="{{ $divisi->id_divisi }}">{{ $divisi->nama_divisi }}</option>
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
                <option value="{{ $jabatan->id_jabatan }}" class="{{ $jabatan->id_divisi }}">
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
                <option value="{{ $pangkat->id_pangkat }}">{{ $pangkat->golongan }}/{{ $pangkat->ruang }} - {{ $pangkat->nama_pangkat }}</option>
              <?php } ?>
            </select>
            
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">TMT dan Eselon</label>
          <div class="col-md-3">
            <input type="text" name="tmt" class="form-control datepicker" placeholder="TMT" value="{{ old('tmt') }}" required>
          </div>
          <div class="col-md-6">
            <select name="eselon" id="eselon" class="form-control" required>
              <option value="">Pilih Eselon</option>
              <option value="0">Non Eselon</option>
              <option value="I">Eselon I</option>
              <option value="II">Eselon II</option>
              <option value="III">Eselon III</option>
              <option value="IV">Eselon IV</option>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Tanggal dan Nomor SK</label>
          <div class="col-md-3">
            <input type="text" name="tanggal_sk" class="form-control datepicker" placeholder="Tanggal SK" value="{{ old('tanggal_sk') }}">
          </div>
          <div class="col-md-6">
            <input type="text" name="nomor_sk" class="form-control" placeholder="Nomor SK" value="{{ old('nomor_sk') }}">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Pejabat yang bertanda tangan</label>
          <div class="col-md-3">
            <input type="text" name="nip_pejabat" class="form-control" placeholder="NIP Pejabat" value="{{ old('nip_pejabat') }}">
          </div>
          <div class="col-md-6">
            <input type="text" name="nama_pejabat" class="form-control" placeholder="Nama Pejabat" value="{{ old('nama_pejabat') }}">
          </div>
        </div>
       
        <div class="form-group row">
          <label class="col-md-3">Jabatan Pejabat yang bertanda tangan</label>
          <div class="col-md-9">
            <input type="text" name="jabatan_pejabat" class="form-control" placeholder="Jabatan Pejabat" value="{{ old('jabatan_pejabat') }}">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Keterangan/Catatan</label>
          <div class="col-md-9">
            <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
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