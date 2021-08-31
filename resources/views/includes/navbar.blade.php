<div class="bg-white shadow-sm ">
	<nav class="navbar navbar-expand-md border py-0 navbar-light">
		<div class="navbar-toggler pl-0 mynav-icon-container" data-toggle="collapse"
			data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
			aria-label="Toggle navigation">
			<i class="fa fa-bars"></i>
		</div>

		<a class="navbar-brand mr-auto font-weight-bold py-0" href="/">
			<img src="/uploads/logo.png" height="40" width="40" alt="yetecan">
			<span style="font-family: 'Montserrat', sans-serif;font-size:20px;">yetecan.com</span>
		</a>

		<div class="collapse navbar-collapse py-0">
			<ul class="navbar-nav ml-2 ml-lg-5 mynav-link">
				<!--<li class="nav-item pr-3">
					<a class="py-3 text-decoration-none a-grey" href="{ route('annonce.type.offre') }}">
						OFFRES
					</a>
				</li>-->
				<li class="nav-item pr-3">
					<a class="py-3 text-decoration-none a-grey" href="{{ route('aide') }}">
						Aides
					</a>
				</li>
				<li class="nav-item">
					<a class="py-3 text-decoration-none a-grey" href="{{ route('ads.search') }}">
						Toutes les annonces
					</a>
				</li>
			</ul>

			<div class="ml-auto">
				<div class="mydropdown-account mr-2 d-inline-block">
					<a class="mydropdown-btn d-block py-3" href="{{route('profile')}}">
						<img src="/uploads/profiles/@if(Auth::check()){{Auth::user()->avatar}}@else{{'user.png'}} @endif" class="rounded-circle" width="45" height="45" class="mr-2"
							alt="">
						<span class="text-dark">
							@if (Auth::check())
							{{Auth::user()->first_name}}
							@else
							Compte
							@endif
						</span>
					</a>

					<div class="mydropdown-content py-2 shadow-sm">
						<a class="d-block px-3 py-1 a-grey" href="{{ route('profile.annonce') }}">
							<i class="fa fa-pencil-square-o mr-2"></i> Mes annonces
						</a>
						<a class="d-block px-3 py-1 a-grey" href="{{ route('profile.favori') }}">
							<i class="fa fa-heart-o mr-2"></i> Mes favoris
						</a>
						<a class="d-block px-3 py-1 a-grey" href="{{ route('profile.recherche') }}">
							<i class="fa fa-bookmark-o mr-2"></i> Mes recherches
						</a>
						<a class="d-block px-3 py-1 a-grey" href="{{ route('profile.message') }}">
							<i class="fa fa-envelope-o mr-2"></i> Mes messages
						</a>

						@unless (Auth::check())
						<a class="d-block px-3 py-1 a-grey" href="{{ route('login') }}">
							<i class="fa fa-sign-in mr-2"></i> Se connecter / S'inscrire
						</a>
						@endunless

						@auth
						<a class="d-block px-3 py-1 a-grey" href="{{ route('logout') }}" onclick="event.preventDefault(); 
					        document.getElementById('logout-form').submit();">
							<i class="fa fa-sign-out mr-2"></i> Se déconnecter
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
						@endauth

					</div>
				</div>
				<a class="p-0 d-inline-block" href="{{ route('add.new.ad') }}">
					<button class="btn shadow-none text-white new-ad-link"><i class="fa fa-plus"></i> D&#233;poser une
						annonce</button>
				</a>
			</div>
		</div>
		<a class="my-3 p-0 d-md-none" href="{{ route('add.new.ad') }}">
			<button class="btn btn-sm shadow-none text-white new-ad-link"><i class="fa fa-plus"></i> D&#233;poser<span> une
					annonce</span></button>
		</a>
	</nav>

	<div class="collapse d-md-none mynavbar-md w-100" id="navbarSupportedContent">

		<nav class="navbar bg-white p-0 navbar-light w-75">
			<ul class="navbar-nav pb-3 w-100 border">
				<li class="nav-item mb-2 bg-light border-bottom">
					<a class="px-3 py-3 my-3 a-grey d-block" href="{{route('profile')}}">
						<img src="/uploads/profiles/@if(Auth::check()){{Auth::user()->avatar}}@else{{'user.png'}} @endif" class="rounded-circle" width="45" height="45" class="mr-2"
							alt="">
						<span class="text-dark">
							@if (Auth::check())
							{{Auth::user()->first_name}}
							@else
							Mon compte
							@endif
						</span>
					</a>
				</li>
				<li class="nav-item py-1">
					<a class="px-3 a-grey" href="{{ route('profile.annonce') }}">
						<i class="fa fa-pencil-square-o mr-3"></i> Mes annonces
					</a>
				</li>
				<li class="nav-item py-1">
					<a class="px-3 a-grey" href="{{ route('profile.favori') }}">
						<i class="fa fa-heart-o mr-3"></i> Mes favoris
					</a>
				</li>
				<li class="nav-item py-1">
					<a class="px-3 a-grey" href="{{ route('profile.recherche') }}">
						<i class="fa fa-bookmark-o mr-3"></i> Mes recherches
					</a>
				</li>

				<li class="nav-item py-1">
					<a class="px-3 a-grey" href="{{ route('profile.message') }}">
						<i class="fa fa-envelope-o mr-3"></i> Mes messages
					</a>
				</li>

				@unless (Auth::check())
				<li class="nav-item py-1">
					<a class="px-3 a-grey" href="{{ route('login') }}">
						<i class="fa fa-sign-in mr-3"></i> Se connecter / S'inscrire
					</a>
				</li>
				@endunless

				@auth
				<li class="nav-item py-1">
					<a class="px-3 a-grey" href="{{ route('logout') }}" onclick="event.preventDefault(); 
					    document.getElementById('logout-form').submit();">
						<i class="fa fa-sign-out mr-3"></i> Se déconnecter
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
				</li>
				@endauth

				<li>
					<hr />
				</li>
				<!--<li class="nav-item py-1">
					<a class="px-3 a-grey" href="{ route('annonce.type.offre') }}"><i
							class="fa fa-exchange mr-3"></i> Offres</a>
				</li>-->
				<li class="nav-item py-1">
					<a class="px-3 a-grey" href="{ route('aide') }}">
						<span class=" mr-3"></span> Aide
					</a>
				</li>
				<li class="nav-item py-1">
					<a class="px-3 a-grey" href="{{ route('ads.search') }}">
						<span class=" mr-3"></span> Toutes les annonces
					</a>
				</li>
			</ul>
		</nav>

	</div>

</div>