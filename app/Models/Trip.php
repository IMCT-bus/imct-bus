<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    protected $primaryKey = 'uuid';

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

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeTodayAndLater(Builder $query): Builder
    {
        $today = new DateTime('now', new DateTimeZone('Asia/Vladivostok'));

        return $query->whereDate('date', '>=', $today);
    }
}
