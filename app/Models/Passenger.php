<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $pass
 * @property string $full_name
 * @property string|null $telegram
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
}
