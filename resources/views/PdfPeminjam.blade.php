<!DOCTYPE html>
<html>
<head>
	<title>Export Laporan Peminjaman</title>
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
    <h5>Laporan Peminjam</h5>
</center>
<br>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nim</th>
				<th>Nama</th>
				<th>Nama Barang</th>
				<th>Jumlah</th>
				<th>Keterangan</th>
				<th>Expired</th>
				<th>Created</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach ($data as $no=> $row)
			<tr>
				<td>{{ $i++ }}</td>
				<td style="text-align: center">{{$row ->nim}}</td>
                <td style="text-align: center">{{$row ->nama}}</td>
                <td style="text-align: center">{{$row ->nama_barang}}</td>
                <td style="text-align: center">{{$row ->jumlah}}</td>
                <td style="text-align: center">{{$row ->keterangan}}</td>
                <td style="text-align: center">{{$row ->expired_at->format('Y-m-d')}}</td>
                <td style="text-align: center">{{$row ->created_at->format('Y-m-d')}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>