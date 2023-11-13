<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $pass
 * @property string $full_name
 * @property string|null $telegram
 *
 * @property Registration[] $registrations
 */
class Passenger extends Model
{
    use HasFactory;

    public $timestamps = false;

	protected $fillable = [
		'pass',
		'full_name',
		'telegram'
	];

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }
}
