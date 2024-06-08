<?php

namespace App\View\Composers;

use App\Models\Slider;
use Illuminate\Contracts\View\View;

class MainSliderComposer
{
    public function compose(View $view)
    {
        $sliders = Slider::query()
            ->where('slider_id', 'main-slider')
            ->first();

        if (!$sliders) return collect([]);

        $sliders = collect($sliders->getMedia('sliders'))->transform(function ($slider) {
            return $slider->getUrl();
        })
        ->transform(function ($url) {
            return str_replace('http://localhost/', 'http://localhost:8000/', $url);
        });

        $view->with('sliders', $sliders);
    }
}
