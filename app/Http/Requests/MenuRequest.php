<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'page_description' => 'nullable|string',
            'page_title' => 'nullable|string|max:255',
        ];
    }
}
