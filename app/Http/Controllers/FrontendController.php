<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        return $this->page('home');
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        $slider = null;
        if ($page->slug == 'home')
        {
            $slider = Slider::query()->where('slider_id', 'main-slider')->first();
        }

        return view('page', ['page' => $page, 'slider' => $slider]);
    }
}
