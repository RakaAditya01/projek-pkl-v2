@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Barang</h1>
        </div>
        <div class="row">
           <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <form  method="POST"  action="/insertbarang/"  enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Gambar</label>
                                    <input type="file" name="gambar" class="form-control 
                                    @error('gambar')
                                        is-invalid
                                    </div>
                                    @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{ old('gambar') }}">
                                    @error('gambar')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                                    <input type="text" name="nama_barang" class="form-control 
                                    @error('nama_barang')
                                        is-invalid
                                    @enderror" id="" aria-describedby="emailHelp" value="{{ old('nama_barang') }}">
                                    @error('nama_barang')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Stock</label>
                                    <input type="text" name="stock" class="form-control 
                                    @error('stock')
                                        is-invalid
                                    @enderror" id="" aria-describedby="emailHelp" value="{{ old('stock') }}"> 
                                    @error('stock')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Anggaran</label>
                                    <input type="text" name="anggaran" class="form-control 
                                    @error('anggaran')
                                        is-invalid
                                    @enderror" id="" aria-describedby="emailHelp" value="{{ old('anggaran') }}">
                                    @error('anggaran')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
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
