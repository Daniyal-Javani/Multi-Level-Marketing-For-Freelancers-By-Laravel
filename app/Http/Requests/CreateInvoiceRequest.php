<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use Auth;

class CreateInvoiceRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $isAdmin = Auth::user()->admin;
        if($isAdmin !== null) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|min:3|username_check',
            'name' => 'required|min:3',
            'amount'  => 'required|numeric',
        ];
    }
}
