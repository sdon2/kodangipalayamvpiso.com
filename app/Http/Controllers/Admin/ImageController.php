<?php

namespace App\Http\Controllers\Admin;

use App\Classes\ImageUploader;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function list()
    {
        try {
            $response = ImageUploader::list();
            return response($response);
        }
        catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    public function upload(Request $request)
    {
        try {
            $response = ImageUploader::upload('file');
            return response($response);
        }
        catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    public function delete()
    {
        try {
            ImageUploader::delete(request('data-name'));
            return response('Success');
        }
        catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
