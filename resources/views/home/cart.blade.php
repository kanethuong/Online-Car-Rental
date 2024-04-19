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
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
</head>

<div class="hero_area">
    @include('home.header');
</div>

<section class="bg-success">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-2 py-3">
                <h5><a href="/" class="text-dark">Home</a> › Cart</h5>
            </div>
        </div>
    </div>
</section>

@php use App\Models\Product; @endphp
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(isset($cart_data))
                @if(Cookie::get('shopping_cart'))
                @php $total="0" @endphp
                <div class="shopping-cart">
                    <div class="shopping-cart-table">
                        <div class="table-responsive">
                            <div class="col-md-12 text-right mb-3">
                                <a href="javascript:void(0)" class="clear_cart font-weight-bold">Clear Cart</a>
                            </div>
                            <table class="table table-bordered text-center" id="product-table">
                                <thead>
                                    <tr>
                                        <th class="cart-description">Image</th>
                                        <th class="cart-product-name">Product Name</th>
                                        <th class="cart-price">Price</th>
                                        <th class="cart-qty">Quantity</th>
                                        <th class="cart-total">Grandtotal</th>
                                        <th class="cart-romove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart_data as $data)
                                    @php $product = Product::find($data['item_id']) @endphp
                                    <tr class="cartpage">
                                        <td class="cart-image">
                                            <a class="entry-thumbnail" href="javascript:void(0)">
                                                <img src="{{ $product->image }}" width="70px" alt="">
                                            </a>
                                        </td>
                                        <td class="cart-product-name-info">
                                            <h4 class='cart-product-description'>
                                                <a href="javascript:void(0)">{{ $product->product_name }}</a>
                                            </h4>
                                        </td>
                                        <td class="cart-product-sub-total">
                                            <span class="cart-sub-total-price">{{ number_format($product->unit_price, 2) }}</span>
                                        </td>
                                        <td class="cart-product-quantity" width="130px">
                                            <input type="hidden" class="product_id" value="{{ $data['item_id'] }}">
                                            <input type="hidden" class="product_price" value="{{ $product->unit_price }}">
                                            <div class="input-group quantity">
                                                <div class="input-group-prepend decrement-btn changeQuantity" style="cursor: pointer">
                                                    <span class="input-group-text">-</span>
                                                </div>
                                                <input type="text" class="qty-input form-control" maxlength="2" max="10" value="{{ $data['item_quantity'] }}">
                                                <div class="input-group-append increment-btn changeQuantity" style="cursor: pointer">
                                                    <span class="input-group-text">+</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="cart-product-grand-total">
                                            <span class="cart-grand-total-price" id="{{ $data['item_id'] }}">{{ number_format($data['item_quantity'] * $product->unit_price, 2) }}</span>
                                        </td>
                                        <td style="font-size: 20px;">
                                            <button type="button" class="delete_cart_data">
                                                <li class="fa fa-trash-o"></li> Delete
                                            </button>
                                        </td>
                                        @php $total = $total + ($data["item_quantity"] * $product->unit_price) @endphp
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table><!-- /table -->
                        </div>
                    </div><!-- /.shopping-cart-table -->
                    <div class="row">
                        <div class="col-md-8 col-sm-12 estimate-ship-tax p-2">
                            <div>
                                <a href="/" class="btn btn-upper btn-secondary float-left">Continue Shopping</a>
                            </div>
                            <div>
                                <input type="submit" class="btn btn-upper btn-primary ml-3 save-cart-btn">Save Cart</input>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12 p-3">
                            <div class="cart-shopping-total">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="cart-subtotal-name">Subtotal</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="cart-subtotal-price">
                                            $
                                            <span class="cart-grand-price-viewajax">{{ number_format($total, 2) }}</span>
                                        </h6>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="cart-grand-name">Grand Total</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="cart-grand-price">
                                            $
                                            <span class="cart-grand-price-viewajax">{{ number_format($total, 2) }}</span>
                                        </h6>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="cart-checkout-btn text-center">
                                            @if (Auth::user())
                                            <a href="{{ url('checkout') }}" class="btn btn-success btn-block checkout-btn">PROCCED TO CHECKOUT</a>
                                            @else
                                            <a href="{{ url('login') }}" class="btn btn-success btn-block checkout-btn">PROCCED TO CHECKOUT</a>
                                            {{-- you add a pop modal for making a login --}}
                                            @endif
                                            <h6 class="mt-3">Checkout with Fabcart</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- /.shopping-cart -->
                @endif
                @else
                <div class="row">
                    <div class="col-md-12 mycard py-5 text-center">
                        <div class="mycards">
                            <h4>Your cart is currently empty.</h4>
                            <a href="{{ url('collections') }}" class="btn btn-upper btn-primary outer-left-xs mt-5">Continue Shopping</a>
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
