<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $table = 'subscribers';

    protected $fillable = [
        'user_id',
        'email',
        'website_id',
    ];

//    public function posts(){
//        return $this->belongsToMany(Post::class);
//
//    }

}
