
<?php 
use Illuminate\Support\Facades\DB;
$site_config = DB::table('konfigurasi')->first();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	  <title>{{ $title }}</title>
<!--===============================================================================================-->	
	<link rel="icon" href="{{ asset('assets/upload/image/'.$site_config->icon) }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/vendor/bootstrap/css/bootstrap.min.css') }} ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }} ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/vendor/animate/animate.css') }} ">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/vendor/css-hamburgers/hamburgers.min.css') }} ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/vendor/select2/select2.min.css') }} ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/css/util.css') }} ">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/css/main.css') }} ">
<!--===============================================================================================-->
  <!-- jQuery -->
  <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
  <!-- sweetalert -->
  <script src="{{ asset('assets/sweetalert/js/sweetalert.min.js') }}"></script>
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/sweetalert/css/sweetalert.css') }}">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{ asset('assets/upload/image/'.$site_config->logo) }}" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="{{ asset('login/check') }}" method="POST">
					{{ csrf_field() }}
					<span class="login100-form-title" style="padding-bottom: 0;" style="padding-top: 0;">
          <h1>{{ $site->singkatan }}</h1>
					</span>
					<center><h5>
          {{ $site->nama_singkat }}
					</h5>
					</center><br/>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="nip" placeholder="NIP">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Created by
						</span>
						<a class="txt2" href="{{ asset('/') }}">
							IT Puskesmas Kecamatan Kramat Jati
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	


	<script>
@if ($message = Session::get('sukses'))
// Notifikasi
swal ( "Berhasil" ,  "<?php echo $message ?>" ,  "success" )
@endif

@if ($message = Session::get('warning'))
// Notifikasi
swal ( "Oops.." ,  "<?php echo $message ?>" ,  "warning" )
@endif

// Popup Delete
$(document).on("click", ".delete-link", function(e){
  e.preventDefault();
  url = $(this).attr("href");
  swal({
    title:"Yakin akan menghapus data ini?",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: 'btn btn-danger',
    cancelButtonClass: 'btn btn-success',
    buttonsStyling: false,
    confirmButtonText: "Delete",
    cancelButtonText: "Cancel",
    closeOnConfirm: false,
    showLoaderOnConfirm: true,
  },
  function(isConfirm){
    if(isConfirm){
      $.ajax({
        url: url,
        success: function(resp){
          window.location.href = url;
        }
      });
    }
    return false;
  });
});
// Popup disable
$(document).on("click", ".disable-link", function(e){
  e.preventDefault();
  url = $(this).attr("href");
  swal({
    title:"Yakin akan menonaktifkan data ini?",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: 'btn btn-danger',
    cancelButtonClass: 'btn btn-success',
    buttonsStyling: false,
    confirmButtonText: "Non Aktifkan",
    cancelButtonText: "Cancel",
    closeOnConfirm: false,
    showLoaderOnConfirm: true,
  },
  function(isConfirm){
    if(isConfirm){
      $.ajax({
        url: url,
        success: function(resp){
          window.location.href = url;
        }
      });
    }
    return false;
  });
});

// Popup approval
$(document).on("click", ".approval-link", function(e){
  e.preventDefault();
  url = $(this).attr("href");
  swal({
    title:"Anda yakin ingin menyetujui data ini?",
    type: "info",
    showCancelButton: true,
    confirmButtonClass: 'btn btn-danger',
    cancelButtonClass: 'btn btn-success',
    buttonsStyling: false,
    confirmButtonText: "Ya, Setujui",
    cancelButtonText: "Cancel",
    closeOnConfirm: false,
    showLoaderOnConfirm: true,
  },
  function(isConfirm){
    if(isConfirm){
      $.ajax({
        url: url,
        success: function(resp){
          window.location.href = url;
        }
      });
    }
    return false;
  });
});
</script>

<!--===============================================================================================-->	
	<script src="{{ asset('assets/login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('assets/login/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('assets/login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('assets/login/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('asset/slogin/vendor/tilt/tilt.jquery.min.js') }}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('assets/login/js/main.js') }}"></script>

</body>
</html>