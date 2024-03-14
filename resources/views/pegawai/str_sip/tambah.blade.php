<form action="{{ asset('pegawai/str-sip/proses-tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <div class="form-group row">
          <label class="col-md-3">Jenis STR/SIP <span class="text-danger">*</span></label>
          <div class="col-md-9">
            <select name="jenis_str_sip" class="form-control" required>
              <option value="">Pilih STR atau SIP</option>
              <option value="STR">STR - Surat Tanda Registrasi</option>
              <option value="SIP">SIP - Surat Izin Praktik</option>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Nomor STR/SIP <span class="text-danger">*</span></label>
          <div class="col-md-9">
            <input type="text" name="nomor_sertifikat" class="form-control" placeholder="Nomor Sertifikat" value="{{ old('nomor_sertifikat') }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Nomor Registrasi</label>
          <div class="col-md-9">
            <input type="text" name="nomor_registrasi" class="form-control" placeholder="Nomor Registrasi" value="{{ old('nomor_registrasi') }}">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Nomor Ijazah</label>
          <div class="col-md-9">
            <input type="text" name="nomor_ijazah" class="form-control" placeholder="Nomor Ijazah" value="{{ old('nomor_ijazah') }}">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Tanggal Terbit dan Akhir <span class="text-danger">*</span></label>

          <div class="col-md-3">
            <input type="text" name="tanggal_lulus" class="form-control datepicker" placeholder="dd-mm-yyyy" value="{{ old('tanggal_lulus') }}" required>
            <small>Tanggal terbit</small>
          </div>

          <div class="col-md-3">
            <input type="text" name="tanggal_akhir" class="form-control datepicker" placeholder="dd-mm-yyyy" value="{{ old('tanggal_akhir') }}">
            <small>Tanggal berakhir</small>
          </div>

          <div class="col-md-3">

             <div class="custom-control custom-checkbox">
              <input class="custom-control-input" type="checkbox" id="seumur_hidup" name="seumur_hidup" value="Ya">
              <label for="seumur_hidup" class="custom-control-label">Aktif seumur hidup</label>
            </div>

          </div>

        </div>

        <div class="form-group row">
          <label class="col-md-3">Tanggal diterbitkan / ditandatangani</label>
          <div class="col-md-9">
            <input type="text" name="tanggal_tanda_tangan" class="form-control datepicker" placeholder="dd-mm-yyyy" value="{{ old('tanggal_tanda_tangan') }}">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Upload Sertifikat <span class="text-danger">*</span></label>
          <div class="col-md-9">
            <input type="file" name="gambar" class="form-control" placeholder="Upload manual book" value="{{ old('gambar') }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3"></label>
          <div class="col-md-9">
            <a href="{{ asset('pegawai/str-sip') }}" class="btn btn-default" data-dismiss="modal">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>

        </form>