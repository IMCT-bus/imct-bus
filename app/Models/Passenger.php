<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $pass
 * @property string $full_name
 * @property string|null $deleted_at
 *
 * @property Registration[] $registrations
 */
class Passenger extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

	protected $fillable = [
		'pass',
		'full_name',
	];

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    public static function findByCredentials($pass, $fullName)
    {
        return self::where('pass', $pass)
            ->where('full_name', $fullName)
            ->first();
    }
}
