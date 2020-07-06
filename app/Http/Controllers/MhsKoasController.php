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
        $koas = DB::table('mahasiswa_koas')->select('nim','nama','angkatan','status')->orderBy('angkatan','desc')->paginate(25);
        return view('koas.read',compact('koas'));
    }
    public function tambah()
    {
        return view('koas.tambah');
    }

    public function create(Request $request)
    {
        //insert ke user 
        $jumlah = '2';
        $user = new User;
        $user->name = $request->nama;
        $user->username = strtolower(implode("", array_slice(explode(" ", $nama), 0, $jumlah)));
        $user->email = $request->email;
        $user->remember_token = str_random(60);
        $user->password = bcrypt('12345');
        $user->role = '1';
        $user->aktif = '1';
        $user->created_by = Auth::user()->id;
        $user->updated_by = Auth::user()->id;
        $user->save();

        //insert ke mahasiswa koas
        $userId = Auth::user()->id;
        $MhsKoas = new MhsKoas;
        $MhsKoas->nim = $request->no;
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
}
