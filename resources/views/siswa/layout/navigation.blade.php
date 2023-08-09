<div class="sidebar-header">
	<div class="d-flex justify-content-between">
		<div class="logo">
			{{-- <a href="{{ route('dashboard') }}">{{ config('app.name') }}</a> --}}
			{{-- <a href="#" class="sidebar-brand">
				ADMIN<span></span>
			</a> --}}
			<a href="#" class="sidebar-brand">
				SD<span>IT Al Kamilah</span>
			</a>
		</div>
		<div class="toggler">
			<a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
		</div>
	</div>
</div>
<div class="sidebar-menu" style="background-color: #031C32;">
	<ul class="menu">
	</br>
		{{-- <li class="sidebar-title">Menu</li> --}}

		<li class="sidebar-item {{ request()->routeIs('siswa.*') ? 'active' : '' }}">
			<a href="{{ route('siswa.riwayat_pembayaran') }}" class='sidebar-link'>
				<i class="bi bi-people-fill"></i>
				<span style="color: white;">Riwayat Pembayaran</span>
			</a>
		</li>

		<li class="sidebar-item {{ request()->routeIs('siswa.*') ? 'active' : '' }}">
			<a href="{{ route('siswa.tagihan') }}" class='sidebar-link'>
				<i class="bi bi-people-fill"></i>
				<span style="color: white;">Tagihan</span>
			</a>
		</li>

		<li class="sidebar-item">
			<form method="POST" action="{{ route('logout') }}" id="logout">
				@csrf

				<a href="{{ route('logout') }}" class='sidebar-link'>
					<i class="bi bi-box-arrow-left"></i>
					<span style="color: white;">Logout</span>
				</a>
			</form>
		</li>

	</ul>
</div>
<button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
