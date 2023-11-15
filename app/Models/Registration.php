<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $passenger_id
 * @property string $telegram
 * @property string $trip_uuid
 * @property int $stop_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Passenger $passenger
 * @property Stop $stop
 * @property Trip $trip
 */
class Registration extends Model
{
	use HasFactory, SoftDeletes;

	protected $casts = [
		'passenger_id' => 'int',
		'stop_id' => 'int'
	];

	protected $fillable = [
		'passenger_id',
        'telegram',
		'trip_uuid',
		'stop_id'
	];

	public function passenger(): BelongsTo
    {
		return $this->belongsTo(Passenger::class);
	}

	public function stop(): BelongsTo
    {
		return $this->belongsTo(Stop::class);
	}

	public function trip(): BelongsTo
    {
		return $this->belongsTo(Trip::class, 'trip_uuid');
	}

    public static function findByTripAndPassenger($tripUuid, $passengerId)
    {
        return self::where('trip_uuid', $tripUuid)
            ->where('passenger_id', $passengerId)
            ->first();
    }
}
