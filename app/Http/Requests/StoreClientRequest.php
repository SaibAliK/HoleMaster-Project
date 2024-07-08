<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name'      => ['required', 'min:3', 'max:50'],
            'contact' => 'required',
            'phone'   => 'required',
            'address1'  => ['required'],
            // 'address2'  => ['required'], 
            'town'      => ['required'],
            'city'      => ['required'],
            // 'post_code' =>  'required|min:1|max:8',
            'post_code' =>  'required',

        ];
    }
}
