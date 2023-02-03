<!DOCTYPE html>
<html>
<head>
	<title>PDF USER</title>
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
    <h5>Data User</h5>
</center>
<br>

	<table class='table table-bordered'>
		<thead>
			<tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Nim</th>
                <th scope="col">Email</th>
                <th scope="col">Expired</th>
                <th scope="col">Role</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach ($data as $no=> $row)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$row ->name}}</td>
                <td>{{$row ->nim}}</td>
                <td>{{$row ->email}}</td>
                <td>{{$row ->expired_at->format('Y-m-d')}}</td>
                <td>{{$row ->role}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>