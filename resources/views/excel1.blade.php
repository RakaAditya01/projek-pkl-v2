<table>
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">NIM</th>
            <th scope="col">Nama</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">keterangan</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Tgl.Dipinjam</th>
            <th scope="col">Tgl.Pengembalian</th>
        </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        @endphp
        <tr>
            @foreach ($data as $no => $row)
            <td>{{$no + 1}}</td>
            <td>{{$row->nim}}</td>
            <td>{{$row->nama}}</td>
            <td>{{$row->nama_barang}}</td>
            <td>{{$row->keterangan}}</td>
            <td>{{$row->jumlah}}</td>
            <td>{{$row ->created_at->format('Y-m-d')}}</td>
            <td>{{$row ->expired_at->format('Y-m-d')}}</td>
            <td>
           @endforeach
		</tbody>
	</table>
 