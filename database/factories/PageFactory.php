<?php

namespace Database\Factories;

use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(1),
            'language' => 'en',
            'content' => $this->faker->sentence(150),
            'show_in_menu' => true,
            'menu_order' => Page::query()->count() + 1,
            'menu_icon' => 'fa fa-' . $this->faker->randomElement(['address-book', 'address-card', 'adjust', 'archive', 'bar-chart', 'book', 'bookmark', 'calendar-check-o']),
            'user_id' => User::query()->findOrFail(1)->id,
            'created_at' => $this->faker->dateTimeBetween('-7 Days'),
        ];
    }
}
