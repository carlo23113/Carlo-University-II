<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class newsfeed extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'fullname', 'usertype', 'time', 'post'
    ];
}