<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NIU</th>
            <th>Nama Koas</th>
            <th>Departemen</th>
            <th>No.Dental Unit</th>
            <th>Jam Mulai</th>
            <th>Jam Selesai</th>
            <th>Tanggal Praktek</th>
            <th>Petugas Verifikasi</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1 @endphp
    @foreach($transaksi as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->nim }}</td>
            <td>{{ $data->nama_koas }}</td>
            <td>{{ $data->nama_departemen }}</td>
            <td>{{ $data->no }}</td>
            <td>{{ $data->jam_mulai }}</td>
            <td>{{ $data->jam_selesai }}</td>
            <td>{{ $data->tanggal_praktek }}</td>
            <td>{{ $data->petugas_verifikasi }}</td>
                                @if($data->status==0)
                                <td>Tunda</td>
                                @elseif($data->status==1)
                                <td>Diterima</td>
                                @elseif($data->status==2)
                                <td>Dialihkan</td>
                                @elseif($data->status==3)
                                <td>Selesai</td>
                                @elseif($data->status==4)
                                <td>Batal</td>
                                @elseif($data->status==5)
                                <td>Ubah Jadwal</td>
                                @endif
        </tr>
    @endforeach
    </tbody>
</table>