<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    /** @use HasFactory<\Database\Factories\RequestFactory> */
    use HasFactory;

    protected $fillable = ['reason' , 'status' , 'volunteer_id' , 'opportunity_id'];

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class);
    }

    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class);
    }
}
