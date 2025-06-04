<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class Opportunity extends Model
{
    /** @use HasFactory<\Database\Factories\OpportunityFactory> */
    use HasFactory;
    use SoftDeletes;
    use LogsActivity ;
    protected $guarded = ['id'];

    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
    ];

    protected $dates = ['start_date', 'end_date' , 'deleted_at'];

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

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function volunteers()
    {
        return $this->belongsToMany(Volunteer::class, 'volunteer_opportunities', 'opportunity_id', 'volunteer_id')->withPivot('description', 'hours', 'participation_date', 'eval_commitment' , 'eval_teamwork' , 'eval_leadership' , 'report' , 'certificate_path');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'title',
                'description',
                'start_date',
                'end_date',
                'img_url',
                'location',
                'location_url',
                'count',
                'accepted_count',
                'has_certificate',
                'organization_id',
                'sector_id',
            ])
            ->useLogName('opportunity')
            ->logOnlyDirty()
            ->setDescriptionForEvent(function(string $eventName) {
                return match($eventName) {
                    'created' => 'تم إنشاء فرصة تطوعية',
                    'updated' => 'تم تعديل فرصة تطوعية',
                    'deleted' => 'تم حذف فرصة تطوعية',
                };
            });
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->properties = collect(['data' => $activity->properties])->toArray();

        if ($user = auth()->user()) {
            $organization = $user->organization ?? null;
            if ($organization) {
                $activity->causer_type = get_class($organization);
                $activity->causer_id = $organization->id;
            }
        }
    }


}
