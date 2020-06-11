@extends('layouts.login')
@section('title','Masuk - Sistem Informasi Pesan Dental Unit')
@section('content')
<div class="container">
    <div class="row">
       <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Halaman Login Sistem</h3>
            </div>
      @if(Session::has('message'))
      <div class="alert alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
       </button>{{Session::get('message')}}</div>
       @endif
            <div class="panel-body">
                <form role="form" method="post" action="{{route('login.post')}}">
                    {{csrf_field()}}
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="E-mail / NIM / Username" name="username" type="text" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="password" type="password" value="">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Remember Me">Remember Me
                            </label>
                        </div>
                        <!-- Change this to a button or input when using this as a form -->
                        <button class="btn btn-lg btn-success btn-block" type="submit">Masuk</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
