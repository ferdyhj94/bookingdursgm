<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Events\AutoRefundBooking;
use App\TransaksiBooking;
use Illuminate\Http\Request;
use DB;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\transaksiExcels;

class TransaksiBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // 0:tunda,1:diterima,2:dialihkan;3:selesai;4:batal;5:diubah

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
        // 0:tunda,1:diterima,2:dialihkan;3:selesai;4:batal;5:diubah 	
        $statusTrasaksi = [1,2,3,4];
        $resTransaksi = DB::table('transaksi_bookings')
                         ->select('transaksi_bookings.id as id_transaksi','transaksi_bookings.id_dental_unit','transaksi_bookings.id_departemen','transaksi_bookings.nik','transaksi_bookings.tanggal_pesan','transaksi_bookings.nama_pasien','dental_units.no','departemens.nama_departemen','jam_operasionals.id as id_opeasional','jam_operasionals.jam_mulai','jam_operasionals.jam_selesai','mahasiswa_koas.nim','mahasiswa_koas.nama as nama_koas')
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
        }elseif($request->submit=='batal')
        {
            $transaksi->status = '4';
        }
        $transaksi->updated_by = Auth::user()->id;
        $transaksi->update();
        return redirect('transaksi')->with('message','Pesan dental unit diterima');
    }

    function riwayat()
    {
            $transaksiTerbaru = DB::table('transaksi_bookings')->select('transaksi_bookings.id as id_transaksi','transaksi_bookings.id_dental_unit','transaksi_bookings.id_departemen','transaksi_bookings.nik','transaksi_bookings.tanggal_pesan','transaksi_bookings.status','transaksi_bookings.nama_pasien','transaksi_bookings.jam_mulai','transaksi_bookings.jam_selesai','dental_units.no','departemens.nama_departemen', 'mahasiswa_koas.nama as nama_koas','mahasiswa_koas.nim','mahasiswa_koas.angkatan')
                                                               ->join('dental_units','transaksi_bookings.id_dental_unit','=','dental_units.id')
                                                               ->join('departemens','transaksi_bookings.id_departemen','=','departemens.id')
                                                               ->join('mahasiswa_koas','transaksi_bookings.id_user','=','mahasiswa_koas.user_id')
                                                               ->whereDate('transaksi_bookings.created_at', '>', Carbon::now()->subDays(7))
                                                               ->where('transaksi_bookings.id_user','=',Auth::user()->id)
                                                               ->orderBy('transaksi_bookings.tanggal_pesan','DESC')
                                                               ->orderBy('transaksi_bookings.id','DESC')
                                                               ->paginate(5);
                                                               
            $transaksiTerbaruAll = DB::table('transaksi_bookings')->select('transaksi_bookings.id as id_transaksi','transaksi_bookings.id_dental_unit','transaksi_bookings.id_departemen','transaksi_bookings.nik','transaksi_bookings.tanggal_pesan','transaksi_bookings.status','transaksi_bookings.nama_pasien','transaksi_bookings.jam_mulai','transaksi_bookings.jam_selesai','dental_units.no','departemens.nama_departemen', 'mahasiswa_koas.nama as nama_koas','mahasiswa_koas.nim','mahasiswa_koas.angkatan')
                                                               ->join('dental_units','transaksi_bookings.id_dental_unit','=','dental_units.id')
                                                               ->join('departemens','transaksi_bookings.id_departemen','=','departemens.id')
                                                               ->join('mahasiswa_koas','transaksi_bookings.id_user','=','mahasiswa_koas.user_id')
                                                               ->whereDate('transaksi_bookings.created_at', '>', Carbon::now()->subDays(7))
                                                               ->orderBy('transaksi_bookings.tanggal_pesan','DESC')
                                                               ->orderBy('transaksi_bookings.id','DESC')
                                                               ->paginate(10);
                                                               
            $riwayatTransaksi = DB::table('transaksi_bookings')->select('transaksi_bookings.id_dental_unit','transaksi_bookings.id_departemen','transaksi_bookings.nik','transaksi_bookings.tanggal_pesan','transaksi_bookings.status','transaksi_bookings.jam_mulai','transaksi_bookings.nama_pasien','transaksi_bookings.jam_selesai','dental_units.no','departemens.nama_departemen', 'mahasiswa_koas.nama as nama_koas','mahasiswa_koas.nim','mahasiswa_koas.angkatan')
                                                               ->join('dental_units','transaksi_bookings.id_dental_unit','=','dental_units.id')
                                                               ->join('departemens','transaksi_bookings.id_departemen','=','departemens.id')
                                                               ->join('mahasiswa_koas','transaksi_bookings.id_user','=','mahasiswa_koas.user_id')
                                                               ->where('transaksi_bookings.id_user','=',Auth::user()->id)
                                                               ->orderBy('transaksi_bookings.tanggal_pesan','DESC')
                                                               ->orderBy('transaksi_bookings.id','DESC')
                                                               ->paginate(10);
                                                               
            $riwayatTransaksiAll = DB::table('transaksi_bookings')->select('transaksi_bookings.id_dental_unit','transaksi_bookings.id_departemen','transaksi_bookings.nik','transaksi_bookings.tanggal_pesan','transaksi_bookings.status','transaksi_bookings.jam_mulai','transaksi_bookings.nama_pasien','transaksi_bookings.jam_selesai','dental_units.no','departemens.nama_departemen', 'mahasiswa_koas.nama as nama_koas','mahasiswa_koas.nim','mahasiswa_koas.angkatan')
                                                               ->join('dental_units','transaksi_bookings.id_dental_unit','=','dental_units.id')
                                                               ->join('departemens','transaksi_bookings.id_departemen','=','departemens.id')
                                                               ->join('mahasiswa_koas','transaksi_bookings.id_user','=','mahasiswa_koas.user_id')
                                                               ->orderBy('transaksi_bookings.tanggal_pesan','DESC')
                                                               ->orderBy('transaksi_bookings.id','DESC')
                                                               ->paginate(10);
            return view('transaksi.riwayat',compact('transaksiTerbaru','riwayatTransaksi','riwayatTransaksiAll','transaksiTerbaruAll'));                                                                                                         
    }

    function ubahJadwal(Request $request,$id)
    {
        $transaksi = TransaksiBooking::find($id);
        print($transaksi);die();
        return view('transaksi.ubahadwal',compact('transaksi'));
    }

    function submitUbahJadwal(Request $request, $id)
    {
        $transaksi = TransaksiBooking::find($id);
        $transaksi->status = '5';
        $transaksi->updated_by = Auth::user()->id;
        $transaksi->update();

        $transaksiUbah = new TransaksiBooking;
        $transaksiUbah->id_dental_unit = $id;
        $transaksiUbah->id_departemen = $transaksi->id_departemen;
        $transaksiUbah->nik = $transaksi->nik;
        $transaksiUbah->nama_pasien = $transaksi->nama_pasien;
        $transaksiUbah->id_user = Auth::user()->id;
        $transaksiUbah->tanggal_pesan = $transaksi->tanggal_praktek;
        $transaksiUbah->jam_mulai = $jamOperasional->jam_mulai;
        $transaksiUbah->jam_selesai = $jamOperasional->jam_selesai;
        $transaksiUbah->created_by = Auth::user()->id;
        $transaksiUbah->updated_by = Auth::user()->id;
        $transaksiUbah->save();
        // return redirect('pesan')->with('message','Data pesan berhasil disimpan, silahkan tunggu konfirmasi dari petugas verifikasi');
        return redirect()->back()->with('message','Pesan dental unit dibatalkan');
    }

    function alihPengguna(Request $request,$id)
    {
        $detailDu = DB::table('transaksi_bookings')->select('dental_units.id','dental_units.no','dental_units.id_departemen','dental_units.role','departemens.nama_departemen','jam_operasionals.jam_mulai','jam_operasionals.jam_selesai')
                                             ->join('departemens','transaksi_bookings.id_departemen','=','departemens.id')
                                             ->join('jam_operasionals','dental_units.id_jam_operasional','=','jam_operasionals.id')
                                             ->join('dental_units','transaksi_bookings.id_dental_unit','=','dental_units.id')
                                             ->where('dental_units.id','=',$id)
                                             ->first();
                                            //  print($detailDu);die();
        $transaksi = TransaksiBooking::find($id);
        return view('transaksi.alihpengguna',compact('transaksi','detailDu'));
    }

    function submitAlihPengguna()
    {

    }
    function selesai()
    {

    }
    function autocomplete(Request $request){
    $q = $request->query;
    $data = DB::table('mahasiswa_koas')->where('nama',"LIKE","%".$q."%")
                                       ->orWhere('nim',"LIKE","%".$q."%")
                                       ->get();
            return response()->json($data);
    }

    public function export_excel(Request $request)
	{
        $from = date($request->start_date);
        $to = date($request->end_date);
        $namaKoas = $request->nama;
        return (new transaksiExcels($from,$to,$namaKoas))->download('transaksi.xlsx');	
    }
}
