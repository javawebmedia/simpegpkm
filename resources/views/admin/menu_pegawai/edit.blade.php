@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ asset('admin/menu-pegawai/proses-edit') }}" method="post" accept-charset="utf-8">
{{ csrf_field() }}

<input type="hidden" name="id_menu_pegawai" value="{{ $menu_pegawai->id_menu_pegawai }}">

<div class="form-group row">
          <label class="col-md-3">Pilih Pegawai yang Bisa Mengakses</label>
          <div class="col-md-9">
            <select name="id_pegawai" class="form-control select2" required>
            <option value="">Pilih pegawai</option>
            <?php foreach($pegawai as $pegawai) { ?>
              <option value="<?php echo $pegawai->id_pegawai ?>" <?php if($pegawai->id_pegawai==$menu_pegawai->id_pegawai) { echo 'selected'; } ?>>
                <?php echo $pegawai->nama_lengkap ?> - NIP: <?php echo $pegawai->nip ?>
              </option>
            <?php } ?>
          </select>
          </div>
        </div>

<div class="form-group row">
  <label class="col-md-3">Nama Menu Pegawai</label>
  <div class="col-md-9">
    <input type="text" name="nama_menu" class="form-control" placeholder="Nama menu_pegawai" value="{{ $menu_pegawai->nama_menu }}" required>
  </div>
</div>

 <div class="form-group row">
          <label class="col-md-3">Icon Menu</label>
          <div class="col-md-9">
            <input type="text" name="icon" class="form-control" placeholder="Icon" value="{{ $menu_pegawai->icon }}" required>
            <small class="text-secondary">Icon menggunakan Fontawesome 6</small>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3">Link Menu</label>
          <div class="col-md-9">
            <div class="input-group">
                <span class="input-group-text">
                  {{ asset('/')}}
                </span>
                <input type="text" name="link" class="form-control" placeholder="Link" value="{{ $menu_pegawai->link }}" required>
            </div>
            <small class="text-secondary">Misal: <strong>admin/user</strong></small>
          </div>
        </div>

<div class="form-group row">
  <label class="col-md-3">Keterangan</label>
  <div class="col-md-9">
    <textarea name="keterangan" class="form-control">{{ $menu_pegawai->keterangan }}</textarea>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3">No urut tampil</label>
  <div class="col-md-9">
    <input type="number" name="urutan" class="form-control" placeholder="No urut tampil" value="{{ $menu_pegawai->urutan }}" required>
  </div>
</div>

<div class="form-group row">
  <label class="col-md-3"></label>
  <div class="col-md-9">

    <a href="{{ asset('admin/menu_pegawai') }}" class="btn btn-secondary">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>

    <button type="submit" class="btn btn-primary">Simpan</button>
  </div>
</div>

</form>

