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
                                        <th scope="col">Foto</th>
                                        <th scope="col">NIM</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">keterangan</th>
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
                                        <td><img src="{{ $row->image }}" style="width: 60px;"></td>
                                        <td>{{$row->nim}}</td>
                                        <td>{{$row->nama}}</td>
                                        <td>{{$row->nama_barang}}</td>
                                        <td>{{$row->keterangan}}</td>
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
    
    @include('sweetalert::alert')
    @endsection
    @push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('js/after.js') }}"></script>
    @endpush