<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    {{-- <link href='https://fonts.googleapis.com/css?family=Libre Barcode 39' rel='stylesheet'> --}}
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Export PDF Laravel 8!</title>
    <style>
        @font-face {
          font-family: 'Libre Barcode 39';
          src: url({{ storage_path("fonts/LibreBarcode39-Regular.ttf") }}') format('truetype');
        }

        .scan{
          font-family: 'Libre Barcode 39',sans-serif;
          font-family: 'Libre Barcode 39';font-size: 22px;"
          text-decoration: underline;
          text-decoration: overline;
          
        }

        .tengah {
          display:block;
          margin: auto;
          width: 40%;
          border: 1px solid black

          
        }
    </style>
  </head>
  <body>
    <div class="">
      <h1><center>CODE QR BARANG SAPRAS</center></h1>
      @php
          $no = 0;
      @endphp
      @foreach ($data as $data)
        <div class="d-flex">
            <p class="" style="margin-bottom: -5px; margin-left:50px">{{ $data->nama_barang }}</p>
            {{-- <div class="border-bottom tengah "></div> --}}
            {{-- <hr> --}}
            <p class="scan">{{ $data->scan }}</p>
            <p class="cn1" style="margin-top: -25px; margin-left:10px">{{ $data->scan }}</p>
          </div>
        </div>
      </div>
      @endforeach 

      {{-- @foreach ($data as $data)
      <div style="display: flex; justify-content: space-between">
        <img src="..\public\img\pnj1.png" style="height: 100px; width: 100px; float:left; text-align:justify;" alt="ini logo PNJ">
        
        <div>
          <p class="text-center">{{ $data->nama_barang }}</p>
          <div class="border-bottom tengah "></div>
          <p class="scan text-center">{{ $data->scan }}</p>
          <p class="cn1 text-center" style="margin-top: -20px">{{ $data->scan }}</p>
        </div>
      </div>
      @endforeach  --}}
                  
                    {{-- <tr>
                        <th scope="row">{{ ++$no }}</th>
                        <td class="barang">{{ $data->nama_barang }}</td>
                        <td class="scan">{{ $data->scan }}</td>
                        <td class="cn1">{{ $data->scan }}</td>
                      </tr> --}}
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>