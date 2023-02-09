<!DOCTYPE html>
<html>
<head>
	<title>DATA BARANG</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>

<center>
    <h5>Laporan Barang</h5>
</center>
<br>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Stock</th>
				<th>Anggaran</th>
				<th>Kepemilikan</th>
				<th>Serial Number</th>
				<th>Barcode</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach ($data as $no=> $row)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$row ->nama_barang}}</td>
                <td>{{$row ->stock}}</td>
                <td>{{$row ->anggaran}}</td>
                <td>{{$row ->kepemilikan}}</td>
                <td>{{$row ->serialnumber}}</td>
                <td>{{$row ->scan}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>