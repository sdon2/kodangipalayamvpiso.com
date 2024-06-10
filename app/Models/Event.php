<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Event extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public const collectionName = 'event-images';

    protected $guarded = [];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::collectionName)
            ->useDisk(self::collectionName)
            ->acceptsMimeTypes(['image/jpeg', 'image/jpg', 'image/png'])
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion(self::collectionName)
            ->crop('crop-center', 1200, 500);
    }
}
