@extends('layouts.app')
@section('title','Tambah Departemen')
@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Tambah Dental Unit</h1>
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
                                    <h5 class="card-header">Tambah Dental Unit</h5>
                                    <div class="card-body">
                                        <form  method="post" role="form" action="{{url('master-data/dental-unit/simpan')}}">
										{{ csrf_field() }}
										<div class="form-group">
                                                <label for="inputText3" class="col-form-label">Nomor Dental Unit</label>
                                                <input id="inputText3" type="text"  name="no" placeholder="No. Dental Unit" class="form-control">
                                            </div>
											<div class="form-group">
                                                <label for="inputText3" class="col-form-label">Departemen</label>
                                                <select class="form-control" name="departemen" id="">
													@foreach($departemen as $datas) :
													<option value="{{$datas->id}}">{{$datas->nama_departemen}}</option>
													@endforeach
													</select>
                                            </div>
                                            <h4>Jam Operasional</h4>
												@foreach($jamOperasional as $data)
                                            <label class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" value="{{$data->id}}" name="jam_operasionals[]" class="custom-control-input"><span class="custom-control-label">{{$data->jam_mulai}} - {{$data->jam_selesai}}</span>
                                            </label>	
											@endforeach
											<div class="form-row">
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
											<button type="submit" class="btn btn-primary">Simpan</button>
											<button class="btn btn-danger" type="reset">Kosongkan Isian</button>
											<a href="{{url('master-data/departemen')}}" class="btn btn-warning">Kembali</a>
											</div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

@endsection