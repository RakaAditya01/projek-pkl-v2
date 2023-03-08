@extends('layouts.app')

@section('title', 'Tambah Peminjam')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Peminjam</h1>
        </div>
        <div class="row">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body" style="width: 90%">
                                <form action="{{ route('insertpeminjam') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="image">Foto</label>
                                        <div id="camera" class="img-fluid"></div>
                                        <br/>
                                        <input type=button class="btn btn-sm btn-primary" value="Take Snapshot" onClick="take_snapshot()">
                                        <input type="hidden" name="image" class="image-tag">
                                        <div id="results" >Your captured image will appear here...</div>
                                        @error('image')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                   @foreach($user as $users)
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">NIM</label>
                                        <input type="text" name="nim" id="" class="form-control 
                                        @error('nim')
                                            is-invalid
                                        @enderror" aria-describedby="emailHelp" value="{{$users -> nim}}" readonly>
                                        @error('nim')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    @endforeach
            
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama</label>
                                        <input type="text" name="nama"  class="form-control" aria-describedby="emailHelp" value="{{auth()->user()->name}}" readonly>
                                        </input>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                                        <select class="form-control" nama="nama_barang" id="" aria-label="Default select example" name="nama_barang">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($barang as $data)
                                            <option value="{{$data->nama_barang}}">{{ $data->nama_barang}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">keterangan</label>
                                        <input type="text" name="keterangan" class="form-control 
                                        @error('keterangan')
                                            is-invalid
                                        @enderror" id="" aria-describedby="emailHelp">
                                        @error('keterangan')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                            
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Jumlah</label>
                                        <input type="text" name="jumlah" class="form-control 
                                        @error('jumlah')
                                            is-invalid
                                        @enderror" id="" aria-describedby="emailHelp">
                                        @error('jumlah')
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
                document.getElementById('results').innerHTML = '<img src="'+data_uri+'" class="img-fluid mt-4" name="result"/>';
            } );
        }
</script>
@endsection