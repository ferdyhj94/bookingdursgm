<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use DB;
class transaksiExcels implements FromView
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(string $from,$to,$namaKoas)
    {
        $this->from = $from;
        $this->to = $to;
        $this->namaKoas = $namaKoas;
    }    
    public function view(): View
    {

        
        return view('transaksi.transaksi', [
            'transaksi' => DB::table('transaksi_bookings')->select('mahasiswa_koas.nim','mahasiswa_koas.nama as nama_koas','departemens.nama_departemen','dental_units.no','transaksi_bookings.jam_mulai','transaksi_bookings.jam_selesai','transaksi_bookings.tanggal_pesan as tanggal_praktek','users.name as petugas_verifikasi','transaksi_bookings.status')
                                                      ->join('dental_units','transaksi_bookings.id_dental_unit','=','dental_units.id')
                                                      ->join('departemens','transaksi_bookings.id_departemen','=','departemens.id')
                                                      ->join('users','transaksi_bookings.updated_by','=','users.id')
                                                      ->join('mahasiswa_koas','transaksi_bookings.id_user','=','mahasiswa_koas.user_id')
                                                      ->where('transaksi_bookings.tanggal_pesan','>=',$this->from)
                                                      ->where('transaksi_bookings.tanggal_pesan','<=',$this->to)
                                                      ->where('mahasiswa_koas.nama','LIKE','%'.$this->namaKoas.'%')
                                                      ->get()
        ]);
    }
}
