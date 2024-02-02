@extends("templates.app")

@section("title", "Alatash - Rent a Car in Bali")

@section("content")

<section id="home" class="mb-1 mb-md-4 p-0">
    <div class="container-md">
        <div class="owl-carousel carousel owl-theme shadow-sm reveal">
            @foreach($carousels as $row)
                <img src="{{asset('storage/images/carousels')}}/{{$row['image_url']}}" alt="{{$row['image_url']}}" class="object-fit-cover carousel-items">
            @endforeach
        </div>
    </div>
</section>

<section id="sell-out" class="reveal-section">
    <div class="container-md">
        <div class="d-flex justify-content-center align-items-center p-1 p-md-3 gap-3">
            <div class="col-md-4 reveal-delay">
                <div class="row align-items-center g-1 g-lg-2 justify-content-center justify-content-lg-start">
                    <div class="col-lg-3 col-7 col-sm-9 col-md-5 col-lg-3">
                        <img class="sellout-img" style="width:100%" src="{{asset('images/icon/cars.png')}}" alt="">
                    </div>
                    <div class="col-lg-9 col-12">
                        <h5 class="fw-bold text-muted text-responsive text-center text-lg-start">Rental Mobil Terlengkap di Bali</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 reveal-delay">
                <div class="row align-items-center g-1 g-lg-2 justify-content-center justify-content-lg-start">
                    <div class="col-lg-3 col-7 col-sm-9 col-md-5 col-lg-3">
                        <img class="sellout-img" style="width:100%" src="{{asset('images/icon/pelayanan1.png')}}" alt="">
                    </div>
                    <div class="col-lg-9 col-12">
                        <h5 class="fw-bold text-muted text-responsive text-center text-lg-start">Layanan dan Respon Cepat</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 reveal-delay">
                <div class="row align-items-center g-1 g-lg-2 justify-content-center justify-content-lg-start">
                    <div class="col-lg-3 col-7 col-sm-9 col-md-5 col-lg-3">
                        <img class="sellout-img" style="width:100%" src="{{asset('images/icon/pengalaman-wisata.png')}}" alt="">
                    </div>
                    <div class="col-lg-9 col-12">
                        <h5 class="fw-bold text-muted text-responsive text-center text-lg-start">Pengalaman Wisata Yang Terbaik</h5>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<section id="sewa-mobil" class="reveal-section">
    <div class="container-md">
        <div class="d-flex flex-column gy-2">
            <h3 class="fw-bold text-color text-center h3-responsive reveal-delay">KENDARAAN PALING BARU! PERIKSA TARIF SEWA DAN KENDARAAN DI BALI INCLUDE DENGAN DRIVER.</h3>
            <h5 class="fw-bold text-color-light text-center h5-responsive reveal-delay">Pastikan Liburan Anda Nyaman dengan Layanan Kami</h5>
        </div>
    </div>
    <div class="shadow-md border-top border-bottom my-3 border-2">
        <div class="container-md">
            <div class="d-flex flex-wrap justify-content-center py-2 gap-2">
                <button class="btn btn-outline-primary-color-alt rounded-pill category text-responsive active" data-id="all">Semua</button>
                @foreach($categories as $row)
                    <button class="btn btn-outline-primary-color-alt rounded-pill category text-responsive" data-id="{{$row['id']}}">{{$row['name']}}</button>
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

