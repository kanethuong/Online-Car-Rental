<header class="header_section">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="/"><img width="250" src="/images/logo.png" alt="#" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @if (request()->is('cart') || request()->is('delivery') || request()->is('order-detail/*'))
                @else
                    <form action="{{ route('home') }}" method="GET" id="search-form"
                        class="form-inline d-flex align-items-center pt-3">
                        {{-- @csrf --}}
                        <input class="form-control flex-grow-1" type="text" placeholder="Search products"
                            aria-label="Search" id="search_text" name="search_text">
                        <button type="submit" class="input-group-text ml-2 mb-3 py-2" id="searchbtn">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                @endif

                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>

                    @if (isset($categories))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Category
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                                @foreach ($categories as $category)
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#"
                                            id="dropdownMenu-{{ $category->category_id }}" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ $category->category_name }}
                                        </a>
                                        <ul class="dropdown-menu"
                                            aria-labelledby="dropdownMenu-{{ $category->category_id }}">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ url('category/' . $category->category_id) }}">
                                                    All {{ $category->category_name }}
                                                </a>
                                            </li>
                                            @foreach ($catSubcatMap[$category->category_id] as $subCategory)
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ url('sub-category/' . $subCategory->sub_category_id) }}">
                                                        {{ $subCategory->sub_category_name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a href="{{ url('cart') }}" class="nav-link">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            Cart
                            <span class="basket-item-count">
                                <span class="badge badge-pill badge-danger"> 0 </span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
</header>
