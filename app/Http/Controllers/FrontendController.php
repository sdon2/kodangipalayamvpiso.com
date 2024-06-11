<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Event;
use App\Models\Page;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    public function home()
    {
        return $this->page('home');
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        if (View::exists('pages.' . $page->slug)) {
            return view('pages.' . $page->slug, ['page' => $page]);
        } else {
            return view('page', ['page' => $page]);
        }
    }

    public function announcement($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('announcement', ['announcement' => $announcement]);
    }

    public function event($id)
    {
        $event = Event::findOrFail($id);
        return view('event', ['event' => $event]);
    }
}
