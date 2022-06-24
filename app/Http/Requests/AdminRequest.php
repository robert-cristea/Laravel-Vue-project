<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        switch($this->method())
        {
            case 'POST':
            {
                return [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|max:255|unique:users',
                    'password' => 'required|string|min:8',
                    'department' => 'required|string|max:255'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|max:255|unique:users,email,'.$this->segment(3),
                    'department' => 'required|string|max:255'
                ];
            }
            default:break;
        }
    }
}
