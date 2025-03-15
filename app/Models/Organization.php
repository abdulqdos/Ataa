<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    /** @use HasFactory<\Database\Factories\OrganizationFactory> */
    use HasFactory;

    protected $fillable = ['name' , 'city_id' , 'sector_id'];
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
}
