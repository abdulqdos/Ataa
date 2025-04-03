<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /** @use HasFactory<\Database\Factories\NotificationFactory> */
    use HasFactory;

    public $fillable = ['title' , 'message' , 'read_at' , 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
