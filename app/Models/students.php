<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class students extends Model
{
    use HasFactory;


    protected $fillable = [
        'student_id', 'firstname', 'middlename', 'lastname', 'year', 'course', 'section', 'valid'
    ];
}