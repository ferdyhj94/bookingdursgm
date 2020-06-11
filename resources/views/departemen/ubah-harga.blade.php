@extends('layouts.app')
@section('title','Ubah Harga Obat')
@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Ubah Harga Obat</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
@if ($errors->any())
<div class="alert alert-danger">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
<form method="post" action="{{route('stok.simpanUbahHarga')}}">
	{{ csrf_field() }}

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Harga Obat Baru</div>
				@if (Session::has('message'))
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
					<p>{{ Session::get('message') }}</p>
				</div>
				@endif

				<div class="panel-body">
					<div class="row">
						<div class="col-lg-6">
							<input type="hidden" class="form-control" name="id" value="{{$obat->id}}">	
							<label>Haga Saat Ini</label>
							<input type="text" class="form-control" value="{{$obat->harga_jual}}" readonly>	
							<label>Haga Baru</label>
							<input type="text" class="form-control" name="harga_baru" placeholder="Harga Baru">	

							<button type="submit" class="btn btn-primary">Simpan</button>
						</form>
						<a href="{{route('stok.detail',$obat->kode_obat)}}" class="btn btn-warning">Kembali</a>

					</div>
				</div>
			</div>
		</div>
	</div>

</form>

@endsection