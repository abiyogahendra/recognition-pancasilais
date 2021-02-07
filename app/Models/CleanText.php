<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CleanText extends Model
{
    // use HasFactory;
    protected $table = 'clean_tweet';
    protected $primaryKey = 'id_clean';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable  = [
        'id_user',
        'clean_tweet',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
