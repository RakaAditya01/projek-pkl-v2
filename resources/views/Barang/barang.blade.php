@extends('layouts.app')

@section('title', 'Barang')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Barang</h1>
        </div>
        <div class="row">
            <div class="table-responsive">
                <div class="bd-highlight d-flex">
                    <div class="card-header-form">
                        <form action="/barang" method="GET" class="mt-3">
                            <div class="input-group">
                                <ul class="navbar-nav mr-3">
                                  <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                                </ul>
                                <form class="form-inline mr-auto">
                                <input type="search"
                                    id="input"
                                    aria-label="Search" data-width="250"
                                    class="form-control"
                                    placeholder="Search"
                                    onkeyup='searchTable()'>
                                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="p-2 flex-grow-1 bd-highlight text-right">
                        <a href="{{route('tambahbarang')}}" type="button" class="btn btn-success mt-2 mb-4">Tambah +</a>
                    </div>
                </div>    
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table-striped table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Anggaran</th>
                                    <th scope="col">Barcode</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                @endphp
                                <tr>
                                    @foreach ($data as $index => $row)
                                    <input type="hidden" class="delete_id" value="{{ $row->id }}">
                                    <th scope="row">{{ $index + $data->firstItem() }}</th>
                                    <td>
                                        <img src="{{ $row->gambar }}" alt=""
                                            style="width: 80px;">
                                    </td>
                                    <td>{{$row ->nama_barang}}</td>
                                    <td>{{$row ->stock}}</td>
                                    <td>{{$row ->anggaran}}</td>
                                    <td>{{$row ->scan}}</td>
                                    <td class="d-flex">
                                        <div class="row mt-0">
                                            <form action="{{ route('deletebarang', $row->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-icon btn-danger m-1 ml-3 mt-3 mb-3  btndelete"><i class="fas fa-trash"></i></button>
                                            </form>
                                            <a href="/tampilanbarang/{{$row->id}}" class="btn btn-primary m-1 mr-3 mb-3 mt-3 "><i class="fas fa-pencil-alt "></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>    
                    </div>
                </div>
            </div>
        </div>
    </section>
     {{ $data->links() }}
</div>

{{-- @include('sweetalert::alert') --}}
<script src="https://code.jquery.com/jquery-3.6.0.slim.js"
    integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>

{{-- end --}}
</body>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
                            type: "DELETE",
                            url: 'deletebarang/' + deleteid,
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
@endsection
