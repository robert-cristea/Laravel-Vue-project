<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserConcessionaireRequest extends FormRequest
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
                    'phone' => 'required|numeric|min:10',
                    'fax' => 'required|string|max:200',
                    'reg_no' => 'required|string|max:255',
                    'website' => 'required|string|max:255',
                    'address' => 'required|string|max:255',
                    'person_in_charge' => 'required|string|max:255'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|max:255|unique:users,email,'.$this->segment(3),
                    'phone' => 'required|numeric|min:10',
                    'fax' => 'required|string|max:200',
                    'reg_no' => 'required|string|max:255',
                    'website' => 'required|string|max:255',
                    'address' => 'required|string|max:255',
                    'person_in_charge' => 'required|string|max:255'
                ];
            }
            default:break;
        }
    }
}
