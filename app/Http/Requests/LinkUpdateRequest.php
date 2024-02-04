<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkUpdateRequest extends FormRequest
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
            'url_key' => 'nullable|string|max:255|:' . config('link.table_names.links', 'links') . ',url_key' . $this->route('admin.shortlink.update', $this->id),
            'destination_url' => 'required|string|max:255|:' . config('link.table_names.links', 'links') . ',destination_url' . $this->route('admin.shortlink.update', $this->id),
        ];
    }
}
