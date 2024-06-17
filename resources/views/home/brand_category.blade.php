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
    <title>KANE - Online Car Rental</title>
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
                    <span>{{ $cars[0]['brand'] }}</span>
                </h2>
            </div>
            <div class="row">
                @foreach ($cars as $car)
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="box car_data">
                            <div class="option_container">
                                @if ($car['availability'] == 'Yes')
                                    <div class="options">
                                        <input type="submit" value="Rent" class="btn btn-danger rent-btn">
                                        <input type="hidden" class="car_id" value="{{ $car['car_id'] }}">
                                    </div>
                                @else
                                    <div class="options">
                                        <input type="submit" value="Unavailable for renting" class="btn btn-secondary"
                                            disabled>
                                    </div>
                                @endif
                            </div>
                            <div class="img-box">
                                <img src="{{ $car['image'] }}" alt="">
                            </div>
                            <div class="detail-box">
                                <h5>
                                    {{ $car['brand'] }} {{ $car['model'] }}
                                </h5>
                                <h6>
                                    ${{ $car['price_per_day'] }}/day
                                </h6>
                                <h6>
                                    Availabity:
                                    <span
                                        style="color: {{ $car['availability'] == 'No' ? 'red' : '' }}">{{ $car['availability'] }}</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                @endforeach
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
    <script src="/home/js/reservation.js"></script>
    <script src="/home/js/search.js"></script>
    <script src="/home/js/header.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
</body>

</html>
