<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    /** @use HasFactory<\Database\Factories\NotificationFactory> */
    use HasFactory;
    use SoftDeletes;

    public $fillable = ['title' , 'message' , 'read_at' , 'user_id'];

    public function markAsRead()
    {
        $this->update(['read_at' => now()]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
