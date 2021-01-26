<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    // use HasFactory;
    protected $table = 'dt_tw';
    protected $primaryKey = 'id_tweet';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable  = [
        'id_user',
        'tweet',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
