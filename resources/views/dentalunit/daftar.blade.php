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
<form method="post" action="{{route('dentalUnit.simpanPesan',$detailDu->id)}}">
	{{ csrf_field() }}
	<div class="row">
				@if (Session::has('message'))
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
					<p>{{ Session::get('message') }}</p>
				</div>
				@endif
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Pencarian Data Dental Unit</h5>
                                <div class="card-body">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom01">NIM</label>
												<input type="text" class="form-control" name="nim" value="{{$user->nim}}" required readonly>
							                      <!-- <div class="valid-feedback">
                                                    Looks good!
                                                </div> -->
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom02">Nama</label>
												<input type="text" class="form-control" name="nama" value="{{$user->nama}}" required readonly>	
                                                <!-- <div class="valid-feedback">
                                                    Looks good!
                                                </div> -->
											</div>
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom02">Angkatan</label>
												<input type="text" class="form-control" name="angkatan" value="{{$user->angkatan}}" required>	
                                                <!-- <div class="valid-feedback">
                                                    Looks good!
                                                </div> -->
											</div>
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom02">NIK</label>
												<input type="text" class="form-control" name="nik">	
                                                <!-- <div class="valid-feedback">
                                                    Looks good!
                                                </div> -->
											</div>
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom02">Nama Pasien</label>
												<input type="text" class="form-control" name="nama_pasien">	
                                                <!-- <div class="valid-feedback">
                                                    Looks good!
                                                </div> -->
											</div>
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom02">Tanggal Praktek</label>
												<input type="text" class="form-control" name="tanggal_praktek" value="{{$tanggalPesan}}" required readonly>
                                                <!-- <div class="valid-feedback">
                                                    Looks good!
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
								</div>
							</div>
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Detail Dental Unit</h3>
						</div>
						<div class="card-body">
							<p class="card-text">Departemen: {{$detailDu->nama_departemen}}</p>
							<!-- <p class="card-text">Tanggal : <?= date("d F Y",strtotime($tanggalPesan))?></p> -->
							<p class="card-text">Nomor Dental Unit : {{$detailDu->no}}</p>
							<p class="card-text">Jam : {{date("H:i",strtotime($detailDu->jam_mulai))}} - {{date("H:i",strtotime($detailDu->jam_selesai))}}</p>
						</div>
						<div class="card-footer p-0 text-center">
							<div class="card-footer-item card-footer-item-bordered">
								<button type="submit" class="btn btn-primary">Pesan</button>                                     
							   </div>
							</div>
						</div>
					</div>
					</div>
					</div>
				</form>

@endsection