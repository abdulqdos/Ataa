<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Opportunity extends Model
{
    /** @use HasFactory<\Database\Factories\OpportunityFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 'title' , 'description' , 'status' , 'start_date' , 'end_date' , 'img_url' , 'location' , 'location_url' , 'count', 'organization_id' ];

    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
    ];

    protected $dates = ['start_date', 'end_date'];

    public function updateStatus()
    {
        $today = now()->format('Y-m-d');
        $start = $this->start_date->format('Y-m-d');
        $end = $this->end_date->format('Y-m-d');

        if ($start > $today) {
            $this->status = 'upcoming';
        } elseif ($start <= $today && $end >= $today) {
            $this->status = 'active';
        } else {
            $this->status = 'completed';
        }

        $this->save();
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function volunteers()
    {
        return $this->belongsToMany(Volunteer::class, 'volunteer_opportunities', 'opportunity_id', 'volunteer_id');    }
}
