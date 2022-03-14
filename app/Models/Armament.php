<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Armament
 * @package App\Models
 * @property string $title
 * @property string $slug
 */
class Armament extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'armament';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
    ];
}
