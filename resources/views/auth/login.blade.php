@extends('layouts.auth.main')

@section('content')
<div class="row justify-content-center h-100 align-items-center ">
	<div class="col-md-6">
			<div class="text-center row no-gutters bg-guttters rounded shadow mx-auto">
				<div class="col-xl-12">
					<div class="auth-form">
						<h4 class="text-center mb-4 mt-3">SISTEM INFORMASI KEUANGAN</h4>
						<div class="text-center mb-3">
							<img src="{{ URL::to('images/logo-sd.png') }}" alt="">
						</div>
						</br>
						<form action="{{ route('login') }}" method="POST">
							@csrf
							@error('email')
							<div class="alert alert-danger alert-dismissible fade show text-sm" role="alert">
								<strong>Gagal!</strong> {{ $message }}.
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
							@enderror
							<div class="form-group position-relative has-icon-left mb-3 ml-9 mr-9">
								<input type="email" class="form-control form-control-l  @error('email') is-invalid @enderror" name="email"
									id="email" placeholder="Email" value="admin@mail.com" required>
								<div class="form-control-icon">
									<i class="bi bi-person"></i>
								</div>
							</div>
							<div class="form-group position-relative has-icon-left mb-3">
								<input type="password" class="form-control form-control-l @error('password') is-invalid @enderror"
									name="password" id="password" placeholder="Password" value="secret" required>
								<div class="form-control-icon">
									<i class="bi bi-shield-lock"></i>
								</div>
							</div>
							<div class="form-check form-check-lg d-flex align-items-end mb-3">
								<input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
								<label class="form-check-label text-gray-600" for="flexCheckDefault">
									Keep me logged in
								</label>
							</div>
							<button class="btn btn-primary btn-block mb-10 mt-12 bg-log">Log in</button>
						</form>
					</div>
				</div>
		</div>
	</div>
</div>
@endsection

@push('js')
<script>
	$(function() {
		$('form').submit(function() {
			let URL = "{{ route('api.login') }}";
			let email = $('#email').val();
			let password = $('#password').val();

			$.ajax({
				url: URL,
				type: 'post',
				data: {
					'email': email,
					'password': password
				},
				success: function (res) {
					localStorage.setItem('token', res.data);
				}
			});
		});
	});
</script>
@endpush
