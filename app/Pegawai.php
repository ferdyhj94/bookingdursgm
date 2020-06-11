<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawais';
    protected $fillable= ['user_id','nik','nama','jabatan','status','created_by','updated_by'];
}
