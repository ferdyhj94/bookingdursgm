<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MhsKoas extends Model
{
    protected $table = 'mahasiswa_koas';
    protected $fillable= ['nim','nama','angkatan','status','created_by','updated_by'];
}
