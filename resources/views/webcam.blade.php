@extends('layouts.app')

@section('title', 'Webcam')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Webcam</h1>
        </div>
        <div class="card-body">
            <head>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
                <style type="text/css">
                    #results { padding:15px; border:1px solid; background:#ccc; }
                </style>
            </head>
            <div class="d-flex bd-highlight">
                <form method="POST" action="{{ route('webcam.capture') }}">
                    @csrf
                    <div class="row">
                        <div class="p-2 flex-fill bd-highlight">
                            <div id="my_camera"></div>
                            <br/>
                            <input type=button value="Take Snapshot" onClick="take_snapshot()">
                            <input type="hidden" name="image" class="image-tag">
                        </div>
                        <div class="p-2 flex-fill bd-highlight">
                            <div id="results">Your captured image will appear here...</div>
                        </div>
                        <div class="col-md-12 text-center">
                            <br/>
                            <button class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
                
            <script language="JavaScript">
                Webcam.set({
                    width: 490,
                    height: 350,
                    image_format: 'jpeg',
                    jpeg_quality: 90
                });
                
                Webcam.attach( '#my_camera' );
                
                function take_snapshot() {
                    Webcam.snap( function(data_uri) {
                        $(".image-tag").val(data_uri);
                        document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
                    } );
                }
            </script>
        </div>
    </section>
</div>
@endsection