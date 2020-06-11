@extends('layouts.app')
@section('title','Riwayat Jadwal Pesanan Dental Unit')
@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Riwayat Jadwal Pesanan Dental Unit</h1>
	</div>
	<!-- /.col-lg-12 -->
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
                                <!-- <h5 class="section-title">Outline Tabs</h5>
                                <p>Takes the basic nav from above and adds the .nav-tabs class to generate a tabbed interface..</p>
                            </div> -->
                            <div class="tab-outline">
                                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                    <li class="nav-item active show">
                                        <a class="nav-link active show" id="tab-outline-two" data-toggle="tab" href="#pesananTerakhir" role="tab" aria-controls="profile" aria-selected="false">Pesanan Terakhir</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab-outline-three" data-toggle="tab" href="#riwayatPesanan" role="tab" aria-controls="contact" aria-selected="false">Riwayat Pesanan</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent2">
                                    <div class="tab-pane fade active show" id="pesananTerakhir" role="tabpanel" aria-labelledby="tab-outline-two">
                                    <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>No. RM</th>
                                    <th>No. Dental Unit<br>Tanggal Praktek <br>Departemen </th>
                                    <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no=1;?>
                                    @forelse($transaksiTerbaru as $data)
                                    <tr>
                                    <td><?= $no++ ?></td>
                                    <td>{{$data->no_rm}}</td>
                                    <td>{{$data->no}} <br> {{date("d F Y",strtotime($data->tanggal_pesan))}} <br>{{$data->nama_departemen}} </td>
                                    @if($data->status==0):
                                    <td><span class="badge badge-warning"> Tunda</span></td>
                                    <td><button class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash-alt"><a href="{{route('transaksi.verifikasi',$data->id_transaksi)}}"></a></i></button> ||
                                     <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Ubah Jadwal"><i class="fas fa-pencil-alt"><a href="{{route('transaksi.verifikasi',$data->id_transaksi)}}"></a></i></button</td>
                                    @elseif($data->status==1):
                                    <td><span class="badge badge-success">Diterima</span></td>
                                    </tr>
                                    @endif
                                    @empty
                                    <tr>
                                    <td colspan="5">Data Kosong!</td>
                                    </tr>
                                    @endforelse
                                    </tbody>
                                    </table>
                                    {{$transaksiTerbaru->render()}}
                                    </div>
                                    <div class="tab-pane fade" id="riwayatPesanan" role="tabpanel" aria-labelledby="tab-outline-three">
                                    <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>No. RM</th>
                                    <th>No. Dental Unit<br>Tanggal Praktek <br>Departemen </th>
                                    <th>Status</th>
                                    <!-- <th>Aksi</th> -->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no=0;?>
                                    @forelse($riwayatTransaksi as $data)
                                    <tr>
                                    <td><?= $no++ ?></td>
                                    <td>{{$data->no_rm}}</td>
                                    <td>{{$data->no}} <br> {{date("d F Y",strtotime($data->tanggal_pesan))}} <br>{{$data->nama_departemen}} </td>
                                    @if($data->status==0):
                                    <td>Tunda</td>
                                    @elseif($data->status==1):
                                    <td>Diterima</td>
                                    </tr>
                                    @endif
                                    @empty
                                    <tr>
                                    <td colspan="5">Data Kosong!</td>
                                    </tr>
                                    @endforelse
                                    </tbody>
                                    </table>
                                    {{$riwayatTransaksi->render()}}
                                    </div>
                                    </div>
                                </div>
                                </div>
                                </div>
@endsection