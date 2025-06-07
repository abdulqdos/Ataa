<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{

    /** @use HasFactory<\Database\Factories\OrganizationFactory> */
    use HasFactory ;

    protected $fillable = ['name' , 'city_id' , 'sector_id' , 'user_id' , 'contact_email' , 'phone_number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function opportunities()
    {
        return $this->hasMany(Opportunity::class);
    }


}
