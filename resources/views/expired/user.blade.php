@extends('layouts.app')

@section('title', 'User')

@push('style')
<link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
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
                        <div class="table-responsive">
                            <table class="table-striped table nowrap" id="table-1" style="width: 100%">
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
@include('sweetalert::alert')
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/after.js') }}"></script>
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>
@endpush