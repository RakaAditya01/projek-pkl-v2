@extends('layouts.app')

@section('title', 'History')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Barang Dipinjam</h1>
        </div>
        <div class="row">
           <div class="table-responsive">
            <div class="bd-highlight d-flex">
                <div class="card-header-form">
                    <form action="/history" method="GET" class="mt-3">
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
                                <th scope="col">Foto</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">keterangan</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Tgl.Dipinjam</th>
                                <th scope="col">Tgl.Dikembalikan</th>
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
                                <img src="images/{{$row->image}}" style="width: 60px;">
                                </td>
                                <td>{{$row ->nama_barang}}</td>
                                <td>{{$row ->keterangan}}</td>
                                <td>{{$row ->jumlah}}</td>
                                <td>{{$row ->created_at->format('Y-m-d')}}</td>
                                <td>{{$row ->expired_at->format('Y-m-d')}}</td>
                                <td>
                                        <form action="{{route('deletehistory',$row->id)}}" id="delete{{$row->id}}" method="POST" class="d-block">
                                            @csrf
                                            @method('delete')
                                            <a href="#" data-id={{$row->id}} class="btn btn-danger m-1 delete swal-confrim">
                                                Kembalikan
                                            </a>
                                        </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $data->links() }}
           </div>
        </div>
        
    </section>
</div>

@include('sweetalert::alert')
    @endsection
    @push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('js/after.js') }}"></script>
    @endpush