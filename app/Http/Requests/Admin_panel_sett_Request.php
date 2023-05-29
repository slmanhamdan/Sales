<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Admin_panel_sett_Request extends FormRequest
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
            'system_name'=>'required',
            'address'=>'required' ,
        ];
    }
    public function messages()
    {
        return[
        'system_name.required'=>'The system_name is required',
        'address.required'=>'The address is required'];
    }
}
