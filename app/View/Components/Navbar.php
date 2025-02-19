<?php

namespace App\View\Components;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class Navbar extends Component
{
    public $menu = [];

    public function __construct(Request $request)
    {
        $menu = Page::query()
            ->where('show_in_menu', true)
            ->orderBy('menu_order')
            ->get(['slug', 'title', 'menu_icon'])
            ->transform(function ($item) {
                $item->active = request()->url() === route('page', ['slug' => $item->slug]);
                if ($item->slug === 'home' && request()->url() === route('home')) {
                    $item->active = true;
                }
                return $item;
            });

        if (!auth()->user()) {
            $entry = Page::factory()->make([
                'slug' => 'login',
                'title' => 'Login',
                'menu_order' => Page::query()->count() + 1,
                'menu_icon' => 'fa fa-sign-in',
                'active' => false,
            ]);
        } else {
            $entry = Page::factory()->make([
                'slug' => 'dashboard',
                'title' => 'Go to Dashboard',
                'menu_order' => Page::query()->count() + 1,
                'menu_icon' => 'fa fa-sign-in',
                'active' => false,
            ]);
        }

        $menu->push($entry);

        $this->menu = $menu;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navbar');
    }
}
