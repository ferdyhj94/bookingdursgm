@extends('layouts.app')
@section('title','Pegawai')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Pegawai</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div>
    <div>
        <div class ="col-md-6">
            <div class="btn-group" role="group">
                <a href="{{route('pegawai.tambah')}}" class="btn btn-primary">Tambah Data</a></li>
                
        </div>
    </div>
</div>
@if(session()->has('message'))
<div class="form-group">
    <div class="alert alert-dismissable alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        {{session()->get('message')}}
    </div>
</div>
@endif

<div class="table-responsive table-bordered">
    <table class="table">
        <thead>
            <tr>
                <th>Nomor</th>
                <th>NIP</th>
                <th>Nama Pegawai</th>
                <th>Jabatan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no=1;
            ?>
            @forelse($pegawai as $data)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$data->nik}}</td>
                <td>{{$data->nama}}</td>
                <td>{{$data->jabatan}}</td>
                @if($data->status=='0')
                    <td>Tidak Aktif</td>
                @elseif($data->status=='1')
                <td>Aktif</td>
                    @endif
                    <td>
                    @if($data->status=='0')
        <button class="btn btn-danger" data-toggle="tooltip" data-placement="top"
                                        title="Non Aktif"><i class="fas fa-power-off"><a href="{{route('pegawai.activate',$data->id)}}"></a></i></button>
            @else($data->status=='1')
            <button class="btn btn-success" data-toggle="tooltip" data-placement="top"
                                        title="Aktif"><i class="fas fa-power-off"><a href="{{route('pegawai.deactive',$data->id)}}"></a></i></button>
                                        @endif
                                        || <a href="{{route('pegawai.edit',$data->id)}}"><button class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Ubah">
                                    <i class="fas fa-pencil-alt"></i></button></a> </td>    
                                </tr>
    @empty
    <tr>
        <td colspan="6"><center><strong>Kosong!</strong></center></td>
    </tr>
@endforelse
</tbody>
</table>
{{$pegawai->render()}}

</div>
</div>
@endsection