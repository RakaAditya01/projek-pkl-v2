@extends('layouts.app')

@section('title', 'List Barang')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>List Barang</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
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
                                @php
                                $no = 1;
                                @endphp
                                 <tr>
                                    @foreach ($data as $index => $row)
                                    <th scope="row">{{ $index + $data->firstItem() }}</th>
                                    <td>
                                        <img src="{{ $row->image }}" alt=""
                                            style="width: 80px;">
                                    </td>
                                    <td hidden id="id">{{$row -> id}}</td>
                                    <td>{{$row -> nama_barang}}</td>
                                    <td>{{$row -> stock}}</td>
                                    <td>
                                        <a href="pinjamuser/{{$row->id}}" type="button" class="btn btn-primary m-2">Pinjam</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
        </div>
    </section>
    {{ $data->links() }}
</div>

@include('sweetalert::alert')
    @endsection
    @push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('js/after.js') }}"></script>
    @endpush