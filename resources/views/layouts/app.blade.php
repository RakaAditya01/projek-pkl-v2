<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"
        name="viewport">
    <link rel="shortcut icon" href="img/pnj.ico" type="image/x-icon">
    <title>@yield('title') &mdash; Sarpras PNJ</title>

    <!-- General CSS Files -->
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('library/datatables/media/css/jquery.dataTables.min.css')}}">
   <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    @stack('style')

    <!-- Template CSS -->
    <link rel="stylesheet"
        href="{{ asset('css/style.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/components.css') }}">

    <!-- Start GA -->
    <script async
        src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- END GA -->
</head>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <!-- Header -->
            @include('components.header')

            <!-- Sidebar -->
            @include('components.sidebar')

            <!-- Content -->
            @yield('main')

            <!-- Footer -->
            @include('components.footer')
        </div>
    </div>
    
    @stack('before-scripts')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script> --}}

    <!-- JS Libraies -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Template JS File -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    {{-- foto --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>

    @if(Request::is("tambahbarang") || Request::route()->getName() == 'tampilanbarang')
    <script>
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
                    document.getElementById('results').innerHTML = '<img src="'+data_uri+'" class="img-fluid"/>';
                } );
            }

            let signature;

            function setupSignature(){
                const canvas = document.querySelector('canvas');
                signature = new SignaturePad(canvas);
            }

            $(document).ready(setupSignature)

            $('#clear').click(function() {
                signature.clear()
                $('#signature64').val('');
            });

            $('#simpanEdit123').click(function(){
                let ttd = signature.toDataURL();
                let data = $('#signature64').val(ttd);
            })

            let width = window.screen.width;
            if(width < 480){
                const video = document.querySelector('#camera video');
                const sig = document.querySelector('#sig');
                video.style.width = "16rem";
                sig.style.width = "15rem";
            }

        // var canvas = document.getElementById('signature-pad');

        // var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
        // $('#clear').click(function(e) {
        //     e.preventDefault();
        //     sig.signature('clear');
        //     $("#signature64").val('');
        // });

    </script>
    @endif

    @if (Request::route()->getName() == 'dataedit')
        <script>
            tombolTandaTanganBatal.addEventListener('click', function(){
            containertandatangan.style.display =  'none';
            container2tandatangan.style.display = 'block';
            tombolTandaTangan.style.display = 'block';
            tombolTandaTanganBatal.style.display = 'none';
            signature.clear();
            $('#signature64').val('');
        })
        </script>
    @endif

    @if (Request::is("bukutamu"))
        <script>
            const butModal = document.querySelectorAll(".butModal");
            if(butModal.length > 0){
                butModal.forEach((el) => {
                    el.addEventListener("click", function(){
                        let tempat = [];
                        let key = el.getAttribute("data-id");
                        let data = document.querySelectorAll(`.key${key}`);
                        tempat = [];
                        data.forEach((e) => { 
                            tempat.push(e.value);
                        })
                        const namaPengunjung = document.querySelector(".namaPengunjung");
                        const instansi = document.querySelector(".instansi");
                        const alamat = document.querySelector(".alamat");
                        const potopengunjung = document.querySelector(".potopengunjung");
                        const tandatangan = document.querySelector(".tandatangan");
                        
                        namaPengunjung.innerHTML = tempat[0];
                        instansi.innerHTML = tempat[1];
                        alamat.innerHTML = tempat[2];
                        potopengunjung.setAttribute("src", `storage/${tempat[4]}`);
                        tandatangan.setAttribute("src", `tandatangan/${tempat[3]}`)
                    })
                })
            }

        </script>
    @endif


    @stack('after-script')


    <!-- Page Specific JS File -->
    </body>
    </html>
