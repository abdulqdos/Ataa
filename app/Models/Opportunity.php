<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    /** @use HasFactory<\Database\Factories\OpportunityFactory> */
    use HasFactory;

    protected $fillable = [ 'title' , 'description' , 'status' , 'start_date' , 'end_date' , 'img_url' , 'location' , 'location_url' , 'count', 'organization_id' ];

    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
    ];
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
