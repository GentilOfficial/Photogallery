<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Photo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property string $album_name
 * @property string|null $album_thumb
 * @property string|null $description
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Photo> $photos
 * @property-read int|null $photos_count
 * @method static \Database\Factories\AlbumFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album whereAlbumName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album whereAlbumThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Album withoutTrashed()
 * @property-read string|null $path
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Category|null $categories
 * @property-read int|null $categories_count
 * @mixin \Eloquent
 */
class Album extends Model
{
    /** @use HasFactory<\Database\Factories\PhotoFactory> */
    use HasFactory;
    use SoftDeletes;

    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable = [
        'album_name',
        'description',
        'user_id',
        'album_thumb'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Summary of photos
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    /**
     * Summary of getPathAttribute
     * @return string|null
     */
    public function getPathAttribute()
    {
        $url = $this->album_thumb;
        if (!str_starts_with($url, 'http')) {
            $url = 'storage/' . $url;
        }

        return $url;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
}
