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
    <title>Famms - Fashion HTML Template</title>
    @include('css_link')
</head>

<body>
    <div class="hero_area">
        @include('home.header')
    </div>

    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Order <span>Details</span>
            </h2>
        </div>

        <div class="alert alert-success" role="alert">
            A confirmation email has been sent to your email address. Thank you for shopping with us!
        </div>

        <div class="row">
            <div class="col-md-7">
                @csrf {{-- CSRF token for security --}}

                {{-- Recipient's Name --}}
                <div class="form-group">
                    <label for="name">Name <span class="required">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" required placeholder="Name"
                        value="{{ $order->name }}" disabled>
                </div>

                {{-- Recipient's Street Address --}}
                <div class="form-group">
                    <label for="street">Street <span class="required">*</span></label>
                    <input type="text" class="form-control" id="street" name="street" required
                        placeholder="Street" value="{{ $order->street }}" disabled>
                </div>

                {{-- Recipient's City/Suburb --}}
                <div class="form-group">
                    <label for="city">City/Suburb <span class="required">*</span></label>
                    <input type="text" class="form-control" id="city" name="city" required
                        placeholder="City/Suburb" value="{{ $order->city }}" disabled>
                </div>

                {{-- Recipient's Australian State/Territory --}}
                <div class="form-group">
                    <label for="state">State/Territory <span class="required">*</span></label>
                    <input type="text" class="form-control" id="state" name="state" required
                        placeholder="State/Territory" value="{{ $order->state }}" disabled>
                </div>

                {{-- Recipient's Mobile Number --}}
                <div class="form-group">
                    <label for="mobile">Mobile Number <span class="required">*</span></label>
                    <input type="tel" class="form-control" id="mobile" name="mobile" required
                        placeholder="Mobile Number" value="{{ $order->mobile }}" disabled>
                </div>

                {{-- Recipient's Email Address --}}
                <div class="form-group">
                    <label for="email">Email Address <span class="required">*</span> </label>
                    <input type="email" class="form-control" id="email" name="email" required
                        placeholder="Email Address" value="{{ $order->email }}" disabled>
                </div>
            </div>

            <div class="col-md-5">
                <table class="table text-center" id="product-table">
                    <thead>
                        <tr>
                            <th class="cart-product-name">Product Name</th>
                            <th class="cart-price">Price</th>
                            <th class="cart-qty">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderItems as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
                <div class="text-right">
                    <h5>Grand Total: ${{ $order->total }}</h5>
                </div>
            </div>
        </div>
    </div>

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
