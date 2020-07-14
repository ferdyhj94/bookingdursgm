@extends('layouts.app')
@section('title','Beranda')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Selamat datang, {{Auth::user()->name}}</h1>
    </div>
</div>
                            <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="card" id="blockquote">
                                        <h5 class="card-header">Pengantar</h5>
                                        <div class="card-body">
                                            <blockquote class="blockquote">
                                                <p class="mb-0">Sistem Informasi Pesan Dental Unit RSGM UGM Prof. Soedomo </p>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            <!-- / end of panel-heading -->
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Status Pesanan</h5>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                <th scope="col">No. Dental Unit <br>Departemen</th>
                                                @if(auth()->user()->role=='1')
                                                <th scope="col">NIM<br>Nama Koas</th>
                                                @endif
                                                <th scope="col">Tanggal Pesan <br> Jam Mulai - Jam Selesai</th>
                                                <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($unverifiedBooking as $data)
                                        <tr>
                                        <td>{{$data->no}} <br>{{$data->nama_departemen}}</td>
                                        <td>{{date("d F Y",strtotime($data->tanggal_pesan))}} <br>{{$data->jam_mulai}} - {{$data->jam_selesai}}</td>
                                        <td>
                                        @if($data->status==0)
                                        <span class="badge badge-warning">Pending</span>
                                        @elseif($data->status==1)              
                                        <span class="badge badge-success">Verified</span>
                                        @endif
                                        </td>
                                        </tr>
                                        @empty
                                        <tr>
                                        <td colspan="3">
                                        <center>
                                        Kosong!
                                        </center>  
                                        </td>
                                        </tr>
                                        @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!--end of table status pemesanan-->
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Ketersediaan Dental Unit Hari Ini</h5>
                                <div class="card-body">
                                    <div class="table-responsive ">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                <th scope="col">Departemen</th>
                                                <th scope="col">Jumlah DU</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($countDentalUnitNow as $data)
                                                <tr>
                                        <td>{{$data->nama_departemen}}</td>
                                        <td>{{$data->total_du}}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                        <td colspan="2">
                                        <center>
                                        Kosong!
                                        </center>  
                                        </td>
                                        </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> <!--end table ketersediaan-->
                            </div>
@endsection