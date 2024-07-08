<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOperativeRequest extends FormRequest
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
            'first_name' => ['required','min:3','max:50'],
            'surname' => ['required','min:3','max:50'],
            'phone' => 'required',
            // 'address2' => ['required'],
            'town' => ['required',],
            'city' => ['required',],
            // 'post_code' => 'required', 'min:1', 'max:7',
            'post_code' =>  'required',

        ];
    }
}
