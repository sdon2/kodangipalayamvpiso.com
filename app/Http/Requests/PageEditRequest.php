<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required'],
            'keywords' => ['nullable'],
            'description' => ['nullable'],
            'content' => ['required'],
            'show_in_menu' => ['required', 'boolean'],
            'featured_image' => ['nullable'],
            'menu_order' => ['required_if:show_in_menu,true'],
            'menu_icon' => ['nullable'],
        ];
    }
}
