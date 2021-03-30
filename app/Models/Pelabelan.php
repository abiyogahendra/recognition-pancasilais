<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelabelan extends Model
{
    // use HasFactory;
    protected $table = 'pelabelan';
    protected $primaryKey = 'id_pelabelan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable  = [
        'id_user',
        'j_pancasilais',
        'j_negative',
        'klasifikasi',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
