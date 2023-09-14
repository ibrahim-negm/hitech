<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [
        'service_id',
        'image_name',
        'image',

    ];

    public function service(){
        return $this->belongsTo(Service::class,'service_id','id');
    }
}
