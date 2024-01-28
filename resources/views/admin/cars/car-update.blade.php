@extends('templates/admin-app')

@section('title','Altash - Edit Mobil')

@section('content')

<div class="container shadow bg-white py-3 mb-4">
<span>
    <a class="text-success" href="{{url('admin/cars')}}"><i class="fas fa-chevron-left"></i> Kembali</a>
</span>
@if (Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
        {{Session::get('error')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<form class="border border-light px-4 py-3 row" action="{{ url('admin/cars/'.$car['car_id']) }}" method="POST">
    @csrf
    @method("PUT")
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h3 class="h3 mb-0 text-base fw-bold">Edit Mobil</h3>
    </div>
    <hr>

    <div class="mb-3">
        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Kategori<span class="text-danger">*</span></label>
            <select name="category_id" class="form-select">
                    <option selected value="{{$car['cat_id']}}">{{$car['cat_name']}}</option>
                @foreach($categories as $row)
                @if($row["id"] == $car["cat_id"])
                    @continue
                @endif
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
            <input type="text" id="defaultSubscriptionFormPassword" class="form-control" name="name" value="{{$car['car_name']}}">
        </div>

        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Deskripsi<span class="text-danger">*</span></label>
            @if($errors->has('description'))
                <div class="text-danger">{{ $errors->first('description') }}</div>
            @endif
            <textarea id="tinyMCE" class="form-control" name="description">{{$car['description']}}</textarea>
        </div>

        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Harga Sewa (Rp)<span class="text-danger">*</span></label>
            @if($errors->has('price'))
                <div class="text-danger">{{ $errors->first('price') }}</div>
            @endif
            <input type="text" id="defaultSubscriptionFormPassword" class="form-control" name="price" value="{{$car['price']}}">
        </div>

        <div class="mb-4">
            <label class="form-label" for="textAreaExample">Diskon (%)</label>
            @if($errors->has('discount'))
                <div class="text-danger">{{ $errors->first('discount') }}</div>
            @endif
            <input type="text" id="defaultSubscriptionFormPassword" class="form-control" name="discount" value="{{$car['discount']}}">
        </div>

        <div class="mb-4">
            <label class="form-label mb-0" for="textAreaExample">Status Mobil</label><br>
            <div class="badge badge-info mb-3" for="textAreaExample">Menentukan apakah mobil akan ditampilkan atau tidak</div>
            <div class="form-check form-switch">
                @if($car['status'] == "active")
                    <input class="form-check-input" type="checkbox" name="status[]" value="1" id="flexSwitchCheckChecked" checked>
                @elseif($car['status'] == "non-active")
                    <input class="form-check-input" type="checkbox" name="status[]" value="1" id="flexSwitchCheckChecked">
                @endif
            </div>
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

<script>
    tinymce.init({
        selector: 'textarea#tinyMCE',
        plugins: 'powerpaste advcode table lists checklist',
        toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table'
    });
</script>
@endsection