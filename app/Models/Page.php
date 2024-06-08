<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model implements HasMedia
{
    use HasSlug, HasFactory, InteractsWithMedia;

    protected $guarded = [];

    protected $appends = [
        'featured_image'
    ];

    protected $featuredImageCollection = 'featured-images';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50)
            ->usingSeparator('-');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection($this->featuredImageCollection)
            ->useDisk('public')
            ->acceptsMimeTypes(['image/jpeg', 'image/jpg', 'image/png'])
            ->singleFile();
    }

    public function getFeaturedImageAttribute()
    {
        $media = $this->getMedia($this->featuredImageCollection)
            ->first();

        if ($media) {
            return $media->getUrl();
        }

        return null;
    }
}
