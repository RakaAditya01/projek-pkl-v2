<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QrCode</title>
</head>
<body>
    <video id="previewKamera" style="width: 300px;height: 300px;"></video>
    <br>
    
    <script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    
    <?php
    $tgl_now=date("Y-m-d");
    $tgl_exp="2020-02-28";//tanggal expired
    if ($tgl_now >=$tgl_exp )
    {
    echo"<center><h1>siti</h1>
    <h3>kamu pasti wibu<h3></center>";
    }
    else
    {
    ?>
    <!--ISIKAN SCRIPT INDEXNYA DISINI-->
    <?php
    }
    ?>
</body>
</html>