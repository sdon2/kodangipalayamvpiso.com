<?php

namespace App\View\Components;

use App\Models\Event;
use Illuminate\View\Component;

class EventSlider extends Component
{
    public $sliders;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Event $event)
    {
        if (!$event) {
            $this->sliders = collect();
        } else {
            $sliders = collect($event->getMedia('event-images'))
                ->transform(function ($slider) {
                    return $slider->getUrl('event-images');
                });

            $this->sliders = $sliders;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.event-slider');
    }
}
