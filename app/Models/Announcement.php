<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Announcement extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public const collectionName = "announcement-files";

    protected $guarded = [];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::collectionName)
            ->useDisk(self::collectionName)
            ->singleFile();
    }
}
