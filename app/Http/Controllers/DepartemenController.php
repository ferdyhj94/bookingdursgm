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
        // print($request->nama_departemen);die();
        $userId = Auth::user()->id;
        $departemen = new Departemen;
        $departemen->nama_departemen = $request->nama_departemen;
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
        $departemen = DB::table('departemens')->where('id','=',$id)->first();
        return view('departemen.edit',compact('departemen'));
    }

    function storeEdit(Request $request,$id)
    {
        $userId = Auth::user()->id;
        $departemen = Departemen::find($id);
        $departemen->nama_departemen = $request->nama_departemen;
        $departemen->updated_by = $userId;
        $departemen->update();
        return redirect('master-data/departemen')->with('message','Sukses menghapus departemen');
    }

    function activate(Request $request)
    {
        // $departemen = new Departemen;

        // $departemen->status = 
    }

    function delete(Request $request, $id)
    {
        // print($id);die();
        DB::table('departemens')->where('id',$id)->delete();
        return back()->with('message','Sukses menghapus departemen');

    }
}
