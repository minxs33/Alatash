
<div id="load" style="min-height: 400px;">
    <div class="row g-4 justify-content-center">
        @foreach($car as $row)
            <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6 col-12">
                <div class="shadow-sm card border-0 reveal">
                
                @if($row['car_images']->count() != 0)
                        @foreach($row['car_images'] as $images)
                            @if($images['is_active'] == 1)
                                <img src="{{asset('storage/images/car-images')}}/{{$images['image_url']}}" class="card-img-top img-fluid car-image" alt="Product Photo">
                            @break
                            @endif
                        @endforeach
                    @else
                        <img src="{{asset('storage/images/car-images/default.png')}}" class="card-img-top img-fluid" alt="Car Photo">
                    @endif
                    <div class="card-body p-2 my-2">
                        <!-- <label class="fw-medium text-muted text-center">{{substr($row['name'],0,40)}}</label> -->

                        <div class="d-flex flex-column gap-3 text-center">
                            <label class="fw-semibold text-color">{{$row['name']}}</label>
                            <div class="d-flex flex-column gap-1">
                                <h5 class="fw-semibold h5-responsive mb-0">Rp. {{number_format($row['total_price'], 2, '.', ',');}}</h5>
                            @if($row['discount'] == 0)
                            </div>
                            @else
                                <div class="d-flex justify-content-center gap-1">
                                    <label class="badge badge-sm text-bg-danger">{{$row['discount']}}%</label>
                                    <label class="small text-decoration-line-through">Rp. {{number_format($row['price'], 2, '.', ',');}}</label>
                                </div>
                            </div>
                            @endif
                            <div class="text-start text-muted car-description">
                                {!!$row['description']!!}
                            </div>
                            <div class="d-flex flex-column">
                                @php
                                    $namaMobil = str_replace(' ', '%20', $row['name']);
                                @endphp
                                <a href="https://wa.me/?text=Permisi%20Altash,%20saya%20ingin%20bertanya%20mengenai%20penyewaan%20mobil%20{{$namaMobil}}" target="_blank" class="btn btn-primary-color rounded-pill">Sewa sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if($car->hasPages())
    <div class="px-3 pt-3">
        {{ $car->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>