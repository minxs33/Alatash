@extends('templates/admin-app')

@section('title','Altash - Tambah mobil')

@section('content')

<div class="container shadow bg-white py-3 mb-4">
<span>
    <a class="text-success" href="{{url('admin/cars')}}"><i class="fas fa-chevron-left"></i> Kembali</a>
</span>
<form class="border border-light px-4 py-3 row" action="{{ url('admin/cars') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h3 class="h3 mb-0 text-base fw-bold">Tambah Mobil</h3>
    </div>
    <hr>
    @if (Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
            {{Session::get('error')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="mb-3">
        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Kategori<span class="text-danger">*</span></label>
            @if($errors->has('category_id'))
                <div class="text-danger">{{ $errors->first('category_id') }}</div>
            @endif
            <select name="category_id" class="form-select">
                    <option disabled selected>Pilih kategori</option>
                @foreach($categories as $row)
                    <option value="{{$row['id']}}">{{$row['name']}}</option>
                @endforeach
            </select>
        </div>    

        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Nama Mobil<span class="text-danger">*</span>
            </label>
            @if($errors->has('name'))
                <div class="text-danger">{{ $errors->first('name') }}</div>
            @endif
            <input type="text" id="defaultSubscriptionFormPassword" class="form-control" name="name">
        </div>

        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Deskripsi<span class="text-danger">*</span></label>
            @if($errors->has('description'))
                <div class="text-danger">{{ $errors->first('description') }}</div>
            @endif
            <textarea id="tinyMCE" class="form-control" name="description"></textarea>
        </div>

        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Harga Sewa (Rp)<span class="text-danger">*</span></label>
            @if($errors->has('price'))
                <div class="text-danger">{{ $errors->first('price') }}</div>
            @endif
            <input type="text" id="defaultSubscriptionFormPassword" class="form-control" name="price">
        </div>

        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Diskon (%)</label>
            @if($errors->has('discount'))
                <div class="text-danger">{{ $errors->first('discount') }}</div>
            @endif
            <input type="text" id="defaultSubscriptionFormPassword" class="form-control" name="discount">
        </div>

        @if(Auth::user()->role == 1)
        <div class="mb-4">
            <label class="form-label mb-0" for="textAreaExample">Status Mobil</label><br>
            <div class="badge badge-info mb-3" for="textAreaExample">Menentukan apakah mobil akan ditampilkan atau tidak</div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="status[]" value="1" id="flexSwitchCheckChecked">
            </div>
        </div>
        @endif

        <div class="mb-4">
            <label class="form-label mb-0" for="textAreaExample">Foto Mobil</label><br>
            <div class="badge badge-info mb-4">Nyalakan <i class="fas fa-toggle-on"></i> jika Anda ingin gambar ditampilkan pada produk. Anda dapat mengatur gambar produk di tabel produk di kolom gambar dengan <i class="fas fa-image small"></i> ikon sebagai indikator.</div>
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
            <div class="d-flex gap-2">
                <label for="formFile" class="form-label">Foto 1</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="image_status_1" value="1" id="flexSwitchCheckChecked">
                </div>
            </div>
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

<script type="text/javascript">
    tinymce.init({
        selector: 'textarea#tinyMCE',
        plugins: 'powerpaste advcode table lists checklist',
        toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table'
    })
    jQuery(() => {
        
        let photoCount = $(".photoCount");
        let photos = $(".photos");

        photoCount.on('change',function(){
            // alert($((this)).val());
            photos.html("");
            for(var i = 1; i <= $((this)).val(); i++)
            {
                photos.append(`
                <div class="d-flex gap-2">
                    <label for="formFile" class="form-label">Foto ${i}</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="image_status_${i}" value="1" id="flexSwitchCheckChecked">
                    </div>
                </div>
                <input class="form-control mb-2" name="image_${i}" type="file" id="formFile">
                `)
            }
        })
    })
</script>

@endsection