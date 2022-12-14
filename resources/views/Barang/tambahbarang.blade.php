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
                                    <label for="image">Foto</label>
                                    <div id="camera" class="img-fluid"></div>
                                    <br/>
                                    <input type=button class="btn btn-sm btn-primary" value="Take Snapshot" onClick="take_snapshot()">
                                    <input type="hidden" name="image" class="image-tag">
                                    <div id="results">Your captured image will appear here...</div>
                                    
                                    @error('image')
                                        <div class="alert alert-danger" role="alert">
                                            Data Harus diisi!
                                        </div>
                                    @enderror
                                </div>

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

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Barcode</label>
                                    <input type="text" name="scan" class="form-control 
                                    @error('scan')
                                        is-invalid
                                    @enderror" id="" aria-describedby="emailHelp" value="{{ old('scan') }}">
                                    @error('scan')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
           </div>
        </div>
</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
    <script type='text/javascript'>
        Webcam.set({
                width: 350,
                height: 250,
                image_format: 'jpeg',
                jpeg_quality: 90
            });

            Webcam.attach('#camera');
            function take_snapshot() {
                Webcam.snap( function(data_uri) {
                    $(".image-tag").val(data_uri);
                    document.getElementById('results').innerHTML = '<img src="'+data_uri+'" class="img-fluid mt-4"/>';
                } );
            }

        

        

    </script>
     @endsection
  </body>
</html>