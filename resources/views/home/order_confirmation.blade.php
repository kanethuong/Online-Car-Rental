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
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>KANE - Online Car Rental</title>
    @include('css_link')
</head>

<div class="hero_area">
    @include('home.header')
</div>

<?php use Illuminate\Http\Request; ?>
<section class="section">
    <div class="form-container">
        <!-- Display the success message -->
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="text-center font-weight-bold" style="color: #dd470b">ORDER CONFIRMATION</h2>

        <div class="row center p-4">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ $order['user_email'] }}" disabled>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date"
                        value="{{ $order['rent_start_date'] }}" disabled>
                </div>

                <div class="form-group col-md-6">
                    <label for="end_date">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date"
                        value="{{ $order['rent_end_date'] }}" disabled>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <h5 class="font-weight-bold">Rental Cost: $<span id="rental_cost">{{ $order['price'] }}</span>
                    </h5>
                </div>
            </div>

            <a class="btn btn-primary mt-3"
                href="{{ route('order-confirmation', ['id' => $car_id, 'email' => $order['user_email']]) }}">Confirm
                Order</a>
        </div>
    </div><!-- /.container -->
</section>

<!-- jQery -->
<script src="home/js/jquery-3.4.1.min.js"></script>
<!-- popper js -->
<script src="home/js/popper.min.js"></script>
<!-- bootstrap js -->
<script src="home/js/bootstrap.js"></script>
<script src="/home/js/reservation.js"></script>
<script src="/home/js/search.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
