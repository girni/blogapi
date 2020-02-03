<?php

namespace BlogApi\Blog\Model;

use BlogApi\Core\Model\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'image',
        'title',
        'slug',
        'content'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
