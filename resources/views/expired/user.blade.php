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
                <div class="d-flex bd-highlight">
                    <div class="p-2 flex-grow-1 bd-highlight">
                        <form action="/user" method="GET" class="mt-3">
                            <input type="text" id="input" placeholder="Cari User..." onkeyup='searchTable()'>
                        </form>
                    </div>
                    <div class="p-2 bd-highlight">
                         <a hrefc="{{route('tambahuser')}}" type="button" class="btn btn-success mt-2 mb-4">Tambah +</a>
                    </div>
                </div>
                <div style="overflow-x: scroll;;">
                    <table class="table-sm table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Nim</th>
                            <th scope="col">Email</th>
                            <th scope="col">password</th>
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
                            <td>{{$row ->password}}</td>
                            <td>{{$row ->expired_at}}</td>
                            <td>{{$row ->role}}</td>
                            <td class="d-flex">
                                <a href="#" class="btn btn-danger m-2 delete" data-id="{{$row->id}}"  data-nama="{{$row->name}}">Delete</a>
                            <a href="/tampilanuser/{{$row->id}}" type="submit"class="btn btn-warning m-2">Edit</a>
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
    </section>
</div>

{{-- script --}}
<script
src="https://code.jquery.com/jquery-3.6.0.slim.js"
integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY="
crossorigin="anonymous"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

{{-- end --}}
</body>
<script>
$('.delete').click( function( ){
    var barangid = $(this).attr('data-id');
    var nama = $(this).attr('data-name');
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
@endsection