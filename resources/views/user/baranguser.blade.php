@extends('layouts.app')

@section('title', 'List Barang')

@push('style')
<link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>List Barang</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-striped table nowrap" id="table-abc" style="width: 100%">
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
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach ($data as $index => $row)
                                    {{-- <tr>
                                        <td scope="row">{{ $index + $data->firstItem() }}</td>
                                        <td>
                                            <img src="{{ $row->image }}" alt="" style="width: 80px;">
                                        </td>
                                        <td hidden id="id">{{$row -> id}}</td>
                                        <td>{{$row -> nama_barang}}</td>
                                        <td>{{$row -> stock}}</td>
                                        <td>
                                            <a href="{{route('pinjamuser', $row->id)}}" type="button"
                                                class="btn btn-primary m-2">Pinjam</a>
                                        </td>
                                    </tr> --}}
                                    <tr>
                                        <td scope="row">{{ $index + $data->firstItem() }}</td>
                                        <td>
                                            <img src="{{ $row->image }}" alt="" style="width: 80px;">
                                        </td>
                                        <td>{{$row -> nama_barang}}</td>
                                        <td>{{$row -> stock}}</td>
                                        @if($row -> stock >= 1)
                                        {
                                        <td>
                                            <a href="{{route('pinjamuser', $row->id)}}" type="button"
                                                class="btn btn-primary m-2">Pinjam</a>
                                        </td>
                                        }
                                        @else{
                                            <td>Barang Habis !!</td>
                                        }
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <br>
        </div>
    </section>
    {{-- {{ $data->links() }} --}}
</div>
@include('sweetalert::alert')
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/after.js') }}"></script>
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>
@endpush