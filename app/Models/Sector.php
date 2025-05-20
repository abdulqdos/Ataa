<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    /** @use HasFactory<\Database\Factories\SectorFactory> */
    use HasFactory;
    protected $fillable = ['name'];

    public function opportunities()
    {
        return $this->hasMany(Opportunity::class);
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }
}
