<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\MhsKoas;
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
        $userId = Auth::user()->id;
        $MhsKoas = new MhsKoas;
        $MhsKoas->nim = $request->no;
        $MhsKoas->nama = $request->nama;
        $MhsKoas->angkatan = $request->angkatan;
        $MhsKoas->status = '1';
        $MhsKoas->created_by = $userId;
        $MhsKoas->updated_by = $userId;
        $MhsKoas->save();
        session()->flash('message','Menambah data mahasiswa koas berhasil!');
        return redirect('master-data/koas');

    }
}
