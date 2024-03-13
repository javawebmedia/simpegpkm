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

        <form action="{{ asset('admin/pangkat/tambah') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <div class="form-group row">
          <label class="col-md-3">Nama Pangkat</label>
          <div class="col-md-9">
            <input type="text" name="nama_pangkat" class="form-control" placeholder="Nama pangkat" value="{{ old('nama_pangkat') }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Golongan</label>
          <div class="col-md-9">
            <input type="text" name="golongan" class="form-control" placeholder="Golongan" value="{{ old('golongan') }}" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Ruang</label>
          <div class="col-md-9">
            <input type="text" name="ruang" class="form-control" placeholder="Ruang" value="{{ old('ruang') }}" required>
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