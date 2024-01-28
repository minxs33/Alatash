@extends('templates/admin-app')

@section('title','Altash - Product Lists')

@section('content')

<div class="container-fluid card bg-white shadow-sm p-4">
    <h4 class="fw-semibold"><i class="fas fa-boxes-stacked"></i> Manajemen Mobil</h4>
    <hr class="border-success">
    @if (Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{Session::get('error')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{Session::get('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row align-items-center">
        <div class="col-4 mb-4">
            <a class="btn btn-outline-success btn-sm" href="{{ url('/admin/cars/create') }}" class="text-white text-decoration-none"><i class="fas fa-plus"></i> Tambah Mobil</a>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-hover text-center" id="cars-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Foto</th>
                            <th>Nama Mobil</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Status keaktifan</th>
                            <th>Dibuat pada</th>
                            <th>Terakhir diupdate</th>
                            <th>Dibuat oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        @foreach($cars as $row)
                            <tr>
                                <td>
                                    {{$loop->index+1}}
                                </td>
                                <td>
                                    {{$row['cat_name']}}
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-success image-modal position-relative" type="button" value="{{$row['car_id']}}" data-mdb-toggle="modal" data-mdb-target="#image-Modal"><i class="fas fa-image"></i>
                                    @if($row['car_images_count'] != 0)
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{$row['car_images_count']}}
                                        <span class="visually-hidden">Foto-foto mobil</span>
                                        </span>
                                    @endif
                                    </button>
                                </td>
                                <td style="max-width: 250px;">
                                    {{$row['car_name']}}
                                </td>
                                <td>
                                    {{substr($row['description'],0,50)}}
                                </td>
                                <td>
                                    @if($row['discount'] != 0)
                                        Rp{{$row['total_price']}}
                                        <div class="badge badge-danger">{{$row['discount']}}%</div>
                                        <div class="text-decoration-line-through">Rp{{$row['price']}}</div>
                                    @else
                                    Rp{{$row['total_price']}}
                                    @endif
                                    
                                </td>
                                <td>
                                    {!!$row['status'] == 'active' ? '<div class="form-switch"><input class="form-check-input status" type="checkbox" value="'.$row['car_id'].'" id="flexCheckChecked" checked></div>' : '<div class="form-switch"><input class="form-check-input status" type="checkbox" value="'.$row['car_id'].'" id="flexCheckChecked"></div>'!!}
                                </td>
                                <td>
                                    {{$row['created_at']->format('j F, Y. H:i')}}
                                </td>
                                <td>
                                    {{$row['updated_at']->format('j F, Y. H:i')}}
                                </td>
                                <td>
                                    {{$row['users_name']}}
                                </td>
                                <td>
                                    <form method="POST" action="{{ url('admin/cars/'.$row['car_id']) }}">
                                        <a class="btn btn-warning btn-sm" href="{{ url('admin/cars/'.$row['car_id'].'/edit') }}"><i class="fas fa-edit fa-sm"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Apa Anda yakin?')" type="submit"><i class="fas fa-trash fa-sm"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="image-Modal" tabindex="-1" aria-labelledby="image-ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-success fw-bold" id="image-ModalLabel"><i class="fas fa-image"></i> Manajemen foto mobil</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-info p-2">
            Gambar aktif pertama adalah gambar yang ditampilkan pada thumbnail produk
        </div>
        <div class="link-container">
            
        </div>
        <div class="d-flex flex-column image-container">
           
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-mdb-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>


<script>
    jQuery(() => {
        $('#cars-table').DataTable();

        $(document).on("change", ".status",function(){
   
            // alert($((this)).val());
            $.ajax({
                url : "{{url('admin/ajaxReq/change-car-status')}}",
                type: "POST",
                data : {id:$((this)).val()},
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                success : (data) => {
                    console.log(data);
                }
            })
        })

        let imageContainer = $('.image-container');
        let linkContainer = $('.link-container');
        function reloadImage($id){
            imageContainer.html("");
            $.ajax({
                url: "{{url('admin/ajaxReq/car-image-list')}}",
                data : {id : $id},
                type: "POST",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                success : (data) => {
                    // console.log(data);
                    linkContainer.html(`<a class="btn btn-outline-success" href="{{ url('/admin/car_images/create/${$id}') }}" class="text-white text-decoration-none"><i class="fas fa-plus"></i> Tambahkan foto mobil baru</a>`);
                    $.each(data, (i,v) => {
                        
                        imageContainer.append(`
                            <hr>
                            <div class="d-flex flex-column mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <h5 class="text-muted">Foto ke-${i+1}</h5>
                                    <div class="d-flex align-items-center gap-2">
                                        ${v['is_active'] == 1 ? `<div class="form-switch"><input class="form-check-input image-status" type="checkbox" value="${v['id']}" id="flexCheckChecked" checked></div>` : `<div class="form-switch"><input class="form-check-input image-status" type="checkbox" value="${v['id']}" id="flexCheckChecked"></div>`}
                                        <button class="btn btn-danger btn-sm delete-image" type="button" value="${v['id']}" data-prod-id="${v['cars_id']}"><i class="fas fa-trash fa-sm"></i></button>
                                    </div>
                                </div>
                                <img class="object-fit-scale" src="{{asset('storage/images/car-images')}}/${v['image_url']}" alt="{{asset('storage/images/car-images')}}/${v['image_url']}" style="width:100%; height:auto;">
                            </div>
                            
                        `);
                    });
                }
            })
        }
        $(document).on("click", ".image-modal",function(){
            reloadImage($(this).val());
        })

        $(document).on("change", ".image-status",function(){
            $.ajax({
                url : "{{url('admin/ajaxReq/change-images-status/')}}",
                data : {id:$((this)).val()},
                type: "POST",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                success : (data) => {
                    // console.log(data);
                }
            })
        })

        $(document).on("click", ".delete-image",function(){
            // console.log($((this)).val())
            if(confirm("Apa Anda yakin?") == true)
            {
                $.ajax({
                    url : "{{url('admin/car_images')}}/"+$((this)).val(),
                    type: "DELETE",
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    success : (data) => {
                        // console.log(data);
                        // alert($(this).attr("data-prod-id"));
                        reloadImage($(this).attr("data-car-id"));
                    }
                })
            }
        })
    })

    
</script>

@endsection