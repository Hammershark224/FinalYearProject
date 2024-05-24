@php
	$role = Auth::user()->role;
@endphp

<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
	id="sidenav-main">
	<div class="sidenav-header">
		<i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
			aria-hidden="true" id="iconSidenav"></i>
		<a class="navbar-brand m-0" href="{{ route('home') }}" target="_blank">
			<img src="{{ asset('img/PCPRO favicon.png') }}" class="navbar-brand-img h-100" alt="main_logo">
			<span class="ms-1 font-weight-bold">PCPRO</span>
		</a>
	</div>
	<hr class="horizontal dark mt-0">
	<div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
		<ul class="navbar-nav">
			<!-- dashboard side nav -->
			<li class="nav-item">
				<a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
					<div
						class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
						<i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
					</div>
					<span class="nav-link-text ms-1">Dashboard</span>
				</a>
			</li>

			@if ($role == 'owner')
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
						aria-controls="collapseExample">
						<i class="fas fa-carrot -32 text-dark text-sm opacity-10"></i> Ingredient
					</a>
					<div class="collapse" id="collapseExample">
						<a class="nav-link {{ Route::currentRouteName() == 'ingredient.manage' ? 'active' : '' }}"
							href="{{ route('ingredient.manage') }}">
							<div
								class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
								<i class="fa-solid fa-wheat-awn-32 text-dark text-sm opacity-10"></i>
							</div>
							<span class="nav-link-text ms-1">Ingredient Compare</span>
						</a>

						<a class="nav-link {{ Route::currentRouteName() == 'ingredient' ? 'active' : '' }}"
							href="{{ route('ingredient') }}">
							<div
								class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
								<i class="ni ni-chart-bar-32 text-dark text-sm opacity-10"></i>
							</div>
							<span class="nav-link-text ms-1">Ingredient List</span>
						</a>
					</div>
				</li>



				<li class="nav-item">

				</li>

				<li class="nav-item">
					<a class="nav-link {{ Route::currentRouteName() == 'company.manage' ? 'active' : '' }}"
						href="{{ route('company.manage') }}">
						<div
							class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
							<i class="ni ni-chart-bar-32 text-dark text-sm opacity-10"></i>
						</div>
						<span class="nav-link-text ms-1">Supplier List</span>
					</a>
				</li>
				<li class="nav-item">

					<a class="nav-link {{ Route::currentRouteName() == 'dish.manage' ? 'active' : '' }}"
						href="{{ route('dish.manage') }}">
						<div
							class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
							<i class="ni ni-chart-bar-32 text-dark text-sm opacity-10"></i>
						</div>
						<span class="nav-link-text ms-1">Dish List</span>
					</a>
				</li>
				<li class="nav-item">

					<a class="nav-link {{ Route::currentRouteName() == 'menu.manage' ? 'active' : '' }}"
						href="{{ route('menu.manage') }}">
						<div
							class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
							<i class="ni ni-chart-bar-32 text-dark text-sm opacity-10"></i>
						</div>
						<span class="nav-link-text ms-1">Menu List</span>
					</a>
				</li>
				<li class="nav-item">

					<a class="nav-link {{ Route::currentRouteName() == 'menu' ? 'active' : '' }}" href="{{ route('menu') }}">
						<div
							class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
							<i class="ni ni-chart-bar-32 text-dark text-sm opacity-10"></i>
						</div>
						<span class="nav-link-text ms-1">Menu</span>
					</a>
				</li>
				<li class="nav-item">

					<a class="nav-link {{ Route::currentRouteName() == 'dish.manage' ? 'active' : '' }}"
						href="{{ route('dish.manage') }}">
						<div
							class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
							<i class="ni ni-chart-bar-32 text-dark text-sm opacity-10"></i>
						</div>
						<span class="nav-link-text ms-1">Report</span>
					</a>
				</li>
				<li class="nav-item">

					<a class="nav-link {{ Route::currentRouteName() == 'calculator.selection' ? 'active' : '' }}"
						href="{{ route('calculator.selection') }}">
						<div
							class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
							<i class="ni ni-chart-bar-32 text-dark text-sm opacity-10"></i>
						</div>
						<span class="nav-link-text ms-1">Margin Calculator</span>
					</a>
				</li>
			@endif
		</ul>
	</div>
</aside>
