<?php

namespace App\Http\Controllers;

use App\Mail\RegisterComplaint;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\Page;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

    public function complaint(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'phone' => ['required', 'size:10'],
            'message' => ['required', 'string', 'min:10'],
        ]);

        $data['content'] = $data['message'];

        unset($data['message']);

        if (Mail::send(new RegisterComplaint(['name' => 'Saravana', 'phone' => '9766123456', 'content' => '123456']))) {
            return(back()->with('success', 'Your complaint has been registered successfully. Our representative will contact you regarding your complaint.'));
        } else {
            return(back()->with('error', 'Oops! Sorry. Unable to register your complaint. Please try again later.'));
        }
    }
}
