<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $uuid
 * @property Carbon $date
 * @property int $route_id
 * @property bool $is_published
 * @property string|null $car_number
 * @property string|null $link
 * @property int $seats
 *
 * @property Route $route
 */
class Trip extends Model
{
    use HasFactory, UsesUuid;

	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime',
		'route_id' => 'int',
		'is_published' => 'bool',
		'seats' => 'int'
	];

	protected $fillable = [
		'uuid',
		'date',
		'route_id',
		'is_published',
		'car_number',
		'link',
		'seats'
	];

	public function route(): BelongsTo
    {
        return $this->belongsTo(Route::class);
	}
}
