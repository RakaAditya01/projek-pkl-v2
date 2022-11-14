@extends('layouts.app')

@section('title', 'Edit Barang')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Barang</h1>
        </div>
        <div class="row">
           <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <form  method="POST" action="/updatebarang/{{$data->id}}">
                                @csrf
                                @method('put')
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                                    <input type="text" name="nama_barang" value="{{$data->nama_barang}}" class="form-control" id=""
                                        aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text"></div>
                                </div>
        
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Stock</label>
                                    <input type="text" name="stock" value="{{$data->stock}}" class="form-control" id=""
                                        aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text"></div>
                                </div>
        
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Anggaran</label>
                                    <input type="text" name="anggaran" value="{{$data->anggaran}}" class="form-control" id=""
                                        aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Barcode</label>
                                    <input type="text" name="scan" value="{{$data->scan}}" class="form-control" id=""
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

{{-- <div class="container">
    <h1 class="text-center mb-4 pt-4">Edit Data Diri</h1>
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-body" style="width: 90%">
                    <form  method="POST" action="/updatebarang/{{$data->id}}">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" value="{{$data->nama_barang}}" class="form-control" id=""
                                aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Stock</label>
                            <input type="text" name="stock" value="{{$data->stock}}" class="form-control" id=""
                                aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Anggaran</label>
                            <input type="text" name="anggaran" value="{{$data->anggaran}}" class="form-control" id=""
                                aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
