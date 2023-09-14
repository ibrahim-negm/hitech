<?php

namespace App\Models\Admin;

use App\Models\Admin;
use App\Models\Front\Contact;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sent extends Model
{
    use HasFactory;

    protected $table='sents';

    protected $fillable = [
        'admin_id',
        'contact_id',
        'subject',
        'message',
    ];

    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id','id');
    }

    public function contact(){
        return $this->belongsTo(Contact::class,'contact_id','id');
    }
}
