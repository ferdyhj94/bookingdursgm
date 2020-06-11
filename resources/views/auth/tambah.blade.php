@extends('layouts.app')
@section('title','Tambah Departemen')
@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Tambah Departemen</h1>
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
<form method="post" role="form" action="{{url('master-data/dental-unit/simpan')}}" id="form">
	{{ csrf_field() }}
	<div class="row">
		<div class="col-lg-8">
			<div class="panel panel-default">
				<div class="panel-heading">Form Tambah</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-8">
							<label>No. Dental Unit</label>
							<input type="text" class="form-control" name="no" placeholder="No. Dental Unit">	
						</div>	
						<div class="col-lg-8">
							<label>Departemen</label>
							<select class="form-control" name="departemen" id="">
							@foreach($departemen as $datas) :
							<option value="{{$datas->id}}">{{$datas->nama_departemen}}</option>
							@endforeach
							</select>
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