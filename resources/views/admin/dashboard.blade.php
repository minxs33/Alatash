@extends('templates/admin-app')

@section('title','Alatash - Dashboard')

@section('content')
<!-- Begin Page Content -->
<div class="container-md d-flex flex-column gap-4">

    <div class="row border border-2 py-4 rounded">
        <h5 class="text-info fw-bold mb-3"><i class="fas fa-boxes"></i> Mobil</h5>

        <div class="col-xl-3 col-md-6 mb-4 mb-lg-0">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Mobil</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_cars}}</div>
                        </div>
                        <div class="col-auto">
                            <a href="{{url('admin/cars')}}">
                                <i class="fa-solid fa-up-right-from-square text-primary"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 mb-lg-0">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Mobil Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$active_car}}</div>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 mb-lg-0">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Foto</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$images}}</div>
                        </div>
                        <div class="col-auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4 mb-lg-0">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                <i class="fas fa-panorama"></i> Carousel</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_carousels}}</div>
                        </div>
                        <div class="col-auto">
                            <a href="{{url('admin/carousels')}}">
                                <i class="fa-solid fa-up-right-from-square text-danger"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 mb-lg-0">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                <i class="fas fa-book"></i> Kategori</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_categories}}</div>
                        </div>
                        <div class="col-auto">
                            <a href="{{url('admin/categories')}}">
                                <i class="fa-solid fa-up-right-from-square text-dark"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 mb-lg-0">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <i class="fas fa-users"></i> Roles</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_roles}}</div>
                        </div>
                        <div class="col-auto">
                            <a href="{{url('admin/roles')}}">
                                <i class="fa-solid fa-up-right-from-square text-primary"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4 mb-lg-0">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_users}}</div>
                        </div>
                        <div class="col-auto">
                            <a href="{{url('admin/users')}}">
                                <i class="fa-solid fa-up-right-from-square text-info"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection