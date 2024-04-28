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
    <title>KANE - Online Grocery Store</title>
    @include('css_link')
</head>

<div class="hero_area">
    @include('home.header')
</div>

@php use App\Models\Product; @endphp
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (isset($cart_data) && Cart::count() > 0)
                    <div class="shopping-cart">
                        <div class="shopping-cart-table">
                            <div class="table-responsive">
                                <div class="col-md-12 text-right mb-3">
                                    <button class="clear_cart font-weight-bold btn btn-danger m-2">Clear Cart</button>
                                </div>
                                <table class="table table-bordered text-center" id="product-table">
                                    <thead>
                                        <tr>
                                            <th class="cart-description">Image</th>
                                            <th class="cart-product-name">Product Name</th>
                                            <th class="cart-price">Price</th>
                                            <th class="cart-qty">Quantity</th>
                                            <th class="cart-total">Subtotal</th>
                                            <th class="cart-romove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart_data as $data)
                                            <tr class="cartpage">
                                                <td class="cart-image">
                                                    <img src="{{ $data['options']['image'] }}" width="70px"
                                                        alt="">
                                                </td>
                                                <td class="cart-product-name-info">
                                                    <h4 class='cart-product-description'>
                                                        {{ $data['name'] }}
                                                    </h4>
                                                </td>
                                                <td class="cart-product-sub-total">
                                                    <span
                                                        class="cart-sub-total-price">${{ number_format($data['price'], 2) }}</span>
                                                </td>
                                                <td class="cart-product-quantity" width="130px">
                                                    <input type="hidden" class="row_id" value="{{ $data['rowId'] }}">
                                                    <input type="hidden" class="product_price"
                                                        value="{{ $data['price'] }}">
                                                    <div class="input-group quantity">
                                                        <div class="input-group-prepend decrement-btn changeQuantity"
                                                            style="cursor: pointer">
                                                            <span class="input-group-text">-</span>
                                                        </div>
                                                        <input type="text" readonly="readonly"
                                                            class="qty-input form-control m-0" maxlength="2"
                                                            max="{{ $data['qty'] }}" value="{{ $data['qty'] }}">
                                                        <div class="input-group-append increment-btn changeQuantity"
                                                            style="cursor: pointer">
                                                            <span class="input-group-text">+</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="cart-product-grand-total">
                                                    <span class="cart-grand-total-price"
                                                        id="{{ $data['rowId'] }}">${{ number_format($data['qty'] * $data['price'], 2) }}</span>
                                                </td>
                                                <td style="font-size: 20px;">
                                                    <button type="button" class="delete_cart_data btn btn-danger">
                                                        <li class="fa fa-trash-o"></li> Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table><!-- /table -->
                            </div>
                        </div><!-- /.shopping-cart-table -->
                        <div class="row">
                            <div class="col-md-8 col-sm-12 estimate-ship-tax p-2">
                                <div>
                                    <a href="/" class="btn btn-upper btn-warning">Continue Shopping</a>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12 p-3">
                                <div class="cart-shopping-total">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="cart-grand-name">Grand Total</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="cart-grand-price">
                                                $<span class="cart-grand-price-viewajax">{{ Cart::subtotal() }}</span>
                                            </h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="cart-checkout-btn text-center">
                                                <a href="{{ url('delivery') }}"
                                                    class="btn btn-success btn-block checkout-btn">PLACE AN ORDER</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- /.shopping-cart -->
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
        </div> <!-- /.row -->
    </div><!-- /.container -->
</section>

<!-- jQery -->
<script src="home/js/jquery-3.4.1.min.js"></script>
<!-- popper js -->
<script src="home/js/popper.min.js"></script>
<!-- bootstrap js -->
<script src="home/js/bootstrap.js"></script>
<!-- custom js -->
<script src="home/js/custom.js"></script>
<script src="home/js/cart.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
