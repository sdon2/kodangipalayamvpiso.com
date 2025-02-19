<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventAddRequest extends FormRequest
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
            'event_date' => ['required'],
            'title' => ['required'],
            'content' => ['required'],
            'event_images' => ['nullable','array'],
            'event_images.*' => ['required', 'file', 'mimes:png,jpg']
        ];
    }
}
