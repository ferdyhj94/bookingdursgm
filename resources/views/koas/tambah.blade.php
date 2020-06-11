@extends('layouts.app')
@section('title','Tambah Mahasiswa Koas')
@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Tambah Mahasiswa Koas</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
@if(count($errors))
<div class="form-group">
	<div class="aler alert-danger"> 
		<ul>
			@foreach($errors->all() as $error)
			<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>
</div>
@endif
@if(session()->has('message'))
<div class="form-group">
	<div class="alert alert-success">
		{{session()->get('message')}}
	</div>
</div>
@endif

<div class="row">
<form method="post" role="form" action="{{url('master-data/koas/simpan')}}" id="form">
	{{ csrf_field() }}
	<div class="row">
		<div class="col-lg-8">
			<div class="panel panel-default">
				<div class="panel-heading">Form Tambah</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-4">
							<label>NIM</label>
							<input type="text" class="form-control" name="no" placeholder="NIM">	
						</div>	
						<div class="col-lg-4">
							<label>Nama Mahasiswa Koas</label>
							<input type="text" class="form-control" name="nama" placeholder="Nama Mahasiswa Koas">
						</div>		
                        <div class="col-lg-4">
							<label>Angkatan</label>
							<input type="text" class="form-control" name="angkatan" placeholder="Angkatan">
						</div>		
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button class="btn btn-danger" type="reset">Kosongkan Isian</button>
					<a href="{{url('master-data/departemen')}}" class="btn btn-warning">Kembali</a>
</form>
</div>

@endsection