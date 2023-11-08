<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property string $link
 *
 * @property Route[] $routes
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
		return $this->belongsToMany(Route::class)->withPivot('arrives_at');
	}
}
