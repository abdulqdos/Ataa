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

    protected $fillable = [ 'title' , 'description' , 'start_date' , 'end_date' , 'img_url' , 'location' , 'location_url' , 'count' , 'accepted_count', 'organization_id' ];

    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
    ];

    protected $dates = ['start_date', 'end_date'];

    public function getStatus()
    {
        $now = now();

        if ($this->start_date > $now) {
            return 'upcoming';
        } elseif ($this->start_date <= $now && $this->end_date >= $now) {
            return 'active';
        } elseif ($this->end_date < $now) {
            return 'completed';
        }

        return null;
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
        return
            $this->belongsToMany(Volunteer::class, 'volunteer_opportunities', 'opportunity_id', 'volunteer_id')
            ->withPivot('description', 'hours', 'participation_date', 'eval_commitment' , 'eval_teamwork' , 'eval_leadership' , 'report' , 'certificate_path');
    }
}
