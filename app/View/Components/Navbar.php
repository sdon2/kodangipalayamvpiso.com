<?php

namespace App\View\Components;

use App\Models\Page;
use Illuminate\View\Component;

class Navbar extends Component
{
    protected $menu = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $menu = Page::query()
            ->where('show_in_menu', true)
            ->orderBy('menu_order')
            ->get(['slug', 'title', 'menu_icon']);

        $login = Page::factory()->make([
            'slug' => 'login',
            'title' => 'Login',
            'menu_order' => Page::query()->count() + 1,
            'menu_icon' => 'fa fa-sign-in',
        ]);

        $menu->push($login);

        $this->menu = collect($menu);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navbar', ['menu' => $this->menu]);
    }
}
