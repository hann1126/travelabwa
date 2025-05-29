<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdatePackageTourRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name'=> ['required', 'string', 'max:225'],
            'location'=> ['required', 'string', 'max:225'],
            'thumbnail'=> ['sometimes', 'image', 'mimes:png,jpg,jpeg'],
            'category_id'=> ['required', 'integer'],
            'price'=> ['required', 'integer'],
            'day'=> ['required', 'integer'],
            'about'=> ['required', 'string', 'max:65535'],
            'package_photos.*'=> ['sometimes', 'image', 'mimes:png,jpg,jpeg'],
             'slug' => [
            Rule::unique('package_tours', 'slug')->ignore($this->route('package_tour')->id),
        ],

        ];
    }
}
