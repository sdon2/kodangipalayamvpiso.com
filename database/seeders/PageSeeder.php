<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Page::factory()->create([
            'title' => 'Home',
            'show_in_menu' => true,
            'menu_order' => 1,
            'menu_icon' => 'fa fa-home',
        ]);

        \App\Models\Page::factory(4)->create();
    }
}
