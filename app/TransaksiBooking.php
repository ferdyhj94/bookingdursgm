<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiBooking extends Model
{
    protected $table = 'transaksi_bookings';
    protected $fillable = ['id_dental_unit','id_departemen','no_rm','id_user','tanggal_pesan','jam_mulai','jam_selesai','created_by','updated_by'];
}
