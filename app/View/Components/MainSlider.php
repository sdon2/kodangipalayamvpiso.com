<?php

namespace App\View\Components;

use App\Models\Slider;
use Illuminate\View\Component;

class MainSlider extends Component
{
    public $sliders;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $sliders = Slider::mainSlider();

        if (!$sliders) {
            $this->sliders = collect();
        } else {
            $sliders = collect($sliders->getMedia('sliders'))
                ->transform(function ($slider) {
                    return $slider->getUrl('sliders');
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
        return view('components.main-slider');
    }
}
