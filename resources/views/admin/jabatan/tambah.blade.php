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

        <form action="{{ asset('admin/jabatan/tambah') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <div class="form-group row">
          <label class="col-md-3">Nama Jabatan</label>
          <div class="col-md-9">
            <input type="text" name="nama_jabatan" class="form-control" placeholder="Nama jabatan" value="{{ old('nama_jabatan') }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Divisi</label>
          <div class="col-md-9">

            <select name="id_divisi" class="form-control" required>
              <option value="">Pilih salah satu</option>
              <?php foreach($divisi as $divisi) { ?>
              <option value="{{ $divisi->id_divisi }}">
                {{ $divisi->nama_divisi }}
              </option>
              <?php } ?>
            </select>

          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Jenis Jabatan</label>
          <div class="col-md-9">

            <select name="jenis_jabatan" class="form-control" required>
              <option value="">Pilih salah satu</option>
              <option value="Fungsional">Fungsional</option>
              <option value="Struktural">Struktural</option>
            </select>
            
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Keterangan</label>
          <div class="col-md-9">
            <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">No urut tampil</label>
          <div class="col-md-9">
            <input type="number" name="urutan" class="form-control" placeholder="No urut tampil" value="{{ old('urutan') }}" required>
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