@extends('layouts.app')
@section('title','Riwayat Jadwal Pesanan Dental Unit')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Riwayat Jadwal Pesanan Dental Unit</h1>
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
        <div class="tab-outline">
            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                <li class="nav-item active show">
                    <a class="nav-link active show" id="tab-outline-two" data-toggle="tab" href="#pesananTerakhir"
                        role="tab" aria-controls="profile" aria-selected="false">Pesanan 7 Hari Terakhir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-outline-three" data-toggle="tab" href="#riwayatPesanan" role="tab"
                        aria-controls="contact" aria-selected="false">Riwayat Pesanan</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent2">
                <div class="tab-pane fade active show" id="pesananTerakhir" role="tabpanel"
                    aria-labelledby="tab-outline-two">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIK<br>Nama Pasien</th>
                                <th>No. Dental Unit<br>Tanggal Praktek <br>Departemen </th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1;?>
                            @forelse($transaksiTerbaru as $data)
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>{{$data->nik}}<br>{{$data->nama_pasien}}</td>
                                <td>{{$data->nama_koas}}<br>{{$data->nim}}<br>{{$data->angkatan}}</td>
                                <td>{{$data->no}} <br> {{date("d F Y",strtotime($data->tanggal_pesan))}}
                                    <br>{{$data->nama_departemen}} </td>
                                @if($data->status==0)
                                <td><span class="badge badge-default">Tunda</span></td>
                                @elseif($data->status==1)
                                <td><span class="badge badge-success">Diterima</span></td>
                                @elseif($data->status==2)
                                <td><span class="badge badge-warning">Dialihkan</span></td>
                                @elseif($data->status==3)
                                <td><span class="badge badge-success">Selesai</span></td>
                                @elseif($data->status==4)
                                <td><span class="badge badge-danger">Batal</span></td>
                                @elseif($data->status==5)
                                <td><span class="badge badge-warning">Ubah Jadwal</span></td>
                            </tr>
                            @endif
                            @empty
                            <tr>
                                <td colspan="6"><center>Data Kosong!</center></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{$transaksiTerbaru->render()}}
                </div>
                <div class="tab-pane fade" id="riwayatPesanan" role="tabpanel" aria-labelledby="tab-outline-three">
            <a href="#" data-toggle="modal" data-target="#exportExcel" class="btn btn-success"><i class="fas fa-file-excel"></i>Export Excel</a>
            <div class="modal fade" id="exportExcel" tabindex="-1" role="dialog" aria-labelledby="exportExcelLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exportExcelLabel">Pilih Data</h5>
                                                                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </a>
                                                            </div>
                                                            <div class="modal-body">
                                                            <form method="get" role="form" action="{{route('transaksi.excel')}}">
										{{ csrf_field() }}
                                        <label>Tanggal Mulai</label>
											<div class="form-group">
                                                <input type="date" name="start_date" placeholder="Tanggal Mulai" class="form-control">
                                            </div>
                                        <label>Tanggal Selesai</label>
											<div class="form-group">
                                                <input type="date" name="end_date" placeholder="Tanggal Selesai" class="form-control">
                                            </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="#" class="btn btn-secondary" data-dismiss="modal">Tutup</a>
                                                                <button type="submit" class="btn btn-primary">Expor</button>
                                        </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIK<br>Nama Pasien</th>
                                <th>No. Dental Unit<br>Tanggal Praktek <br>Departemen </th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1;?>
                            @if(auth()->user()->role=='0')
                            @forelse($riwayatTransaksiAll as $data)
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>{{$data->nik}}<br>{{$data->nama_pasien}}</td>
                                <td>{{$data->nama_koas}}<br>{{$data->nim}}<br>{{$data->angkatan}}</td>
                                <td>{{$data->no}} <br> {{date("d F Y",strtotime($data->tanggal_pesan))}}
                                    <br>{{$data->nama_departemen}} </td>
                                @if($data->status==0)
                                <td><span class="badge badge-default">Tunda</span></td>
                                @elseif($data->status==1)
                                <td><span class="badge badge-success">Diterima</span></td>
                                @elseif($data->status==2)
                                <td><span class="badge badge-warning">Dialihkan</span></td>
                                @elseif($data->status==3)
                                <td><span class="badge badge-success">Selesai</span></td>
                                @elseif($data->status==4)
                                <td><span class="badge badge-danger">Batal</span></td>
                                @elseif($data->status==5)
                                <td><span class="badge badge-warning">Ubah Jadwal</span></td>
                            </tr>
                            @endif
                            @empty
                            <tr>
                                <td colspan="6"><center>Data Kosong!</center></td>
                            </tr>
                            @endforelse
                            @elseif(auth()->user()->role=='1')
                            @forelse($riwayatTransaksiAll as $data)
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>{{$data->nik}}<br>{{$data->nama_pasien}}</td>
                                <td>{{$data->nama_koas}}<br>{{$data->nim}}<br>{{$data->angkatan}}</td>
                                <td>{{$data->no}} <br> {{date("d F Y",strtotime($data->tanggal_pesan))}}
                                    <br>{{$data->nama_departemen}} </td>
                                @if($data->status==0)
                                <td><span class="badge badge-default">Tunda</span></td>
                                @elseif($data->status==1)
                                <td><span class="badge badge-success">Diterima</span></td>
                                @elseif($data->status==2)
                                <td><span class="badge badge-warning">Dialihkan</span></td>
                                @elseif($data->status==3)
                                <td><span class="badge badge-success">Selesai</span></td>
                                @elseif($data->status==4)
                                <td><span class="badge badge-danger">Batal</span></td>
                                @elseif($data->status==5)
                                <td><span class="badge badge-warning">Ubah Jadwal</span></td>
                            </tr>
                            @endif
                            @empty
                            <tr>
                                <td colspan="6"><center>Data Kosong!</center></td>
                            </tr>
                            @endforelse
                            @elseif(auth()->user()->role=='2')
                            @forelse($riwayatTransaksi as $data)
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>{{$data->nik}}<br>{{$data->nama_pasien}}</td>
                                <td>{{$data->nama_koas}}<br>{{$data->nim}}<br>{{$data->angkatan}}</td>
                                <td>{{$data->no}} <br> {{date("d F Y",strtotime($data->tanggal_pesan))}}
                                    <br>{{$data->nama_departemen}} </td>
                                @if($data->status==0)
                                <td><span class="badge badge-default">Tunda</span></td>
                                @elseif($data->status==1)
                                <td><span class="badge badge-success">Diterima</span></td>
                                @elseif($data->status==2)
                                <td><span class="badge badge-warning">Dialihkan</span></td>
                                @elseif($data->status==3)
                                <td><span class="badge badge-success">Selesai</span></td>
                                @elseif($data->status==4)
                                <td><span class="badge badge-danger">Batal</span></td>
                                @elseif($data->status==5)
                                <td><span class="badge badge-warning">Ubah Jadwal</span></td>
                            </tr>
                            @endif
                            @empty
                            <tr>
                                <td colspan="6"><center>Data Kosong!</center></td>
                            </tr>
                            @endforelse
                            @endif
                        </tbody>
                    </table>
                    {{$riwayatTransaksi->render()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
