@extends('layouts.app')
@section('title','Pengguna')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Pengguna</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- <div>
    <div>
        <div class ="col-md-6">
            <div class="btn-group" role="group">
                <a href="{{route('pengguna.tambah')}}" class="btn btn-primary">Tambah Data</a></li>
                
        </div>
    </div>
</div> -->
@if(session()->has('message'))
<div class="form-group">
    <div class="alert alert-dismissable alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        {{session()->get('message')}}
    </div>
</div>
@endif
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <!-- <h5 class="card-header"></h5> -->
                                <div class="card-body">
                                    <div class="table-responsive ">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Nomor</th>
                                                    <th>Username <br>E-Mail</th>
                                                    <th>Nama</th>
                                                    <th>Role</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
            $no=1;
            ?>
            @forelse($pengguna as $data)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$data->username}}<br>{{$data->email}}</td>
                <td>{{$data->name}}</td>
                @if($data->role=='0')
                <td>Admin</td>
                @elseif($data->role=='1')
                <td>Pegawai</td>
                @elseif($data->role=='2')
                    <td>Mahasiswa Koas</td>
                    @endif
    </tr>
    @empty
    <tr>
        <td colspan="6"><center><strong>Kosong!</strong></center></td>
    </tr>
@endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
@endsection