@extends('layouts.app')
@section('title','Tambah Pegawai')
@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Tambah Data Pegawai</h1>
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
                                    <!-- <h5 class="card-header">Tambah Data Mahasiswa Koas</h5> -->
                                    <div class="card-body">
                                        <form  method="post" role="form" action="{{url('master-data/pegawai')}}">
										{{ csrf_field() }}
										<div class="form-group">
                                                <!-- <label for="inputText3" class="col-form-label">Nomor Dental Unit</label> -->
                                                <input id="inputText3" type="text"  name="nik" placeholder="NIP" class="form-control">
                                            </div>
											<div class="form-group">
                                                <!-- <label for="inputText3" class="col-form-label">Departemen</label> -->
                                                <input id="inputText3" type="text"  name="nama" placeholder="Nama Pegawai" class="form-control">
                                            </div>
											<div class="form-group">
                                                <!-- <label for="inputText3" class="col-form-label">Departemen</label> -->
                                                <input id="inputText3" type="email" name="email" placeholder="E-Mail" class="form-control">
                                            </div>
											<div class="form-group">
                                                <!-- <label for="inputText3" class="col-form-label">Departemen</label> -->
                                                <input id="inputText3" type="jabatan" name="jabatan" placeholder="Jabatan" class="form-control">
                                            </div>
											<div class="form-row">
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
											<button type="submit" class="btn btn-primary">Simpan</button>
											<button class="btn btn-danger" type="reset">Kosongkan Isian</button>
											<a href="{{url('master-data/pegawai')}}" class="btn btn-warning">Kembali</a>
											</div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

@endsection