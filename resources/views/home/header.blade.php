<header class="header_section">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="/"><img width="250" src="/images/logo.png" alt="#" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @if (!request()->is('reservation') && !request()->is('place-order'))
                    <div style="position: relative;">
                        <form action="{{ route('home') }}" method="GET" id="search-form"
                            class="form-inline d-flex align-items-center pt-3">
                            <div class="input-group">
                                <input class="form-control flex-grow-1" type="text" placeholder="Search cars"
                                    aria-label="Search" id="search_text" name="search_text">
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text" id="searchbtn">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="suggestions-dropdown mt-2" id="suggestions">
                            <ul id="suggestions-list"></ul>
                        </div>
                    </div>
                @endif

                <ul class="navbar-nav">
                    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                        <a class="nav-link" href="/">Home</a>
                    </li>

                    @if (!request()->is('reservation') && !request()->is('place-order'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Category
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenu-type"
                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Type
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu-type">
                                        <li>
                                            <a class="dropdown-item" href="{{ url('category/type/Sedan') }}">
                                                Sedan
                                            </a>

                                            <a class="dropdown-item" href="{{ url('category/type/Wagon') }}">
                                                Wagon
                                            </a>

                                            <a class="dropdown-item" href="{{ url('category/type/SUV') }}">
                                                SUV
                                            </a>
                                        </li>
                                    </ul>

                                    <a class="dropdown-item dropdown-toggle" href="#" id="dropdownMenu-brand"
                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Brand
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu-brand">
                                        <li>
                                            <a class="dropdown-item" href="{{ url('category/brand/Ford') }}">
                                                Ford
                                            </a>

                                            <a class="dropdown-item" href="{{ url('category/brand/Mazda') }}">
                                                Mazda
                                            </a>

                                            <a class="dropdown-item" href="{{ url('category/brand/BMW') }}">
                                                BMW
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endif

                    <li class="nav-item {{ Request::is('reservation') ? 'active' : '' }}">
                        <a href="{{ url('reservation') }}" class="nav-link">
                            Reservation
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
</header>
