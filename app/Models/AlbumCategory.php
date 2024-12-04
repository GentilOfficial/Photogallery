<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * 
 *
 * @property int $id
 * @property int $album_id
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategory whereAlbumId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AlbumCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AlbumCategory extends Pivot
{
    //
}
