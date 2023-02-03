@extends('layouts.app')

@section('title', 'User')

@push('style')
<link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.bootstrap4.min.css" />
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data User</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-body p-0">
                            <div class="bd-highlight d-flex">
                                <div class="p-2 flex-grow-1 bd-highlight text-right">
                                    <a href="{{route('tambahuser')}}" type="button" class="btn btn-success mt-2 mb-4">Tambah+</a>
                                    <a href="/pdfuser" type="button" class="btn btn-danger mt-2 mb-4">Barcode PDF</a>
                                </div>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-1">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Nim</th>
                                        <th scope="col">Email</th>
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
                                        <td>{{$row ->expired_at->format('Y-m-d')}}</td>
                                        <td>{{$row ->role}}</td>
                                        <td>
                                            <div class="container d-flex" style="margin: 0;padding: 0;">
                                                <form action="{{route('deleteuser',$row->id)}}"
                                                    id="delete{{$row->id}}" method="POST" class="d-block">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="#" data-id={{$row->id}}
                                                        class="btn btn-icon btn-danger m-1 ml-3 mt-1 mb-3 delete swal-confrim">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </form>
                                                <a href="{{route('tampilanuser',$row->id)}}"
                                                    class="btn btn-primary m-1 mr-3 mb-3 mt-1 "><i
                                                        class="fas fa-pencil-alt "></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
<script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.3/js/select.bootstrap4.js"></script>
<script src="{{ asset('js/after.js') }}"></script>
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>
@endpush