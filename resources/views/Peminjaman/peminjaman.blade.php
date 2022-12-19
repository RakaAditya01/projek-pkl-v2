@extends('layouts.app')

@section('title', 'Peminjam')

@push('style')
<link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Peminjam</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="bd-highlight d-flex">
                        <div class="p-2 flex-grow-1 bd-highlight text-right">
                            <a href="{{route('tambahpeminjam')}}" type="button" class="btn btn-success mt-2 mb-4">Tambah
                                +</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-striped table" id="table-1">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">NIM</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">keterangan</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Tgl.Dipinjam</th>
                                        <th scope="col">Tgl.Pengembalian</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
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
                                        <td>{{$row ->created_at->format('Y-m-d')}}</td>
                                        <td>{{$row ->expired_at->format('Y-m-d')}}</td>
                                        <td>
                                            <div class="container d-flex" style="margin: 0;padding: 0;">
                                                <form action="{{route('deletepeminjaman',$row->id)}}"
                                                    id="delete{{$row->id}}" method="POST" class="d-block">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="#" data-id={{$row->id}}
                                                        class="btn btn-icon btn-danger m-1 btn-lg delete swal-confrim">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </form>
                                                <a href="{{route('tampilanpeminjam',$row->id)}}"
                                                    class="btn btn-primary m-1 btn-lg">
                                                    <i class="fas fa-pencil-alt "></i></a>
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
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@include('sweetalert::alert')
@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('js/after.js') }}"></script>
<script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>
@endpush