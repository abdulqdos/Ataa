<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    /** @use HasFactory<\Database\Factories\VolunteerFactory> */
    use HasFactory;

    protected $fillable = [ 'first_name' ,  'last_name' , 'gender' , 'phone_number' , 'age' , 'user_id' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
