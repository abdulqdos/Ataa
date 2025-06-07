<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class Sector extends Model
{
    /** @use HasFactory<\Database\Factories\SectorFactory> */
    use HasFactory  , LogsActivity ;
    protected $fillable = ['name'];

    public function opportunities()
    {
        return $this->hasMany(Opportunity::class);
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class);
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
                    'created' => 'تم إنشاء القطاع',
                    'updated' => 'تم تعديل القطاع',
                    'deleted' => 'تم حذف القطاع',
                };
            });
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->properties = collect(['data' => $activity->properties])->toArray();

        if (auth()->user()) {
            $admin = auth()->user() ?? null;
            if ($admin) {
                $activity->causer_type = get_class(auth()->user());
                $activity->causer_id = $admin->id;
            }
        }
    }
}
