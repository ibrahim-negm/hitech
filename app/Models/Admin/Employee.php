<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected  $fillable =[
        'employee_name',
        'position',
        'image',
        'facebook',
        'instgram',
        'twitter',
        'whatsup'

    ];

}
