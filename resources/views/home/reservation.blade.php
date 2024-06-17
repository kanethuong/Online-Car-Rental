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
        <!-- Display the error message -->
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if (Cookie::get('reservation') !== null)
            <h2 class="text-center font-weight-bold" style="color: #dd470b">RESERVATION DETAILS</h2>
            <div class="row">
                <div class="col">
                    <img src="{{ $reservation['image'] }}" class="img-fluid">
                </div>
                <div class="col">
                    <h4 class="mt-3 font-weight-bold">{{ $reservation['brand'] }}
                        {{ $reservation['model'] }}
                    </h4>
                    <p class="font-weight-bold text-muted">Type: {{ $reservation['type'] }}</p>
                    <div class="row">
                        <div class="col">
                            <p class="text-muted"><i class="fa-solid fa-gauge"></i> {{ $reservation['mileage'] }}</p>
                        </div>
                        <div class="col">
                            <p class="text-muted"><i class="fa-solid fa-gas-pump"></i>
                                {{ $reservation['fuel_type'] }} </p>
                        </div>
                        <div class="col">
                            <p class="text-muted"><i class="fa-solid fa-people-group"></i> {{ $reservation['seats'] }}
                                seats</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="text-muted">Availability: {{ $reservation['availability'] }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="text-muted">Description: {{ $reservation['description'] }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h5 class="font-weight-bold">Rental Cost: $<span
                                    id="rental_cost">{{ $reservation['price_per_day'] }}</span>
                            </h5>
                        </div>
                    </div>
                    <input type="hidden" id="price_per_day" value="{{ $reservation['price_per_day'] }}">
                </div>
            </div>

            <div class="row center p-4">
                <form id="validationForm" action="{{ route('place-order') }}" method="POST">
                    @csrf <!-- {{ csrf_field() }} -->
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" step="1" min="1" max="{{ $reservation['quantity'] }}"
                            class="form-control" id="quantity" name="quantity" value="1" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <span id="name_error" class="error-message">Name must be between 2 and 50 characters and contain
                            only letters.</span>
                    </div>

                    <div class="form-group">
                        <label for="phone">Mobile Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                        <span id="phone_error" class="error-message">Please enter a valid phone number.</span>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <span id="email_error" class="error-message">Please enter a valid email address.</span>
                    </div>

                    <div class="form-group">
                        <label for="driver_license">Do you have a valid driver license?</label>
                        <select class="form-control" id="driver_license" required>
                            <option selected disabled>Please choose one option...</option>
                            <option value="Y">Yes</option>
                            <option value="N">No</option>
                        </select>
                        <span id="driver_license_error" class="error-message">Please choose either "Yes" or
                            "No".</span>
                    </div>
                    <input type="hidden" id="price_per_day" name="price_per_day"
                        value="{{ $reservation['price_per_day'] }}">

                    <button type="submit" class="btn btn-primary mt-3">Place a rental order</button>
                    <a href="/cancel-order" class="btn btn-danger mt-3">Cancel</a>
                </form>
            </div>
        @else
            <div class="row">
                <div class="col-md-12 mycard py-5 text-center">
                    <div class="mycards">
                        <h4>Your reservation is currently empty. Rent a car to see it here!</h4>
                        <a href="/" class="btn btn-upper btn-primary outer-left-xs mt-5">Find A Car</a>
                    </div>
                </div>
            </div>
        @endif
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
