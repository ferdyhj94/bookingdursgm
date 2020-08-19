<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\MhsKoas;
use App\User;

class MhsKoasController extends Controller
{

    public function index()
    {
        $koas = DB::table('mahasiswa_koas')->select('mahasiswa_koas.id as koas_id','mahasiswa_koas.nim','mahasiswa_koas.nama','mahasiswa_koas.angkatan','mahasiswa_koas.status','users.id as user_id')
                                           ->join('users','mahasiswa_koas.user_id','=','users.id')
                                           ->orderBy('angkatan','desc')->paginate(25);
        return view('koas.read',compact('koas'));
    }
    public function tambah()
    {
        return view('koas.tambah');
    }

    public function create(Request $request)
    {
        //insert ke user 
        // $jumlah = '2';
        $user = new User;
        $user->name = $request->nama;
        $user->username = $request->nim;
        $user->email = $request->email;
        $user->remember_token = str_random(60);
        $user->password = bcrypt($request->nim);
        $user->role = '2';
        $user->aktif = '1';
        $user->created_by = Auth::user()->id;
        $user->updated_by = Auth::user()->id;
        $user->save();

        //insert ke mahasiswa koas
        $userId = Auth::user()->id;
        $MhsKoas = new MhsKoas;
        $MhsKoas->nim = $request->nim;
        $MhsKoas->nama = $request->nama;
        $MhsKoas->user_id = $user->id;
        $MhsKoas->angkatan = $request->angkatan;
        $MhsKoas->status = '1';
        $MhsKoas->created_by = $userId;
        $MhsKoas->updated_by = $userId;
        $MhsKoas->save();
        session()->flash('message','Menambah data mahasiswa koas berhasil!');
        return redirect('master-data/koas');
    }

    function deactive(Request $request,$id)
    {
        $userMhsKoas = ['aktif'=>0,'updated_by'=>Auth::user()->id];
        $mhsKoas = ['status'=>0,'updated_by'=>Auth::user()->id];
        DB::table('users')->where('id','=',$id)->update($userMhsKoas);
        DB::table('mahasiswa_koas')->where('user_id','=',$id)->update($mhsKoas);
        return redirect('master-data/koas')->with('message','Sukses menonaktifkan mahasiswa');
    }

    function activate(Request $request,$id)
    {
        $userMhsKoas = ['aktif'=>0,'updated_by'=>Auth::user()->id];
        $mhsKoas = ['status'=>1,'updated_by'=>Auth::user()->id];
        DB::table('users')->where('id','=',$id)->update($userMhsKoas);
        DB::table('mahasiswa_koas')->where('user_id','=',$id)->update($mhsKoas);
        return redirect('master-data/koas')->with('message','Sukses mengaktifkan mahasiswa');       

    }
}
