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

<div class="card">
                                    <div class="card-body">
                                        <form method="post" role="form" action="{{url('master-data/koas/simpan')}}">
										{{ csrf_field() }}
										<div class="form-group">
                                                <input type="text"  name="nim" placeholder="NIU (6 digit)" class="form-control">
                                            </div>
											<div class="form-group">
                                                <input type="text"  name="nama" placeholder="Nama Mahasiswa" class="form-control">
                                            </div>
											<div class="form-group">
                                                <input type="text" name="email" placeholder="E-Mail" class="form-control">
                                            </div>
											<div class="form-group">
                                                <input type="text" name="angkatan" placeholder="Angkatan" class="form-control">
                                            </div>
											<div class="form-row">
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
											<button type="submit" class="btn btn-primary">Simpan</button>
											<button class="btn btn-danger" type="reset">Kosongkan Isian</button>
											<a href="{{url('master-data/koas')}}" class="btn btn-warning">Kembali</a>
											</div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
@endsection