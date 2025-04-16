<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerOpportunity extends Model
{
    /** @use HasFactory<\Database\Factories\VolunteerOpportunityFactory> */
    use HasFactory;

    protected $table = 'volunteer_opportunities';
    protected $fillable = ['volunteer_id', 'opportunity_id'];

//    public function volunteer()
//    {
//        return $this->belongsTo(Volunteer::class);
//    }
//
//    public function opportunity()
//    {
//        return $this->belongsTo(Opportunity::class);
//    }

}
