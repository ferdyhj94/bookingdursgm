@extends('layouts.app')
@section('title','Mahasiswa Koas')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Mahasiswa Koas</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div>
    <div>
        <div class ="col-md-6">
            <div class="btn-group" role="group">
                <a href="{{route('koas.tambah')}}" class="btn btn-primary">Tambah Data</a></li>
                
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
                <th>NIU</th>
                <th>Mahasiswa Koas</th>
                <th>Angkatan</th>
                <th>Status</th>
                <!-- <th>Aksi</th> -->
            </tr>
        </thead>
        <tbody>
            <?php 
            $no=1;
            ?>
            @forelse($koas as $data)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$data->nim}}</td>
                <td>{{$data->nama}}</td>
                <td>{{$data->angkatan}}</td>
                @if($data->status=='0') :
                    <td>Tidak Aktif</td>
                @elseif($data->status=='1')
                <td>Reguler</td>
                @elseif($data->status=='2')
                    <td>Inhall</td>
                    @endif
    </tr>
    @empty
    <tr>
        <td colspan="6"><center><strong>Kosong!</strong></center></td>
    </tr>
@endforelse
</tbody>
</table>
{{$koas->render()}}

</div>
</div>
@endsection