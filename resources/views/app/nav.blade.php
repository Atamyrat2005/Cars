<nav class="navbar navbar-expand-lg navbar-dark bg-black" aria-label="Navbar">
    <div class="container-xl">
        <a class="navbar-brand {{ request()->routeIs('home') ? 'link-primary':'' }}" href="{{ route('home') }}"><i class="bi-car-front-fill"></i> @lang('app.appName')</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cars.index') ? 'link-primary':'' }}" href="{{ route('cars.index') }}">
                        <i class="bi-search"></i> @lang('app.search')
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">@lang('app.brands')</a>
                    <ul class="dropdown-menu">
                        @foreach($brands as $brand)
                            <li>
                                <a class="dropdown-item" href="{{ route('cars.index', ['brands' => [$brand->id]]) }}">
                                    {{ $brand->name }}
                                    <span class="badge bg-primary-subtle border border-primary-subtle text-primary-emphasis rounded-pill">
                                        {{ $brand->cars_count }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">@lang('app.locations')</a>
                    <ul class="dropdown-menu">
                        @foreach($locations as $location)
                            <li>
                                <a class="dropdown-item" href="{{ route('cars.index', ['locations' => [$location->id]]) }}">
                                    {{ $location->getName() }}
                                    <span class="badge bg-primary-subtle border border-primary-subtle text-primary-emphasis rounded-pill">
                                        {{ $location->cars_count }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contacts.create') }}">
                        <i class="bi-envelope"></i> @lang('app.contact')
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('locale', 'tm') }}">Türkmen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('locale', 'en') }}">English</a>
                </li>
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi-person-circle"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end"><li>
                            <a class="dropdown-item" href="{{ route('contacts.index') }}">
                                <i class="bi-envelope"></i> @lang('app.messages')
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout').submit();">
                                <i class="bi-box-arrow-right"></i> @lang('app.logout')
                            </a>
                        </ul>
                        <form id="logout" action="{{ route('logout') }}" method="post" class="d-none">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link link-warning" href="{{ route('login') }}">
                            <i class="bi-box-arrow-in-right"></i> @lang('app.login')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-warning" href="{{ route('register') }}">
                            <i class="bi-person-add"></i> @lang('app.register')
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>