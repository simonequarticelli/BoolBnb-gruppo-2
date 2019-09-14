  <nav class="navbar navbar-deatils-apartment navbar-expand-md navbar-light bg-white shadow-sm">

    <div class="container-fluid">
        <a class="navbar-brand " href="{{ url('/') }}">
            <img src="{{ asset('images/logo-ai-bnb-green.png') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav-bar-ligth" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Authentication Links -->
                @guest
                    <li class="nav-item ml-3">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item ml-3">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else

                    @if (Auth::user()->HasRole('upra'))
                      
                        <li class="nav-item">
                            <a class="nav-link upra ml-3 {{request()->route()->getName() == 'house.index' ? 'active' : ''}}" id="badge-new" href="{{ route('house.index') }}">

                                Area personale</a>
                        </li>
                      
                        <li class="nav-item">
                            <a class="nav-link upra ml-3 {{request()->route()->getName() == 'show_statistics' ? 'active' : ''}}" id="badge-new" href="{{ route('show_statistics', Auth::user()->id) }}">

                              @if (session()->exists('badge_statistics'))
                              @else
                              <span class="badge upra-statics badge-danger mb-5">New</span>
                              @endif
                              Statistiche</a>
                        </li>
                        <li class="nav-item">


                            <a class="nav-link upra ml-3 {{request()->route()->getName() == 'messages.index' ? 'active' : ''}}" id="badge-new" href="{{ route('messages.index')}}">

                              @if (session()->exists('badge_messages'))
                              @else
                              <span class="badge upra-messages badge-danger mb-5 ">New</span>
                              @endif

                              Messaggi</a>
                        </li>
                    @endif

                    <li class="nav-item dropdown ml-3">
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

<div class="py-2"></div>
