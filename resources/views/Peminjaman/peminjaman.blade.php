@extends('layouts.app')

@section('title', 'Peminjaman')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Peminjam</h1>
        </div>
        <div class="row">
            <div class="table-responsive">
                <div class="bd-highlight d-flex">
                    <div class="card-header-form">
                        <form action="/peminjaman" method="GET" class="mt-3">
                            <div class="input-group">
                                <input type="text" 
                                id="input"
                                class="form-control" 
                                placeholder="Search"  
                                onkeyup='searchTable()'>
                            </div>
                        </form>
                    </div>
                    <div class="p-2 flex-grow-1 bd-highlight text-right">
                        <a href="{{route('tambahpeminjam')}}" type="button" class="btn btn-success mt-2 mb-4">Tambah +</a>
                    </div>
                </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table-striped table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">NIM</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Dokumentasi</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
        
                                    <tr>
                                        @foreach ($data as $no => $row)
                                        <input type="hidden" value="{{ $row->image }}" class="key{{ $no }}">
                                        <input type="hidden" value="{{ $row->nim }}" class="key{{ $no }}">
                                        <input type="hidden" value="{{ $row->nama }}" class="key{{ $no }}">
                                        <input type="hidden" value="{{ $row->nama_barang }}" class="key{{ $no }}">
                                        <input type="hidden" value="{{ $row->jumlah }}" class="key{{ $no }}">
                                        <td>{{$data->firstItem()+$no}}</td>
                                        <td><img src="images/{{$row->image}}" style="width: 30px;"></td>
                                        <td>{{$row->nim}}</td>
                                        <td>{{$row->nama}}</td>
                                        <td>{{$row->nama_barang}}</td>
                                        <td>{{$row->jumlah}}</td>
                                        <td>
                                        <div class="container d-flex" style="margin: 0;padding: 0;">
                                            <form action="{{route('deletepeminjaman',$row->id)}}" id="delete{{$row->id}}" method="POST" class="d-block">
                                                @csrf
                                                @method('delete')
                                                <a href="#" data-id={{$row->id}} class="btn btn-icon btn-danger m-1 ml-3 mt-3 mb-3 delete swal-confrim">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </form>
                                            <a href="{{route('tampilanpeminjam',$row->id)}}" class="btn btn-primary m-1 mr-3 mb-3 mt-3 "><i class="fas fa-pencil-alt "></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- @else
                        <div class="alert alert-success mt-3 alert-dismissible fade show" role="alert">
                            Maaf, tidak ada ditemukan
                        </div>
                        @endif --}}
                        {{-- {{$data->links()}} --}}
                
                    </div>
                </div>
        </div>
        </div>
    </section>

    @endsection
    
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
 @endpush
