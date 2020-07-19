@extends('layouts.app')
@section('title','Pemesanan Dental Unit')
@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Pemesanan Dental Unit</h1>
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
<form method="get" action="{{route('dentalUnit.hasilPencarian')}}">
	{{ csrf_field() }}                                                                                      
	<div class="row">
				@if (Session::has('message'))
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
					<p>{{ Session::get('message') }}</p>
				</div>
				@endif
				<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <img class="img-fluid" src="{{url('storage/denahtemp.png')}}" alt="Denah dental unit">
                                    <div class="card-body">
                                        <h3 class="card-title">Keterangan</h3>
                                        <p class="card-text">Hijau : Tersedia</p>
                                        <p class="card-text">Putih : Tidak digunakan/cadangan</p>
                                        <!-- <p class="text-muted">Last updated 3 mins ago</p> -->
                                    </div>
                                </div>
                            </div>
				<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Pencarian Data Dental Unit</h5>
                                <div class="card-body">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom01">Departemen</label>
												<select class="form-control" name="departemen" required>
													@foreach($departemen as $data)
													<option value="{{$data->id}}">{{$data->nama_departemen}}</option>
													@endforeach
													</select>
							                      <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom02">Tanggal Praktek</label>
												<input type="date" class="form-control" name="tanggal_praktek" required>	
                                                <!-- <div class="valid-feedback">
                                                    Looks good!
                                                </div> -->
                                            </div>
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom02">Jam Praktek</label>
												<select class="form-control" name="jam_operasionals" required>
													@foreach($jamOperasional as $data)
													<option value="{{$data->id}}">{{$data->jam_mulai}} - {{$data->jam_selesai}}</option>
													@endforeach
													</select>
							                      <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
											<button type="submit" class="btn btn-primary">Cari</button>
                                        </div>
										</div>
			</div>
			</div>
	</div>
</form>
@if(!empty($resDentalUnit))
@foreach($resDentalUnit as $data)
					<!-- <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12"> -->
							<div class="card">
                                    <div class="card-header">
									<h3 class="card-title"> {{$data->nama_departemen}}</h3>
                                    </div>
                                    <div class="card-body">
									<p class="card-text">Tanggal : <?= date("d-m-Y",strtotime($tanggalPesan))?></p>
									<p class="card-text">Nomor Dental Unit : {{$data->no}}</p>
									<p class="card-text">Jam : {{$data->jam_mulai}} - {{$data->jam_selesai}}</p>
                                    </div>
                                    <div class="card-footer p-0 text-center">
                                        <div class="card-footer-item card-footer-item-bordered">
										<a href="daftar/{{$data->id_dental_unit}}/{{$tanggalPesan}}" class="btn btn-primary">Pilih</a>
                                        </div>
                                    </div>
                                </div>
						@endforeach
@endif
@endsection