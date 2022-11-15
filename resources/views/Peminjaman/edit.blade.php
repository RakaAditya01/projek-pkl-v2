@extends('layouts.app')

@section('title', 'Edit')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Peminjam</h1>
        </div>
        <div class="row">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body" style="width: 90%">
                                <form  method="POST" action="/updatepeminjam/{{$data->id}}">
                                    @csrf
                                    @method('put')
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">NIM</label>
                                        <input type="text" name="nim" value="{{$data->nim}}" class="form-control" id=""
                                            aria-describedby="emailHelp">
                                        <div id="emailHelp" class="form-text"></div>
                                    </div>
            
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama</label>
                                        <input type="text" name="nama" value="{{$data->nama}}" class="form-control" id=""aria-describedby="emailHelp">
                                        <div id="emailHelp" class="form-text"></div>
                                    </div>
            
            
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                                        <input type="text" name="nama_barang" value="{{$data->nama_barang}}" class="form-control" id=""
                                            aria-describedby="emailHelp">
                                        <div id="emailHelp" class="form-text"></div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Dokumentasi</label>
                                        <input type="file" name="dokumentasi" value="{{$data->dokumentasi}}" class="form-control"  id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                        @error('dokumentasi')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Jumlah</label>
                                        <input type="text" name="jumlah" value="{{$data->jumlah}}" class="form-control" id=""
                                            aria-describedby="emailHelp">
                                        <div id="emailHelp" class="form-text"></div>
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