@extends('layouts.app')

@section('title', 'List Barang')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>List Barang</h1>
        </div>
        <div class="row">
            <div class="table-responsive">
                <div class="bd-highlight d-flex">
                    <div class="card-header-form">
                        <form action="/barang" method="GET" class="mt-3">
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
                                <th scope="col">Gambar</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
            
                             <tr>
                                @foreach ($data as $no => $row)

                                <td>{{$data->firstItem()+$no}}</td>
                                <td><img src="images/{{$row->image}}" style="width: 30px;"></td>
                                <td hidden id="id">{{$row -> id}}</td>
                                <td>{{$row ->nama_barang}}</td>
                                <td>{{$row ->stock}}</td>
                                <td>
                                    <a href="{{route('pinjamuser')}}" type="button" class="btn btn-primary m-2">Pinjam</a>
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