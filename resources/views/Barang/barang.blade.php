@extends('layouts.app')

@push('style')
<style>
    @media print {
  body * {
    visibility: hidden;
  }
  #barcode, #barcode * {
    visibility: visible;
  }
  #barcode {
    position: absolute;
    left: 0;
    top: 0;
  }
}
</style>
@endpush
@section('title', 'Barang')

@push('style')
<link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

<link href='https://fonts.googleapis.com/css?family=Libre Barcode 39' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+39&display=swap" rel="stylesheet">

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Barang<h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="bd-highlight d-flex">
                            <div class="p-2 flex-grow-1 bd-highlight text-right">
                                <a href="{{route('tambahbarang')}}" type="button" class="btn btn-success mt-2 mb-4">Tambah+</a>
                                <a href="/pdf" type="button" class="btn btn-danger mt-2 mb-4">Barcode PDF</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table-striped table" id="table-1">
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
                                    @foreach ($data as $no=> $row)
                                    <tr>
                                        <input type="hidden" value="{{ $row->image }}" class="key{{ $no }}">
                                        <input type="hidden" value="{{ $row->nama_barang }}" class="key{{ $no }}">
                                        <input type="hidden" value="{{ $row->stock }}" class="key{{ $no }}">
                                        <input type="hidden" value="{{ $row->anggaran }}" class="key{{ $no }}">
                                        <input type="hidden" value="{{ $row->scan }}" class="key{{ $no }}">
                                        <td>{{$data->firstItem()+$no}}</td>
                                        <td><img src="{{ $row->image }}" style="width: 90px;"></td>
                                        <td>{{$row ->nama_barang}}</td>
                                        <td>{{$row ->stock}}</td>
                                        <td>{{$row ->anggaran}}</td>
                                        <td>{{$row ->scan}}</td>
                                        <td>
                                            <div class="container d-flex" style="margin: 0;padding: 0;">
                                                <form action="{{route('deletebarang',$row->id)}}"
                                                    id="delete{{$row->id}}" method="POST" class="d-block">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="#" data-id={{$row->id}}
                                                        class="btn btn-icon btn-danger m-1 ml-3 mt-3 mb-3 btn-lg delete swal-confrim">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </form>
                                                <a href="{{route('tampilanbarang',$row->id)}}"
                                                    class="btn btn-primary m-1 mr-3 mb-5 mt-3 btn-lg">
                                                    <i class="fas fa-pencil-alt "></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$data->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('sweetalert::alert')
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('js/after.js') }}"></script>
<script src="{{ asset('library/datatables/media/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>
@endpush