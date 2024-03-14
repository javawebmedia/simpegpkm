<form action="{{ asset('pegawai/str-sip/proses-edit') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <input type="hidden" name="id_str_sip" value="{{ $str_sip->id_str_sip }}">

        <div class="form-group row">
          <label class="col-md-3">Jenis STR/SIP <span class="text-danger">*</span></label>
          <div class="col-md-9">
            <select name="jenis_str_sip" class="form-control" required>
              <option value="">Pilih STR atau SIP</option>
              <option value="STR" <?php if($str_sip->jenis_str_sip=='STR') { echo 'selected'; } ?>>STR - Surat Tanda Registrasi</option>
              <option value="SIP" <?php if($str_sip->jenis_str_sip=='SIP') { echo 'selected'; } ?>>SIP - Surat Izin Praktik</option>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Nomor STR/SIP <span class="text-danger">*</span></label>
          <div class="col-md-9">
            <input type="text" name="nomor_sertifikat" class="form-control" placeholder="Nomor Sertifikat" value="{{ $str_sip->nomor_sertifikat }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Nomor Registrasi</label>
          <div class="col-md-9">
            <input type="text" name="nomor_registrasi" class="form-control" placeholder="Nomor Registrasi" value="{{ $str_sip->nomor_registrasi }}">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Nomor Ijazah</label>
          <div class="col-md-9">
            <input type="text" name="nomor_ijazah" class="form-control" placeholder="Nomor Ijazah" value="{{ date('d-m-Y',strtotime($str_sip->nomor_ijazah)) }}">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Tanggal Terbit dan Akhir <span class="text-danger">*</span></label>

          <div class="col-md-3">
            <input type="text" name="tanggal_lulus" class="form-control datepicker" placeholder="dd-mm-yyyy" value="{{ date('d-m-Y',strtotime($str_sip->tanggal_lulus)) }}" required>
            <small>Tanggal terbit</small>
          </div>

          <div class="col-md-3">
            <input type="text" name="tanggal_akhir" class="form-control datepicker" placeholder="dd-mm-yyyy" value="{{ date('d-m-Y',strtotime($str_sip->tanggal_akhir)) }}">
            <small>Tanggal berakhir</small>
          </div>

          <div class="col-md-3">

             <div class="custom-control custom-checkbox">
              <input class="custom-control-input" type="checkbox" id="seumur_hidup" name="seumur_hidup" value="Ya" <?php if($str_sip->seumur_hidup=='Ya') { echo 'checked'; } ?>>
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
          <label class="col-md-3">Upload Sertifikat</label>
          <div class="col-md-6">
            <input type="file" name="gambar" class="form-control" placeholder="Upload manual book" value="{{ old('gambar') }}">
          </div>
          <div class="col-md-3">
            <a href="{{ asset('assets/upload/file/'.$str_sip->gambar) }}" class="btn btn-danger btn-sm" target="_blank"><i class="fa fa-file-pdf"></i> Unduh</a>
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