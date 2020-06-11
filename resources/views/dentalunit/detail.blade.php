@extends('layouts.app')
@section('title','Detail Obat')
@section('content')
<link rel="stylesheet" type="text/css" href="{{url('assets/js/easyAutocomplete.js')}}">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Detail Obat</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Detail Obat</div>
                <div class="panel-body">
                <div class="row">
                    <table class="table">
                            <tr>
                                <td>Kode Obat</td>
                                <td colspan="2">{{$obat->kode_obat}}</td>
                            </tr>
                            <tr>
                                <td>Nama Obat </td>
                                <td colspan="2">{{$obat->nama_obat}}</td>
                            </tr>
                            <tr>
                                <td>Stok Saat Ini </td>
                                <td colspan="2">{{$obat->qty}}</td>
                            </tr>
                            <tr>
                                <td>Harga Satuan </td>
                                <td>{{$obat->harga_jual}}</td>
                                <td><a href="{{route('stok.ubahHarga',$obat->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a></td>
                            </tr>
                    </table>
                </div>
                </div>
                </div>

                  <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#pengiriman">Riwayat Pengiriman</a></li>
                    <li><a data-toggle="tab" href="#transaksi">Riwayat Penjualan</a></li>
                    <li><a data-toggle="tab" href="#retur">Riwayat Retur Obat</a></li>
                    <li><a data-toggle="tab" href="#rusak">Riwayat Obat Rusak</a></li>
                 </ul>

  <div class="tab-content">
        <div id="pengiriman" class="tab-pane fade in active">
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="list_obat">
                                <tr>
                                    <th>No Faktur</th>
                                    <th>Tanggal Suplai</th>
                                    <th>Nama Suplier</th>  
                                    <th>Qty <br> Bonus Stok</th>
                                    <th>Qty Total</th>
                                    <th>Harga Beli/Item</th>  
                                    <th>Harga Jual/Item</th>  
                                    <th>Harga Total</th>  
                                </tr>
                                <?php $no=1;?>
                                @forelse($detail as $data)
                                <tr>
                                    <td><a href="{{route('stok.detailRiwayat',$data->id)}}">{{$data->no_faktur}}</td>
                                    <td><?= date("d-M-Y",strtotime($data->created_at))?></td>
                                    <td>{{$data->nama_suplier}}</td>
                                    <td>{{$data->qty}} <br> {{$data->bonus_stok}}</td>
                                    <td>{{$data->qty_total}}</td>
                                    <td>{{$data->harga}}</td>
                                    <td>{{$data->harga_jual}}</td>
                                    <td>{{$data->harga_total}}</td>
                                @empty
                                 <td colspan="7"><center><strong>Data tidak ditemukan!</strong></center></td>
                                @endforelse
                                </tr>
                   
                        </table>
                        </div>
              <a href="{{route('stok.riwayat')}}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
            <div id="transaksi" class="tab-pane fade">
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="list_obat">
                                <tr>
                                    <th>No Transaksi</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Nama Kasir</th>  
                                    <th>Qty</th>
                                    <th>Harga/Iitem</th>  
                                    <th>Harga Total</th>  
                                </tr>
                                <?php $no=1;?>
                                @forelse($transaksi as $data)
                                <tr>
                                    <td><a href="{{route('transaksi.detail',$data->id)}}">{{$data->no_transaksi}}</td>
                                    <td><?= date("d-M-Y",strtotime($data->created_at))?></td>
                                    <td>{{$data->kasir}}</td>
                                    <td>{{$data->qty}}</td>
                                    <td>{{$data->harga}}</td>
                                    <td>{{$data->total}}</td>
                                @empty
                                 <td colspan="6"><center><strong>Data tidak ditemukan!</strong></center></td>
                                @endforelse
                                </tr>
                   
                        </table>
                        </div>
              <a href="{{route('stok.riwayat')}}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
                <div id="retur" class="tab-pane fade">
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="list_obat">
                                <tr>
                                    <th>No Retur</th>
                                    <th>Tanggal Retur</th>
                                    <th>Nama Kasir</th>  
                                    <th>Qty</th>
                                    <th>Harga/Iitem</th>  
                                    <th>Harga Total</th>  
                                </tr>
                                <?php $no=1;?>
                                @forelse($retur as $data)
                                <tr>
                                    <td><a href="{{route('retur.detail',$data->id)}}">{{$data->no_retur}}</td>
                                    <td><?= date("d-M-Y",strtotime($data->created_at))?></td>
                                    <td>{{$data->kasir}}</td>
                                    <td>{{$data->jumlah}}</td>
                                    <td>{{$data->harga}}</td>
                                    <td>{{$data->sub_total}}</td>
                                @empty
                                 <td colspan="6"><center><strong>Data tidak ditemukan!</strong></center></td>
                                @endforelse
                                </tr>
                   
                        </table>
                        </div>
              <a href="{{route('stok.riwayat')}}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
                <div id="rusak" class="tab-pane fade">
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="list_obat">
                                <tr>
                                    <th>No Transaksi</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Nama Kasir</th>  
                                    <th>Qty</th>
                                    <th>Harga/Iitem</th>  
                                    <th>Harga Total</th>  
                                    <th>Keterangan</th>  
                                </tr>
                                <?php $no=1;?>
                                @forelse($rusak as $data)
                                <tr>
                                    <td><a href="{{route('obatrusak.detail',$data->id)}}">{{$data->no_obat_rusak}}</td>
                                    <td><?= date("d-M-Y",strtotime($data->created_at))?></td>
                                    <td>{{$data->kasir}}</td>
                                    <td>{{$data->qty}}</td>
                                    <td>{{$data->harga}}</td>
                                    <td>{{$data->sub_total}}</td>
                                    <td>{{$data->keterangan}}</td>
                                @empty
                                 <td colspan="7"><center><strong>Data tidak ditemukan!</strong></center></td>
                                @endforelse
                                </tr>
                   
                        </table>
                        </div>
              <a href="{{route('stok.riwayat')}}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection