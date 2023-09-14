<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;

    protected $table ='seos';

    protected $fillable = [
        'meta_title',
        'meta_auth',
        'meta_tag',
        'meta_description',
        'google_analytics',
    ];
}
