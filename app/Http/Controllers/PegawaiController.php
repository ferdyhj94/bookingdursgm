<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Pegawai;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai= DB::table('pegawais')->paginate(20);
        return view('pegawai.read',compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambah()
    {
        return view('pegawai.tambah');
    }

    public function create(Request $request)
    {
        //insert ke user
        $nama = $request->nama;
        $jumlah = "2";

        $user = new \App\User;
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->username = strtolower(implode("", array_slice(explode(" ", $nama), 0, $jumlah)));
        $user->remember_token = str_random(60);
        $user->password = bcrypt('12345');
        $user->role = '1';
        $user->aktif = '1';
        $user->created_by = Auth::user()->id;
        $user->updated_by = Auth::user()->id;
        $user->save();
        
        //insert ke pegawai
        $userId = Auth::user()->id;
        $pegawai = new Pegawai;
        $pegawai->user_id = $userId;
        $pegawai->nik = $request->nik;
        $pegawai->nama = $request->nama;
        $pegawai->jabatan = $request->jabatan;
        $pegawai->status = '1';
        $pegawai->created_by = $userId;
        $pegawai->updated_by = $userId;
        $pegawai->save();

        return redirect('master-data/pegawai')->with('message','Berhasil menambahkan data pegawai');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}
