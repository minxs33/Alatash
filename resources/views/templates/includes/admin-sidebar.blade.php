
    <ul class="navbar-nav sidebar sidebar-success accordion toggled" id="accordionSidebar">

    <a class="sidebar-brand align-items-center justify-content-center mb-4" href="{{ url('/') }}"><img src="{{ asset('images/logo_alatash_mini.png') }}" alt="A Logo" style="width: 65px; height:auto;"></a>

        @if(Auth::user()->role == 1 || Auth::user()->role == 2 )
        <li class="nav-item">
            <a class="nav-link collapsed text-muted" href="{{ url('admin/dashboard') }}">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <hr class="sidebar-divider mb-4">
        
        <div class="sidebar-heading">
            Carousel
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed text-muted" href="{{ url('admin/carousels') }}">
                <i class="fas fa-panorama"></i>
                <span>Carousel Lists</span>
            </a>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
        @endif
        <div class="sidebar-heading">
            Car
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed text-muted" href="{{ url('admin/cars') }}">
                <i class="fas fa-car"></i>
                <span>Car Lists</span>
            </a>
        </li>

        @if(Auth::user()->role == 1)
        <li class="nav-item">
            <a class="nav-link collapsed text-muted" href="{{ url('admin/categories') }}">
                <i class="fas fa-truck-pickup"></i>
                <span>Car Categories</span>
            </a>
        </li>

        <hr class="sidebar-divider d-none d-md-block">

        <div class="sidebar-heading">
            User
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed text-muted" href="{{ url('admin/roles') }}">
                <i class="fas fa-users"></i>
                <span>User Groups</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed text-muted" href="{{ url('admin/users') }}">
                <i class="fas fa-user-alt"></i>
                <span>User Lists</span>
            </a>
        </li>
        @endif

        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0 shadow-sm primary-color-ascent text-white" id="sidebarToggle"></button>
        </div>

    </ul>