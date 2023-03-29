<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SentEmail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'sent'
    ];

    public function subscribers()
    {
        return $this->hasMany(Subscriber::class, 'id');
    }
}
