<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'website_id',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'website_id');

    }

    public function sent_emails()
    {
        return $this->hasMany(SentEmail::class,'user_id')->where('sent',1);

    }

}
