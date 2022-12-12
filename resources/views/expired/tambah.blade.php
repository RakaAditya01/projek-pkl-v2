@extends('layouts.app')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah User</h1>
        </div>
        <div class="row">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body" style="width: 90%">
                                <form method="POST" action="/insertuser/" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Name</label>
                                        <input type="text" name="name" id="" class="form-control 
                                        @error('name')
                                            is-invalid
                                        @enderror" aria-describedby="emailHelp">
                                        @error('name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
            
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nim</label>
                                        <input type="text" name="nim" id="nim" class="form-control 
                                        @error('nim')
                                            is-invalid
                                        @enderror" aria-describedby="emailHelp">
                                        @error('nim')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="text" name="email" id="email" class="form-control 
                                        @error('email')
                                            is-invalid
                                        @enderror" aria-describedby="emailHelp">
                                        @error('email')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Password</label>
                                        <input type="text" name="Password" id="Password" class="form-control 
                                        @error('Password')
                                            is-invalid
                                        @enderror" aria-describedby="emailHelp">
                                        @error('Password')
                                        <div class="text-danger">
                                            {{ $message }}
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