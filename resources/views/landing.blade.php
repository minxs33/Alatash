@extends("templates.app")

@section("title", "Altash - Rent Car")

@section("content")

<section id="home" class="mb-4 p-0">
    <div class="container-md content-container">
        <div class="owl-carousel carousel owl-theme shadow-sm reveal">
            @foreach($carousels as $row)
                <img src="{{asset('storage/images/carousels')}}/{{$row['image_url']}}" alt="{{$row['image_url']}}" class="object-fit-cover carousel-items">
            @endforeach
        </div>
    </div>
</section>

<section id="sell-out" class="reveal-section">
    <div class="container-md">
        <div class="d-flex justify-content-center align-items-center p-5 py-lg-3 gap-1 gap-lg-3">
            <div class="col-md-4 reveal-delay">
                <div class="row align-items-center g-1 g-lg-2 justify-content-center justify-content-lg-start">
                    <div class="col-lg-3 col-6">
                        <img class="rounded-circle sellout-img" style="width:100%" src="https://www.kurin.com/wp-content/uploads/placeholder-square.jpg" alt="">
                    </div>
                    <div class="col-lg-9 col-12">
                        <h5 class="fw-bold text-color text-responsive text-center text-lg-start">Pengalaman Wisata Yang Terbaik</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 reveal-delay">
                <div class="row align-items-center g-1 g-lg-2 justify-content-center justify-content-lg-start">
                    <div class="col-lg-3 col-6">
                        <img class="rounded-circle sellout-img" style="width:100%" src="https://www.kurin.com/wp-content/uploads/placeholder-square.jpg" alt="">
                    </div>
                    <div class="col-lg-9 col-12">
                        <h5 class="fw-bold text-color text-responsive text-center text-lg-start">Pengalaman Wisata Yang Terbaik</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 reveal-delay">
                <div class="row align-items-center g-1 g-lg-2 justify-content-center justify-content-lg-start">
                    <div class="col-lg-3 col-6">
                        <img class="rounded-circle sellout-img" style="width:100%" src="https://www.kurin.com/wp-content/uploads/placeholder-square.jpg" alt="">
                    </div>
                    <div class="col-lg-9 col-12">
                        <h5 class="fw-bold text-color text-responsive text-center text-lg-start">Pengalaman Wisata Yang Terbaik</h5>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<section id="sewa-mobil" class="reveal-section">
    <div class="container-md">
        <div class="d-flex flex-column gy-2">

        <!-- <div class="d-flex justify-content-between align-items-center gap-3 bg-white px-3 py-2 rounded-top shadow-sm">
            <label class="fw-semibold fs-5">All Cars</label>
            <div class="d-flex align-items-center gap-2">
                <label class="text-secondary">Filter</label>
                <select class="form-select rounded-pill category" aria-label="Default select example">
                        <option selected value="all">All</option>
                        @foreach($categories as $row)
                            <option value="{{$row['id']}}">{{ucfirst($row['name'])}}</option>
                        @endforeach
                    </select>
                </div>
            </div> -->
            <h3 class="fw-bold text-color text-center h3-responsive reveal-delay">Lorem ipsum, dolor sit amet consectetur adipisicing elit.</h3>
            <h5 class="fw-bold text-color-light text-center h5-responsive reveal-delay">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed vel veritatis a.</h5>
        </div>
    </div>
    <div class="shadow-md border-top border-bottom my-3 border-2">
        <div class="container-md">
            <div class="d-flex flex-wrap justify-content-center py-2 gap-2">
                <button class="btn btn-outline-info rounded-pill category active" data-id="all">Semua</button>
                @foreach($categories as $row)
                    <button class="btn btn-outline-info rounded-pill category" data-id="{{$row['id']}}">{{$row['name']}}</button>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container-md">
        <div class="cars">
            @include('templates/includes/car-card')
        </div>
    </div>  
</section>
    
</div>

<script>

    jQuery(function(){
        ScrollReveal().reveal(".reveal", {
            duration: 1000,
            origin: 'bottom',
            distance: '50px',
            // reset: true,
        });

        $(".reveal-delay").each(function (index, element) {
            ScrollReveal().reveal(element, {
                duration: 1000,
                origin: 'bottom',
                // reset: true,
                delay: 500 + index * 200,
                distance: '0px',
                opacity: 0,
            });
        });

        $(".reveal-section").each(function (index, element) {
            ScrollReveal().reveal(element, {
                duration: 500,
                origin: 'left',
                // reset: true,
                delay: 350 + index * 200,
                distance: '50px',
                opacity: 0,
            });
        });

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();

            $('#load .page-link').css('color', '#0A3622');

            $('#load').html(`
            <div class="d-flex align-items-center justify-content-center mb-2" style="height:200px;">
                <div class="spinner-border text-info" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>`);

            var url = $(this).attr('href');
            // alert(url);  
            getData(url);
        });

        $(document).on('click', '.category', function(e){
            e.preventDefault();
            
            $('.category').removeClass('active');
            $(this).addClass('active')

            $('#load .page-link').css('color', '#0A3622');

            $('#load').html(`
            <div class="d-flex align-items-center justify-content-center mb-2" style="height:200px;">
                <div class="spinner-border text-info" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>`);

            $.ajax({
                url: "{{url('/')}}",
                data: {category:$(this).data("id")},
                type: "GET",
                dataType: "html"
            }).done(function (data) {
                $('.cars').html(data);  
            }).fail(function () {
                $('.cars').html(`
                    <div class="alert alert-danger"> Mobil gagal memuat, <a href="#here" onclick="location.reload()">tekan ini<a> untuk muat ulang </div>
                `);  
            });
            })
    });

    function getData(url) {
        var category = $(".category").data("id");
        $.ajax({
            url : url,
            data: {category: category},
            type: "GET",
            dataType : "html"
        }).done(function (data) {
            $('.cars').html(data);  
        }).fail(function () {
            $('.cars').html(`
                <div class="alert alert-danger"> Mobil gagal memuat, <a href="#here" onclick="location.reload()">tekan ini<a> muat ulang </div>
            `);  
        });
    }
</script>
@endsection