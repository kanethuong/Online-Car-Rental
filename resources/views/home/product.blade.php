<section class="product_section">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
        </div>
        <div class="row">
            @foreach ($product as $products)
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box product_data">
                        <div class="option_container">
                            @if ($products->in_stock > 0)
                                <div class="options">
                                    <input type="submit" value="Add To Cart" class="btn btn-danger add-to-cart-btn">
                                    <input type="hidden" class="product_id" value="{{ $products->product_id }}">
                                </div>
                            @else
                                <div class="options">
                                    <input type="submit" value="Out of Stock" class="btn btn-secondary add-to-cart-btn" disabled>
                                </div>
                            @endif
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
