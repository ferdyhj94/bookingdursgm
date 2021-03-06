<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\DentalUnit;
use App\TransaksiBooking;

class DentalUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dentalUnit = DB::table('dental_units')->select('dental_units.*','departemens.nama_departemen','jam_operasionals.jam_mulai','jam_operasionals.jam_selesai')
                                               ->join('departemens','dental_units.id_departemen','=','departemens.id')
                                               ->join('jam_operasionals','dental_units.id_jam_operasional','jam_operasionals.id')
                                               ->orderBy('dental_units.no','asc')
                                               ->paginate(10);
        return view('dentalunit.read',compact('dentalUnit'));                                       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambah()
    {
        $departemen = DB::table('departemens')->select('*')->orderBy('nama_departemen','asc')->get();
        $jamOperasional = DB::table('jam_operasionals')->get();
        return view('dentalunit.tambah',compact('departemen','jamOperasional'));
    }

    public function create(Request $request)
    {
        $jamOperasional = $request->jam_operasionals;
        foreach($jamOperasional as $data){
            $userId = Auth::user()->id;
            DB::table('dental_units')->insert([
                'no'=>$request->no,
                'id_departemen'=>$request->departemen,
                'id_jam_operasional'=>$data,
                'created_by'=>$userId,
                'updated_by'=>$userId
            ]
        );
        }
            session()->flash('message','Menambah data dental unit berhasil!');
        return redirect('master-data/dental-unit');

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
    public function delete(Request $request,$id)
    {
        DB::table('dental_units')->where('id',$id)->delete();
        return back()->with('message','Sukses menghapus dental unit');
    }

    public function pesan()
    {
        $departemen = DB::table('departemens')->get();
        $jamOperasional = DB::table('jam_operasionals')->get();
        return view('dentalUnit.cari',compact('departemen','jamOperasional'));
    }

    function deactive(Request $request,$id)
    {
        $dentalUnit = DentalUnit::find($id);
        $dentalUnit->role = 1;
        $dentalUnit->updated_by = Auth::user()->id;
        $dentalUnit->update();
        return redirect('master-data/dental-unit')->with('message','Sukses menonaktifkan status dental unit');       
    }

    function activate(Request $request,$id)
    {
        $dentalUnit = DentalUnit::find($id);
        $dentalUnit->role = 0;
        $dentalUnit->updated_by = Auth::user()->id;
        $dentalUnit->update();
        return redirect('master-data/dental-unit')->with('message','Sukses mengaktifkan status dental unit');       

    }

    public function hasil_pencarian(Request $request)
    {
        $departemen = DB::table('departemens')->get();
        $tanggalPesan = $request->tanggal_praktek;
        $departemenSearch = $request->departemen;
        $jamOperasional = DB::table('jam_operasionals')->get();
        $jamOperasionalSearch = $request->jam_operasionals;
        $resDentalUnit = DB::table('dental_units')
                         ->select('dental_units.id as id_dental_unit','dental_units.id_departemen','dental_units.no','dental_units.role','jam_operasionals.id as id_opeasional','jam_operasionals.jam_mulai','jam_operasionals.jam_selesai','departemens.nama_departemen')
                         ->join('departemens','dental_units.id_departemen','=','departemens.id')
                         ->join('jam_operasionals','dental_units.id_jam_operasional','=','jam_operasionals.id')
                         ->whereNotIn('dental_units.id',function($query) use ($request)
                         {
                            // 0:tunda,1:diterima,2:dialihkan;3:selesai;4:batal;5:diubah 	
                             $status = [0,1,2,5];//status yang dipakai, kecuali yang dibatalkan, dental unit masuk list pencarian
                             $query->where('tanggal_pesan','=',$request->tanggal_praktek)
                                   ->select('id_dental_unit')
                                   ->from('transaksi_bookings')
                                   ->whereIn('status',$status);
                         })
                         ->where('departemens.id',$departemenSearch)
                         ->where('jam_operasionals.id',$jamOperasionalSearch)
                        //  ->where('transaksi_bookings.status','=','4')
                        ->where('dental_units.role','=',0)//status dental unit yang aktif
                        ->orderBy('dental_units.no','asc')
                         ->get(); 
        return view('dentalUnit.cari',compact('resDentalUnit','departemen','tanggalPesan','jamOperasional'));
    }

    public function daftar_pesan(Request $request,$id,$tanggalPesan)
    {
        $user = Auth::user()->username;
        $user = DB::table('mahasiswa_koas')->where('nim','=',$user)->first();
        $detailDu = DB::table('dental_units')->select('dental_units.id','dental_units.no','dental_units.id_departemen','dental_units.role','departemens.nama_departemen','jam_operasionals.jam_mulai','jam_operasionals.jam_selesai')
                                             ->join('departemens','dental_units.id_departemen','=','departemens.id')
                                             ->join('jam_operasionals','dental_units.id_jam_operasional','=','jam_operasionals.id')
                                             ->where('dental_units.id','=',$id)
                                             ->first();
        return view('dentalUnit.daftar',compact('detailDu','tanggalPesan','user'));
    }

    function simpan_pesan(Request $request,$id)
    {
        $idDepartemen = DB::table('dental_units')->select('id_departemen')->where('id','=',$id)->first();
        $jamOperasional = DB::table('dental_units')->select('jam_operasionals.jam_mulai','jam_operasionals.jam_selesai')
                                             ->join('jam_operasionals','dental_units.id_jam_operasional','=','jam_operasionals.id')
                                             ->where('dental_units.id','=',$id)->first();
        $time = strtotime($jamOperasional->jam_mulai);
        $expiredTime = date("yy-m-d H:i:s",strtotime('+30 minutes',$time));
        // print($expiredTime);die();
        $transaksi = new TransaksiBooking;
        $transaksi->id_dental_unit = $id;
        $transaksi->id_departemen = $idDepartemen->id_departemen;
        $transaksi->nik = $request->nik;
        $transaksi->nama_pasien = $request->nama_pasien;
        $transaksi->id_user = Auth::user()->id;
        $transaksi->angkatan = $request->angkatan;
        $transaksi->tanggal_pesan = $request->tanggal_praktek;
        $transaksi->jam_mulai = $jamOperasional->jam_mulai;
        $transaksi->jam_selesai = $jamOperasional->jam_selesai;
        $transaksi->expired_time = $expiredTime;
        $transaksi->created_by = Auth::user()->id;
        $transaksi->updated_by = Auth::user()->id;
        $transaksi->save();
        return redirect('pesan')->with('message','Data pesan berhasil disimpan, silahkan tunggu konfirmasi dari petugas verifikasi');
    }

    function ketersediaan()
    {
        return view('dentalUnit.cariKetersediaanDu',compact('ketersediaan'));
    }
}
