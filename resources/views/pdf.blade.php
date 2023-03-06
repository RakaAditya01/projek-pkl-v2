<!doctype html>
<html lang="en">
    <!-- Bootstrap CSS -->
    {{-- <link href='https://fonts.googleapis.com/css?family=Libre Barcode 39' rel='stylesheet'> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"
        name="viewport">
    <link rel="shortcut icon" href="img/pnj.ico" type="image/x-icon">
    <title>Export PDF SAPRAS</title>
    <style>
        @font-face {
          font-family: 'Libre Barcode 39';
          src: url({{ storage_path("fonts.LibreBarcode39-Regular.ttf") }}') format('truetype');
        }

        .scan{
          font-family: 'Libre Barcode 39',sans-serif;
          font-family: 'Libre Barcode 39';font-size: 35px;"
          text-decoration: underline;
          text-decoration: overline;
          margin-left:3px;
        }
    </style>
  <body>
    <h1><center>CODE QR BARANG SAPRAS</center></h1>
    <table>
      @php
          $i = 0;
      @endphp
      
      @foreach ($data as $dat)
      @php
          if ($i > 1) $i = 0;
      @endphp
      @if ($i == 0)
      <tr>
      @endif
        <td>
          <div class="col-md-3">
            <div class="card m-2" style="width: 19rem">
              <div class="card-body text-center">
              <img src="../public/img/pnj1.png" style="width: 60px" alt="">
                <p class="p" style="margin-bottom: -5px;">{{ $dat->nama_barang }}</p>
                <p class="scan">*{{ $dat->scan }}*</p>
                <p class="cn1" style="margin-top: -25px; margin-left:13px">{{ $dat->scan }}</p>
                <p class="ci1" style="margin-top: -15px; margin-left:10px">{{ $dat->serialnumber }}</p>
              </div>
            </div>
          </div>
        </td>
        @if ($i == 2)
            
        </tr>
        @endif
        @php
            $i++;
        @endphp
      @endforeach
    </table>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>