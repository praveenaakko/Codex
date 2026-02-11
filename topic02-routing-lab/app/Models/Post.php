<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'status',
        'tenant_slug',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
