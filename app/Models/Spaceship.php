<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Spaceship
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $class
 * @property string $crew
 * @property string $image
 * @property float $value
 * @property int $status_id
 * @property Relation|HasMany armament
 * @property Relation|BelongsTo status
 * @property string status_title
 */
class Spaceship extends Model
{
    use SoftDeletes;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'class',
        'crew',
        'image',
        'value',
        'status_id',
    ];

    /**
     * @return HasMany
     */
    public function armament(): HasMany
    {
        return $this->hasMany(ArmamentItem::class);
    }

    /**
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
}
