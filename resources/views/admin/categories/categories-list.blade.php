@extends('templates/admin-app')

@section('title','Altash - List kategori')

@section('content')

<div class="container-fluid card bg-white shadow-sm p-4">
    <h4 class="fw-semibold"><i class="fas fa-book"></i> Manajemen Kategori</h4>
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
    <div class="row">
        <div class="col-12 mb-4">
            <a class="btn btn-outline-success" href="{{ url('/admin/categories/create') }}" class="text-white text-decoration-none"><i class="fas fa-plus"></i> Tambah kategori baru</a>
        </div>
        
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-hover text-center" id="categories-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Dibuat Pada</th>
                            <th>Terakhir Diupdate</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        @foreach($categories as $row)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$row['name']}}</td>
                            <td>
                                {{$row['created_at']->format('j F, Y. H:i')}}
                            </td>
                            <td>
                                {{$row['updated_at']->format('j F, Y. H:i')}}
                            </td>
                            <td>
                                <form method="POST" action="{{ url('admin/categories/'.$row['id']) }}">
                                    <a class="btn btn-warning btn-sm" href="{{ url('admin/categories/'.$row['id'].'/edit') }}"><i class="fas fa-edit fa-sm"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Aoa Anda yakin?')" type="submit"><i class="fas fa-trash fa-sm"></i></button>
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

<script>
    jQuery(() => {
        $('#categories-table').DataTable();

        $(document).on("click", ".image-btn",function(){
            // alert($((this)).attr("src"));
            $('.image-container').html(
                `<img class="object-fit-scale" src="${$((this)).attr("src")}" alt="${$((this)).attr("src")}" style="width:100%; height:auto;">`
            );
        })
    })
</script>
@endsection