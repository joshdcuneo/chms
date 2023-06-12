<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attendance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'person_id',
        'event_id',
    ];

    public function joinsMany(Event|Person $from): BelongsToMany
    {
        $to = match ($from::class) {
            Event::class => Person::class,
            Person::class => Event::class
        };

        return $from->belongsToMany($to, $this->getTable())
            ->withTimestamps();
    }
}
