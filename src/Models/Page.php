<?php

namespace JonasPardon\KamiCore\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\HtmlString;
use JonasPardon\KamiCore\Helpers\PageHelper;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model
{
    use SoftDeletes,
        HasSlug;

    protected $fillable = [
        'slug',
        'title',
        'body',
        'active',
        'publish_at',
        'publish_until',
        'lang',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getParsedBodyAttribute()
    {
        return PageHelper::parseToHtml($this);


        return;
    }

    public function blocks()
    {
        return $this->hasMany(Block::class);
    }
}
