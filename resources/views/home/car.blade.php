<section class="product_section">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>Cars</span>
            </h2>
        </div>
        <div class="row">
            @foreach ($cars as $car)
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box car_data">
                        <div class="option_container">
                            @if ($car["availability"] == 'Yes')
                                <div class="options">
                                    <input type="submit" value="Rent" class="btn btn-danger rent-btn">
                                    <input type="hidden" class="car_id" value="{{ $car["car_id"] }}">
                                </div>
                            @else
                                <div class="options">
                                    <input type="submit" value="Unavailable for renting" class="btn btn-secondary" disabled>
                                </div>
                            @endif
                        </div>
                        <div class="img-box">
                            <img src="{{ $car["image"] }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                               {{$car["brand"]}} {{ $car["model"] }}
                            </h5>
                            <h6>
                                ${{ $car["price_per_day"] }}/day
                            </h6>
                            <h6>
                                Availabity:
                                <span style="color: {{$car["availability"] == 'No' ? 'red' : ''}}">{{ $car["availability"] }}</span>
                            </h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
