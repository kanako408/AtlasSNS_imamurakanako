<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
protected $fillable = [
        'user_id',
        'post'
    ];


     public function user(){//post.phpにとってuser.phpは「１」
        return $this->belongsTo('App\Models\User');
    }
}
