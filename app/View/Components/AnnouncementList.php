<?php

namespace App\View\Components;

use App\Models\Announcement;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Stevebauman\Hypertext\Transformer;

class AnnouncementList extends Component
{
    private $announcements = null;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $transformer = new Transformer();

        $this->announcements = Announcement::query()
            ->orderByDesc('created_at')
            ->get()
            ->transform(function ($entry) use ($transformer) {
                $entry->content = Str::limit($transformer->toText($entry->content), 500);
                return $entry;
            });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.announcement-list', ['announcements' => $this->announcements]);
    }
}
