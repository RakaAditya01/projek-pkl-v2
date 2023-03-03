@extends('layouts.app')

@section('title', 'Tambah Barang')

@push('style')
<link rel="shortcut icon" href="img/pnj.ico" type="image/x-icon">
@endpush

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
                            <form action="{{ route('insertbarang') }}" method="POST" enctype="multipart/form-data">
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

                                <div class="row">
                                    <div class="form-group col-6">
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
                                    <div class="form-group col-6">
                                        <label for="exampleInputEmail1" class="form-label">Stock</label>
                                        <input type="number" name="stock" pattern="^[1-9][0-9]*$" class="form-control 
                                        @error('stock')
                                            is-invalid
                                        @enderror" id="" aria-describedby="emailHelp" value="{{ old('stock') }}"> 
                                        @error('stock')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Tahun Anggaran</label>
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
                                    <input type="text" style="font-family: 'Libre Barcode 39';font-size: 30px;" name="scan" class="form-control 
                                    @error('scan')
                                        is-invalid
                                    @enderror" id="barcode" aria-describedby="emailHelp" value="{{ old('scan') }}" onload="generateBarcodeNumber()">
                                    @error('scan')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Serial Number</label>
                                    <input type="text" name="serialnumber" class="form-control 
                                    @error('serialnumber')
                                        is-invalid
                                    @enderror" id="serialnumber" aria-describedby="emailHelp" value="{{ old('serialnumber') }}" onload="generateSerialNumber($id)">
                                    @error('serialnumber')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col mb-lg-2 mb-1">
                                        <label for="exampleFormControlSelect1" class="form-label">Kepemilikan</label>
                                        <select class="form-select @error('level') is-invalid @enderror" id="exampleFormControlSelect1" aria-label="Default select example" name="kepemilikan">
                                            {{-- <option selected value="{{ $user->role }}">{{ $user->role }}</option> --}}
                                            <option value="milik negara">Milik Negara</option>
                                            <option value="milik pnj">Milik PNJ</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <button class="btn btn-primary" id="toastr-2" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('js/modules-toastr.js') }}"></script>
@endpush