
	<table>
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
 