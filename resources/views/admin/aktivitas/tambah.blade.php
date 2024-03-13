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

        <form action="{{ asset('admin/aktivitas/tambah') }}" method="post" accept-charset="utf-8">
        {{ csrf_field() }}

        <div class="form-group row">
          <label class="col-md-3">Nama dan Kode Aktivitas</label>

          <div class="col-md-7">
            <input type="text" name="nama_aktivitas" class="form-control" placeholder="Nama aktivitas" value="{{ old('nama_aktivitas') }}" required>
            <small class="text-secondary">Nama aktivitas</small>
          </div>

          <div class="col-md-2">
            <input type="text" name="kode_aktivitas" class="form-control" placeholder="Kode" value="A{{ $urutan }}" required>
            <small class="text-secondary">Kode aktivitas</small>
          </div>

        </div>

        <div class="form-group row">
          <label class="col-md-3">Divisi</label>
          <div class="col-md-9">

            <select name="id_divisi" class="form-control select2" required>
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
          <label class="col-md-3">Satuan Output</label>
          <div class="col-md-9">

            <select name="id_satuan" class="form-control select2" required>
              <option value="">Pilih salah satu</option>
              <?php foreach($satuan as $satuan) { ?>
              <option value="{{ $satuan->id_satuan }}">
                {{ $satuan->nama_satuan }}
              </option>
              <?php } ?>
            </select>

          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Status Aktivitas</label>
          <div class="col-md-9">

            <select name="status_aktivitas" class="form-control" required>
              <option value="Aktif">Aktif</option>
              <option value="Nonaktif">Nonaktif</option>
            </select>
            
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Waktu, Tingkat Kesulitaan, Bobot</label>

          <div class="col-md-3">
            <input type="number" name="waktu" class="form-control" placeholder="Waktu" value="{{ old('waktu') }}" required>
            <small class="text-secondary">Waktu dalam menit</small>
          </div>

          <div class="col-md-3">
            <input type="number" name="tingkat_kesulitan" class="form-control" placeholder="Tingkat kesulitan" value="{{ old('tingkat_kesulitan') }}" required>
            <small class="text-secondary">Tingkat kesulitan</small>
          </div>

          <div class="col-md-3">
            <input type="number" name="bobot" class="form-control" placeholder="Bobot" value="{{ old('bobot') }}" required>
            <small class="text-secondary">Bobot</small>
          </div>

        </div>

        <div class="form-group row">
          <label class="col-md-3">Keterangan</label>
          <div class="col-md-9">
            <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Kategori dan No urut tampil</label>
          <div class="col-md-6">
            <input type="text" name="kategori" class="form-control" placeholder="Kategori" value="{{ old('kategori') }}" required>
          </div>

          <div class="col-md-3">
            <input type="number" name="urutan" class="form-control" placeholder="No urut tampil" value="{{ $urutan }}" required>
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