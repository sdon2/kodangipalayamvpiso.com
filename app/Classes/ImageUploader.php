<?php

namespace App\Classes;

use Exception;
use Illuminate\Support\Facades\Storage;

class ImageUploader
{
    private static $disk = 'image-uploads';

    public static function list()
    {
        if ($files = Storage::disk(self::$disk)->files()) {
            $result = [];
            foreach ($files as $file) {
                if (!in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png'])) {
                    continue;
                }
                $url = Storage::disk(self::$disk)->url($file);
                $result[] = [
                    'url' => $url,
                    'thumb' => $url,
                    'name' => $file,
                ];
            }

            return $result;
        }
        else {
            throw new Exception('Unable to upload file');
        }
    }

    public static function upload(string $file_field_name)
    {
        if ($path = request()->file($file_field_name)->store(self::$disk)) {
            $url = asset($path);
            return ['link' => $url];
        }
        else {
            throw new Exception('Unable to upload file');
        }
    }

    public static function delete(string $file_name)
    {
        if (Storage::disk(self::$disk)->exists($file_name)) {
            return Storage::disk(self::$disk)->delete($file_name);
        }

        return true;
    }
}
