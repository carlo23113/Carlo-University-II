<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class announcements extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'announcement', 'image' 
    ];

    public function user(){
        return $this->hasOne('App\Models\User');
    }
}