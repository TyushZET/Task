<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $table = 'posts';

    protected $fillable = [
        'title',
        'description',
        'website_id',
    ];

    public function subscribers()
    {
        return $this->hasMany(Subscriber::class, 'website_id');
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function sent_emails()
    {
        return $this->hasMany(SentEmail::class)->where('sent', 0);
    }

}


