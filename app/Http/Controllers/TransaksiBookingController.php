<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Events\AutoRefundBooking;
use App\TransaksiBooking;
use Illuminate\Http\Request;
use DB;
use Auth;

class TransaksiBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transaksi.tampil');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\TransaksiBooking  $transaksiBooking
     * @return \Illuminate\Http\Response
     */
    public function show(TransaksiBooking $transaksiBooking,Request $request)
    { 
        // $departemen = DB::table('departemens')->get();
        // $tanggalPesan = Carbon::now();
        // $nim = $request->nim;
        $statusTrasaksi = ['1'];
        $resTransaksi = DB::table('transaksi_bookings')
                         ->select('transaksi_bookings.id as id_transaksi','transaksi_bookings.id_dental_unit','transaksi_bookings.id_departemen','transaksi_bookings.no_rm','transaksi_bookings.tanggal_pesan','dental_units.no','departemens.nama_departemen','jam_operasionals.id as id_opeasional','jam_operasionals.jam_mulai','jam_operasionals.jam_selesai','mahasiswa_koas.nim','mahasiswa_koas.nama as nama_koas')
                         ->join('departemens','transaksi_bookings.id_departemen','=','departemens.id')
                         ->join('dental_units','transaksi_bookings.id_dental_unit','=','dental_units.id')
                         ->join('jam_operasionals','dental_units.id_jam_operasional','=','jam_operasionals.id')
                         ->join('users','transaksi_bookings.id_user','=','users.id')
                         ->join('mahasiswa_koas','users.username','=','mahasiswa_koas.nim')
                        //  ->where('mahasiswa_koas.nim',$nim)
                        //  ->where('transaksi_bookings.tanggal_pesan','=',$tanggalPesan)
                         ->whereNotIn('transaksi_bookings.status',$statusTrasaksi)
                         ->get(); 
                        //  print_r($resTransaksi);die();
        return view('transaksi.tampil',compact('resTransaksi','tanggalPesan'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TransaksiBooking  $transaksiBooking
     * @return \Illuminate\Http\Response
     */
    public function edit(TransaksiBooking $transaksiBooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TransaksiBooking  $transaksiBooking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransaksiBooking $transaksiBooking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TransaksiBooking  $transaksiBooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransaksiBooking $transaksiBooking)
    {
        //
    }

    function verifikasi(Request $request, $id){
        $transaksi = TransaksiBooking::find($id);
        if($request->submit=='verifikasi'){
            $transaksi->status = '1';
        }else if($request->submit=='batal')
        {
            $transaksi->status = '3';
        }
        $transaksi->updated_by = Auth::user()->id;
        $transaksi->update();
        return redirect('transaksi')->with('message','Pesan dental unit diterima');
    }

    function batal(Request $request,$id)
    {
        $transaksi = TransaksiBooking::find($id);
        $transaksi->status = '1';
        $transaksi->updated_by = Auth::user()->id;
        $transaksi->update();
        return redirect()->back()->with('message','Pesan dental unit dibatalkan');
    }

    function riwayat()
    {
        $transaksiTerbaru = DB::table('transaksi_bookings')->select('transaksi_bookings.id as id_transaksi','transaksi_bookings.id_dental_unit','transaksi_bookings.id_departemen','transaksi_bookings.no_rm','transaksi_bookings.tanggal_pesan','transaksi_bookings.status','transaksi_bookings.jam_mulai','transaksi_bookings.jam_selesai','dental_units.no','departemens.nama_departemen')
                                                           ->join('dental_units','transaksi_bookings.id_dental_unit','=','dental_units.id')
                                                           ->join('departemens','transaksi_bookings.id_departemen','=','departemens.id')
                                                           ->whereIn('transaksi_bookings.status',['0','1'])
                                                           ->whereDate('transaksi_bookings.created_at', '>', Carbon::now()->subDays(7))
                                                           ->orderBy('transaksi_bookings.tanggal_pesan','DESC')
                                                           ->paginate(5);
                                                           //    print($transaksiTerbaru);die();
        $riwayatTransaksi = DB::table('transaksi_bookings')->select('transaksi_bookings.id_dental_unit','transaksi_bookings.id_departemen','transaksi_bookings.no_rm','transaksi_bookings.tanggal_pesan','transaksi_bookings.status','transaksi_bookings.jam_mulai','transaksi_bookings.jam_selesai','dental_units.no','departemens.nama_departemen')
                                                           ->join('dental_units','transaksi_bookings.id_dental_unit','=','dental_units.id')
                                                           ->join('departemens','transaksi_bookings.id_departemen','=','departemens.id')
                                                           ->orderBy('transaksi_bookings.tanggal_pesan','DESC')
                                                           ->paginate(9);
        return view('transaksi.riwayat',compact('transaksiTerbaru','riwayatTransaksi'));                                                           
    }
}
