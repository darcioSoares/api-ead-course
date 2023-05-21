<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreReplySupport extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        // dd($this->description);
        return [
            // 'description' => [ Rule::in($this->description),'min:3']
            // 'support' => ['required', 'exists:supports,id']
        ];
        //observação
        //'support_id' => ['required', 'exists:reply_support,support_id'],
    }
}
