<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
//use App\Http\Request\validasiDepartemen;
use DB;
use Auth;
class DepartemenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
       
    }

    public function index()
    {
        $departemen = DB::table('departemens')->paginate(5);
        return view('departemen.read',compact('departemen'));
    }

    function tambah()
    {
        return view('departemen.tambah');
    } 

    function create(Request $request)
    {
        $userId = Auth::user()->id;
        $departemen = new Departemen;
        $departemen->nama_departemen = $request->nama;
        $departemen->status = '1';
        $departemen->warna = '0';
        $departemen->created_by =  $userId;
        $departemen->updated_by = $userId;
        $departemen->save();

        session()->flash('message','Menambah data departemen berhasil!');
        return redirect('master-data/departemen');
    }

    function edit($id)
    {
        $departemen = DB::table('departemen')->where('id','=',$id)->first();
        return view('departemen.edit',compact('departemen'));
    }

    function storeEdit(Request $request,$id)
    {
        $departemen = Departemen::find($id);
        $departemen->nama = $request->nama;
        $departemen->updated_by = $userId;
        $departemen->update();

    }

    function activate(Request $request)
    {
        // $departemen = new Departemen;

        // $departemen->status = 
    }

    function delete(Request $request, $id)
    {
        $departemen = Departemen::find($id);
        $departemen->delete();
        return back();
    }
}
