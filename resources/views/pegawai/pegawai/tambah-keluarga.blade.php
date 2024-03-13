<div class="modal fade" id="modal-keluarga">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Baru</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ asset('pegawai/pegawai/proses-keluarga') }}" method="post" accept-charset="utf-8">
          {{ csrf_field() }}

          <input type="hidden" name="id_pegawai" value="{{ $pegawai->id_pegawai }}">

          <div class="form-group row">
            <label class="col-md-3">Hubungan Keluarga <span class="text-danger">*</span></label>

            <div class="col-md-9">
              <select name="id_hubungan_keluarga" id="id_hubungan_keluarga" class="form-control" required>
                <option value="">Pilih Hubungan Keluarga</option>
                @foreach($hubungan_keluarga as $hubungan_keluarga)
                <option value="{{ $hubungan_keluarga->id_hubungan_keluarga }}">{{ $hubungan_keluarga->nama_hubungan_keluarga }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3">Nama Lengkap</label>
            <div class="col-md-9">
              <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap" value="{{ old('nama_lengkap') }}" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3">NIK</label>
            <div class="col-md-9">
              <input type="text" name="nik" class="form-control" placeholder="NIK" value="{{ old('nik') }}" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3">Tempat &amp; Tanggal Lahir</label>
            <div class="col-md-6">
              <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat lahir" value="{{ old('tempat_lahir') }}" required>
            </div>
            <div class="col-md-3">
              <input type="text" name="tanggal_lahir" class="form-control datepicker" placeholder="Tanggal lahir" value="{{ old('tanggal_lahir') }}" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3">Jenis Kelamin</label>
            <div class="col-md-9">
              <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                <option value="">Pilih jenis kelamin</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3">Agama</label>
            <div class="col-md-9">
              <select name="id_agama" id="id_agama" class="form-control" required>
                <option value="">Pilih agama</option>
                @foreach($agama as $agama)
                <option value="{{ $agama->id_agama }}">{{ $agama->nama_agama }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3">Status Perkawinan</label>
            <div class="col-md-9">
              <select name="status_perkawinan" id="status_perkawinan" class="form-control" required>
                <option value="">Pilih status perkawinan</option>
                <option value="Belum Menikah">Belum Menikah</option>
                <option value="Menikah">Menikah</option>
                <option value="Cerai Hidup">Cerai Hidup</option>
                <option value="Cerai Mati">Cerai Mati</option>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3">Jenjang Pendidikan<span class="text-danger">*</span></label>
            <div class="col-md-9">
              <select name="id_jenjang_pendidikan" class="form-control" id="id_jenjang_pendidikan">
                <option value="">Pilih Jenjang</option>
                <?php foreach($jenjang_pendidikan as $jenjang_pendidikan) { ?>
                  <option value="{{ $jenjang_pendidikan->id_jenjang_pendidikan }}">{{ $jenjang_pendidikan->nama_jenjang_pendidikan }}</option>
                <?php } ?>
              </select>
            </div>

          </div>

          <div class="form-group row">
            <label class="col-md-3">Pekerjaan<span class="text-danger">*</span></label>
            <div class="col-md-9">
              <select name="id_pekerjaan" class="form-control" id="id_pekerjaan">
                <option value="">Pilih pekerjaan</option>
                <?php foreach($pekerjaan as $pekerjaan) { ?>
                  <option value="{{ $pekerjaan->id_pekerjaan }}">{{ $pekerjaan->nama_pekerjaan }}</option>
                <?php } ?>
              </select>
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