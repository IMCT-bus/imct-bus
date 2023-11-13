<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string|null $link
 *
 * @property Route[] $routes
 * @property Registration[] $registrations
 */
class Stop extends Model
{
	use HasFactory;

	public $timestamps = false;

	protected $fillable = [
		'name',
		'link'
	];

	public function routes(): BelongsToMany
	{
		return $this->belongsToMany(Route::class)
            ->withPivot('arrives_at', 'position');
	}

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }
}
