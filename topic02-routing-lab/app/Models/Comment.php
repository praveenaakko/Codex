<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'body',
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
