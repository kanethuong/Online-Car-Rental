<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/images/favicon.png" type="">
    <title>KANE - Online Grocery Store</title>
    @include('css_link')
</head>

<body>
    <div class="hero_area">
        @include('home.header')
    </div>

    <section class="product_section">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Products of <span>{{ $subCategoryName }}</span>
                </h2>
            </div>
            <div class="row">
                @foreach ($product as $products)
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="box product_data">
                            <div class="option_container">
                                <div class="options">
                                    <input type="submit" value="Add To Cart" class="btn btn-danger add-to-cart-btn">
                                    <input type="hidden" class="product_id" value="{{ $products->product_id }}">
                                </div>
                            </div>
                            <div class="img-box">
                                <img src="{{ $products->image }}" alt="">
                            </div>
                            <div class="detail-box">
                                <h5>
                                    {{ $products->product_name }}
                                </h5>
                                <h6>
                                    ${{ $products->unit_price }}/{{ $products->unit_quantity }}
                                </h6>
                                @if ($products->in_stock > 0)
                                    <h6>
                                        In stock: {{ $products->in_stock }}
                                    </h6>
                                @else
                                    <h6 style="color:red">
                                        Out of Stock
                                    </h6>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <span class="pt-2">
                    {!! $product->withQueryString()->links('pagination::bootstrap-5') !!}
                </span>
            </div>
        </div>
    </section>

    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->

    <!-- jQery -->
    <script src="/home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="/home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="/home/js/bootstrap.js"></script>
    <!-- custom js -->
    {{-- <script src="home/js/custom.js"></script> --}}
    <script src="/home/js/cart.js"></script>
    <script src="/home/js/header.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
</body>

</html>
