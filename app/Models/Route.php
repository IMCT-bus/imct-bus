<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property Carbon $starts_at
 *
 * @property Stop[] $stops
 * @property Trip[] $trips
 */
class Route extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'name',
		'starts_at'
	];

	protected $casts = [
		'starts_at' => 'datetime'
	];

	public function stops(): BelongsToMany
	{
		return $this->belongsToMany(Stop::class)
            ->withPivot('arrives_at', 'position');
	}

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }
}
