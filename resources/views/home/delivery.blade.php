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

    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Order <span>Details</span>
            </h2>
        </div>

        {{-- Display validation errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Display success alert --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Display error alert --}}
        @if (session('error'))
            <script>
                alert('{{ session('error') }}');
                window.location.href = '/cart';
            </script>
        @endif

        <div class="row">
            <div class="col-md-7">
                {{-- Form to collect recipient information --}}
                <form action="{{ url('place-order') }}" method="POST">
                    @csrf {{-- CSRF token for security --}}

                    {{-- Recipient's Name --}}
                    <div class="form-group">
                        <label for="name">Name <span class="required">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required
                            placeholder="Name" value="{{ old('name') }}">
                    </div>

                    {{-- Recipient's Street Address --}}
                    <div class="form-group">
                        <label for="street">Street <span class="required">*</span></label>
                        <input type="text" class="form-control" id="street" name="street" required
                            placeholder="Street" value="{{ old('street') }}">
                    </div>

                    {{-- Recipient's City/Suburb --}}
                    <div class="form-group">
                        <label for="city">City/Suburb <span class="required">*</span></label>
                        <input type="text" class="form-control" id="city" name="city" required
                            placeholder="City/Suburb" value="{{ old('city') }}">
                    </div>

                    {{-- Recipient's Australian State/Territory --}}
                    <div class="form-group">
                        <label for="state">State/Territory <span class="required">*</span></label>
                        <select class="form-control" id="state" name="state" required>
                            <option value="" disabled selected>Select your state/territory</option>
                            <option value="NSW" {{ old('state') == 'NSW' ? 'selected' : '' }}>New South Wales (NSW)
                            </option>
                            <option value="VIC" {{ old('state') == 'VIC' ? 'selected' : '' }}>Victoria (VIC)</option>
                            <option value="QLD" {{ old('state') == 'QLD' ? 'selected' : '' }}>Queensland (QLD)
                            </option>
                            <option value="WA" {{ old('state') == 'WA' ? 'selected' : '' }}>Western Australia (WA)
                            </option>
                            <option value="SA" {{ old('state') == 'SA' ? 'selected' : '' }}>South Australia (SA)
                            </option>
                            <option value="TAS" {{ old('state') == 'TAS' ? 'selected' : '' }}>Tasmania (TAS)
                            </option>
                            <option value="ACT" {{ old('state') == 'ACT' ? 'selected' : '' }}>Australian Capital
                                Territory (ACT)</option>
                            <option value="NT" {{ old('state') == 'NT' ? 'selected' : '' }}>Northern Territory (NT)
                            </option>
                            <option value="Others" {{ old('state') == 'Others' ? 'selected' : '' }}>Others</option>
                        </select>
                    </div>

                    {{-- Recipient's Mobile Number --}}
                    <div class="form-group">
                        <label for="mobile">Mobile Number <span class="required">*</span></label>
                        <input type="tel" class="form-control" id="mobile" name="mobile" required
                            placeholder="Mobile Number" value="{{ old('mobile') }}">
                    </div>

                    {{-- Recipient's Email Address --}}
                    <div class="form-group">
                        <label for="email">Email Address <span class="required">*</span> </label>
                        <input type="email" class="form-control" id="email" name="email" required
                            placeholder="Email Address" value="{{ old('email') }}">
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <div class="col-md-5">
                @if (isset($cart_data) && Cart::count() > 0)
                    <table class="table text-center" id="product-table">
                        <thead>
                            <tr>
                                <th class="cart-product-name">Product Name</th>
                                <th class="cart-price">Price</th>
                                <th class="cart-qty">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart_data as $data)
                                <tr>
                                    <td>{{ $data['name'] }}</td>
                                    <td>${{ number_format($data['price'], 2) }}</td>
                                    <td>{{ $data['qty'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <div class="text-right">
                        <h5>Grand Total: ${{ Cart::subtotal() }}</h5>
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-12 mycard py-5 text-center">
                            <div class="mycards">
                                <h4>Your cart is currently empty.</h4>
                                <a href="/" class="btn btn-upper btn-primary outer-left-xs mt-5">Continue
                                    Shopping</a>
                            </div>
                        </div>
                    </div>
                @endif
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
