<?php

namespace App\View\Composers;

use App\Models\Page;
use Illuminate\Contracts\View\View;

class MenuComposer
{
    public function compose(View $view)
    {
        $menu = Page::query()
            ->where('show_in_menu', true)
            ->orderBy('menu_order')
            ->get(['slug', 'title', 'menu_icon']);

        $view->with('menu', $menu);
    }
}
