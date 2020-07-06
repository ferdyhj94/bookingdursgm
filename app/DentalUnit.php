<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DentalUnit extends Model
{
    protected $table = 'dental_units';
    protected $fillable = [
        'name','username', 'email', 'role','password',
    ];
}