<section id="destinasi-wisata" class="section-reveal bg bg-size-cover bg-size-md-auto position-relative parallax-wrapper">
    <div class="overlay-destinasi-wisata position-absolute top-0 start-0 end-0 bottom-0 h-100 w-100"></div>
    <img src="{{ asset('images/wisata-background.jpg') }}" style="z-index:-100;" alt="" class="img-fluid object-fit-cover position-absolute top-0 start-0 end-0 bottom-0 h-100 w-100 parallax">
    <div class="container">
        <div class="d-flex flex-column gy-2">
            <h3 class="fw-bold text-muted text-center h3-responsive reveal">Destinasi Wisata Kece di Bali</h3>
            <h5 class="fw-bold text-color text-center h5-responsive reveal">Nikmati Liburanmu Dengan Pesona Keindahan Bali</h5>
            <div class="owl-carousel destinasi-carousel owl-theme my-3 reveal">
                <div class="d-flex flex-column gap-2 destinasi-item position-relative">
                    <div class="position-absolute start-0 end-0 pt-1 mx-2 my-1 rounded-pill bg-dark">
                        <h5 class="fw-medium text-white text-responsive text-center"><i class="fas fa-location-dot text-danger"></i> Pura Uluwatu</h5>
                    </div>
                    <img src="{{ asset('images/destinasi/pura-uluwatu.png')}}" alt="" class="object-fit-cover">
                    <div class="destination-caption text-center">
                        <h5 class="fw-medium text-color-alt text-responsive">Pura laut Bali di Bukit, terkenal dengan lokasi tebing indah dan pertunjukan tari Kecak saat matahari terbenam.</h5>
                    </div>
                </div>
                
                <div class="d-flex flex-column gap-2 destinasi-item position-relative">
                    <div class="position-absolute start-0 end-0 pt-1 mx-2 my-1 rounded-pill bg-dark">
                        <h5 class="fw-medium text-white text-responsive text-center"><i class="fas fa-location-dot text-danger"></i> GWK</h5>
                    </div>
                    <img src="{{ asset('images/destinasi/gwk.png')}}" alt="" class="object-fit-cover">
                    <div class="destination-caption text-center">
                        <h5 class="fw-medium text-color-alt text-responsive">GWK Bali menawarkan pengalaman wisata spektakuler dengan patung Wisnu, pertunjukan seni ini membuatnya destinasi yang sangat menarik.</h5>
                    </div>
                </div>

                <div class="d-flex flex-column gap-2 destinasi-item position-relative">
                    <div class="position-absolute start-0 end-0 pt-1 mx-2 my-1 rounded-pill bg-dark">
                        <h5 class="fw-medium text-white text-responsive text-center"><i class="fas fa-location-dot text-danger"></i> Hutan Monyet</h5>
                    </div>
                    <img src="{{ asset('images/destinasi/monyet.png')}}" alt="" class="object-fit-cover">
                    <div class="destination-caption text-center">
                        <h5 class="fw-medium text-color-alt text-responsive">Monkey Forest Ubud terkenal dengan monyet, kuil kuno, dan suasana alam eksotisnya.</h5>
                    </div>
                </div>

                <div class="d-flex flex-column gap-2 destinasi-item position-relative">
                    <div class="position-absolute start-0 end-0 pt-1 mx-2 my-1 rounded-pill bg-dark">
                        <h5 class="fw-medium text-white text-responsive text-center"><i class="fas fa-location-dot text-danger"></i> Terasering Tegalang</h5>
                    </div>
                    <img src="{{ asset('images/destinasi/terasering.png')}}" alt="" class="object-fit-cover">
                    <div class="destination-caption text-center">
                        <h5 class="fw-medium text-color-alt text-responsive">Terasering Tegalalang di Bali adalah pemandangan sawah yang indah dengan bentuk teras berundak, menciptakan panorama alam yang memukau.</h5>
                    </div>
                </div>

                <div class="d-flex flex-column gap-2 destinasi-item position-relative">
                    <div class="position-absolute start-0 end-0 pt-1 mx-2 my-1 rounded-pill bg-dark">
                        <h5 class="fw-medium text-white text-responsive text-center"><i class="fas fa-location-dot text-danger"></i> Tanah Lot</h5>
                    </div>
                    <img src="{{ asset('images/destinasi/tanah-lot.png')}}" alt="" class="object-fit-cover">
                    <div class="destination-caption text-center">
                        <h5 class="fw-medium text-color-alt text-responsive">Tanah Lot, sebuah pura laut di Bali, menawarkan pemandangan spektakuler dengan kuil di atas batu karang dan matahari terbenam yang memukau.</h5>
                    </div>
                </div>

                <div class="d-flex flex-column gap-2 destinasi-item position-relative">
                    <div class="position-absolute start-0 end-0 pt-1 mx-2 my-1 rounded-pill bg-dark">
                        <h5 class="fw-medium text-white text-responsive text-center"><i class="fas fa-location-dot text-danger"></i> Pantai Pandawa</h5>
                    </div>
                    <img src="{{ asset('images/destinasi/pantai-pandawa.png')}}" alt="" class="object-fit-cover">
                    <div class="destination-caption text-center">
                        <h5 class="fw-medium text-color-alt text-responsive">Pantai Pandawa di Bali menawarkan pasir putih bersih, air laut biru jernih, dan tebing-tebing kapur yang indah, menciptakan destinasi pantai yang menawan.</h5>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section id="mengapa-harus-kami">
    <div class="container">
        <div class="d-flex flex-column gy-3 justify-content-center">
            <h3 class="fw-bold text-color text-center h3-responsive reveal mb-4 mb-lg-5">Mengapa harus Alatash Travel & Tour?</h3>
            <!-- <div class="hr reveal text-responsive mb-4 mb-lg-5"></div> -->
            <div class="row gy-5">
                <div class="col-md-3 col-6">
                    <div class="d-flex flex-column justify-content-center align-items-center reveal">
                        <img src="{{asset('images/icon/driver.png')}}" alt="" class="object-fit-cover rounded-circle mb-2 mengapa-img" style="width:100px;">
                        <h5 class="fw-bold text-color text-center h5-responsive">Driver Profesional</h5>
                        <label class="fw-medium text-center text-responsive">Pengemudi berpengalaman, akan selalu bersikap ramah sebagai bukti layanan profesional yang diberikan</label>

                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="d-flex flex-column justify-content-center align-items-center reveal">
                        <img src="{{asset('images/icon/pelayanan.png')}}" alt="" class="object-fit-cover rounded-circle mb-2 mengapa-img" style="width:100px;">
                        <h5 class="fw-bold text-color text-center h5-responsive">Pelayanan Sopan & Ramah</h5>
                        <label class="fw-medium text-center text-responsive">Pelayanan bersahabat kami memberikan kenyamanan sepanjang proses pemesanan hingga perjalanan Anda.</label>

                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="d-flex flex-column justify-content-center align-items-center reveal">
                        <img src="{{asset('images/icon/bersih.png')}}" alt="" class="object-fit-cover rounded-circle mb-2 mengapa-img" style="width:100px;">
                        <h5 class="fw-bold text-color text-center h5-responsive">Mobil Bersih & Nyaman</h5>
                        <label class="fw-medium text-center text-responsive">Perawatan mobil secara rutin untuk menjaga mesin dalam keadaan baik dan AC tetap dingin, sehingga kenyamanan perjalanan terjaga.</label>

                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="d-flex flex-column justify-content-center align-items-center reveal">
                        <img src="{{asset('images/icon/harga.png')}}" alt="" class="object-fit-cover rounded-circle mb-2 mengapa-img" style="width:100px;">
                        <h5 class="fw-bold text-color text-center h5-responsive">Harga Bersahabat</h5>
                        <label class="fw-medium text-center text-responsive">Harga sewa mobil di Bali yang kami tawarkan sangat kompetitif, memberikan nilai terbaik dengan kualitas pelayanan yang tinggi.</label>

                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="d-flex flex-column justify-content-center align-items-center reveal">
                        <img src="{{asset('images/icon/time.png')}}" alt="" class="object-fit-cover rounded-circle mb-2 mengapa-img" style="width:100px;">
                        <h5 class="fw-bold text-color text-center h5-responsive">On Time</h5>
                        <label class="fw-medium text-center text-responsive">Kebiasaan kami adalah menjemput tamu dengan tepat waktu, yaitu 30 menit sebelum tamu seharusnya tiba di lokasi penjemputan.</label>

                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="d-flex flex-column justify-content-center align-items-center reveal">
                        <img src="{{asset('images/icon/lengkap.png')}}" alt="" class="object-fit-cover rounded-circle mb-2 mengapa-img" style="width:100px;">
                        <h5 class="fw-bold text-color text-center h5-responsive">Unit Armada Lengkap</h5>
                        <label class="fw-medium text-center text-responsive">Kami menyediakan berbagai unit armada sehingga Anda dapat memilih kendaraan sesuai dengan kebutuhan Anda.</label>

                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="d-flex flex-column justify-content-center align-items-center reveal">
                        <img src="{{asset('images/icon/berpengalaman.png')}}" alt="" class="object-fit-cover rounded-circle mb-2 mengapa-img" style="width:100px;">
                        <h5 class="fw-bold text-color text-center h5-responsive">Driver Berpengalaman</h5>
                        <label class="fw-medium text-center text-responsive">Pengemudi berpengalaman, akan selalu bersikap ramah sebagai bukti layanan profesional yang diberikan.</label>

                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="d-flex flex-column justify-content-center align-items-center reveal">
                        <img src="{{asset('images/icon/tour.png')}}" alt="" class="object-fit-cover rounded-circle mb-2 mengapa-img" style="width:100px;">
                        <h5 class="fw-bold text-color text-center h5-responsive">Program Tour</h5>
                        <label class="fw-medium text-center text-responsive">Driver profesional kami terampil dalam mengatur jadwal dan rencana perjalanan sesuai dengan keinginan tamu untuk memaksimalkan efisiensi selama perjalanan.</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="syarat-dan-ketentuan" class="section-reveal bg bg-size-cover bg-size-md-auto position-relative parallax-wrapper">
    <div class="overlay-syarat-dan-ketentuan position-absolute top-0 start-0 end-0 bottom-0 h-100 w-100"></div>
    <img src="{{ asset('images/syarat-dan-ketentuan-background.jpg') }}" alt="" class="img-fluid object-fit-cover position-absolute top-0 start-0 end-0 bottom-0 h-100 w-100 parallax">
    <div class="d-flex justify-content-center align-items-center">
        <div class="syarat-dan-ketentuan-card d-flex flex-column gap-3 col-lg-6 col-sm-8 rounded shadow-sm reveal px-3 py-2 p-md-4 border-0">
            <div class="d-flex justify-content-between gap-2 align-items-center reveal">
                <div class="hr-syarat-dan-ketentuan"></div>
                <h3 class="fw-bold text-color h3-responsive text-nowrap mb-0">Syarat & Ketentuan</h3>
                <div class="hr-syarat-dan-ketentuan"></div>
            </div>
            <div class="reveal">
                <h4 class="fw-semibold text-muted h4-responsive">Termasuk</h4>
                <ul class="fw-medium fa-ul">
                    <li class="text-responsive"><span class="fa-li"><i class="fas fa-circle-check fa-xs text-color"></i></span><label class="text-muted">Harga Supir & BBM</label></li>
                </ul>
                <h4 class="fw-semibold text-muted h4-responsive">Tidak termasuk</h4>
                <ul class="fw-medium fa-ul">
                    <li class="text-responsive"><span class="fa-li"><i class="fas fa-circle-check fa-xs text-color"></i></span><label class="text-muted">Harga Belum Termasuk Tips Supir</label></li>
                    <li class="text-responsive"><span class="fa-li"><i class="fas fa-circle-check fa-xs text-color"></i></span><label class="text-muted">Harga Tidak Untuk Perjalanan Keluar Kota</label></li>
                    <li class="text-responsive"><span class="fa-li"><i class="fas fa-circle-check fa-xs text-color"></i></span><label class="text-muted">Harga Belum Termasuk Parkir, Tol dan Tiket Masuk Destinasi Wisata</label></li>
                </ul>
                <h4 class="fw-semibold text-muted h4-responsive">Ketentuan</h4>
                <ul class="fw-medium fa-ul">
                    <li class="text-responsive"><span class="fa-li"><i class="fas fa-circle-check fa-xs text-color"></i></span><label class="text-muted">Akan Dikenakan Biaya Overtime 10% Perjamnya Dari Harga Sewa Mobil</label></li>
                    <li class="text-responsive"><span class="fa-li"><i class="fas fa-circle-check fa-xs text-color"></i></span><label class="text-muted">Harga Sewa Mobil Tidak Berlaku Pada Periode HIGH SEASON atau PEAK SEASON</label></li>
                    <li class="text-responsive"><span class="fa-li"><i class="fas fa-circle-check fa-xs text-color"></i></span><label class="text-muted">Segala Bentuk Perubahan Ketentuan & Harga Akan Mengacu Pada Pemberitahuan Dari Team Alttash Travel & Tour</label></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="footer">
    <br><br><br><br><br><br><br><br><br><br><br>
</section>

<script>

    new simpleParallax(document.getElementsByClassName('parallax'), {
        scale: 1.5,
        delay: .6,
        customWrapper: '.parallax-wrapper',
        orientation: 'up'
    });
    jQuery(function(){


        ScrollReveal().reveal(".reveal", {
            duration: 1000,
            delay: 250,
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

            $('html, body').animate({
                scrollTop: $('#sewa-mobil').offset().top
            });

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