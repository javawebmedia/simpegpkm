@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form method="post" action="{{ asset('admin/akun/ganti-password') }}">
{{ csrf_field() }}

<div class="form-group row">
	<label class="col-md-4 text-right">Password Baru</label>
	<div class="col-md-8">
		<input type="password" name="password" value="{{ old('password') }}" placeholder="Password baru" class="form-control" minlength="6" maxlength="32" required>
		<small class="text-danger">Minimal 6 karakter dan maksimal 32 karakter</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-4 text-right">Konfirmasi Password Baru</label>
	<div class="col-md-8">
		<input type="password" name="password_konfirmasi" value="{{ old('password_konfirmasi') }}" placeholder="Password baru" class="form-control" minlength="6" maxlength="32" required>
		<small class="text-danger">Minimal 6 karakter dan maksimal 32 karakter</small>
	</div>
</div>

<div class="form-group row">
	<label class="col-md-4 text-right"></label>
	<div class="col-md-8">
		<button class="btn btn-success" type="submit" name="submit">
			<i class="fa fa-save"></i> Ganti Password
		</button>
		<button class="btn btn-secondary" type="reset" name="reset">
			<i class="fa fa-times"></i> Reset
		</button>
	</div>
</div>

</form>

