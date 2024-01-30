<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLinkRequest extends FormRequest
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
            'url_key' => 'required|string|max:255|unique:' . config('link.table_names.links', 'links') . ',url_key',
            'destination_url' => 'required|string|max:255|unique:' . config('link.table_names.links', 'links') . ',destination_url',
            'generated_shortlink' => 'required|string|max:255|unique:' . config('link.table_names.links', 'links') . ',generated_shortlink',
        ];
    }
}
