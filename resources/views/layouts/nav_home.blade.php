<nav class="navbar navbar-home navbar-expand-md">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo-air-bnb.png') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon">
                <i class="fas fa-bars"></i>
            </span>
        </button>
        <div class="collapse navbar-collapse nav-bar-black" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
               
                @guest
                    @if (Route::has('register'))
                        <li class="nav-item ml-3">
                            <a class="nav-link" href="{{ route('register') }}">Registrati</a>
                        </li>
                    @endif
                    <li class="nav-item ml-3">
                        <a class="nav-link" href="{{ route('login') }}">Accedi</a>
                    </li>
                @else


                    @if (Auth::user()->HasRole('upra'))
                        <li class="nav-item">
                            <a class="nav-link upra ml-3" id="badge-new" href="{{ route('house.index') }}">

                                @if (session()->exists('badge_upra'))
                                @else
                                  <span class="badge upra badge-danger mb-5">New</span>
                                @endif


                                Area personale</a>
                        </li>
                    @endif

                        <li class="nav-item">
                            <a class="nav-link house ml-3" id="badge-new" href="{{ route('house.create') }}">

                                @if (session()->exists('badge_house'))
                                @else
                                <span class="badge house badge-danger">New</span>
                                @endif

                                Offri una casa</a>
                        </li>

                    <li class="nav-item ml-3 dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
