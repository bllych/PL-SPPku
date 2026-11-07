<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'user_id',
    'nisn',
    'nis',
    'class',
    'major',
    'school_year'
])]
class Student extends Model
{
    protected $table = 'students';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}