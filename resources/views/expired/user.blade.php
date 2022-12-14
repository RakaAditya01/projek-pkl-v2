@extends('layouts.app')

@section('title', 'User')

@push('style')
    <link rel="stylesheet"
        href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data User</h1>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
                    <br>
                    <div class="card-body">
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
                                        <td class="d-flex">
                                        <div class="row mt-0">
                                        <form action="{{ route('deleteuser', $row->id) }}" method="POST">
                                        @csrf
                                        
                                        <button class="btn btn-icon btn-danger mr-1 btnde   lete"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <a href="/tampilanuser/{{$row->id}}" class="btn btn-primary mr-1"><i class="fas fa-pen-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                {{-- @if ($data->count() == 0)
                                        <div class="alert alert-danger" role="alert">
                                            Tidak Ada Data Peminjam!
                                        </div>
                                    @endif --}}
                                 </tbody>
                             </table>
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
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.btndelete').click(function (e) {
            e.preventDefault();

            var deleteid = $(this).closest("tr").find('.delete_id').val();

            swal({
                    title: "Apakah anda yakin?",
                    text: "Setelah dihapus, Anda tidak dapat memulihkan Tag ini lagi!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        var data = {
                            "_token": $('input[name=_token]').val(),
                            'id': deleteid,
                        };
                        $.ajax({
                            type: "POST",
                            url: 'deleteuser/' + deleteid,
                            data: data,
                            success: function (response) {
                                swal(response.status, {
                                        icon: "success",
                                    })
                                    .then((result) => {
                                        location.reload();
                                    });
                            }
                        });
                    }
                });
        });

    });

</script>

<script>
    $("#table").dataTable({
    "scrollX" : true,
    "responsive" : true,
    "autoWidth" : false,
  "columnDefs": [
    { "sortable": false, "targets": [2,3] }
  ]
});
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
            tr[i].style.display = "test";
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