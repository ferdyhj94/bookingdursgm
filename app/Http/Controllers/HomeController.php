<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $status = ['0','1'];
        $unverifiedBooking = DB::table('transaksi_bookings')->select('transaksi_bookings.id','transaksi_bookings.tanggal_pesan','transaksi_bookings.status','transaksi_bookings.updated_by','departemens.nama_departemen','dental_units.no','jam_operasionals.jam_mulai','jam_operasionals.jam_selesai')
        ->join('departemens','transaksi_bookings.id_departemen','=','departemens.id')
        ->join('dental_units','transaksi_bookings.id_dental_unit','=','dental_units.id')
        ->join('jam_operasionals','dental_units.id_jam_operasional','=','jam_operasionals.id')
        ->where('transaksi_bookings.id_user',auth()->user()->id)
        ->where('transaksi_bookings.status',$status)
        ->get();
        
        $countDentalUnitNow = DB::table('dental_units')
        ->select('departemens.nama_departemen',DB::raw('count(dental_units.id) as total_du'))
        ->join('departemens','dental_units.id_departemen','=','departemens.id')
        ->whereNotIn('dental_units.id',function($query) use ($request)
        {
            $nowDate = (date("Y-m-d",strtotime(Carbon::now())));
                            //status 0:tunda;1:diterima;2:dialihkan;5:selesai
                             $status = [0,1,2,5];
                             $query->where('tanggal_pesan','=',$nowDate)
                                    ->whereIn('status',$status)
                                   ->select('id_dental_unit')
                                   ->from('transaksi_bookings');
                         })
                         
                         ->groupBy('departemens.id')
                         ->get(); 
        return view('home',compact('countDentalUnitNow','unverifiedBooking'));
    }
}
