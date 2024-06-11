<?php

namespace App\View\Components;

use App\Models\ScrollText as ScrollTextModel;
use Illuminate\View\Component;

class ScrollText extends Component
{
    public $texts;

    public function __construct()
    {
        $this->texts = ScrollTextModel::query()
            ->latest('created_at')
            ->get(['scroll_text']);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.scroll-text');
    }
}
