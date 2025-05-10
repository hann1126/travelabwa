<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePackageTourRequest extends FormRequest
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
            'name'=> ['required', 'sting', 'max:225'],
            'location'=> ['required', 'sting', 'max:225'],
            'thumbnail'=> ['required', 'image', 'mimes:png,jpg,jpeg'],
            'category_id'=> ['required', 'integer'],
            'price'=> ['required', 'integer'],
            'day'=> ['required', 'integer'],
            'about'=> ['required', 'sting', 'max:65535'],
            'pack_photos.*'=> ['required', 'image', 'mimes:png,jpg,jpeg']

        ];
    }
}
