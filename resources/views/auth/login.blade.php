@extends('layouts.login')
@section('title','Masuk - Sistem Pesan Dental Unit RSGM UGM Prof. Soedomo')
@section('subtitle','Sistem Pesan Dental Unit RSGM UGM Prof. Soedomo')
@section('content')
<div class="splash-container">
    <div class="card ">
        <div class="card-header text-center"><span class="splash-description">@yield('subtitle')</span></div>
        <div class="card-body">
        <form role="form" method="post" action="{{route('login.post')}}">
        {{csrf_field()}}
                <div class="form-group">
                    <input class="form-control form-control-lg" name="username" id="username" type="text" placeholder="E-mail / NIM / Username" autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" name="password" id="password" type="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                        <input class="custom-control-input" name="remember" type="checkbox"><span class="custom-control-label">Ingat Saya</span>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Masuk</button>
            </form>
        </div>
        <div class="card-footer bg-white p-0  ">
            <div class="card-footer-item card-footer-item-bordered">
                <a href="#" class="footer-link">Buat Akun Baru</a></div>
            <div class="card-footer-item card-footer-item-bordered">
                <a href="#" class="footer-link">Reset Kata Sandi</a>
            </div>
        </div>
    </div>
</div>
@endsection