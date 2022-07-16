<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    use HasFactory, SoftDeletes;

    // tambahkan fillable,menyimpan seacara langsung
    protected $fillable = [
        'title', 'description', 'role', 'year', 'image',
    ];

    protected $hide = [

    ];


}
