<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Baru</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ asset('admin/panduan/tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <div class="form-group row">
          <label class="col-md-3">Nama Panduan</label>
          <div class="col-md-9">
            <input type="text" name="nama_panduan" class="form-control" placeholder="Nama panduan" value="{{ old('nama_panduan') }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Upload Manual Book</label>
          <div class="col-md-9">
            <input type="file" name="gambar" class="form-control" placeholder="Upload manual book" value="{{ old('gambar') }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Link Video Panduan</label>
          <div class="col-md-9">
            <input type="text" name="video" class="form-control" placeholder="Link Video panduan" value="{{ old('video') }}">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Keterangan</label>
          <div class="col-md-9">
            <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Panduan untuk</label>
          <div class="col-md-9">
            <select name="pengguna" class="form-control">
              <option value="Pegawai">Pegawai</option>
              <option value="Administrator">Administrator</option>
              <option value="Umum">Umum</option>
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