<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Slider extends Model implements HasMedia
{
    use HasFactory, HasSlug, InteractsWithMedia;

    protected $guarded = [];

    public const collectionName = 'sliders';

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('slider_name')
            ->saveSlugsTo('slider_id')
            ->slugsShouldBeNoLongerThan(15)
            ->usingSeparator('-');
    }

    public function getRouteKeyName()
    {
        return 'slider_id';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::collectionName)
            ->useDisk(self::collectionName)
            ->acceptsMimeTypes(['image/jpeg', 'image/jpg', 'image/png']);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion(self::collectionName)
            ->crop('crop-center', 1200, 500);
    }
}
