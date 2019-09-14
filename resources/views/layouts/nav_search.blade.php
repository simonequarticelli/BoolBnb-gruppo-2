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
          <ul class="navbar-nav">
            <li class="d-flex align-items-center">
              <div class="input-group w-100 ml-2 mr-2">
                <input class="form-control" id="address-input-search" type="search" placeholder="Search" aria-label="Search" value="{{ old('address') }}">
                <div class="input-group-append" id="button-addon4">
                  <button class="btn btn-danger" id="btn_filter_api" role="button" type="submit">Cerca</button>
                  <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Filtra
                  </button>
                </div>
              </div>
            </li>
            <li class="d-flex align-items-center">
            <li class="d-flex align-items-center">
            </li>
            <div class="collapse" id="collapseExample">
              <div class="card card-body collapse-filter">
                <form id="form">
                  <ul class="d-flex u-filter-ch" style="margin-left: 80px">
                    @foreach ( $features as $feature )
                    <li class="nav-item mr-3 list-unstyled">
                    {{-- checkbox per servizi aggiuntivi --}}
                      <label class="label-checkbox m-1">
                          <input class="features mr-1" type="checkbox" name="feature[]" value="{{ $feature->id }}"
                          {{ in_array($feature->id, old('feature', array() )) ? 'checked' : ''}}>
                          {{ $feature->name }}
                      </label>
                    </li>
                    @endforeach

                    {{--  input range per ricerca a raggio --}}
                    <li class="d-flex align-items-center">
                      <label class="label-checkbox m-1 d-inline">
                        Cerca nel raggio di:
                      </label>
                      <input type="range" name="weight" id="range_weight" value="20" min="20" max="100"
                      oninput="range_weight_disp.value = range_weight.value">
                      <output id="range_weight_disp">20</output>km
                    </li>
                  </ul>
                </form>
              </div>
            </div>
            </li>
            <li class="d-none">
              {{-- input nascosto indirizzo --}}
              <input style="line-height: normal;" id="search_filter_page" name="address_api" type="text">
            </li>
            <li class="d-none">
              {{-- input nascosto latitudine --}}
              <input style="line-height: normal;" id="lat" name="latitude" type="text">
            </li>
            <li class="d-none">
              {{-- input nascosto longitudine --}}
              <input style="line-height: normal;" id="lng" name="longitude" type="text">
            </li>
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
              <li>
              </li>
          </ul>
      </div>
  </div>
</nav>
