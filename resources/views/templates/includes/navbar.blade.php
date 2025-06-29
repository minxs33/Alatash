<!-- Navbar -->

<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top shadow-sm" id="navbar">
  <div class="container">
    <div class="row col-12 my-1">
        <div class="col-lg-2 d-lg-flex d-flex justify-content-lg-center justify-content-between mt-2 mt-lg-0 align-items-center col-sm-12 justify-content-sm-between">
            <a class="navbar-brand logo-title text-success-emphasis d-flex align-items-center gap-1" href="{{ url('/') }}"><img src="{{ asset('images/logo_alatash_new.png') }}" alt="ALatash Logo" style="max-width: 100px; height:auto;"></a>
            <i class="fas fa-bars d-lg-none text-color" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            </i>
        </div>
        <div class="col-lg-8 d-flex align-items-center justify-content-center">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-lg-0">
                    <li class="d-block d-md-block d-lg-none d-xl-none">
                        <hr class="text-color my-1">
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link link-anchor text-responsive text-nowrap" href="#sewa-mobil">Sewa Mobil</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link link-anchor text-responsive text-nowrap" href="#destinasi-wisata">Destinasi Wisata</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link link-anchor text-responsive text-nowrap" href="#syarat-dan-ketentuan">Syarat dan Ketentuan</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link link-anchor text-responsive text-nowrap" href="#kontak-kami">Kontak Kami</a>
                    </li>
                    <li class="d-block d-md-block d-lg-none d-xl-none">
                        <hr class="text-color my-1">
                    </li>
                    @if(Auth::check())
                    <li class="d-block d-md-block d-lg-none d-xl-none">
                        <a class="nav-link link-anchor text-responsive" href="{{ url('admin/dashboard') }}">Dashboard</a>
                    </li>
                    <li class="d-block d-md-block d-lg-none d-xl-none">
                        <form action="{{ url('logout') }}" method="post">
                            @csrf
                            <button class="nav-link link-anchor text-responsive" type="submit">Logout</button>
                        </form>
                    @else
                    <li class="d-block d-md-block d-lg-none d-xl-none">
                        <div class="d-flex gap-2 justify-content-center">
                            <label class="text-color text-responsive">Perlu bantuan? hubungi kami</label>
                            <a class="link-anchor text-responsive" href="tel:081339439431" target="_blank"><i class="fas fa-phone"></i></a>
                            <a class="link-anchor text-responsive" href="https://wa.me/+6281339439431?text=Permisi%20Alatash,%20saya%20butuh%20bantuan%20menyewa%20mobil" target="_blank"><i class="fab fa-square-whatsapp fa-lg"></i></a>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="col-lg-2 py-3 d-lg-flex justify-content-end align-items-center d-none">
            <div class="d-flex justify-content-center align-items-center gap-2">

                @if(Auth::check())
                <div class="dropdown dropdown-user">
                    <a class="dropdown d-flex align-items-center hidden-arrow text-black text-decoration-none" href="#" role="button">
                        <img class="img rounded-circle object-fit-cover" style="width:25px; height:25px;" src="{{asset('storage/images/avatar')}}/{{Auth::user()->avatar}}">
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ url('admin/dashboard') }}">Dashboard</a>
                        </li>
                        <li>
                            <form action="{{ url('logout') }}" method="post">
                                @csrf
                                <button class="dropdown-item" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
                @else
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <small class="text-color">Perlu bantuan?</small>
                    <div class="d-flex justify-content-center gap-2">
                        <a class="link-anchor" href="tel:081339439431"><i class="fas fa-phone"></i></a>
                        <a class="link-anchor" target="_blank" href="https://wa.me/+6281339439431?text=Permisi%20Alatash,%20saya%20butuh%20bantuan%20menyewa%20mobil"><i class="fab fa-square-whatsapp fa-lg"></i></a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    
  </div>
</nav>

<script>
    jQuery(function () {
    var navbar = $('#navbar');

    ScrollReveal().reveal("#navbar", {
        duration: 1000,
        origin: 'top',
        distance: '50px',
        reset: true,
        beforeReveal: function (el) {
        },
    });
});



</script>
<!-- End of navbar -->