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
<form method="post" role="form" action="{{url('master-data/pegawai')}}" id="form">
	{{ csrf_field() }}
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Form Tambah</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-4">
							<label>NIK</label>
							<input type="text" class="form-control" name="nik" placeholder="NIK">	
						</div>	
						<div class="col-lg-4">
							<label>Nama Pegawai</label>
							<input type="text" class="form-control" name="nama" placeholder="Nama Pegawai">
						</div>		
                        <div class="col-lg-4">
							<label>E-Mail</label>
							<input type="email" class="form-control" name="email" placeholder="Angkatan">
						</div>	
						<div class="col-lg-4">
							<label>Jabatan</label>
							<input type="text" class="form-control" name="jabatan" placeholder="Jabatan">
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