<?php

namespace App\Http\Requests;

use Pearl\RequestValidate\RequestAbstract;

class TransactionRequest extends RequestAbstract
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'value' => 'required|numeric',
            'payer' => 'required|integer|exists:users,uuid|is_customer',
            'payee' => 'required|integer|exists:users,uuid|different:payer'
        ];
    }

    public function message()
    {
        return [
            'exists' => ":attribute provided doesn't not found",
            'payee.different' => "you can't make a transfer to same account"
        ];
    }
}
