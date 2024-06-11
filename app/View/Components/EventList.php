<?php

namespace App\View\Components;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Stevebauman\Hypertext\Transformer;

class EventList extends Component
{
    public $events = null;
    public $size = null;
    public $showPagination = false;

    public function __construct($size = 'col-md-12 col-sm-12', $itemsPerPage = 5, $showPagination = true)
    {
        $this->size = $size;
        $this->showPagination = $showPagination;

        $this->events = Event::recent($itemsPerPage);

        $this->transformCollection();
    }

    protected function transformCollection()
    {
        $transformer = new Transformer();

        $events = (function () use ($transformer) {
            return collect($this->events->items())
                ->transform(function ($entry) use ($transformer) {
                    $entry->content = Str::limit($transformer->toText($entry->content), 500);
                    return $entry;
                });
        })();

        $this->events->setCollection($events);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.event-list');
    }
}
