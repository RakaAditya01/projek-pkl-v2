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
                    <form action="/barang" method="GET" class="mt-3">
                        <input type="text" id="input" placeholder="Cari Barang..." onkeyup='searchTable()'>
                    </form>
            <table class="table-sm table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Anggaran</th>
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
                            <img src="{{ asset('fotodokumentasi/'.$row->gambar) }}" alt=""
                                style="width: 80px;">
                        </td>
                        <td hidden id="id">{{$row -> id}}</td>
                        <td>{{$row -> nama_barang}}</td>
                        <td>{{$row -> stock}}</td>
                        <td>{{$row -> anggaran}}</td>
                        <td>
                            <a href="{{route('pinjamuser')}}" type="button" class="btn btn-primary m-2">Pinjam</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </section>
    {{ $data->links() }}
</div>

{{-- @include('sweetalert::alert') --}}
<script src="https://code.jquery.com/jquery-3.6.0.slim.js"
    integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

{{-- end --}}
</body>
<script>
$('.delete').click( function( ){
    var barangid = $(this).attr('data-id');
    var nama = $(this).attr('data-nama');
    swal({
            title: "Yakin?",
            text: "Anda Akan Menghapus Data Ini? "+barangid+"",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location = "/deletebarang/ "+barangid+""
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
@endsection