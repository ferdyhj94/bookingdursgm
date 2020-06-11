@extends('layouts.app')
@section('title','Detail Riwayat Obat Masuk')
@section('content')
<link rel="stylesheet" type="text/css" href="{{url('assets/js/easyAutocomplete.js')}}">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Detail Riwayat Obat Masuk</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Detail Transaksi</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>No. Faktutr</label>
                            <input type="text" class="form-control" value="{{$riwayat->no_faktur}}" readonly>    
                            <label>Nama Suplier</label>
                            <input type="text" class="form-control" value="{{$riwayat->nama_suplier}}" readonly>   
                            <label>Tanggal Transaksi</label>
                            <input type="text" class="form-control" value="{{$riwayat->created_at}}" readonly>   
                        </div>
                        <div class="col-lg-6">
                            <label>Diskon</label>
                            <input type="text" class="form-control" value="{{$riwayat->diskon}}" readonly>
                            <label>PPn</label>
                            <input type="text" class="form-control" value="{{$riwayat->ppn}}" readonly>
                            <label>Total</label>
                            <input type="text" class="form-control" value="{{$riwayat->total}}" readonly> 
                        </div>
                    </div>
                    <label><h2>Obat</h2></label>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="list_obat">
                                    <tr>
                                     <th>Nomor</th>
                                     <th>Kode Obat <br> Nama Obat</th>
                                     <th>Qty <br> Bonus Stok</th>
                                     <th>Qty Total</th>
                                     <th>Kadaluarsa</th>
                                     <th>Harga <br> Harga Jual</th>                                   
                                 </tr>
                                 <?php $no=1;?>
                                 @forelse($detail as $data)
                                 <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$data->kode_obat}} <br> {{$data->nama_obat}}</td>
                                    <td>{{$data->qty}} <br> {{$data->bonus_stok}}</td>
                                    <td>{{$data->qty_total}}</td>
                                    <?php if(strtotime($data->tgl_kadaluarsa) < strtotime('-30 days') ): ?>
                                    <td style="background-color:red"><?= date("M-Y",strtotime($data->tgl_kadaluarsa)) ?></td>
                                <?php else: ?>
                                <td><?= date("M-Y",strtotime($data->tgl_kadaluarsa)) ?></td>
                            <?php endif ?>
                            <td>{{$data->harga}} <br> {{$data->harga_jual}}</td>
                        </tr>
                        @empty
                        <td colspan="5"><center><strong>Kosong!</strong></center></td>
                        @endforelse
                        <tfoot>
                                    <tr>
                                        <td colspan="5"><strong>Sub Total</strong></td>
                                        <td>{{$data->harga_total}}</td>
                                    </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <a href="{{route('stok.riwayat')}}" class="btn btn-primary">Kembali</a>
    </div>
</div>
</div>
</div>
@endsection

