@extends('layouts.app')
@section('title','Tambah Stok Obat')
@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Impor Data Stok Obat</h1>
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
{{ csrf_field() }}
<form method="post" action="{{route('stok.importSubmit')}}" enctype="multipart/form-data">
	{{ csrf_field() }}

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Unggah File Excel Stok Obat</div>
				@if (Session::has('message'))
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
					<p>{{ Session::get('message') }}</p>
				</div>
				@endif

				<div class="panel-body">
					<div class="row">
						<div class="col-lg-6">
							<label>Dokumen</label>
							<input type="file" class="form-control" name="import_stok" placeholder="Berkas">	

							<button type="submit" class="btn btn-primary">Simpan</button>
						</form>
						<a href="{{route('stok.index')}}" class="btn btn-warning">Kembali</a>

					</div>
				</div>
			</div>
		</div>
	</div>

</form>

@endsection