@extends('layouts.login')
@section('title','Daftar - Sistem Pesan Dental Unit RSGM UGM Prof. Soedomo')
@section('subtitle','Sistem Pesan Dental Unit RSGM UGM Prof. Soedomo')
@section('content')
<div class="splash-container">
    <div class="card ">
        <div class="card-header text-center"><span class="splash-description">@yield('subtitle')</span></div>
        <div class="card-body">
        <form role="form" method="post" action="{{route('register.create')}}">
        {{csrf_field()}}
                <div class="form-group">
                    <input class="form-control form-control-lg" name="name" id="nama" type="text" placeholder="Nama" autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" name="username" id="username" type="text" placeholder="Username" autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" name="email" id="email" type="text" placeholder="E-mail" autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" name="password" id="password" type="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Daftar</button>
            </form>
        </div>
</div>
@endsection
