
<div id="load" class="mb-2" style="min-height: 400px;">
    <div class="row g-3 mb-2 justify-content-center">
        @foreach($car as $row)
            <a href="{{url('/cars/')}}/{{$row['id']}}" class="text-decoration-none col-xl-3 col-lg-4 col-md-5 col-6">
                <div class="shadow-sm card border-0 reveal-car-delay" style="height:25rem">
                
                @if($row['car_images']->count() != 0)
                        @foreach($row['car_images'] as $images)
                            @if($images['is_active'] == 1)
                                <img src="{{asset('storage/images/car-images')}}/{{$images['image_url']}}" class="card-img-top " alt="Product Photo" style="width:100%; height: 240px;">
                            @break
                            @endif
                        @endforeach
                    @else
                        <img src="{{asset('storage/images/car-images/default.png')}}" class="card-img-top " alt="Car Photo" style="width:100%; height: 240px;">
                    @endif
                    <div class="card-body p-2">
                        <small class="card-title fw-medium text-muted">{{substr($row['name'],0,40)}}</small>
                        <div class="d-flex flex-column mt-1">
                            <label class="fw-semibold">Rp{{$row['total_price']}}
                            </label>
                            @if($row['discount'] == 0)
                            @else
                            <div class="span d-flex gap-2">
                                <div class="badge badge-sm text-bg-danger">{{$row['discount']}}%</div>
                                <div class="small text-decoration-line-through">Rp{{$row['price']}}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    @if($car->hasPages())
    <div class="bg-white rounded-bottom px-3 pt-3 mb-4 shadow-sm">
        {{ $car->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

<script>
    jQuery(function(){
        $(".reveal-car-delay").each(function (index, element) {
            ScrollReveal().reveal(element, {
                duration: 300,
                origin: 'bottom',
                // reset: true,
                delay: 100 + index * 200,
                distance: '50px',
                easing: 'ease-in',
            });
        });
    })
</script>