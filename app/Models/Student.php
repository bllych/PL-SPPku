<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'nisn', 'nis', 'class', 'major', 'school_year'])]
#[Table('students')]
class Student extends Model
{
}
