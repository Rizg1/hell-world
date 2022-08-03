<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientsRequest extends FormRequest
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
        return [
            'folder_id' => 'required|bail',
            'kyc_form' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'folder_id' => 'The Company field is required',
            'kyc_form.required' => 'The Know Your Customer(KYC) field is required',
        ];
    }
}
