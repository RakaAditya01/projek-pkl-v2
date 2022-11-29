@extends('layouts.app')

@section('title', 'History')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Barang Dipinjam</h1>
        </div>
        <div class="row">
           <div class="table-responsive">
            <div class="bd-highlight d-flex">
                <div class="card-header-form">
                    <form action="/history" method="GET" class="mt-3">
                        <input type="text" id="input" placeholder="Search" class="form-control" onkeyup='searchTable()'>
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
                                <th scope="col">Foto</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Tgl.Dipinjam</th>
                                <th scope="col">Tgl.Dikembalikan</th>
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
                                <td>
                                    <img src="{{ $row->dokumentasi }}" alt=""
                                        style="width: 80px;">
                                </td>
                                <td>{{$row -> nama_barang}}</td>
                                <td>{{$row -> jumlah}}</td>
                                <td>{{$row -> created_at->format('Y-m-d')}}</td>
                                <td>{{$row -> expired_at->format('Y-m-d')}}</td>
                                <td>
                                    <form action="/deletehistory/{{$row->id}}" method="POST">
                                        @csrf
                                        @method("delete")
                                        <button class="btn btn-primary m-2">Kembalikan</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $data->links() }}
           </div>
        </div>
    </section>
</div>

{{-- @include('sweetalert::alert') --}}
<script src="https://code.jquery.com/jquery-3.6.0.slim.js"
    integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</tbody>
<script>
    $('.deletebarang').click(function () {
        var peminjamsid = $(this).attr('data-id');
        swal({
                title: "Kembalikan Barang?",
                text: "kamu akan mengembalikan barang dengan id " + peminjamsid + " ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/deletehistory/" + peminjamsid + " "
                    swal("Barang berhasil di kembalikan", {
                        icon: "success",
                    });
                } else {
                    swal("Barang tidak jadi di Kembalikan");
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
                tr[i].style.display = "";
                status = false;
            } else {
                tr[i].style.display = "none";
            }
        }
    }
</script>
@endsection