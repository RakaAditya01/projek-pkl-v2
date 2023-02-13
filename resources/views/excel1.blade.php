<table>
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">NIM</th>
            <th scope="col">Nama</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">keterangan</th>
            <th scope="col">kepemilikan</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Tgl.Dipinjam</th>
            <th scope="col">Tgl.Pengembalian</th>
        </tr>
    </thead>
    <tbody>
        @php $i=1 @endphp
			@foreach ($data as $no=> $row)
        <tr>
            <td>{{$no + 1}}</td>
            <td>{{$row->nim}}</td>
            <td>{{$row->nama}}</td>
            <td>{{$row->nama_barang}}</td>
            <td>{{$row->keterangan}}</td>
            <td>{{$row->kepemilikan}}</td>
            <td>{{$row->jumlah}}</td>
            <td>{{$row ->created_at->format('Y-m-d')}}</td>
            <td>{{$row ->expired_at->format('Y-m-d')}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

 