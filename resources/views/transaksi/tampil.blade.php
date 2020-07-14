@extends('layouts.app')
@section('title','Pencarian Jadwal Pesanan Dental Unit')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Daftar Pesanan Dental Unit</h1>
    </div>
</div>
@if ($errors->any())
<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="section-block">
        <div class="card">
            <h5 class="card-header">Recent Orders</h5>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-light">
                            <tr class="border-0">
                                <th class="border-0">No.</th>
                                <th class="border-0">Nama <br> NIM</th>
                                <th class="border-0">No. Dental Unit <br> Departemen</th>
                                <th class="border-0">Tanggal Praktek <br> Jam </th>
                                <th class="border-0">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1;?>
                            @forelse($resTransaksi as $data)
                            <tr>
                                <form method="post" action="{{route('transaksi.verifikasi',$data->id_transaksi)}}">
                                    {{ csrf_field() }}
                                    <td><?= $no++ ?></td>
                                    <td> {{$data->nama_koas}} <br> {{$data->nim}} </td>
                                    <td> {{$data->no}} <br> {{$data->nama_departemen}} </td>
                                    <td>{{date("d M Y",strtotime($data->tanggal_pesan))}}<br>{{date("H:i",strtotime($data->jam_mulai))}}
                                        - {{date("H:i",strtotime($data->jam_selesai))}} </td>
                                    <td>
                                        <button value="verifikasi" name="submit"
                                            class="btn btn-success">Verifikasi</button>
                                        <button value="batal" name="submit" class="btn btn-danger">Batal</button>
                                    </td>
                                </form>
                            </tr>
                            @empty
                            <tr>
                                <td>
                                    <center>Data tidak ditemukan!</center>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
