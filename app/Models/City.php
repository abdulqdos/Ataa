<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /** @use HasFactory<\Database\Factories\CityFactory> */
    use HasFactory;
    protected $fillable = ['name'];
    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }

    public function opportunities()
    {
        return $this->hasMany(Organization::class);
    }
}
