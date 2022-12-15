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
                                <th scope="col">Foto Bukti</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
            
                             <tr>
                                @foreach ($data as $no => $row)

                                <td>{{$data->firstItem()+$no}}</td>
                                <td><img src="{{$row->image}}" style="width: 60px;"></td>
                                <td hidden id="id">{{$row -> id}}</td>
                                <td>{{$row ->nama_barang}}</td>
                                <td>{{$row ->stock}}</td>
                                <td>
                                    <a href="{{route('pinjamuser',$row->id)}}" type="button" class="btn btn-primary m-2">Pinjam</a>
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

@include('sweetalert::alert')
    @endsection
    @push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('js/after.js') }}"></script>
    @endpush