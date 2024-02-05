@extends('templates/admin-app')

@section('title','Altash - Tambah Foto Mobil')

@section('content')
<div class="container shadow bg-white py-3 mb-4">
    <span>
        <a class="text-color" href="{{url('admin/cars')}}"><i class="fas fa-chevron-left"></i> Kembali</a>
    </span>

    <div class="px-4">
        <div class="d-sm-flex align-items-center justify-content-between mt-3">
            <h3 class="h3 mb-0 text-base fw-bold">Tambah Foto Mobil</h3>
        </div>
        <hr>
        @if (Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                {{Session::get('error')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="alert alert-info p-3">
                <div class="row gy-3">
                    <div class="col-lg-6">
                        <div class="d-flex flex-wrap flex-column">
                            <small class="fw-bold text-muted mb-0">Nama Mobil</small>
                            <small>{{$cars['car_name']}}</small>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="d-flex flex-wrap flex-column">
                            <small class="fw-bold text-muted mb-0">Kategori</small>
                            <small>{{$cars['cat_name']}}</small>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="d-flex flex-wrap flex-column">
                            <small class="fw-bold text-muted mb-0">Harga Sewa</small>
                            <small>Rp{{$cars['total_price']}}</small>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="d-flex flex-wrap flex-column">
                                <small class="fw-bold text-muted mb-0">Deskripsi</small>
                                <small>{!!$cars['description']!!}</small>
                            </div>
                        </div>
                </div>

            </div>
        </div>
    
        <form class="py-3 row" action="{{ url('admin/car_images') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="cars_id" value="{{$cars['car_id']}}">
            <div class="mb-3">

                <div class="mb-4">
                    <label class="form-label" for="textAreaExample">Car Images</label>
                    <select class="form-select photoCount" name="image_count">
                            <option selected value="1">1 Foto</option>
                            <option value="2">2 Foto</option>
                            <option value="3">3 Foto</option>
                            <option value="4">4 Foto</option>
                            <option value="5">5 Foto</option>
                            <option value="6">6 Foto</option>
                            <option value="7">7 Foto</option>
                            <option value="8">8 Foto</option>
                            <option value="9">9 Foto</option>
                            <option value="10">10 Foto</option>

                    </select>
                </div>

                <div class="mb-4 photos">
                    <label for="formFile" class="form-label">Foto 1</label>
                    <input class="form-control" name="image_1" type="file" id="formFile">
                </div>

            </div>

            <div class="col-6">
                <button class="btn btn-warning btn-block" type="reset"><i class="fa-solid fa-arrows-spin"></i> Reset Input</button>
            </div>
            <div class="col-6">
                <button class="btn btn-success btn-block" type="submit"><i class="fa-solid fa-plus"></i> Submit</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    jQuery(() => {
        
        let photoCount = $(".photoCount");
        let photos = $(".photos");

        photoCount.on('change',function(){
            // alert($((this)).val());
            photos.html("");
            for(var i = 1; i <= $((this)).val(); i++)
            {
                photos.append(`
                <label for="formFile" class="form-label">Foto `+i+` </label>
                <input class="form-control mb-2" name="image_`+i+`" type="file" id="formFile">
                `)
            }
        })
    })
</script>

@endsection