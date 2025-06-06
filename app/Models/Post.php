<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Post extends Model
{
    use HasFactory, AsSource, Filterable, Attachable;

    protected $with = [
        'templates'
    ];

    protected $fillable = [
        'name',
        'slug',
        'description',
        'posttype_id',
        'content'
    ];

    public function templates(): BelongsToMany
    {
        return $this->belongsToMany(Template::class);
    }

    public function posttype(): BelongsTo
    {
        return $this->belongsTo(Posttype::class);
    }
}
