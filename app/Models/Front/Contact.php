<?php

namespace App\Models\Front;

use App\Models\Admin\Sent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table='contacts';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
    ];

    public function sents(){
        return $this->hasMany(Sent::class,'contact_id','id');
    }
}
