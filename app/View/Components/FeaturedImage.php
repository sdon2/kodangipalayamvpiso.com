<?php

namespace App\View\Components;

use App\Models\Page;
use Illuminate\View\Component;

class FeaturedImage extends Component
{
    public $featured_image;

    public function __construct()
    {
        $slug = request('slug') ?? 'home';

        $page = Page::query()->where('slug', $slug)->first();

        if ($page && $page->hasMedia('featured-images')) {
            $this->featured_image = $page->getFirstMedia('featured-images')->getUrl('featured-images');
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.featured-image');
    }
}
