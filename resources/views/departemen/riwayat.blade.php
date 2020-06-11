@extends('layouts.app')
@section('title','Riwayat Obat Masuk')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Riwayat Obat Masuk</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div>
    <div class="col-md-6">
    <a href="{{url('stok-obat/riwayat/ekspor/xls')}}"><button type="button" class="btn btn-outline btn-primary">Ekspor Data Excel</button></a>
    <a href="{{route('riwayat.ekspor-pdf')}}"><utton type="button" class="btn btn-outline btn-primary">Ekspor Data PDF</button></a>
    </div>
    <div class ="col-md-6">
        <label>Periode</label>
        <form action="stok/riwayat/periode/" method="get">
            {{csrf_field()}}
    <input class="form-control" name="periode" id="dates" type="text">
    <input class="btn btn-primary" type="submit" value="Cari">
        </form>
    </div>
   
</div>

@if (Session::has('message'))
<div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <p>{{ Session::get('message') }}</p>
</div>

@endif

<div class="table-responsive table-bordered">
	<table class="table">
        <thead>
            <tr>
                <th>Nomor</th>
                <th>Nama suplier
                <br>No. Faktur</th>
                <th>Tanggal Transaksi</th>
                <th>Total Transaksi</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no=1;
            ?>
            @forelse($riwayat as $data)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$data->nama_suplier}}<br>
                {{$data->no_faktur}}</td>
                <td><?= date("d-M-Y",strtotime($data->created_at)) ?></td>
                <td>{{$data->total}}</td>
                <td>{{$data->keterangan}}</td>
                <td><a href="stok/detail-riwayat/{{$data->id}}" class="btn btn-primary">Detail</a></td>
            </tr>
            @empty
            <tr>
                <td colspan="6"><center><strong>Kosong!</strong></center></td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{$riwayat->render()}}
</div>
 <script type="text/javascript">
    $('input[name="periode"]').daterangepicker();
</script>
@endsection