<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    protected $table = 'departemens';
    protected $fillable = ['nama_departemen','status','warna','created_by','updated_by'];
}
