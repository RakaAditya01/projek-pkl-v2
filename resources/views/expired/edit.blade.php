@extends('layouts.app')

@push('style')
<link rel="shortcut icon" href="img/pnj.ico" type="image/x-icon">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Data User</h1>
        </div>
        <div class="row">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body" style="width: 90%">
                                <form method="POST" action="/updateuser/{{$data->id}}">
                                    @csrf
                                    @method('put')
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama</label>
                                        <input type="text" name="name" value="{{$data->name}}" class="form-control" id=""
                                            aria-describedby="emailHelp">
                                        <div id="emailHelp" class="form-text"></div>
                                    </div>
            
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nim</label>
                                        <input type="text" name="nim" value="{{$data->nim}}" class="form-control" id=""aria-describedby="emailHelp">
                                        <div id="emailHelp" class="form-text"></div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="text" name="email" value="{{$data->email}}" class="form-control" id=""
                                            aria-describedby="emailHelp">
                                        <div id="emailHelp" class="form-text"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Expired</label>
                                        <input type="text" name="expired_at" value="{{$data->expired_at}}" class="form-control" id="">
                                        <div id="emailHelp" class="form-text"></div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Password</label>
                                        <input type="text" name="password" value="{{$data->pswrd}}" class="form-control"  id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                        @error('password')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col mb-lg-2 mb-1">
                                            <label for="exampleFormControlSelect1" class="form-label">Role</label>
                                            <select class="form-select @error('level') is-invalid @enderror" id="exampleFormControlSelect1" aria-label="Default select example" name="role">
                                                {{-- <option selected value="{{ $user->role }}">{{ $user->role }}</option> --}}
                                                <option value="admin">Admin</option>
                                                <option value="mahasiswa">Mahasiswa</option>
                                            </select>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection