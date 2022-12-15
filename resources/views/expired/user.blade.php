@extends('layouts.app')

@section('title', 'User')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data User</h1>
        </div>
        <div class="row">
            <div class="table-responsive">
                <div class="bd-highlight d-flex">
                    <div class="card-header-form">
                        <form action="/user" method="GET" class="mt-3">
                            <input type="text" id="input" placeholder="Search"
                            class="form-control" onkeyup='searchTable()'>
                        </form>
                    </div>
                </div>
                <br>
               <div class="card-body p-0">

                <div class="table-responsive">
                        <table class="table-striped table nowrap" id="table" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Nim</th>
                                <th scope="col">Email</th>
                                {{-- <th scope="col">password</th> --}}
                                <th scope="col">Expired</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            <tr>
                                @foreach ($data as $index => $row)
                                <th scope="row">{{ $index + $data->firstItem() }}</th>
                                <td>{{$row ->name}}</td>
                                <td>{{$row ->nim}}</td>
                                <td>{{$row ->email}}</td>
                                {{-- <td>{{$row ->password}}</td> --}}
                                <td>{{$row ->expired_at->format('Y-m-d')}}</td>
                                <td>{{$row ->role}}</td>
                                <td>
                                    <div class="container d-flex" style="margin: 0;padding: 0;">
                                        <form action="{{route('deleteuser',$row->id)}}" id="delete{{$row->id}}" method="POST" class="d-block">
                                            @csrf
                                            @method('delete')
                                            <a href="#" data-id={{$row->id}} class="btn btn-icon btn-danger m-1 ml-3 mt-3 mb-3 delete swal-confrim">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </form>
                                        <a href="{{route('tampilanuser',$row->id)}}" class="btn btn-primary m-1 mr-3 mb-3 mt-3 "><i class="fas fa-pencil-alt "></i></a>
                                    </div>
                                </td>
                        </tr>
                        @endforeach
                        @if ($data->count() == 0)
                                <div class="alert alert-danger" role="alert">
                                    Tidak Ada Data Peminjam!
                                </div>
                            @endif
                         </tbody>
                     </table>
                </div>

               </div>
            </div>
        </div>
    </section>
</div>

@push('after-script')
<script>
    $(".swal-confrim").click(function(e) {
        id = e.target.dataset.id;
        Swal.fire({
            title: 'Apakah anda yakin ingin hapus data ini?',
            text: "Data yang terhapus tidak dapat dikembalikan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success',
                    )
                    $(`#delete${id}`).submit();
                }else{
                    
                }
                
            })
            
        });
        </script>
<script>
$('.delete').click( function( ){
    var barangid = $(this).attr('data-id');
    var nama = $(this).attr('data-nama');
    swal({
            title: "Yakin?",
            text: "Anda Akan Menghapus Data Ini id "+nama+"",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location = "/deleteuser/ "+nama+""
                swal("Data Anda Berhasil Di Hapus", {
                icon: "success",
                });
            } else {
                swal("Data Anda Tidak Jadi Di Hapus");
            }
    });
});

</script>

<script>
function searchTable() {
    var input;
    var saring;
    var status;
    var tbody;
    var tr;
    var td;
    var i;
    var j;
    input = document.getElementById("input");
    saring = input.value.toUpperCase();
    tbody = document.getElementsByTagName("tbody")[0];;
    tr = tbody.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            if (td[j].innerHTML.toUpperCase().indexOf(saring) > -1) {
                status = true;
            }
        }
        if (status) {
            tr[i].style.display = "uuun";
            status = false;
        } else {
            tr[i].style.display = "none";
        }
    }
}

</script>
</html>
@include('sweetalert::alert')
@endsection