<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class ArmamentItem
 * @package App\Models
 * @property int $armament_id
 * @property int $spaceship_id
 * @property int $qty
 * @property Relation|BelongsTo armament
 * @property Relation|BelongsTo spaceship
 */
class ArmamentItem extends Model
{
    use HasFactory;

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
        'armament_id',
        'spaceship_id',
        'qty',
    ];

    /**
     * @return BelongsTo
     */
    public function armament(): BelongsTo
    {
        return $this->belongsTo(Armament::class);
    }

    /**
     * @return BelongsTo
     */
    public function spaceship(): BelongsTo
    {
        return $this->belongsTo(Spaceship::class);
    }
}
