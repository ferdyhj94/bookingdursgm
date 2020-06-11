@extends('layouts.app')
@section('title','Dental Unit')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dental Unit</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div>
    <div>
        <div class ="col-md-6">
            <div class="btn-group" role="group">
                <a href="{{route('dentalUnit.tambah')}}" class="btn btn-primary">Tambah Data</a></li>
                
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
                <th>Dental Unit</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no=1;
            ?>
            @forelse($dentalUnit as $data)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$data->no}}</td>
                <td>{{$data->nama_departemen}}</td>
                @if($data->role=='0') :
                    <td>Tersedia</td>
                @elseif($data->role=='1') :
                <td>Pending Booking</td>
                @elseif($data->role=='2') :
                    <td>Booking</td>
                    @endif
        <td><button type="button" data-toggle="modal" data-target="#hapusObat" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
    </tr>
    @empty
    <tr>
        <td colspan="6"><center><strong>Kosong!</strong></center></td>
    </tr>
@endforelse
</tbody>
</table>
{{$dentalUnit->render()}}

</div>
</div>
@endsection