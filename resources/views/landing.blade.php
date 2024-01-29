@extends("templates.app")

@section("title", "Altash - Rent Car")

@section("content")

<div class="container-md mt-4">
    <div class="owl-carousel carousel owl-theme mb-5 shadow-sm">
        @foreach($carousels as $row)
            <img src="{{asset('storage/images/carousels')}}/{{$row['image_url']}}" alt="{{$row['image_url']}}" class="object-fit-cover carousel-items">
        @endforeach
    </div>

    <section class="mb-4">
        <div class="d-flex flex-column gap-2">
            <div class="d-flex justify-content-between align-items-center gap-3 bg-white px-3 py-2 rounded-top shadow-sm">
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
            </div>
            <div class="cars">
                @include('templates/includes/car-card')
            </div>
        </div>
    </section>
    
</div>

<script>

    jQuery(function(){
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();

            $('#load .page-link').css('color', '#0A3622');

            $('#load').html(`
            <div class="d-flex align-items-center justify-content-center mb-2" style="height:200px;">
                <div class="spinner-border text-success" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>`);

            var url = $(this).attr('href');
            // alert(url);  
            getData(url);
        });

        $(document).on('change', '.category', function(e){
            e.preventDefault();

            $('#load .page-link').css('color', '#0A3622');

            $('#load').html(`
            <div class="d-flex align-items-center justify-content-center mb-2" style="height:200px;">
                <div class="spinner-border text-success" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>`);

            $.ajax({
                url: "{{url('/')}}",
                data: {category:$(this).val()},
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
        var category = $(".category").val();
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