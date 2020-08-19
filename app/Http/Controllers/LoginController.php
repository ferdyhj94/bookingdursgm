<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
	use AuthenticatesUsers;
	protected $guard = 'admin';

	public function __construct()
	{
		$this->middleware('guest')->except('logout');
	}

	public function guard()
	{
		return auth()->guard('admin');
	}

    public function login()
	{
		return view('auth.login');
	}
	
	function login_auth(Request $request)
	{
		// $remember = $request->has('remember') ? true : false;
		// $this->validator($request,['username'=>'reqired|string','password'=>'required|string|min:6']);

		$loginType = filter_var($request->username,FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
		$login = [$loginType=>$request->username,
				  'password'=>$request->password];
				//   print_r($loginType);die();
		if(auth()->attempt($login) && Auth::user()->aktif=='1')
		{
			return redirect('/home');
		}
		else{
			return redirect('login')->with('message','Username / Password salah, coba lagi!');
		}
	} 

	function logout(Request $request){
		Auth::logout();
		return redirect('login');
	}
	
	function register()
	{
		return view('auth.register');
	}

	protected function validator(array $data)
    {
        return Validator::make($data, [
			'name' => 'required|string|max:255',
			'username' =>'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
	protected function register_post(Request $request)
    {
        \App\User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return redirect('login')->with('message','silahkan login!');
	}
	
}
